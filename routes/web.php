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

Route::get('/home', 'HomeController@index');

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

Route::get('test', function() {
	$file = 'https://avatars.githubusercontent.com/u/4241851?v=3';
	$image_info = getimagesize($file);
	echo $extension = image_type_to_extension($image_info[2]);

	file_put_contents('storage/avatars/origional/'.rand() . $extension, file_get_contents($file));

	return;
	dd(App\User::destroy('581c9366b3f3ba475d2c4c84'));

	$carbonObj = Carbon\Carbon::now();

	/*$blog = new App\Blog();
	$blog->title = 'Tthis is title';
	$blog->text = 'Tthis is text';
	$blog->posted_on = $carbonObj->toDateString();
	$blog->save();*/

	return $blogs = App\Blog::all();
});


