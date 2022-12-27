<?php

use Illuminate\Support\Facades\Route;
use Modules\Rent\Http\Controllers\BookingController;
use Modules\Rent\Http\Controllers\RentController;
use Modules\Rent\Http\Controllers\RoomController;

Route::prefix('rents')->group(function () {
    /**
     * -----------------------------------------
     *	Rooms
     * -----------------------------------------
     */
    Route::prefix('rooms')->group(function () {
        Route::get('available', [RoomController::class, 'listAvailable']);
        Route::apiResource('', RoomController::class);
    });
    /**
     * -----------------------------------------
     *	Booking
     * -----------------------------------------
     */
    Route::prefix('bookings')->group(function () {
        Route::apiResource('', BookingController::class);
    });
    /**
     * -----------------------------------------
     *	Rents
     * -----------------------------------------
     */
    Route::get('with-rents', [RentController::class, 'showWithRents']);
    Route::apiResource('', RentController::class);
});
