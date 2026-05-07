<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IkanController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Teknisi\DashboardController as TeknisiDashboard;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\LaporanController;

// ===================== PUBLIC =====================
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Google Auth Routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// ── Wilayah API (proxy ke ibnux, public) ──────────────
Route::prefix('api/wilayah')->name('wilayah.')->group(function () {
    Route::get('/provinsi',          [WilayahController::class, 'getProvinces'])->name('provinsi');
    Route::get('/kabupaten/{id}',    [WilayahController::class, 'getCities'])->name('kabupaten');
    Route::get('/kecamatan/{id}',    [WilayahController::class, 'getDistricts'])->name('kecamatan');
    Route::get('/kelurahan/{id}',    [WilayahController::class, 'getVillages'])->name('kelurahan');
});

// ===================== REDIRECT SETELAH LOGIN =====================
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    return match($role) {
        'admin'    => redirect()->route('admin.dashboard'),
        'teknisi'  => redirect()->route('teknisi.dashboard'),
        default    => redirect()->route('user.dashboard'),
    };
})->middleware('auth')->name('dashboard');

// ===================== ADMIN =====================
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {

    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Laporan
    Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
    Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');

    // Manajemen data (hanya admin)
    Route::resource('layanan', LayananController::class);
    Route::resource('teknisi', TeknisiController::class);

    // Admin bisa lihat semua booking & pembayaran
    Route::resource('booking', BookingController::class)->only(['index', 'destroy']);
});

// ===================== USER =====================
Route::prefix('user')
    ->middleware(['auth', 'role:user'])
    ->name('user.')
    ->group(function () {

    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');

    // Manajemen ikan milik sendiri
    Route::resource('ikan', IkanController::class);

    // Booking
    Route::resource('booking', BookingController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::patch('/booking/{booking}/selesai', [UserDashboard::class, 'markSelesai'])->name('booking.mark-selesai');

    // Pembayaran
    Route::get('/bayar/{booking_id}', [PembayaranController::class, 'bayar'])->name('bayar');
});

// ===================== TEKNISI =====================
Route::prefix('teknisi-area')
    ->middleware(['auth', 'role:teknisi'])
    ->name('teknisi.')
    ->group(function () {

    Route::get('/dashboard', [TeknisiDashboard::class, 'index'])->name('dashboard');
    Route::patch('/booking/{booking}/status/{status}', [TeknisiDashboard::class, 'updateStatus'])->name('booking.update-status');
});

// ===================== SHARED (semua yang login) =====================
// Route untuk resource yang dipakai shared (booking, ikan) dengan nama lama
// agar tidak break link yang sudah ada
Route::middleware(['auth'])->group(function () {
    Route::resource('ikan', IkanController::class)->names([
        'index'   => 'ikan.index',
        'create'  => 'ikan.create',
        'store'   => 'ikan.store',
        'edit'    => 'ikan.edit',
        'update'  => 'ikan.update',
        'destroy' => 'ikan.destroy',
    ]);

    Route::resource('booking', BookingController::class)->names([
        'index'   => 'booking.index',
        'create'  => 'booking.create',
        'store'   => 'booking.store',
        'destroy' => 'booking.destroy',
    ]);

    Route::resource('layanan', LayananController::class);
    Route::resource('teknisi', TeknisiController::class);

    Route::get('/bayar/{booking_id}', [PembayaranController::class, 'bayar'])->name('bayar');
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');

    // Profile
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/midtrans/finish', [PembayaranController::class, 'finish'])->name('midtrans.finish');
});

// ===================== CALLBACK MIDTRANS =====================
Route::post('/midtrans/callback', [PembayaranController::class, 'callback']);
