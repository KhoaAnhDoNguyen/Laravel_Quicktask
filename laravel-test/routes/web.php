<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Localization;
use App\Http\Controllers\LanguageController;

// Trang chào mừng
Route::get('/', function () {
    return view('welcome');
});

// Trang Dashboard
Route::get('/dashboard', [CustomerController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Các route quản lý hồ sơ người dùng
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Các route quản lý khách hàng
    Route::resource('customers', CustomerController::class);
});

// Route thay đổi ngôn ngữ
Route::get('language/{lang}', [LanguageController::class, 'setLocale']);

// Tải các route từ auth.php
require __DIR__.'/auth.php';
