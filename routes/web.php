<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\TransaksiController as AdminTransaksiController;
use App\Http\Controllers\Admin\DashboardAdmin;
use App\Http\Controllers\Admin\ManageAnggotaController;
use App\Http\Controllers\Admin\ManageMuridController;
use App\Http\Controllers\Admin\HistoryTransaksiController;
use App\Http\Controllers\BukuSiswaController;
use App\Http\Controllers\ListPinjamanController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [AnggotaController::class, 'welcomePage'])
    ->name('welcome');

/*
|--------------------------------------------------------------------------
| AUTH USER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/dashboard', [AnggotaController::class, 'dashboard'])
        ->name('user.dashboard');

    Route::get('/daftar-anggota', [AnggotaController::class, 'create'])
        ->name('anggota.create');

    Route::post('/daftar-anggota', [AnggotaController::class, 'store'])
        ->name('anggota.store');

    Route::get('/buku', [BukuSiswaController::class, 'index'])
        ->name('buku.index');

    Route::get('/search-buku', [BukuSiswaController::class, 'search']);

    Route::post('/pinjam/{buku}', [PeminjamanController::class, 'store'])
        ->name('pinjam.store');

    Route::post('/pengembalian/{transaksi}', [PeminjamanController::class, 'ajukanPengembalian'])
        ->name('pengembalian.ajukan');

    Route::get('/siswa/history', [PeminjamanController::class, 'historyPinjaman'])
        ->name('siswa.history');

    Route::get('/siswa/peminjaman-aktif', [ListPinjamanController::class, 'index'])
        ->name('siswa.peminjaman');

    Route::get('/siswa/adminHistory', [AdminTransaksiController::class, 'history'])
        ->name('siswa.adminHistory');
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

        Route::get('/dashboard', [DashboardAdmin::class, 'index'])
            ->name('dashboard');

        Route::get('/buku', [BukuController::class, 'index'])
            ->name('buku.index');

        Route::get('/buku/create', [BukuController::class, 'create'])
            ->name('buku.create');

        Route::post('/buku', [BukuController::class, 'store'])
            ->name('buku.store');

        Route::get('/buku/{buku}/edit', [BukuController::class, 'edit'])
            ->name('buku.edit');

        Route::put('/buku/{buku}', [BukuController::class, 'update'])
            ->name('buku.update');

        Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])
            ->name('buku.destroy');

        Route::post('/admin/murid/store', [ManageMuridController::class, 'store'])
            ->name('murid.store');

        Route::delete('/murid/{id}', [ManageMuridController::class, 'destroy'])
            ->name('murid.destroy');

        Route::put('/admin/murid/{murid}', [ManageMuridController::class, 'update'])
            ->name('murid.update');

        Route::get('/list-murid', [ManageMuridController::class, 'index'])
            ->name('managemurid.index');

        Route::get('/transaksi', [AdminTransaksiController::class, 'index'])
            ->name('transaksi.index');

        Route::post('/transaksi/{transaksi}/approve', [AdminTransaksiController::class, 'approve'])
            ->name('transaksi.approve');

        Route::post('/transaksi/{transaksi}/reject', [AdminTransaksiController::class, 'reject'])
            ->name('transaksi.reject');

        Route::post('/transaksi/{transaksi}/return', [AdminTransaksiController::class, 'return'])
            ->name('transaksi.return');

        Route::get('/manage-anggota', [ManageAnggotaController::class, 'index'])
            ->name('manageanggota.index');

        Route::delete('/anggota/{id}', [ManageAnggotaController::class, 'destroy'])
            ->name('anggota.destroy');

        Route::put('/anggota/{id}', [ManageAnggotaController::class, 'update'])
            ->name('anggota.update');

        Route::get('/admin-daftar-anggota', [ManageAnggotaController::class, 'create'])
            ->name('anggota.create');

        Route::post('/admin-daftar-anggota', [AnggotaController::class, 'store'])
            ->name('anggota.store');

        Route::get('/admin-transaksi/history', [HistoryTransaksiController::class, 'history'])
            ->name('historytransaksi');
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
