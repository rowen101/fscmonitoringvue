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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'Api'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('checkToken', 'AuthController@checkToken');
    Route::post('logout', 'AuthController@logout');
    Route::get('admin', 'AdminController@index');
    Route::post('register', 'RegisterController@register');
    Route::get('menu', 'MenuController@index');
    Route::get('task-list', 'DailytaskController@index');
    Route::post('task-store', 'DailytaskController@store');
});
