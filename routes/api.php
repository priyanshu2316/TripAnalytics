<?php

use App\Http\Controllers\Api\TripController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sales-performance', [TripController::class, 'showSalesPerformance'])->name('api.sales-performance.show');

Route::get('/trips-status', [TripController::class, 'showTripsStatus'])->name('api.trips-status.show');

