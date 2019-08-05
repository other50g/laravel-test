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

Route::group(['middleware' => 'guest:api'], function() {
    Route::post('/login', 'Api\UsersController@login');
});

Route::group(['middleware' => ['auth:api']], function() {
    Route::resource('users', 'Api\UsersController');
});
