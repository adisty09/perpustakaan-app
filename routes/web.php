<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\JenisBukuController;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\RakBukuController;
use App\Http\Controllers\PustakawanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;

// Landing page (public)
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Guest routes (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Authenticated routes (sudah login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data Routes
    Route::resource('anggota', AnggotaController::class);
    Route::resource('buku', BukuController::class);
    Route::resource('penerbit', PenerbitController::class);
    Route::resource('jenis-buku', JenisBukuController::class);
    Route::resource('pengarang', PengarangController::class);
    Route::resource('rak-buku', RakBukuController::class);
    Route::resource('pustakawan', PustakawanController::class);

    // Transaksi Routes
    Route::resource('peminjaman', PeminjamanController::class);
    Route::get('pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('pengembalian/create/{idPeminjaman}', [PengembalianController::class, 'create'])->name('pengembalian.create');
    Route::post('pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');

    // Laporan Routes
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('buku-terpopuler', [LaporanController::class, 'bukuTerpopuler'])->name('buku-terpopuler');
        Route::get('denda-per-anggota', [LaporanController::class, 'dendaPerAnggota'])->name('denda-per-anggota');
    });
});

// Superadmin only routes
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
});