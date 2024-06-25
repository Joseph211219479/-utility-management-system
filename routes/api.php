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

/*Route::middleware('auth:api')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::resource('meters', MeterController::class);
});*/


/*
 * this one works but does not use the roles
 * Route::post('meters', [MeterController::class, 'store']);
 *
 *
Route::post('meters', [MeterController::class, 'store']);
Route::post('meters_reading', [MeterReadingController::class, 'store']);
*/

Route::middleware(['auth:api' , 'role:admin'])->group(function () {
  /*  Route::middleware('role:admin')->group(function () {
        Route::post('meters', [MeterController::class, 'store']);
    })->middleware([CheckRole::class]);*/

   Route::post('meters', [MeterController::class, 'store'])
        ->middleware(CheckRole::class);

});
