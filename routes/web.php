<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', function () {
	return view('home');
})->name('home');

Auth::routes();

Route::group(['prefix' => 'profile', 'middleware' => 'can:update,user'], function () {
	Route::get('edit/{user}', ['as' => 'profile.edit', 'uses' => 'ProfileController@editProfile']);
	Route::put('update/{user}', ['as' => 'profile.udpate', 'uses' => 'ProfileController@updateProfile']);
	Route::get('change-password/{user}', ['as' => 'password.change', 'uses' => 'ProfileController@changePassword']);
	Route::put('update-password/{user}', ['as' => 'password.udpate', 'uses' => 'ProfileController@udpatePassword']);
	Route::get('set-password/{user}', ['as' => 'password.set', 'uses' => 'ProfileController@setPassword']);
	Route::post('save-password/{user}', ['as' => 'password.save', 'uses' => 'ProfileController@savePassword']);
});

Route::group(['prefix' => 'auth'], function () {
	Route::get('facebook', ['as' => 'auth.facebook', 'uses' => 'SocialAuthController@redirectToFacebook']);
	Route::get('facebook/callback', ['as' => 'auth.facebook.callback', 'uses' => 'SocialAuthController@returnFromFacebook']);
	Route::get('twitter', ['as' => 'auth.twitter', 'uses' => 'SocialAuthController@redirectToTwitter']);
	Route::get('twitter/callback', ['as' => 'auth.twitter.callback', 'uses' => 'SocialAuthController@returnFromTwitter']);
	Route::get('google', ['as' => 'auth.google', 'uses' => 'SocialAuthController@redirectToGoogle']);
	Route::get('google/callback', ['as' => 'auth.google.callback', 'uses' => 'SocialAuthController@returnFromGoogle']);
	Route::get('linkedin', ['as' => 'auth.linkedin', 'uses' => 'SocialAuthController@redirectToLinkedin']);
	Route::get('linkedin/callback', ['as' => 'auth.linkedin.callback', 'uses' => 'SocialAuthController@returnFromLinkedin']);
	Route::get('github', ['as' => 'auth.github', 'uses' => 'SocialAuthController@redirectToGithub']);
	Route::get('github/callback', ['as' => 'auth.github.callback', 'uses' => 'SocialAuthController@returnFromGithub']);
	Route::get('bitbucket', ['as' => 'auth.bitbucket', 'uses' => 'SocialAuthController@redirectToBitbucket']);
	Route::get('bitbucket/callback', ['as' => 'auth.bitbucket.callback', 'uses' => 'SocialAuthController@returnFromBitbucket']);
});

Route::group(['prefix' => 'blog'], function () {
	Route::get('/', ['as' => 'blog.index', 'uses' => 'BlogController@index']);
	Route::get('user/{user}', ['as' => 'user.blog', 'uses' => 'BlogController@userBlogs']);
	Route::get('create', ['as' => 'blog.create', 'uses' => 'BlogController@create'])->middleware('auth');
	Route::post('/', ['as' => 'blog.store', 'uses' => 'BlogController@store'])->middleware('auth');
	Route::get('{blog}/edit', ['as' => 'blog.edit', 'uses' => 'BlogController@edit'])->middleware('can:update,blog');
	Route::match(['put', 'patch'], '{blog}', ['as' => 'blog.update', 'uses' => 'BlogController@update'])->middleware('can:update,blog');
	Route::delete('{blog}', ['as' => 'blog.destroy', 'uses' => 'BlogController@destroy'])->middleware('can:delete,blog');
	Route::get('{blog}', ['as' => 'blog.show', 'uses' => 'BlogController@show']);
});

Route::group(['prefix' => 'page'], function () {
	Route::get('services', ['as' => 'services', 'uses' => 'BasicpageController@getServices']);
	Route::get('portfolio', ['as' => 'portfolio', 'uses' => 'BasicpageController@getPortfolio']);
	Route::get('about', ['as' => 'about', 'uses' => 'BasicpageController@getAbout']);
	Route::get('team', ['as' => 'team', 'uses' => 'BasicpageController@getTeam']);
	Route::get('contact', ['as' => 'contact', 'uses' => 'BasicpageController@getContact']);
});

Route::get('test', function() {
	dd(Carbon\Carbon::now());
});