<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\TelegramAuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\LoadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);
});

Route::group(['prefix' => 'main'], function () {
    Route::get('positions', [LoadController::class, 'getPositions']);
});

Route::group(['prefix' => 'telegram'], function () {
    Route::post('login', [TelegramAuthController::class, 'Login']);
});
