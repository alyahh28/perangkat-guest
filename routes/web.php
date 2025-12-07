<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\JabatanLembagaController;

// Route untuk halaman home guest (landing page)
Route::get('/', [GuestController::class, 'index']);
Route::get('/pages/dashboard', [GuestController::class, 'index']);

// Route untuk autentikasi
Route::get('/auth', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.post');

// Route untuk Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Route untuk Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Route dashboard - INI YANG HARUS DIPERBAIKI
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route resources
Route::resource('warga', WargaController::class);

Route::resource('perangkat', PerangkatDesaController::class);

// Routes untuk User
Route::resource('users', UserController::class);

// Routes untuk Hal Tentang
Route::get('/tentang', function () {
    return view('pages/tentang');
})->name('tentang');

// CRUD Lembaga Desa
Route::resource('lembaga', LembagaDesaController::class);

// Route untuk Jabatan Lembaga
Route::resource('jabatan-lembaga', JabatanLembagaController::class);

Route::group(['middleware' => ['checkrole:Admin']], function () {
     Route::get('user',[UserController::class, 'index'])->name('user.index');
 });


 Route::apiResource('media', MediaController::class);

// Route tambahan
Route::post('/media/sort-order', [MediaController::class, 'updateSortOrder']);
Route::get('/media/reference/{table}/{id}', [MediaController::class, 'getByReference']);
