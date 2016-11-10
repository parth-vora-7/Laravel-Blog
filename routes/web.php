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
use App\Http\Controllers\SocialAuthController;

Route::get('/', function () {
	return view('home');
})->name('home');

Auth::routes();

Route::get('profile/edit/{user}', ['as' => 'profile.edit', 'uses' => 'ProfileController@editProfile'])->middleware('can:update,user');
Route::put('profile/update/{user}', ['as' => 'profile.udpate', 'uses' => 'ProfileController@updateProfile']);

Route::get('profile/change-password/{user}', ['as' => 'password.change', 'uses' => 'ProfileController@changePassword'])->middleware('can:update,user');
Route::put('profile/update-password/{user}', ['as' => 'password.udpate', 'uses' => 'ProfileController@udpatePassword']);

Route::get('services', ['as' => 'services', 'uses' => 'BasicpageController@getServices']);
Route::get('portfolio', ['as' => 'portfolio', 'uses' => 'BasicpageController@getPortfolio']);
Route::get('about', ['as' => 'about', 'uses' => 'BasicpageController@getAbout']);
Route::get('team', ['as' => 'team', 'uses' => 'BasicpageController@getTeam']);
Route::get('contact', ['as' => 'contact', 'uses' => 'BasicpageController@getContact']);

Route::get('auth/facebook', ['as' => 'auth.facebook', 'uses' => 'SocialAuthController@redirectToFacebook']);
Route::get('auth/facebook/callback', ['as' => 'auth.facebook.callback', 'uses' => 'SocialAuthController@returnFromFacebook']);

Route::get('auth/twitter', ['as' => 'auth.twitter', 'uses' => 'SocialAuthController@redirectToTwitter']);
Route::get('auth/twitter/callback', ['as' => 'auth.twitter.callback', 'uses' => 'SocialAuthController@returnFromTwitter']);

Route::get('auth/google', ['as' => 'auth.google', 'uses' => 'SocialAuthController@redirectToGoogle']);
Route::get('auth/google/callback', ['as' => 'auth.google.callback', 'uses' => 'SocialAuthController@returnFromGoogle']);

Route::get('auth/linkedin', ['as' => 'auth.linkedin', 'uses' => 'SocialAuthController@redirectToLinkedin']);
Route::get('auth/linkedin/callback', ['as' => 'auth.linkedin.callback', 'uses' => 'SocialAuthController@returnFromLinkedin']);

Route::get('auth/github', ['as' => 'auth.github', 'uses' => 'SocialAuthController@redirectToGithub']);
Route::get('auth/github/callback', ['as' => 'auth.github.callback', 'uses' => 'SocialAuthController@returnFromGithub']);

Route::get('auth/bitbucket', ['as' => 'auth.bitbucket', 'uses' => 'SocialAuthController@redirectToBitbucket']);
Route::get('auth/bitbucket/callback', ['as' => 'auth.bitbucket.callback', 'uses' => 'SocialAuthController@returnFromBitbucket']);

Route::resource('blog', 'BlogController');
Route::get('myblogs', ['as' => 'myblogs', 'uses' => 'BlogController@myBlogs']);

Route::get('test', function() {
	$blog = App\Blog::find('582424b4b3f3ba21f238c072')->user->name;
	dd($blog);
});