<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerangkatDesaController;

// Route untuk halaman home guest (landing page)
Route::get('/', [GuestController::class, 'index']);
Route::get('/home', [GuestController::class, 'index']);

// Route untuk autentikasi
Route::get('/auth', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.post');

// Route untuk Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Route dashboard - INI YANG HARUS DIPERBAIKI
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route resources
Route::resource('warga', WargaController::class);

Route::resource('perangkat', PerangkatDesaController::class);

// Routes untuk User
Route::resource('user', UserController::class);


Route::get('/test', function() {
    return view('test');
});
