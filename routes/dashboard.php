<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\PositionsController;
use App\Http\Controllers\Dashboard\OrdersController;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
*/

Route::post('login', [LoginController::class, 'Login']);


Route::middleware(['auth:api'])->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('render', [UserController::class, 'render']);
        Route::post('create', [UserController::class, 'create']);
        Route::post('update/{id}', [UserController::class, 'update']);
        Route::delete('delete/{id}', [UserController::class, 'delete']);
    });
    Route::group(['prefix' => 'positions'], function () {
        Route::get('render', [PositionsController::class, 'render']);
        Route::post('create', [PositionsController::class, 'create']);
        Route::post('update/{id}', [PositionsController::class, 'update']);
        Route::delete('delete/{id}', [PositionsController::class, 'delete']);
    });
    Route::group(['prefix' => 'orders'], function () {
        Route::get('render', [OrdersController::class, 'render']);
        Route::post('create', [OrdersController::class, 'create']);
        Route::post('update/{id}', [OrdersController::class, 'update']);
        Route::delete('delete/{id}', [OrdersController::class, 'delete']);
        Route::get('excel', [OrdersController::class, 'ExportExcel']);
    });
});
