<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvakuasiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GedungController;
use App\Http\Controllers\Admin\JalurMitigasiController;
use App\Http\Controllers\Admin\LantaiController;
use App\Http\Controllers\Admin\RuanganController;
use Illuminate\Support\Facades\Auth;


// Public routes (no login needed)
Route::get('/', [EvakuasiController::class, 'index'])->name('home');
Route::post('/cari', [EvakuasiController::class, 'cari'])->name('cari.evakuasi');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});


Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Admin routes (require login and admin role)
Route::middleware(['auth', 'admin', 'prevent.back'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('gedung', GedungController::class);
    Route::resource('jalur-mitigasi', JalurMitigasiController::class);
    Route::resource('lantai', LantaiController::class);
    Route::resource('ruangan', RuanganController::class);
});
