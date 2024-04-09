<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
*/

Route::post('login', [LoginController::class, 'Login']);


Route::group(['prefix' => 'users'], function () {
    Route::get('render', [UserController::class, 'render']);
    Route::post('create', [UserController::class, 'create']);
    Route::post('update/{id}', [UserController::class, 'update']);
    Route::delete('delete/{id}', [UserController::class, 'delete']);
});
