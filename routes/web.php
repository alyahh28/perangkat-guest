<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\JabatanLembagaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- HALAMAN PUBLIK (Bisa diakses siapa saja) ---
Route::get('/', [GuestController::class, 'index']);
Route::get('/pages/dashboard', [GuestController::class, 'index']);

// Halaman Tentang
Route::get('/tentang', function () {
    return view('pages/tentang');
})->name('tentang');

Route::resource('users', UserController::class);

// --- OTENTIKASI (Login & Register) ---
// Kita gunakan middleware 'guest' agar yang sudah login tidak bisa buka halaman ini lagi
Route::middleware('guest')->group(function () {
    Route::get('/auth', [AuthController::class, 'index'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');


// --- HALAMAN KHUSUS YANG SUDAH LOGIN ---
// Semua route di dalam sini WAJIB Login dulu
Route::group(['middleware' => ['checkislogin']], function () {

    // 1. DASHBOARD UTAMA
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. ROUTE KHUSUS ADMIN
    Route::group(['middleware' => ['checkrole:Admin']], function () {
        Route::resource('lembaga', LembagaDesaController::class);
        Route::resource('jabatan-lembaga', JabatanLembagaController::class);
    });

    // 3. ROUTE UNTUK WARGA (Admin juga bisa akses via middleware logic biasanya)
    Route::group(['middleware' => ['checkrole:Warga']], function () {
        Route::resource('warga', WargaController::class);
        Route::resource('perangkat', PerangkatDesaController::class);
        Route::apiResource('media', MediaController::class);
        Route::post('/media/sort-order', [MediaController::class, 'updateSortOrder']);
        Route::get('/media/reference/{table}/{id}', [MediaController::class, 'getByReference']);
    });

    // 4. ROUTE UNTUK USER BIASA
    Route::group(['middleware' => ['checkrole:User']], function () {
        Route::resource('users', UserController::class);
    });

});
