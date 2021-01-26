<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IPController;

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

    Route::post('addip', 'IPController@addIP');
    Route::get('getAllIP/{id}', 'IPController@getAllIPByUser');
    Route::get('getIPRecordByID/{id}', 'IPController@getIPRecordByID');
    
    Route::post('saveIPRecordById', 'IPController@saveIPRecordById');

    Route::get('getUserAudits', 'IPController@getAuditByUserID');

});