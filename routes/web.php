<?php

use App\Http\Controllers\TelegramController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::fallback([WebController::class, 'layout']);

Route::get('set-hook', [TelegramController::class, 'setWebHook']);

Route::post(env('TELEGRAM_BOT_TOKEN') . '/webhook', [TelegramController::class, 'commandHandlerWebHook']);
