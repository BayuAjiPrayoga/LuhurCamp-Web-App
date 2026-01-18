<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreKavlingRequest;
use App\Http\Requests\Admin\UpdateKavlingRequest;
use App\Models\Kavling;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KavlingController extends Controller
{

    /**
     * Display a listing of kavlings
     */
    public function index(Request $request)
    {
        $kavlings = Kavling::query()
            ->when($request->search, fn($q, $v) => $q->where('nama', 'like', "%{$v}%"))
            ->when($request->status, fn($q, $v) => $q->where('status', $v))
            ->withExists([
                'bookings as is_occupied' => function ($q) {
                    $q->whereIn('status', ['pending', 'waiting_confirmation', 'confirmed', 'checked_in'])
                        ->whereDate('tanggal_check_in', '<=', now())
                        ->whereDate('tanggal_check_out', '>=', now());
                }
            ])
            ->latest()
            ->paginate(10);

        return view('admin.kavling.index', compact('kavlings'));
    }

    /**
     * Show the form for creating a new kavling
     */
    public function create()
    {
        return view('admin.kavling.create');
    }

    /**
     * Store a newly created kavling
     */
    public function store(Request $request)
    {
        // Manual validation instead of StoreKavlingRequest (which was causing 500 error)
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1|max:20',
            'harga_per_malam' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string|max:1000',
            'status' => 'nullable|in:aktif,nonaktif,penuh,maintenance',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Generate unique slug
        $baseSlug = Str::slug($validated['nama']);
        $slug = $baseSlug;
        $counter = 1;

        while (Kavling::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $validated['slug'] = $slug;
        $validated['status'] = $validated['status'] ?? 'aktif';

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('kavlings', 'public');
        }

        Kavling::create($validated);

        return redirect()->route('admin.kavling.index')
            ->with('success', 'Kavling berhasil ditambahkan.');
    }

    /**
     * Show the form for editing a kavling
     */
    public function edit(Kavling $kavling)
    {
        return view('admin.kavling.edit', compact('kavling'));
    }

    /**
     * Update the specified kavling
     */
    public function update(UpdateKavlingRequest $request, Kavling $kavling)
    {
        $data = $request->validated();

        if ($kavling->nama !== $data['nama']) {
            // Generate unique slug
            $baseSlug = Str::slug($data['nama']);
            $slug = $baseSlug;
            $counter = 1;

            while (Kavling::where('slug', $slug)->where('id', '!=', $kavling->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $data['slug'] = $slug;
        }

        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($kavling->gambar) {
                \Storage::disk('public')->delete($kavling->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('kavlings', 'public');
        }

        // Use Eloquent directly instead of repository
        $kavling->update($data);

        return redirect()->route('admin.kavling.index')
            ->with('success', 'Kavling berhasil diperbarui.');
    }

    /**
     * Remove the specified kavling
     */
    public function destroy(Kavling $kavling)
    {
        // Delete associated image if exists
        if ($kavling->gambar) {
            \Storage::disk('public')->delete($kavling->gambar);
        }

        // Use Eloquent directly instead of repository
        $kavling->delete();

        return redirect()->route('admin.kavling.index')
            ->with('success', 'Kavling berhasil dihapus.');
    }
}
