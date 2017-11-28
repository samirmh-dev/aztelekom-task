<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::get('/', 'IndexController@index')->name('index');

//Admin paneli ucun
Route::group(['prefix' => 'admin',  'middleware' => ['auth','admin']], function()
{
	Route::get('/',function(){
		return view('admin.index');
	})->name('admin.index');

	Route::resource('kateqoriyalar','KateqoriyalarController',[
		'except'=>['show']
	]);

	Route::resource('alt-kateqoriyalar','AltKateqoriyalarController',[
		'except'=>['show']
	]);

	Route::resource( 'product', 'ProductController');
});


Route::get('product/{id}','ProductController@product_page')->name('product_page');
Route::post('add-to-cart','ProductController@add_to_cart')->name('add-to-cart');
Route::post('add-rating','ProductController@add_rating')->name('add-rating');
