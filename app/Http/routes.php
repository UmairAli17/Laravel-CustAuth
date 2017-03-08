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

Route::get('/home', 'HomeController@index')->name('home');


/**** LANDLORD SPECIFIC ROUTES***/
Route::group(['middleware' => 'roles:landlord'], function() {

  //Landlord Dashboard
  Route::get("/landlord", "LandlordController@landlord_dash")->name('landlord.dash');

  //add a residence to landlord - show form
  Route::get("/landlord/my-residences", "LandlordController@my_residences")->name('landlord.my_residences');

  //add a residence to landlord - show form
  Route::get("/landlord/add-residence", "LandlordController@add_residence")->name('residence.add');

  //add a residence to landlord - post form
  Route::POST("/landlord/store-residence", "LandlordController@store_residence")->name('residence.store');

  Route::get("/residence/{id}/edit", "LandlordController@edit_residence")->name('residence.edit');
  
  Route::PATCH("/residence/{id}/update", "LandlordController@update_residence")->name('residence.update');
});



Route::group(['middleware' => 'roles:admin|user|landlord'], function() 
{

  // Residence Routes

  //show all residences
  Route::get('residence', 'ResidenceController@all')->name('residences.all');

  //residence/1
  Route::get('residence/{id}', 'ResidenceController@view')->name('residence.view');

  //
  Route::POST('review/{residence}', 'ResidenceController@store_residence_review')->name('residence.store_residence_review');

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