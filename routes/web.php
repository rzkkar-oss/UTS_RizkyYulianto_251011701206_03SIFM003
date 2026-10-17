<?php

use App\Http\Controllers\BikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BikeController::class, 'home'])->name('home');
Route::get('/sepeda', [BikeController::class, 'index'])->name('bikes.index');
Route::get('/sepeda/{bike}', [BikeController::class, 'show'])->name('bikes.show');
