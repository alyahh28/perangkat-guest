<?php
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

// Route untuk halaman home guest (satu halaman)
Route::get('/home', [GuestController::class, 'index']);