<?php

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

Route::middleware('api')->get('/user', function (Request $request) {
    return 'Hello user muser';
});

//Route::middleware('api', 'throttle:60,1')->group(function () {
//    Route::post('/bet', 'BetController@store');
//});

Route::middleware('api')->group(function () {
    Route::post('/bet', 'BetController@store');
});
