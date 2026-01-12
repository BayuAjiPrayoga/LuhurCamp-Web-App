<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kavling;
use Illuminate\Http\Request;

class KavlingController extends Controller
{
    /**
     * List all active kavlings
     */
    /**
     * List all active kavlings
     */
    public function index(Request $request)
    {
        $query = Kavling::where('status', 'aktif')
            ->when($request->kapasitas_min, fn($q, $v) => $q->where('kapasitas', '>=', $v))
            ->when($request->kapasitas_max, fn($q, $v) => $q->where('kapasitas', '<=', $v))
            ->when($request->harga_max, fn($q, $v) => $q->where('harga_per_malam', '<=', $v));

        // Remove hard filter, instead calculate availability
        $kavlings = $query->orderBy('nama')->get();

        // Calculate availability
        $kavlings->each(function ($kavling) use ($request) {
            $checkIn = $request->check_in ?? now()->format('Y-m-d');
            $checkOut = $request->check_out ?? now()->addDay()->format('Y-m-d');

            $conflicting = $kavling->bookings()
                ->whereIn('status', ['pending', 'waiting_confirmation', 'confirmed', 'checked_in'])
                ->where(function ($q) use ($checkIn, $checkOut) {
                    $q->whereBetween('tanggal_check_in', [$checkIn, $checkOut])
                        ->orWhereBetween('tanggal_check_out', [$checkIn, $checkOut])
                        ->orWhere(function ($overlapQ) use ($checkIn, $checkOut) {
                            $overlapQ->where('tanggal_check_in', '<=', $checkIn)
                                ->where('tanggal_check_out', '>=', $checkOut);
                        });
                })
                ->exists();

            $kavling->setAttribute('is_available', !$conflicting);
        });

        return response()->json([
            'success' => true,
            'data' => $kavlings,
        ]);
    }

    /**
     * Get kavling detail with availability check
     */
    public function show(Request $request, Kavling $kavling)
    {
        // Check availability
        $checkIn = $request->check_in ?? now()->format('Y-m-d');
        $checkOut = $request->check_out ?? now()->addDay()->format('Y-m-d');

        $conflicting = $kavling->bookings()
            ->whereIn('status', ['pending', 'waiting_confirmation', 'confirmed', 'checked_in'])
            ->where(function ($q) use ($checkIn, $checkOut) {
                $q->whereBetween('tanggal_check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('tanggal_check_out', [$checkIn, $checkOut])
                    ->orWhere(function ($q) use ($checkIn, $checkOut) {
                        $q->where('tanggal_check_in', '<=', $checkIn)
                            ->where('tanggal_check_out', '>=', $checkOut);
                    });
            })
            ->exists();

        $isAvailable = !$conflicting;

        return response()->json([
            'success' => true,
            'data' => [
                'kavling' => $kavling,
                'is_available' => $isAvailable,
            ],
        ]);
    }
}
