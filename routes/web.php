<?php

use App\Http\Controllers\CampGroundsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CampGroundsController::class, 'index']);
