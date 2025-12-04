<?php

use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PenginapanController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\WisataController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Admin\ChartController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/destinasi', [HomeController::class, 'destinations'])->name('destinations.index');
Route::get('/destinasi/{slug}', [HomeController::class, 'destinationDetail'])->name('destinations.show');
Route::get('/penginapan', [HomeController::class, 'accommodations'])->name('accommodations.index');
Route::get('/penginapan/{slug}', [HomeController::class, 'accommodationDetail'])->name('accommodations.show');
Route::get('/blog', [HomeController::class, 'blogs'])->name('blogs.index');
Route::get('/blog/{slug}', [HomeController::class, 'blogDetail'])->name('blogs.show');

// User Routes (Authenticated)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HistoryController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Booking
    Route::get('/booking/{slug}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/success/{id}', [BookingController::class, 'success'])->name('booking.success');

    // History & Tickets
    Route::get('/riwayat', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/tiket/{id}', [HistoryController::class, 'show'])->name('tickets.show');
    Route::get('/invoice/{id}', [HistoryController::class, 'invoice'])->name('invoice.download');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Reviews
    Route::post('/review', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/review/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Admin Routes (Authenticated + Admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('wisata', WisataController::class);
    Route::resource('penginapan', PenginapanController::class);
    Route::resource('artikel', ArtikelController::class);
    
    Route::get('/charts', [ChartController::class, 'index'])->name('charts.index');

    Route::get('/transaksi/export', [TransaksiController::class, 'export'])->name('transaksi.export');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::post('/transaksi/{id}/verify', [TransaksiController::class, 'verify'])->name('transaksi.verify');
    Route::post('/transaksi/{id}/reject', [TransaksiController::class, 'reject'])->name('transaksi.reject');
});

require __DIR__.'/auth.php';
