<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Exports\BookingExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings
     */
    public function index(Request $request)
    {
        $bookings = Booking::with(['user', 'kavling'])
            ->when($request->status, fn($q, $status) => $q->where('status', $status))
            ->when(
                $request->search,
                fn($q, $search) =>
                $q->where(function ($query) use ($search) {
                    $query->where('code', 'like', "%{$search}%")
                        ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%{$search}%"));
                })
            )
            ->when($request->date_from, fn($q, $date) => $q->whereDate('tanggal_check_in', '>=', $date))
            ->when($request->date_to, fn($q, $date) => $q->whereDate('tanggal_check_out', '<=', $date))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.booking.index', compact('bookings'));
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return back()->with('success', 'Booking berhasil dihapus.');
    }

    /**
     * Remove multiple bookings from storage.
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|string',
        ]);

        $ids = explode(',', $request->ids);

        Booking::whereIn('id', $ids)->delete();

        return back()->with('success', count($ids) . ' Booking berhasil dihapus.');
    }

    /**
     * Export filtered bookings to Excel
     */
    public function show($id)
    {
        $booking = Booking::with(['user', 'kavling', 'items.peralatan'])->findOrFail($id);

        return view('admin.booking.show', compact('booking'));
    }

    /**
     * Export filtered bookings to Excel
     */
    public function export(Request $request)
    {
        $filename = 'booking-' . date('Y-m-d-His') . '.xlsx';

        return Excel::download(
            new BookingExport($request->all()),
            $filename
        );
    }

    /**
     * Mark booking as checked in
     */
    public function checkIn(Booking $booking)
    {
        if (!in_array($booking->status, ['confirmed', 'paid'])) {
            return back()->with('error', 'Booking tidak dalam status yang valid untuk Check-in.');
        }

        $booking->update([
            'status' => 'checked_in',
        ]);

        return back()->with('success', 'Berhasil Check-in tamu.');
    }

    public function scanPage()
    {
        return view('admin.booking.scan');
    }

    /**
     * Handle Scan Action (Check-In / Check-Out)
     */
    public function scanAction(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:bookings,code',
        ]);

        $booking = Booking::with(['user', 'kavling', 'items.peralatan'])->where('code', $request->code)->first();

        if (!$booking) {
            return response()->json([
                'status' => 'error',
                'message' => 'Booking tidak ditemukan.',
            ], 404);
        }

        try {
            DB::beginTransaction();

            // Scenario 1: Check-In (Status: Confirmed/Paid => Checked In)
            if (in_array($booking->status, ['confirmed', 'paid'])) {

                // Update Inventory (Decrease)
                $this->updateInventory($booking, false);

                $booking->update([
                    'status' => 'checked_in',
                    'tanggal_check_in' => now(), // Record actual check-in time
                ]);

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Check-in Berhasil! Stok peralatan telah dikurangi.',
                    'action' => 'check_in',
                    'booking' => $booking->load('user', 'kavling')
                ]);
            }

            // Scenario 2: Check-Out (Status: Checked In => Completed)
            elseif ($booking->status === 'checked_in') {

                // Update Inventory (Increase/Restore)
                $this->updateInventory($booking, true);

                $booking->update([
                    'status' => 'completed',
                    'tanggal_check_out' => now(), // Record actual check-out time
                ]);

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Check-out Berhasil! Stok peralatan telah dikembalikan.',
                    'action' => 'check_out',
                    'booking' => $booking->load('user', 'kavling')
                ]);
            }

            // Scenario 3: Already Completed
            elseif ($booking->status === 'completed') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Booking ini sudah selesai (Completed).',
                    'booking' => $booking->load('user', 'kavling')
                ], 400);
            }

            // Scenario 4: Other Status
            else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Status booking tidak valid untuk scan: ' . ucfirst($booking->status),
                    'booking' => $booking->load('user', 'kavling')
                ], 400);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Helper to update inventory stock
     * @param Booking $booking
     * @param bool $increment (true = add stock, false = reduce stock)
     */
    private function updateInventory(Booking $booking, bool $increment)
    {
        foreach ($booking->items as $item) {
            $peralatan = $item->peralatan;
            if ($peralatan) {
                if ($increment) {
                    $peralatan->increment('stok_tersedia', $item->jumlah);
                } else {
                    // Check if stock is sufficient before reducing
                    if ($peralatan->stok_tersedia < $item->jumlah) {
                        throw new \Exception("Stok {$peralatan->nama} tidak mencukupi! (Tersedia: {$peralatan->stok_tersedia}, Butuh: {$item->jumlah})");
                    }
                    $peralatan->decrement('stok_tersedia', $item->jumlah);
                }
            }
        }
    }
}
