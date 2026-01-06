<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHeroController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. UBAH BAGIAN INI (Logika Redirect Halaman Utama)
Route::get('/', function () {
    // Cek apakah user sudah login?
    if (Auth::check()) {
        // Jika Admin -> Lempar ke Dashboard Admin
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        // Jika User -> Lempar ke Home User
        return redirect()->route('home');
    }

    // Jika belum login, arahkan ke halaman Login
    // (Atau ganti 'login' menjadi 'welcome' jika ingin menampilkan landing page)
    return redirect()->route('login');
});

// Route bawaan untuk Login/Register/Logout
Auth::routes();

// HAPUS baris bawaan ini agar tidak bentrok dengan route user di bawah:
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 

// 2. GROUP USER (Pelanggan)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/home', [UserController::class, 'index'])->name('home');
    Route::post('/booking', [UserController::class, 'storeBooking'])->name('booking.store');
    Route::get('/booking', [UserController::class, 'bookingPage'])->name('booking.index');
    
    // 2. Route untuk MENYIMPAN data booking (POST)
    Route::post('/booking', [UserController::class, 'storeBooking'])->name('booking.store');
    Route::get('/riwayat', [UserController::class, 'history'])->name('booking.history');
});

// 3. GROUP ADMIN (Bengkel)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
     Route::patch('/admin/booking/{id}', [AdminController::class, 'updateStatus'])->name('admin.booking.update');
     Route::get('/admin/settings/hero', [AdminHeroController::class, 'index'])->name('admin.hero.edit');
    Route::put('/admin/settings/hero', [AdminHeroController::class, 'update'])->name('admin.hero.update');
    // Kelola Berita
Route::get('/admin/settings/news', [App\Http\Controllers\AdminNewsController::class, 'index'])->name('admin.news.index');
Route::put('/admin/settings/news/update', [App\Http\Controllers\AdminNewsController::class, 'updateSetting'])->name('admin.news.updateSetting');
Route::post('/admin/settings/news/store', [App\Http\Controllers\AdminNewsController::class, 'storeItem'])->name('admin.news.storeItem');
Route::delete('/admin/settings/news/{id}', [App\Http\Controllers\AdminNewsController::class, 'destroyItem'])->name('admin.news.destroyItem');
});