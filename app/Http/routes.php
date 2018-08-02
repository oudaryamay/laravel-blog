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

Route::group(['middleware' => ['web']], function () {

	//Authentication route
	Route::get('login',['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
	Route::post('login', 'Auth\AuthController@postLogin');
	Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

	//Profile update
	Route::get('ob-admin/profile/', ['uses' => 'ProfileController@getEdit', 'as' => 'profile.edit']);
	Route::put('ob-admin/profile/{id}', ['uses' => 'ProfileController@getUpdate', 'as' => 'profile.update']);
	//password reset
	Route::get('ob-admin/profile/reset-password', ['uses' => 'ProfileController@getPassword', 'as' => 'profile.password']);

	// Registration Routes
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');

	Route::get('ob-admin',['uses' => 'AdminController@getIndex', 'as' => 'admin.index']);

	//media
	Route::get('ob-admin/media',['uses' => 'MediaController@getMedia', 'as' => 'media.index']);
	Route::get('ob-admin/media/add-new',['uses' => 'MediaController@newMedia', 'as' => 'media.new']);
	Route::any('ob-admin/media/upload', array('as' => 'upload', 'uses' => 'MediaController@upload'));
	Route::any('ob-admin/media/destroy', array('as' => 'destroy', 'uses' => 'MediaController@destroy'));

	//Pages route
	Route::resource('pages','PageController');

	//Category route
	Route::resource('categories', 'CategoryController', ['except' => 'create']);
	Route::resource('tags', 'TagController', ['except' => 'create']);

	//Comments
	Route::post('comment/{post_id}', ['uses' => 'CommentController@store', 'as' => 'comment.store']);
	
	//Comments for admin end
	Route::get('ob-admin/comment',['uses' => 'CommentController@index', 'as' => 'comment.index']);
	Route::get('ob-admin/comment/{id}/edit', ['uses' => 'CommentController@edit', 'as' => 'comment.edit']);
	Route::put('ob-admin/comment/{id}', ['uses' => 'CommentController@update', 'as' => 'comment.update']);
	Route::delete('ob-admin/comment/{id}', ['uses' => 'CommentController@destroy', 'as' => 'comment.destroy']);

	Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug','[\w\d\-\_]+');
	Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);
	Route::get('/contact','PagesController@getContact');
	Route::get('/about','PagesController@getAbout');
    Route::get('/','PagesController@getIndex');
    Route::resource('posts','PostController');

});