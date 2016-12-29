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


/**** LANDLORD SPECIFIC ROUTES***/
Route::group(['middleware' => 'has_business', 'roles:landlord'], function() {
  Route::get("/landlord/business", "LandlordController@business");
});


/**** LANDLORD SPECIFIC ROUTES***/
Route::group(['middleware' => 'has_business', 'roles:landlord'], function() {

  Route::POST("/landlord/store", "LandlordController@store");
});


Route::group(['middleware' => 'roles:admin|user|landlord'], function() 
{
	Route::resource('posts', 'PostsController');
    
    //Shows all of current user's posts
	Route::get('/user/my_posts', 'PostsController@myPosts');
    //Shows all of current user's APPROVED Posts
    Route::get('/user/my_approved_posts', 'PostsController@approvedPosts');
    //Shows all of current user's Refused Posts
    Route::get('/user/my_refused_posts', 'PostsController@approvedPosts');
	//For the current user's account management
	Route::get('user/account', 'AccountManagementController@index');
	Route::get('user/security', 'AccountManagementController@security');
	//Update the current user's name
	Route::POST('user/security/change_name', 'AccountManagementController@updateName');
	//Update the current user's password
	Route::POST('user/security/change_password', 'AccountManagementController@updatePassword');


});

Route::group(['middleware' => 'roles:admin'], function() {
  Route::get('/admin/', 'AdminController@index');
  Route::get('/admin/moderate-posts', 'AdminController@showPostMod');
  Route::PATCH('mp/ap/{posts}', 'AdminController@postStatus');
});