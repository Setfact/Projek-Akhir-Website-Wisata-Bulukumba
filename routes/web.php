<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReviewController;
use App\Models\Destination;
use App\Models\Hotel;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. AREA PUBLIC (Bisa diakses TANPA Login)
// ==========================================

// Halaman Depan (Homepage)
Route::get('/', function () {
    $destinations = Destination::latest()->take(6)->get();
    $hotels = Hotel::latest()->take(3)->get();
    return view('welcome', compact('destinations', 'hotels'));
})->name('home');

// Halaman Daftar Penginapan
Route::get('/penginapan', [HotelController::class, 'index'])->name('hotels.index');

// Halaman Detail Destinasi
Route::get('/destinasi/{slug}', function ($slug) {
    $destination = Destination::where('slug', $slug)->firstOrFail();
    return view('destinations.show', compact('destination'));
})->name('destinations.show');


// ==========================================
// 2. AREA PROTECTED (HARUS Login dulu)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // Redirect Dashboard ke Tiket Saya
    Route::get('/dashboard', function () {
        return redirect()->route('my-tickets');
    })->name('dashboard');

    // Halaman Tiket Saya
    Route::get('/tiket-saya', [OrderController::class, 'index'])->name('my-tickets');
    
    // Proses Pesan Tiket
    Route::post('/order', [OrderController::class, 'store'])->name('orders.store');

    // Proses Kirim Review
    Route::post('/review', [ReviewController::class, 'store'])->name('reviews.store');

    // -- TAMBAHAN BARU (Edit & Delete Review) --
    Route::put('/review/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

require __DIR__.'/auth.php';