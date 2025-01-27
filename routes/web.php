<?php

use App\Http\Controllers\CampGroundsController;
use App\Http\Controllers\UpdateCampGroundController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CampGroundsController::class, 'index']);
Route::get('/update/{id}', [UpdateCampGroundController::class, 'index']);
