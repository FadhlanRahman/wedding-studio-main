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
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/portofolio', [PortofolioController::class, 'index'])->name('portofolio');
    Route::get('/services', [ServicesController::class, 'index'])->name('services');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    // Booking user
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
});

// Halaman Tentang
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
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Akun Terdaftar
    Route::get('/accounts', [AdminController::class, 'accounts'])->name('accounts');
    Route::get('/accounts/{user}/edit', [AdminController::class, 'edit'])->name('accounts.edit');
    Route::put('/accounts/{user}', [AdminController::class, 'update'])->name('accounts.update');
    Route::delete('/accounts/{user}', [AdminController::class, 'destroy'])->name('accounts.destroy');

    // Kalender Booking
    Route::get('/calendar', [AdminController::class, 'calendar'])->name('calendar');

    // About
    Route::get('/about', [AdminController::class, 'about'])->name('about');

    // ====================
    // CONTACT (hanya 1 record di DB)
    // ====================
    Route::get('/contact', [AdminController::class, 'contactIndex'])->name('contact');
    Route::get('/contact/edit', [AdminController::class, 'contactEdit'])->name('contact.edit');
    Route::put('/contact/update', [AdminController::class, 'contactUpdate'])->name('contact.update');

    // Services
    Route::get('/services', [AdminController::class, 'services'])->name('services');

    // Portofolio
    Route::get('/portofolio', [AdminController::class, 'portofolio'])->name('portofolio');

    // Profil Admin
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');

    // Booking (ADMIN)
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});
