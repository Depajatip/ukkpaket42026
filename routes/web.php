<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\Auth\AdminLoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/daftar-anggota', [AnggotaController::class, 'create'])
        ->name('anggota.create');

    Route::post('/daftar-anggota', [AnggotaController::class, 'store'])
        ->name('anggota.store');
});

// DASHBOARD USER
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/daftar-anggota', [AnggotaController::class, 'create'])
        ->name('anggota.create');

    Route::post('/daftar-anggota', [AnggotaController::class, 'store'])
        ->name('anggota.store');
});

// DASHBOARD ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// LOGIN ADMIN
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('admin.login');

Route::post('/admin/login', [AdminLoginController::class, 'login'])
    ->middleware('guest');

Route::post('/admin/logout', [AdminLoginController::class, 'logout'])
    ->middleware('auth');


require __DIR__.'/auth.php';
