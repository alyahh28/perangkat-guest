<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerangkatDesaController;

// Route untuk halaman home guest
Route::get('/', [GuestController::class, 'index']);
Route::get('/home', [GuestController::class, 'index']);

// Route untuk autentikasi
Route::get('/auth', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.post');

// Route dashboard
Route::get('/home', function () {
    return view('home');
})->name('dashboard');

route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('warga', WargaController::class);

Route::resource('perangkat', PerangkatDesaController::class);
