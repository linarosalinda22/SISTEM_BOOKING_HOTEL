<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\TamusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TipeKamarController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pembayaran', PembayaranController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/kamar', KamarController::class);
Route::resource('tipe-kamar', TipeKamarController::class);
Route::get('/tamus', [TamusController::class, 'index']);
Route::resource('tamus', TamusController::class);
Route::resource('booking', BookingController::class);
Route::post('booking/{booking}/check-in', [BookingController::class, 'checkIn'])->name('booking.check-in');
Route::post('booking/{booking}/check-out', [BookingController::class, 'checkOut'])->name('booking.check-out');

require __DIR__.'/auth.php';
