<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MeterController;
use App\Http\Controllers\Api\MeterReadingController;



Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::middleware('auth:api')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::resource('meters', MeterController::class);
});*/


Route::middleware('auth:api')->group(function () {
    Route::apiResource('meter-readings', MeterReadingController::class)
        ->only(['index', 'show'])
        ->middleware('role:user,reader');

    Route::post('meter-readings', [MeterReadingController::class, 'store'])
        ->middleware('role:reader');

    Route::middleware('role:admin')->group(function () {
        Route::apiResource('meters', MeterController::class)->only(['store']);
    });
});
