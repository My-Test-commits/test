<?php

use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('registration', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('authorization', [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout']);

    Route::get('search', [SearchController::class, 'search']);
    Route::get('gagarin-flight', [\App\Http\Controllers\GagarinInfo::class, 'index']);
    Route::get('flight', [\App\Http\Controllers\FlightnInfo::class, 'index']);

    Route::get('lunar-missions', [\App\Http\Controllers\MissionController::class, 'index']);
    Route::post('lunar-missions', [\App\Http\Controllers\MissionController::class, 'store']);
    Route::put('lunar-missions/{mission}', [\App\Http\Controllers\MissionController::class, 'update']);
    Route::delete('lunar-missions/{mission}', [\App\Http\Controllers\MissionController::class, 'destroy']);

    Route::get('space-flights', [\App\Http\Controllers\FlightController::class, 'index']);
    Route::post('space-flights', [\App\Http\Controllers\FlightController::class, 'store']);

    Route::post('book-flight', [\App\Http\Controllers\BookingController::class, 'store']);
});
