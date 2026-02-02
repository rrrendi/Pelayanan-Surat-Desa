<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect('/login');
});

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// AJAX Validation Routes (Public)
Route::post('/check-nik', [RegisterController::class, 'checkNik'])->name('check.nik');
Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check.email');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [SuratController::class, 'dashboard'])->name('dashboard');

    // Surat Routes (Warga)
    Route::middleware('warga')->group(function () {
        Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
        Route::post('/surat/store', [SuratController::class, 'store'])->name('surat.store');
        Route::get('/profile', [SuratController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile', [SuratController::class, 'updateProfile'])->name('profile.update');
    });

    // Admin Routes
    Route::middleware('admin')->group(function () {
        Route::post('/surat/{id}/update-status', [SuratController::class, 'updateStatus'])->name('surat.updateStatus');

        // User Management (HANYA index, edit, update, destroy - TANPA create & store)
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Cetak PDF (Both Admin & Warga)
    Route::get('/surat/{id}/cetak', [SuratController::class, 'cetakPdf'])->name('surat.cetak');
});