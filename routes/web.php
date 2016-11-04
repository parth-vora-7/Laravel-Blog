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


Route::get('test', function() {
	dd(URL::route('auth.facebook.callback'));
	dd(App\User::truncate());

	$carbonObj = Carbon\Carbon::now();

	/*$blog = new App\Blog();
	$blog->title = 'Tthis is title';
	$blog->text = 'Tthis is text';
	$blog->posted_on = $carbonObj->toDateString();
	$blog->save();*/

	return $blogs = App\Blog::all();
});


