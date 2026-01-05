<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RtController;
use App\Http\Controllers\RwController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\AnggotaLembagaController;
use App\Http\Controllers\JabatanLembagaController;

/*
|--------------------------------------------------------------------------
| Web Routes (Dual Database Setup)
|--------------------------------------------------------------------------
*/

// 1. KITA BUNGKUS SEMUA ROUTE KE DALAM VARIABEL
// Tujuannya agar kita tidak perlu copy-paste kodingan yang sama 2 kali.
$appRoutes = function () {

    // Halaman Depan
    Route::get('/', [GuestController::class, 'index'])->name('home');
    Route::get('/pages/dashboard', [GuestController::class, 'index']);

    // Halaman Tentang
    Route::get('/tentang', [GuestController::class, 'tentang'])->name('tentang');

    // Resource User (Public?) - Sesuaikan jika ini harus login
    Route::resource('users', UserController::class);

    // --- OTENTIKASI (Login & Register) ---
    Route::middleware('guest')->group(function () {
        Route::get('/auth', [AuthController::class, 'index'])->name('login');
        Route::post('/auth/login', [AuthController::class, 'login'])->name('login.post');
        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    });

    // Logout & Profile
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');


    // --- HALAMAN KHUSUS YANG SUDAH LOGIN ---
    Route::group(['middleware' => ['checkislogin']], function () {

        // 1. DASHBOARD UTAMA
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // 2. ROUTE KHUSUS ADMIN
        Route::group(['middleware' => ['checkrole:Admin']], function () {
            Route::resource('lembaga', LembagaDesaController::class);
            Route::resource('jabatan-lembaga', JabatanLembagaController::class);
            Route::resource('rw', RwController::class);
            Route::resource('rt', RtController::class);
            Route::resource('anggota-lembaga', AnggotaLembagaController::class);
        });

        // 3. ROUTE UNTUK WARGA
        Route::group(['middleware' => ['checkrole:Warga']], function () {
            Route::resource('warga', WargaController::class);
            Route::resource('perangkat', PerangkatDesaController::class);
            Route::apiResource('media', MediaController::class);
            Route::post('/media/sort-order', [MediaController::class, 'updateSortOrder']);
            Route::get('/media/reference/{table}/{id}', [MediaController::class, 'getByReference']);
            // Tambahkan Route RW

        });

        // 4. ROUTE UNTUK USER BIASA
        // Catatan: Resource 'users' sudah ada di atas, pastikan tidak duplikat logic
        Route::group(['middleware' => ['checkrole:User']], function () {
             // Route::resource('users', UserController::class); // Opsional jika beda logic
        });
    });
};


// ==============================================================================
// 2. PENERAPAN ROUTE (EKSEKUSI)
// ==============================================================================

// A. JALUR GUEST (Tanpa Prefix) -> Mengakses Database Guest
// URL: http://127.0.0.1:8000/dashboard
Route::group(['middleware' => ['web']], $appRoutes);


// B. JALUR ADMIN (Dengan Prefix 'admin') -> Mengakses Database Admin
// URL: http://127.0.0.1:8000/admin/dashboard
// Note: 'as' => 'admin.' akan membuat nama route jadi 'admin.dashboard', 'admin.login', dll.
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['web']], $appRoutes);

Route::resource('rw', RwController::class);
