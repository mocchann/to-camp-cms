<?php

use App\Http\Controllers\CampGroundsController;
use App\Http\Controllers\CreateCampGroundController;
use App\Http\Controllers\DeleteCampGroundController;
use App\Http\Controllers\DeleteUserController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\LogoutUserController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\UpdateCampGroundController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterUserController::class, 'index'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store']);
    Route::get('/login', [LoginUserController::class, 'index'])->name('login');
    Route::post('/login', [LoginUserController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [CampGroundsController::class, 'index'])->name('camp_grounds.index');
    Route::get('/create', [CreateCampGroundController::class, 'index']);
    Route::post('/create', [CreateCampGroundController::class, 'create']);
    Route::get('/update/{id}', [UpdateCampGroundController::class, 'index']);
    Route::post('/update/{id}', [UpdateCampGroundController::class, 'update']);
    Route::delete('/delete/{id}', [DeleteCampGroundController::class, 'delete']);
    Route::group(['prefix' => 'user'], function () {
        Route::post('/logout', [LogoutUserController::class, 'store']);
        Route::delete('/delete', [DeleteUserController::class, 'delete']);
    });
});
