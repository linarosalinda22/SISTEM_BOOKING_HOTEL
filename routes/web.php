<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TamusController;
use App\Http\Controllers\TipeKamarController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PembayaranController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tamus (Guests)
    Route::resource('tamus', TamusController::class);

    // Tipe Kamar (Room Types)
    Route::resource('tipe-kamar', TipeKamarController::class);

    // Kamar (Rooms)
    Route::resource('kamar', KamarController::class);

    // Booking
    Route::resource('booking', BookingController::class);
    Route::post('booking/{booking}/check-in', [BookingController::class, 'checkIn'])->name('booking.check-in');
    Route::post('booking/{booking}/check-out', [BookingController::class, 'checkOut'])->name('booking.check-out');

    // Pembayaran (Payments)
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('pembayaran/{pembayaran}/invoice', [PembayaranController::class, 'printInvoice'])->name('pembayaran.invoice');
});

// require __DIR__.'/auth.php';
