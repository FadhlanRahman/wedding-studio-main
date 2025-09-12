<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookingController;

// ====================
// HALAMAN UTAMA (USER)
// ====================
Route::middleware(['auth', 'user'])->group(function () {
    // Halaman utama
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/portofolio', [PortofolioController::class, 'index'])->name('portofolio');
    Route::get('/services', [ServicesController::class, 'index'])->name('services');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    // Booking user
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store'); // <= disesuaikan
});

// Halaman Tentang (bisa diakses tanpa login)
Route::get('/about', [AboutController::class, 'index'])->name('about');

// ====================
// AUTENTIKASI
// ====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ====================
// HALAMAN ADMIN
// ====================
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Akun Terdaftar
    Route::get('/admin/accounts', [AdminController::class, 'accounts'])->name('admin.accounts');
    Route::get('/admin/accounts/{user}/edit', [AdminController::class, 'edit'])->name('admin.accounts.edit');
    Route::put('/admin/accounts/{user}', [AdminController::class, 'update'])->name('admin.accounts.update');
    Route::delete('/admin/accounts/{user}', [AdminController::class, 'destroy'])->name('admin.accounts.destroy');

    // Kalender Booking (ADMIN)
    Route::get('/admin/calendar', [AdminController::class, 'calendar'])->name('admin.calendar');

    // ====================
    // About (ADMIN PANEL)
    // ====================
    Route::get('/admin/about', [AdminController::class, 'about'])->name('admin.about');
    Route::post('/admin/about/store', [AdminController::class, 'storeTeam'])->name('admin.team.store');
    Route::post('/admin/about/update/{team}', [AdminController::class, 'updateTeam'])->name('admin.team.update');
    Route::delete('/admin/about/delete/{team}', [AdminController::class, 'destroyTeam'])->name('admin.team.delete');

    // contact
    Route::get('/admin/contact', [AdminController::class, 'contact'])->name('admin.contact');

    // services
    Route::get('/admin/services', [AdminController::class, 'services'])->name('admin.services');

    // portofolio
    Route::get('/admin/portofolio', [AdminController::class, 'portofolio'])->name('admin.portofolio');

    // Profil Admin
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');

    // =========================
    // Booking Admin
    // =========================
    Route::get('/admin/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('/admin/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('admin.bookings.edit');
    Route::put('/admin/bookings/{booking}', [BookingController::class, 'update'])->name('admin.bookings.update');
    Route::delete('/admin/bookings/{booking}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');
});

