<?php

use App\Http\Controllers\FrontsiteController;
use App\Http\Controllers\MasyarakatAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Halaman utama (Frontsite)
Route::get('/', [FrontsiteController::class, 'index'])->name('frontsite.index');

// Route untuk Admin & User (Proteksi dengan middleware auth)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('masyarakat', MasyarakatController::class);
    Route::get('/pengaduan', [TanggapanController::class, 'index'])->name('admin.pengaduan.index');
    Route::post('/pengaduan/{id}/tanggapan', [TanggapanController::class, 'store'])->name('admin.pengaduan.tanggapan.store');
    Route::post('/pengaduan/{id}/update', [TanggapanController::class, 'update'])->name('admin.pengaduan.tanggapan.update');
});

// Route untuk Masyarakat
Route::prefix('masyarakat')->group(function () {
    // Menampilkan Form Register
    Route::get('/register', [MasyarakatAuthController::class, 'showRegisterForm'])->name('masyarakat.register');

    // Menangani Proses Register
    Route::post('/register/action', [MasyarakatAuthController::class, 'register'])->name('masyarakat.register.action');

    // Menampilkan Form Login
    Route::get('/login', [MasyarakatAuthController::class, 'showLoginForm'])->name('masyarakat.login');

    // Menangani Proses Login
    Route::post('/login/action', [MasyarakatAuthController::class, 'login'])->name('masyarakat.login.action');

    // Logout
    Route::post('/logout', [MasyarakatAuthController::class, 'logout'])->name('masyarakat.logout');

    // Dashboard masyarakat (Proteksi dengan middleware `auth:masyarakat`)
    Route::get('/dashboard', [FrontsiteController::class, 'dashboard'])->middleware('auth:masyarakat')->name('masyarakat.dashboard');

    // 🔥 **Route Pengaduan (Hanya bisa diakses oleh masyarakat yang login)**
    Route::middleware('auth:masyarakat')->group(function () {
        // Menampilkan Form Buat Pengaduan
        Route::get('/pengaduan/buat', [PengaduanController::class, 'create'])->name('masyarakat.pengaduan.create');

        // Menyimpan Pengaduan
        Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('masyarakat.pengaduan.store');

        // Menampilkan Pengaduan Saya
        Route::get('/pengaduan-saya', [PengaduanController::class, 'pengaduanSaya'])->name('masyarakat.pengaduan.saya');

        // Menampilkan Semua Pengaduan
        Route::get('/semua-pengaduan', [PengaduanController::class, 'semuaPengaduan'])->name('masyarakat.pengaduan.semua');
    });
});

// Laravel Authentication (Default)
Auth::routes();

// Redirect setelah login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');