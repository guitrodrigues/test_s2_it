<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->get('/people', 'ApiController@getPeople');
Route::middleware('api')->get('/person/{id}', 'ApiController@getPerson');
Route::middleware('api')->get('/shiporders', 'ApiController@getShiporders');
Route::middleware('api')->get('/shiporder/{id}', 'ApiController@getIndexShiporder');
