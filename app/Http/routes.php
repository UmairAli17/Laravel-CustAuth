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


Route::auth();

Route::get('/test/{id}', 'ResidenceController@test');


/**** LANDLORD SPECIFIC ROUTES***/
Route::group(['middleware' => 'roles:landlord'], function() {

  //Landlord Dashboard
  Route::get("/landlord", "LandlordController@landlord_dash")->name('landlord.dash');

  //show current landlord residence
  Route::get("/landlord/my-residences", "LandlordController@my_residences")->name('landlord.my_residences');

  //add a residence to landlord - show form
  Route::get("/landlord/add-residence", "LandlordController@add_residence")->name('residence.add');

  //add a residence to landlord - post form
  Route::POST("/landlord/store-residence", "LandlordController@store_residence")->name('residence.store');

  Route::get("/residence/{id}/edit", "LandlordController@edit_residence")->name('residence.edit');
  
  Route::PATCH("/residence/{id}/update", "LandlordController@update_residence")->name('residence.update');

  Route::get("/business/{id}", "LandlordController@profile")->name('business.profile');
  Route::get("/business/{id}/edit-details", "LandlordController@edit")->name('business.edit');
  Route::PATCH("/business/{id}/update-details", "LandlordController@update")->name('business.update');
});



Route::group(['middleware' => 'roles:admin|student|landlord'], function() 
{

  //PostsUpvote Route
  Route::POST('post/{post}/upvote', 'ResidenceController@up')->name('posts.upvote');
  Route::POST('post/{post}/downvote', 'ResidenceController@down')->name('posts.downvote');
  Route::PATCH('post/{post}/delete', 'PostsController@delete')->name('posts.delete');

  // Residence Routes
  Route::get('reply/{comment}/edit', 'LandlordController@edit_comment')->name('comment.edit');
  Route::PATCH('reply/{comment}/update', 'LandlordController@update_comment')->name('comment.update');
  Route::PATCH('reply/{comment}/delete', 'LandlordController@delete_comment')->name('comment.delete');

  Route::POST('residence/{id}/upvote', 'ResidenceController@upRes')->name('residence.upvote');
  Route::POST('residence/{id}/downvote', 'ResidenceController@downRes')->name('residence.downvote');
  Route::PATCH('residence/{id}/delete', 'ResidenceController@delete')->name('residence.delete');

  //show all residences
  Route::get('residence', 'ResidenceController@all')->name('residences.all');

  //residence/1
  Route::get('residence/{id}', 'ResidenceController@view')->name('residence.view');

  //
  Route::POST('review/{residence}', 'ResidenceController@store_residence_review')->name('residence.store_residence_review');
  Route::POST('reply/{post}', 'LandlordController@reply_comment')->name('posts.reply');

	Route::resource('posts', 'PostsController');
    
  //Shows all of current user's posts
	Route::get('/user/my_posts', 'PostsController@myPosts');
  //Shows all of current user's APPROVED Posts
  Route::get('/user/my_approved_posts', 'PostsController@approved')->name('posts.approved');
  //Shows all of current user's Refused Posts
  Route::get('/user/my_refused_posts', 'PostsController@rejected')->name('posts.rejected');
	//For the current user's account management
	Route::get('user/account', 'AccountManagementController@index');
	Route::get('user/security', 'AccountManagementController@security')->name('user.security');
	//Update the current user's name
	Route::POST('user/security/change_name', 'AccountManagementController@updateName');
	//Update the current user's password
	Route::POST('user/security/change_password', 'AccountManagementController@updatePassword');


  // USER PROFILE ROUTES
  
  Route::get('user/profile/{id}', 'AccountManagementController@profile')->name('user.profile');
  Route::get('/user/profile/{id}/edit', 'AccountManagementController@editProfile')->name('user.profile-edit');
  Route::PATCH('/user/profile/{id}/update', 'AccountManagementController@updateProfile')->name('profile.edit');


});

Route::group(['middleware' => 'roles:admin'], function() {
  Route::get('/admin/', 'AdminController@index');
  Route::get('/admin/moderate-posts', 'AdminController@showPostMod');
  Route::PATCH('mp/ap/{posts}', 'AdminController@postStatus');
  Route::PATCH('mp/comment/{id}', 'AdminController@commentStatus')->name('comment.moderate');
});