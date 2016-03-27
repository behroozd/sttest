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

/*


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
*/
Route::get('/hello',function(){
    return 'Hello World!';
});
/*
Route::group(array('prefix' => 'api'), function()
{
  /* 	Route::resource('product', 'ProductController', [
		'except' => ['index']
	]);

});

*/
Route::get('/'             , 'HomeController@index');
Route::get('admin'         , 'AdminController@index');
Route::get('admin/{page}/' , 'AdminController@show');

Route::resource('products'                , 'ProductController');
Route::resource('products/{id}/'          , 'ProductController');
Route::resource('products/{action}/{id}/' , 'ProductController');


Route::resource('login'        , 'LoginController');
Route::resource('login/{act}/' , 'LoginController');
//Route::resource('/admin/products' , 'AdminController@products');

Route::resource('test' , 'TestController@index');
