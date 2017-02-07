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

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/users', 'UsersController@store');
    Route::get('/users', 'UsersController@index');
    Route::get('/users/{user}', 'UsersController@show');

    Route::get('/conversations', 'ConversationsController@index');
    Route::post('/conversations', 'ConversationsController@store');
    Route::get('conversations/{conversation}/messages', 'MessagesController@index');
    Route::post('conversations/{conversation}/messages', 'MessagesController@store');
});