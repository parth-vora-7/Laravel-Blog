const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

 elixir(mix => {
 	//mix.sass('app.scss')
 	mix.webpack('app.js')
 	.styles([
 		'bootstrap.min.css',
 		'agency.css',
 		'font-awesome.min.css',
 		'bootstrap-social.css',
 		'bootstrap-datetimepicker.min.css',
 		'select2.min.css',
 		'icheck.css',
 		'custom.css'
 		])
 	.scripts([
 		//'jquery-3.1.1.min.js',
 		//'bootstrap.min.js',
 		'jquery.easing.min.js',
 		'jqBootstrapValidation.js',
 		'agency.min.js',
 		'moment.js',
 		'bootstrap-datetimepicker.min.js',
 		'select2.min.js',
 		'contact_me.js',
 		'icheck.min.js',
 		'custom.js'
	])
	.version(['css/all.css', 'js/app.js', 'js/all.js'], 'public');
 });