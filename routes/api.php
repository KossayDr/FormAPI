<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\SubscriberController;
use Illuminate\Http\Request;
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

    Route::controller(AuthController::class)->group(function(){
        Route::post('/register','register');
        Route::post('/login','login');
        Route::options('/logout','logout')->middleware('auth:sanctum');
    });

    Route::post('subscriber',[SubscriberController::class,'createSubscriber'])->middleware('auth:sanctum');

