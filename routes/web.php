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
// User 認証不要
Route::get('/', function () {
	 return redirect('home');
});

Route::get('/items', 'ItemController@index');
Route::get('/items/{id}', 'ItemController@detail')->name('detail');
// User ログイン後
Route::group(['middleware' => 'auth:user'], function() {
Route::get('home', 'HomeController@index')->name('home');
Route::resource('carts', 'CartController');
});
// Admin 認証不要
Route::group(['prefix' => 'admin'], function() {
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
});
// Admin ログイン後
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
	Route::get('home', 'HomeController@index')->name('admin.home');
	Route::resource('items', 'Admin\ItemController', ['except' => 'destroy']);
});

?>
