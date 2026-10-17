<?php

use App\Http\Controllers\BikeController;
use App\Http\Controllers\RentalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BikeController::class, 'home'])->name('home');
Route::get('/sepeda', [BikeController::class, 'index'])->name('bikes.index');
Route::get('/sepeda/{bike}', [BikeController::class, 'show'])->name('bikes.show');
// Penyewaan
Route::get('/sepeda/{bike}/sewa', [RentalController::class, 'create'])->name('rentals.create');
Route::post('/sepeda/{bike}/sewa', [RentalController::class, 'store'])->name('rentals.store');
Route::get('/sewa', [RentalController::class, 'index'])->name('rentals.index');
Route::get('/sewa/{rental}', [RentalController::class, 'show'])->name('rentals.show');
Route::post('/sewa/{rental}/selesai', [RentalController::class, 'finish'])->name('rentals.finish');