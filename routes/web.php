<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SuratController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [SuratController::class, 'dashboard'])->name('dashboard');
    
    // Route untuk Warga
    Route::middleware('warga')->group(function () {
        Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
        Route::post('/surat/store', [SuratController::class, 'store'])->name('surat.store');
    });

    // Route untuk Admin
    Route::middleware('admin')->group(function () {
        Route::post('/surat/{id}/update-status', [SuratController::class, 'updateStatus'])->name('surat.updateStatus');
        Route::get('/surat/{id}/cetak', [SuratController::class, 'cetakPdf'])->name('surat.cetak');
    });
});