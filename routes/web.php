<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\PinjamanController;

// ====================
// HALAMAN UMUM (TANPA LOGIN)
// ====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');

// ✅ User bisa langsung akses form booking (tanpa login)
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

// ✅ User submit testimonial (form kirim testimoni)
Route::post('/testimoni', [TestimonialController::class, 'store'])->name('testimoni.store');

Route::get('/pinjaman', [PinjamanController::class,'index'])
    ->name('pinjaman.index');

Route::get('/pinjaman/create', [PinjamanController::class,'create'])
    ->name('pinjaman.create');

Route::post('/pinjaman/store', [PinjamanController::class,'store'])
    ->name('pinjaman.store');

// ====================
// AUTENTIKASI
// ====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ====================
// HALAMAN USER (SETELAH LOGIN)
// ====================
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/portofolio', [PortofolioController::class, 'index'])->name('portofolio');
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

        // Contact + Testimoni
        Route::prefix('contact')->name('contact.')->group(function () {
            Route::get('/', [AdminController::class, 'contactIndex'])->name('index');
            Route::get('/edit', [AdminController::class, 'contactEdit'])->name('edit');
            Route::put('/update', [AdminController::class, 'contactUpdate'])->name('update');
            Route::delete('/delete', [AdminController::class, 'contactDestroy'])->name('destroy');

            // ✅ Testimoni CRUD (admin kelola testimoni user)
            Route::prefix('testimonial')->name('testimonial.')->group(function () {
                Route::delete('/{id}', [TestimonialController::class, 'destroy'])->name('destroy');
                Route::post('/{id}/publish', [AdminController::class, 'publish'])->name('publish');
                Route::post('/{id}/unpublish', [AdminController::class, 'unpublish'])->name('unpublish');
            });
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

        // Pinjaman Aksesoris
        Route::prefix('pinjaman-aksesoris')->name('pinjaman-aksesoris.')->group(function () {
            // Data Penyewaan User
            Route::get('/transaksi', [AdminController::class, 'transaksiPinjaman'])->name('transaksi');

            // Data Barang
            Route::get('/', [AdminController::class, 'pinjamanIndex'])->name('index');
            Route::get('/create', [AdminController::class, 'pinjamanCreate'])->name('create');
            Route::post('/', [AdminController::class, 'pinjamanStore'])->name('store');
            Route::get('/{id}/edit', [AdminController::class, 'pinjamanEdit'])->name('edit');
            Route::put('/{id}', [AdminController::class, 'pinjamanUpdate'])->name('update');
            Route::delete('/{id}', [AdminController::class, 'pinjamanDestroy'])->name('destroy');
            Route::post('/{id}/kurangi-stok', [AdminController::class, 'pinjamanKurangiStok'])->name('kurangi-stok');
            Route::put('/{id}/stok', [AdminController::class, 'pinjamanUpdateStok'])->name('update-stok');
        });

        // Team CRUD
        Route::prefix('team')->name('team.')->group(function () {
            Route::get('/', [AdminController::class, 'about'])->name('index');
            Route::post('/store', [AdminController::class, 'storeTeam'])->name('store');
            Route::put('/update/{team}', [AdminController::class, 'updateTeam'])->name('update');
            Route::delete('/delete/{team}', [AdminController::class, 'destroyTeam'])->name('delete');
        });

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
