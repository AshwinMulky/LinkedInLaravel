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
	Route::post('signout', 'JWTAuthenticationController@signout');

	Route::get('details', 'UserController@index');
	Route::post('update_details', 'UserController@updateDetails');
	Route::post('update_user_skill', 'UserController@updateUserSkill');
	Route::post('update_user_education', 'UserController@updateUserEducation');
	Route::post('update_user_company', 'UserController@updateUserCompany');

	Route::get('auth/linkedin', 'LinkedInAuthenticationController@redirectToProvider');
	Route::get('auth/linkedin/callback', 'LinkedInAuthenticationController@handleProviderCallback');

	Route::get('get_all_trainers', 'TrainerController@listAllTrainers');
	Route::get('get_all_skills','TrainerController@listAllSkills');
	Route::post('get_trainers', 'TrainerController@filterTrainers');
	
});
