<?php

namespace App\Repositories\Eloquent;

use App\Models\Peralatan;
use App\Repositories\Contracts\PeralatanRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PeralatanRepository extends BaseRepository implements PeralatanRepositoryInterface
{
    public function __construct(Peralatan $model)
    {
        parent::__construct($model);
    }

    /**
     * Find peralatan by category
     */
    public function findByCategory(string $category): Collection
    {
        return $this->findBy('kategori', $category);
    }

    /**
     * Find available peralatan (with stock and in good condition)
     */
    public function findAvailable(): Collection
    {
        return $this->query()
            ->where('stok_total', '>', 0)
            ->where('kondisi', 'baik')
            ->get();
    }

    /**
     * Update stock
     */
    public function updateStock(int $id, int $stockChange): bool
    {
        $peralatan = $this->findOrFail($id);
        $newStock = $peralatan->stok_total + $stockChange;

        // Ensure stock doesn't go below 0
        if ($newStock < 0) {
            $newStock = 0;
        }

        return $this->update($id, ['stok_total' => $newStock]);
    }

    /**
     * Get total stock count
     */
    public function getTotalStock(): int
    {
        return (int) $this->query()->sum('stok_total');
    }

    /**
     * Get available stock count (good condition only)
     */
    public function getAvailableStock(): int
    {
        $totalStock = (int) $this->query()
            ->where('kondisi', 'baik')
            ->sum('stok_total');

        // Calculate rented stock (active bookings today)
        $rentedStock = \App\Models\BookingItem::whereHas('booking', function ($query) {
            $query->whereNotIn('status', ['cancelled', 'rejected', 'completed'])
                ->whereDate('tanggal_check_in', '<=', now())
                ->whereDate('tanggal_check_out', '>=', now());
        })->sum('jumlah');

        return max(0, $totalStock - $rentedStock);
    }
}
