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

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/trips/create', [TripController::class, 'create'])->name('trips.create');
    Route::post('/trips', [TripController::class, 'store'])->name('trips.store');
    Route::get('/trips/{trip}/edit', [TripController::class, 'edit'])->name('trips.edit');
    Route::put('/trips/{trip}', [TripController::class, 'update'])->name('trips.update');
    Route::delete('/trips/{trip}', [TripController::class, 'destroy'])->name('trips.destroy');
    Route::resource('users', App\Http\Controllers\UserController::class)->except(['create', 'store', 'show']);
    Route::delete('/trips/delete/group', [App\Http\Controllers\TripController::class, 'deleteGroup'])->name('trips.delete.group');
});

Route::get('/viajes', [TripController::class, 'index'])->name('trips.index');
Route::get('/viajes/{trip:slug}', [TripController::class, 'show'])->name('trips.show');
Route::post('/trips/{trip}/review', [ReviewController::class, 'store'])->name('reviews.store');


require __DIR__.'/auth.php';
