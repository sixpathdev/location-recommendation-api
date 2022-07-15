<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/register', 'registerUser');
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->middleware('auth:sanctum');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('category')->group(function() {
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
        });
    });

    Route::prefix('locations')->group(function () {
        Route::controller(LocationController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/random/{category}', 'suggestPlaces');
            Route::post('/', 'store');
        });
    });
});
