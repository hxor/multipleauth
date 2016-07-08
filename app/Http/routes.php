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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'admin'], function(){
	Route::get('/login', ['as'=>'admin.login', 'uses' => 'Authadmin\AuthController@showLoginForm']);
	Route::post('/login', 'Authadmin\AuthController@login');

	Route::get('/password/reset', 'Authadmin\AuthController@resetPassword');
	Route::post('/password/email','Authadmin\PasswordController@sendResetLinkEmail');
	Route::post('/password/reset','Authadmin\PasswordController@reset');
	Route::get('/password/reset/{token?}','Authadmin\PasswordController@showResetForm');

	Route::get('/register', 'Authadmin\AuthController@showRegistrationForm');
	Route::post('/register', 'Authadmin\AuthController@register');

	Route::group(['middleware'=>'admin'], function(){
		Route::get('/logout', 'Authadmin\AuthController@logout');
		Route::get('/', 'AdminController@index');
	});
});
