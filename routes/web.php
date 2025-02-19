<?php

use App\Http\Controllers\CampGroundsController;
use App\Http\Controllers\CreateCampGroundController;
use App\Http\Controllers\DeleteCampGroundController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\UpdateCampGroundController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CampGroundsController::class, 'index'])->name('camp_grounds.index');
Route::get('/register', [RegisterUserController::class, 'index']);
Route::get('/login', [LoginUserController::class, 'index']);
Route::get('/create', [CreateCampGroundController::class, 'index']);
Route::post('/create', [CreateCampGroundController::class, 'create']);
Route::get('/update/{id}', [UpdateCampGroundController::class, 'index']);
Route::post('/update/{id}', [UpdateCampGroundController::class, 'update']);
Route::post('/delete/{id}', [DeleteCampGroundController::class, 'delete']);
