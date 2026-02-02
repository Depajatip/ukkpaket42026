<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\TransaksiController as AdminTransaksiController;
use App\Http\Controllers\BukuSiswaController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH USER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/buku', [BukuSiswaController::class, 'index'])
        ->name('buku.index');

    Route::post('/pinjam/{buku}', [PeminjamanController::class, 'store'])
        ->name('pinjam.store');

    Route::get('/daftar-anggota', [AnggotaController::class, 'create'])
        ->name('anggota.create');

    Route::post('/daftar-anggota', [AnggotaController::class, 'store'])
        ->name('anggota.store');

    Route::post(
        '/pengembalian/{transaksi}',
        [PeminjamanController::class, 'ajukanPengembalian']
    )->name('pengembalian.ajukan');
});

/*
|--------------------------------------------------------------------------
| AUTH ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('buku', BukuController::class);

        Route::get('/transaksi', [AdminTransaksiController::class, 'index'])
            ->name('transaksi.index');

        Route::post('/transaksi/{transaksi}/approve', [AdminTransaksiController::class, 'approve'])
            ->name('transaksi.approve');

        Route::post('/transaksi/{transaksi}/reject', [AdminTransaksiController::class, 'reject'])
            ->name('transaksi.reject');
        Route::post('/transaksi/{transaksi}/return', [AdminTransaksiController::class, 'return'])
            ->name('transaksi.return');
    });

/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('admin.login');

Route::post('/admin/login', [AdminLoginController::class, 'login'])
    ->middleware('guest');

Route::post('/admin/logout', [AdminLoginController::class, 'logout'])
    ->middleware('auth');

require __DIR__ . '/auth.php';
