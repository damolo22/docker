<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $bookings = Auth::user()->bookings()->with('trip')->latest()->get();

    return view('dashboard', compact('bookings'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/viajes/{trip}/book', [BookingController::class, 'store'])->name('bookings.store');
});


Route::get('/viajes', [TripController::class, 'index'])->name('trips.index');
Route::get('/viajes/{trip:slug}', [TripController::class, 'show'])->name('trips.show');
Route::post('/trips/{trip}/review', [ReviewController::class, 'store'])->name('reviews.store');


require __DIR__.'/auth.php';
