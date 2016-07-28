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
	//return $errors;
});

Route::group(['prefix' => 'api', 'middleware' => ['interceptor']], function(){
	
	Route::post('authenticate','JWTAuthenticationController@authenticate');
	Route::post('signup', 'JWTAuthenticationController@signup');

	Route::get('me', 'UserController@index');
	Route::post('update_user', 'UserController@updateUserDetails');
	Route::post('update_skills', 'UserController@updateSkills');
	Route::post('update_educations', 'UserController@updateEducations');


	Route::get('auth/linkedin', 'LinkedInAuthenticationController@redirectToProvider');
	Route::get('auth/linkedin/callback', 'LinkedInAuthenticationController@handleProviderCallback');
	
});
