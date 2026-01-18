<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KavlingController;
use App\Http\Controllers\Admin\PeralatanController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', function () {
    return view('landing');
})->name('home');



// Auth Routes
Route::get('/fix-storage', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return 'Storage link has been created. Check your images now. <a href="/admin/galeri">Go back</a>';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
Route::get('/debug-php', function () {
    return [
        'post_max_size' => ini_get('post_max_size'),
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        'memory_limit' => ini_get('memory_limit'),
    ];
});

// Debug route to check file state on server
Route::get('/debug-kavling', function () {
    $filePath = app_path('Http/Controllers/Admin/KavlingController.php');
    $content = file_get_contents($filePath);

    // Check if constructor exists
    $hasConstructor = str_contains($content, '__construct');
    $hasRepository = str_contains($content, 'KavlingRepositoryInterface');

    // Try to instantiate the controller
    $instantiateResult = 'Not tested';
    try {
        $controller = app(\App\Http\Controllers\Admin\KavlingController::class);
        $instantiateResult = 'SUCCESS - Controller instantiated';
    } catch (\Exception $e) {
        $instantiateResult = 'FAILED: ' . $e->getMessage();
    }

    return response()->json([
        'file_exists' => file_exists($filePath),
        'file_modified' => date('Y-m-d H:i:s', filemtime($filePath)),
        'has_constructor' => $hasConstructor,
        'has_repository_interface' => $hasRepository,
        'controller_instantiate' => $instantiateResult,
        'first_50_chars' => substr($content, 0, 500),
        'opcache_enabled' => function_exists('opcache_get_status') ? opcache_get_status() !== false : 'N/A',
    ]);
});

// Debug route to test store process
Route::get('/debug-store', function () {
    $results = [];

    // 1. Test Database Connection
    try {
        \DB::connection()->getPdo();
        $results['db_connection'] = 'SUCCESS';
    } catch (\Exception $e) {
        $results['db_connection'] = 'FAILED: ' . $e->getMessage();
    }

    // 2. Test Kavling Model count
    try {
        $count = \App\Models\Kavling::count();
        $results['kavling_count'] = 'SUCCESS - Count: ' . $count;
    } catch (\Exception $e) {
        $results['kavling_count'] = 'FAILED: ' . $e->getMessage();
    }

    // 3. Test Kavling::create with dummy data
    try {
        $testData = [
            'nama' => 'Test Kavling ' . time(),
            'slug' => 'test-kavling-' . time(),
            'kapasitas' => 4,
            'harga_per_malam' => 150000,
            'deskripsi' => 'Test deskripsi',
            'status' => 'aktif',
        ];
        $kavling = \App\Models\Kavling::create($testData);
        $results['kavling_create'] = 'SUCCESS - Created ID: ' . $kavling->id;

        // Clean up
        $kavling->forceDelete();
        $results['kavling_cleanup'] = 'Deleted test data';
    } catch (\Exception $e) {
        $results['kavling_create'] = 'FAILED: ' . $e->getMessage();
    }

    // 4. Check storage
    try {
        $storagePath = storage_path('app/public/kavlings');
        $results['storage_exists'] = file_exists($storagePath) ? 'YES' : 'NO';
        $results['storage_writable'] = is_writable(storage_path('app/public')) ? 'YES' : 'NO';
    } catch (\Exception $e) {
        $results['storage'] = 'FAILED: ' . $e->getMessage();
    }

    return response()->json($results);
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::resource('kavling', KavlingController::class);
    Route::resource('peralatan', PeralatanController::class);

    // Transaksi
    Route::get('/booking/export', [BookingController::class, 'export'])->name('booking.export');
    Route::get('/booking/scan', [BookingController::class, 'scanPage'])->name('booking.scan');
    Route::post('/booking/scan', [BookingController::class, 'scanAction'])->name('booking.scan-action');

    Route::delete('/booking/bulk-destroy', [BookingController::class, 'bulkDestroy'])->name('booking.bulk-destroy');
    Route::resource('booking', BookingController::class)->only(['index', 'show', 'destroy']);
    Route::post('/booking/{booking}/check-in', [BookingController::class, 'checkIn'])->name('booking.check-in');
    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
    Route::post('/verifikasi/{booking}/confirm', [VerifikasiController::class, 'confirm'])->name('verifikasi.confirm');
    Route::post('/verifikasi/{booking}/reject', [VerifikasiController::class, 'reject'])->name('verifikasi.reject');

    // Galeri
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::post('/galeri/bulk-approve', [GaleriController::class, 'bulkApprove'])->name('galeri.bulk-approve');
    Route::post('/galeri/bulk-reject', [GaleriController::class, 'bulkReject'])->name('galeri.bulk-reject');
    Route::post('/galeri/bulk-destroy', [GaleriController::class, 'bulkDestroy'])->name('galeri.bulk-destroy');
    Route::post('/galeri/{gallery}/approve', [GaleriController::class, 'approve'])->name('galeri.approve');
    Route::post('/galeri/{gallery}/reject', [GaleriController::class, 'reject'])->name('galeri.reject');
    Route::delete('/galeri/{gallery}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');

    // Pengaturan
    Route::resource('pengumuman', PengumumanController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');
});
