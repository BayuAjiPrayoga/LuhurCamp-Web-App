<x-layouts.admin title="Daftar Booking">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Daftar Booking</h2>
            <p class="text-sm text-gray-500">Lihat semua pesanan yang masuk</p>
        </div>
        <div class="flex items-center gap-2">
            <x-ui.button variant="primary" size="sm" href="{{ route('admin.booking.scan') }}">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                </svg>
                Scan QR Code
            </x-ui.button>

            <x-ui.button variant="outline" size="sm" href="{{ route('admin.booking.export', request()->all()) }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export
            </x-ui.button>
        </div>
    </div>

    <!-- Filters -->
    <x-ui.card class="mb-6">
        <form method="GET" action="{{ route('admin.booking.index') }}">
            <div class="flex flex-col lg:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode booking atau nama customer..." class="form-input pl-10">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
                <select name="status" class="form-select w-full lg:w-40">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="checked_in" {{ request('status') === 'checked_in' ? 'selected' : '' }}>Checked In</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                <div class="flex items-center gap-2">
                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-input">
                    <span class="text-gray-400">-</span>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-input">
                </div>
                <x-ui.button type="submit" variant="primary">Filter</x-ui.button>
                @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                    <x-ui.button type="button" variant="ghost" href="{{ route('admin.booking.index') }}">Reset</x-ui.button>
                @endif
            </div>
        </form>
    </x-ui.card>

    <!-- Status Legend -->
    <div class="flex flex-wrap items-center gap-4 mb-4 text-sm">
        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-yellow-500"></span> Pending</span>
        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-green-500"></span> Dikonfirmasi</span>
        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-gray-500"></span> Selesai</span>
        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-red-500"></span> Ditolak/Dibatalkan</span>
    </div>

    <!-- Bulk Actions -->
    <div id="bulk-actions" class="hidden mb-4 bg-red-50 p-3 rounded-lg flex items-center justify-between border border-red-100">
        <div class="flex items-center gap-2 text-red-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            <span class="font-medium"><span id="selected-count">0</span> booking dipilih</span>
        </div>
        <form id="bulk-delete-form" action="{{ route('admin.booking.bulk-destroy') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking yang dipilih? Data tidak dapat dikembalikan.')">
            @csrf
            @method('DELETE')
            <input type="hidden" name="ids" id="bulk-delete-ids">
            <button type="submit" class="text-sm bg-red-600 text-white px-3 py-1.5 rounded hover:bg-red-700 transition font-medium">
                Hapus Semua
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="w-4">
                        <input type="checkbox" id="select-all" class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                    </th>
                    <th>Kode</th>
                    <th>Customer</th>
                    <th>Tanggal Camp</th>
                    <th>Kavling</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings ?? [] as $booking)
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_bookings[]" value="{{ $booking->id }}" class="booking-checkbox rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        </td>
                        <td class="font-mono font-medium">{{ $booking->code }}</td>
                        <td>
                            <div>
                                <p class="font-medium">{{ $booking->user->name ?? 'Guest' }}</p>
                                <p class="text-xs text-gray-500">{{ $booking->user->email ?? '-' }}</p>
                            </div>
                        </td>
                        <td>{{ $booking->tanggal_check_in?->format('d M') }} - {{ $booking->tanggal_check_out?->format('d M Y') }}</td>
                        <td>{{ $booking->kavling->nama ?? '-' }}</td>
                        <td class="font-semibold">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @switch($booking->status)
                                @case('pending')
                                    <x-ui.badge variant="warning">Pending</x-ui.badge>
                                    @break
                                @case('paid')
                                @case('confirmed')
                                    <x-ui.badge variant="success">Dikonfirmasi</x-ui.badge>
                                    @break
                                @case('checked_in')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        Checked In
                                    </span>
                                    @break
                                @case('cancelled')
                                    <x-ui.badge variant="error">Dibatalkan</x-ui.badge>
                                    @break
                                @default
                                    <x-ui.badge variant="neutral">{{ ucfirst($booking->status) }}</x-ui.badge>
                            @endswitch
                        </td>
                        <td>
                            <div class="flex items-center gap-2 mt-2 sm:mt-0">
                                <a href="{{ route('admin.booking.show', $booking) }}" class="btn btn-ghost btn-sm" title="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                @if(in_array($booking->status, ['confirmed', 'paid']))
                                    <form action="{{ route('admin.booking.check-in', $booking) }}" method="POST" class="inline" onsubmit="return confirm('Check-in tamu ini?')">
                                        @csrf
                                        <button type="submit" class="btn btn-ghost btn-sm text-purple-600 hover:bg-purple-50" title="Check In">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.booking.destroy', $booking) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus history booking ini? Data yang dihapus tidak dapat dikembalikan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm text-red-600 hover:bg-red-50" title="Hapus Booking">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-12">
                            <div class="flex flex-col items-center">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada booking</h3>
                                <p class="text-sm text-gray-500">Booking dari customer akan muncul di sini</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.booking-checkbox');
            const bulkActions = document.getElementById('bulk-actions');
            const selectedCount = document.getElementById('selected-count');
            const bulkDeleteIds = document.getElementById('bulk-delete-ids');

            function updateBulkActions() {
                const selected = Array.from(checkboxes).filter(cb => cb.checked);
                if (selected.length > 0) {
                    bulkActions.classList.remove('hidden');
                    selectedCount.textContent = selected.length;
                    bulkDeleteIds.value = selected.map(cb => cb.value).join(',');
                } else {
                    bulkActions.classList.add('hidden');
                }
            }

            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = selectAll.checked);
                updateBulkActions();
            });

            checkboxes.forEach(cb => {
                cb.addEventListener('change', updateBulkActions);
            });
        });
    </script>
    @endpush
    </div>

    <!-- Pagination -->
    @if(isset($bookings) && $bookings->hasPages())
        <div class="mt-6">
            {{ $bookings->links() }}
        </div>
    @endif

    <!-- Detail Modal -->
    <x-ui.modal id="modal-detail" title="Detail Booking" size="lg">
        <div class="space-y-6">
            <!-- Booking Info -->
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-500">Kode Booking</p>
                    <p class="text-xl font-bold font-mono text-primary-600">BK-2024001</p>
                </div>
                <x-ui.badge variant="warning">🟡 Pending</x-ui.badge>
            </div>

            <hr>

            <!-- Customer Info -->
            <div>
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Informasi Customer</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Nama</p>
                        <p class="font-medium">John Doe</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Email</p>
                        <p class="font-medium">john@gmail.com</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Telepon</p>
                        <p class="font-medium">+62 812-3456-7890</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Jumlah Orang</p>
                        <p class="font-medium">4 Orang</p>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Booking Details -->
            <div>
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Detail Pesanan</h4>
                <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kavling A1 (2 malam)</span>
                        <span class="font-medium">Rp 300.000</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tenda Dome 4P x 1</span>
                        <span class="font-medium">Rp 150.000</span>
                    </div>
                    <hr>
                    <div class="flex justify-between text-lg font-semibold">
                        <span>Total</span>
                        <span class="text-primary-600">Rp 450.000</span>
                    </div>
                </div>
            </div>

            <!-- Payment Proof -->
            <div>
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Bukti Pembayaran</h4>
                <div class="bg-gray-100 rounded-lg p-8 text-center">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-gray-500">Belum ada bukti pembayaran</p>
                </div>
            </div>
        </div>

        <x-slot name="footer">
            <x-ui.button type="button" variant="ghost" onclick="closeModal('modal-detail')">Tutup</x-ui.button>
        </x-slot>
    </x-ui.modal>
</x-layouts.admin>
