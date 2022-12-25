<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProfileController;
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

Route::apiResource('app', ApplicationController::class);

Route::prefix('users')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
    Route::prefix('profile')->group(function () {
        Route::get('', [ProfileController::class, 'getProfile']);
        Route::post('', [ProfileController::class, 'setProfile']);
    });
});
