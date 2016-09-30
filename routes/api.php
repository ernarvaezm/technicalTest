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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::post('auth/login','AuthController@login');
Route::post('auth/register','AuthController@register');
Route::get('auth/logout','AuthController@logout');
Route::get('movies/','MovieController@index');
Route::get('movies/{id}','MovieController@show');
Route::get('movies/search/{key}','MovieController@search');
