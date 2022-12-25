<?php

use Illuminate\Support\Facades\Route;
use Modules\Rent\Http\Controllers\RentController;
use Modules\Room\Http\Controllers\RoomController;

Route::apiResource('rents', RentController::class);
Route::apiResource('rooms', RoomController::class);
