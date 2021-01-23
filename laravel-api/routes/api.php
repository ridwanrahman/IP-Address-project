<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IPController;
use App\Http\Controllers\ManuController;
use App\Http\Controllers\ProductController;

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

Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'
], function($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::get('profile', 'AuthController@profile');
    Route::post('refresh', 'AuthController@refresh');
});

Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
], function($router) {
    // Route::resource('ip', 'IPController');
    Route::get('open', 'IPController@open');
    Route::get('close', 'IPController@close');
    // Route::get('users', 'IPController@getUsers');
    Route::get('users/{id?}', 'IPController@getUsers');

    Route::post('addip/{id?}', 'IPController@addIP');
    
    Route::get('manu','ManuController@create_data');
    Route::get('prod','ProductController@index');
    Route::get('select_manufacturer','ManuController@select_data');
});