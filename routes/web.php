<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index');

    Route::post('conversations', 'ConversationsController@store');
    Route::get('conversations/{conversation}', 'ConversationsController@index');
    Route::get('conversations/{conversation}/messages', 'MessagesController@index');
    Route::post('conversations/{conversation}/messages', 'MessagesController@store');
});
