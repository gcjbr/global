<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


    Route::get('/create', [PersonController::class, 'create']);
    Route::get('/show/{person}', [PersonController::class, 'show']);
    Route::get('/newest', [PersonController::class, 'newest']);
    Route::get('/statistics', [PersonController::class, 'statistics']);
