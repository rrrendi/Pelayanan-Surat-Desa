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
        
        // Route untuk update profile dan validasi NIK
        Route::post('/profile/update', [SuratController::class, 'updateProfile'])->name('profile.update');
    });

    // Route untuk Admin
    Route::middleware('admin')->group(function () {
        Route::post('/surat/{id}/update-status', [SuratController::class, 'updateStatus'])->name('surat.updateStatus');
        Route::get('/surat/{id}/cetak', [SuratController::class, 'cetakPdf'])->name('surat.cetak');
        
        // User Management Routes
        Route::resource('users', \App\Http\Controllers\UserController::class);
        Route::post('/users/{id}/reset-password', [\App\Http\Controllers\UserController::class, 'resetPassword'])->name('users.resetPassword');
    });
    
    // Route untuk validasi NIK (accessible by both admin and warga)
    Route::post('/check-nik', [\App\Http\Controllers\UserController::class, 'checkNik'])->name('check.nik');
});