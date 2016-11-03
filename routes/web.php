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

Route::get('test', function() {
	$carbonObj = Carbon\Carbon::now();

	/*$blog = new App\Blog();
	$blog->title = 'Tthis is title';
	$blog->text = 'Tthis is text';
	$blog->posted_on = $carbonObj->toDateString();
	$blog->save();*/

	return $blogs = App\Blog::all();
});
