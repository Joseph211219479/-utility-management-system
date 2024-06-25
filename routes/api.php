<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MeterController;
use App\Http\Controllers\API\MeterReadingController;
use App\Http\Middleware\CheckRole;

Route::get('/test', function () { //todo remove later
    return response()->json(['message' => 'API route test successful!']);
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:api' ])->group(function () {
    //meterController routes
   Route::post('meters', [MeterController::class, 'store'])
        ->middleware(CheckRole::class . ":admin");
    Route::get('meters', [MeterController::class, 'index'])
        ->middleware(CheckRole::class . ":admin,reader");
    Route::get('meters/{id}', [MeterController::class, 'show'])
        ->middleware(CheckRole::class . ":admin,reader,client");
    Route::put('meters/{id}', [MeterController::class, 'update'])
        ->middleware(CheckRole::class . ":admin");
    Route::delete('meters/{id}', [MeterController::class, 'destroy'])
        ->middleware(CheckRole::class . ":admin");

    //meterReadingController routes
    Route::post('meter_reading', [MeterController::class, 'store'])
        ->middleware(CheckRole::class . ":admin,reader");
    Route::get('meter_reading', [MeterController::class, 'index'])
        ->middleware(CheckRole::class . ":admin,reader");
    Route::get('meter_reading/{id}', [MeterController::class, 'show'])
        ->middleware(CheckRole::class . ":admin,reader,client");
    Route::put('meter_reading/{id}', [MeterController::class, 'update'])
        ->middleware(CheckRole::class . ":admin");
    Route::delete('meter_reading/{id}', [MeterController::class, 'destroy'])
        ->middleware(CheckRole::class . ":admin");

});
