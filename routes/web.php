<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvakuasiController;  // Controller public, nanti buat
use App\Http\Controllers\Admin\GedungController;  // Controller admin, buat per model biar rapi
use App\Http\Controllers\Admin\JalurMitigasiController;
use App\Http\Controllers\Admin\LantaiController;
use App\Http\Controllers\Admin\RuanganController;

// Public routes (no login needed)
Route::get('/', [EvakuasiController::class, 'index'])->name('home');
Route::post('/cari', [EvakuasiController::class, 'cari'])->name('cari.evakuasi');

// Admin routes (require login)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('gedung', GedungController::class);
    Route::resource('gedung', GedungController::class);
    Route::resource('jalur-mitigasi', JalurMitigasiController::class);  // URL: /admin/jalur-mitigasi
    Route::resource('lantai', LantaiController::class);
    Route::resource('ruangan', RuanganController::class);
});
