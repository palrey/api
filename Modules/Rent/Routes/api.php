<?php

use Illuminate\Support\Facades\Route;
use Modules\Rent\Http\Controllers\RentController;

Route::apiResource('rents', RentController::class);
