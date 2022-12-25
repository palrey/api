<?php

use Illuminate\Support\Facades\Route;
use Modules\Rent\Http\Controllers\RentController;
use Modules\Rent\Http\Controllers\RoomController;

Route::prefix('rents')->group(function () {
    /**
     * -----------------------------------------
     *	Rooms
     * -----------------------------------------
     */
    Route::prefix('rooms')->group(function () {
        Route::apiResource('', RoomController::class);
    });
    /**
     * -----------------------------------------
     *	Rents
     * -----------------------------------------
     */
    Route::get('with-rents', [RentController::class, 'showWithRents']);
    Route::apiResource('', RentController::class);
});
