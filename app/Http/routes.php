<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'HomeController@index');

Route::get('upload', 'UserReportsController@index');
Route::post('apply/upload', 'UserReportsController@upload');
Route::get('reports/{id?}', 'ReportsController@index');

Route::resource('users', 'UsersController');
Route::resource('terminals', 'TerminalController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
