<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;

Route::get('/', [TripController::class, 'index'])->name('trip.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
