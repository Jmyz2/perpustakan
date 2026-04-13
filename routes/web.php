<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjamanController;

use App\Http\Controllers\Siswa\SiswaDashboardController;
use App\Http\Controllers\Siswa\BukuController as SiswaBukuController;
use App\Http\Controllers\Siswa\PeminjamanController as SiswaPeminjamanController;

Route::get('/', function () {
    return redirect('/login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('buku', BukuController::class);
    Route::resource('anggota', AnggotaController::class);
    Route::resource('peminjaman', AdminPeminjamanController::class);
    Route::post('/peminjaman/kembalikan/{id}', [AdminPeminjamanController::class, 'kembalikan'])->name('admin.peminjaman.kembalikan');
});

// Siswa Routes
Route::middleware(['auth'])->prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');
    Route::get('/buku', [SiswaBukuController::class, 'index'])->name('siswa.buku.index');
    Route::get('/peminjaman', [SiswaPeminjamanController::class, 'index'])->name('siswa.peminjaman.index');
    Route::post('/peminjaman', [SiswaPeminjamanController::class, 'store'])->name('siswa.peminjaman.store');
    // Simulate return for siswa self-service (some flowmaps allow this)
    Route::post('/peminjaman/kembali/{id}', [SiswaPeminjamanController::class, 'kembalikan'])->name('siswa.peminjaman.kembalikan');

});
