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
// HALAMAN UMUM (TANPA LOGIN)
// ====================
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ====================
// HALAMAN USER
// ====================
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/portofolio', [PortofolioController::class, 'index'])->name('portofolio');
    Route::get('/services', [ServicesController::class, 'index'])->name('services'); // <-- nama route diganti jadi "services"
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    // Booking user
    Route::prefix('booking')->name('booking.')->group(function () {
        Route::get('/', [BookingController::class, 'create'])->name('create');
        Route::post('/store', [BookingController::class, 'store'])->name('store');
    });
});

// ====================
// HALAMAN ADMIN
// ====================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        // Akun Terdaftar
        Route::prefix('accounts')->name('accounts.')->group(function () {
            Route::get('/', [AdminController::class, 'accounts'])->name('index');
            Route::get('/{user}/edit', [AdminController::class, 'edit'])->name('edit');
            Route::put('/{user}', [AdminController::class, 'update'])->name('update');
            Route::delete('/{user}', [AdminController::class, 'destroy'])->name('destroy');
        });

        // Kalender Booking
        Route::get('/calendar', [AdminController::class, 'calendar'])->name('calendar');

        // About (admin kelola konten about)
        Route::get('/about', [AdminController::class, 'about'])->name('about');

        // Contact (1 record di DB)
        Route::prefix('contact')->name('contact.')->group(function () {
            Route::get('/', [AdminController::class, 'contactIndex'])->name('index');
            Route::get('/edit', [AdminController::class, 'contactEdit'])->name('edit');
            Route::put('/update', [AdminController::class, 'contactUpdate'])->name('update');
        });

        // Services (CRUD)
        Route::prefix('services')->name('services.')->group(function () {
            Route::get('/', [AdminController::class, 'servicesIndex'])->name('index');
            Route::get('/create', [AdminController::class, 'servicesCreate'])->name('create');
            Route::post('/', [AdminController::class, 'servicesStore'])->name('store');
            Route::get('/{service}/edit', [AdminController::class, 'servicesEdit'])->name('edit');
            Route::put('/{service}', [AdminController::class, 'servicesUpdate'])->name('update');
            Route::delete('/{service}', [AdminController::class, 'servicesDestroy'])->name('destroy');
        });

        // Portofolio (admin kelola portofolio)
        Route::get('/portofolio', [AdminController::class, 'portofolio'])->name('portofolio');

        // Profil Admin
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');

        // Booking (ADMIN)
        Route::prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/', [BookingController::class, 'index'])->name('index');
            Route::get('/{booking}/edit', [BookingController::class, 'edit'])->name('edit');
            Route::put('/{booking}', [BookingController::class, 'update'])->name('update');
            Route::delete('/{booking}', [BookingController::class, 'destroy'])->name('destroy');
        });
    });
