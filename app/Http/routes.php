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

	//checkout controller
	Route::get('/checkout','ShopController@checkout');

	//cart controller
	Route::post('cart', ['uses' => 'ShopController@cart', 'as' => 'shop.cart']);
	Route::get('/cart','ShopController@cart');
	//Front-end product route for details page
	Route::get('shop', ['uses' => 'ShopController@getIndex', 'as' => 'shop.index']);

	//Front-end product route for single page
	Route::get('shop/{slug}', ['as' => 'shop.single', 'uses' => 'ShopController@getSingle'])->where('slug','[\w\d\-\_]+');

	//Authentication route
	Route::get('login',['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
	Route::post('login', 'Auth\AuthController@postLogin');
	Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

	//Profile update
	Route::get('ob-admin/profile/', ['uses' => 'ProfileController@getEdit', 'as' => 'profile.edit']);
	Route::put('ob-admin/profile/{id}', ['uses' => 'ProfileController@getUpdate', 'as' => 'profile.update']);
	Route::get('ob-admin',['uses' => 'AdminController@getIndex', 'as' => 'admin.index']);
	//password reset
	Route::get('ob-admin/profile/reset-password', ['uses' => 'ProfileController@getPassword', 'as' => 'profile.password']);
	Route::put('ob-admin/profile/reset-password/update', ['uses' => 'ProfileController@updatePassword', 'as' => 'password.update']);

	// Registration Routes
	Route::get('register', 'Auth\AuthController@getRegister');
	Route::post('register', 'Auth\AuthController@postRegister');
	//Comments
	Route::post('comment/{post_id}', ['uses' => 'CommentController@store', 'as' => 'comment.store']);
		
	Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug','[\w\d\-\_]+');
	Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);
	Route::get('/contact','PagesController@getContact');
	Route::get('/about','PagesController@getAbout');
    Route::get('/','PagesController@getIndex');
    //Route::resource('posts','PostController');

});

Route::group(['middleware' => ['web','admin']], function () {

Route::resource('ob-admin/posts','PostController');
//Comments for admin end
Route::get('ob-admin/comment',['uses' => 'CommentController@index', 'as' => 'ob-admin.comment.index']);
Route::get('ob-admin/comment/{id}/edit', ['uses' => 'CommentController@edit', 'as' => 'ob-admin.comment.edit']);
Route::put('ob-admin/comment/{id}', ['uses' => 'CommentController@update', 'as' => 'ob-admin.comment.update']);
Route::delete('ob-admin/comment/{id}', ['uses' => 'CommentController@destroy', 'as' => 'ob-admin.comment.destroy']);
//Category route
Route::resource('ob-admin/categories', 'CategoryController', ['except' => 'create']);
Route::resource('ob-admin/tags', 'TagController', ['except' => 'create']);
//Pages route
Route::resource('ob-admin/pages','PageController');
//media
Route::get('ob-admin/media',['uses' => 'MediaController@getMedia', 'as' => 'media.index']);
Route::get('ob-admin/media/add-new',['uses' => 'MediaController@newMedia', 'as' => 'media.new']);
Route::any('ob-admin/media/upload', array('as' => 'upload', 'uses' => 'MediaController@upload'));
Route::any('ob-admin/media/destroy', array('as' => 'destroy', 'uses' => 'MediaController@destroy'));
//Product route
Route::resource('ob-admin/products','ProductController',[
'except' => [ 'show' ]]);	

});