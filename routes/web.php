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
Route::get('/scraping/form','ScrapingController@getLoginInformation')->name('login.scraping');

Route::get('/items', 'ItemController@index')->name('user.index');
Route::get('/items/{id}', 'ItemController@detail')->name('detail');
// User ログイン後
Route::group(['middleware' => 'auth:user'], function() {
Route::get('user/home', 'HomeController@index')->name('home');
Route::get('carts/shipping/index', 'ShippingController@index')->name('shipping.index');
Route::post('carts/shipping/save', 'ShippingController@shippingSave')->name('shipping.save');
Route::get('carts/shipping/create', 'ShippingController@showCreateForm')->name('create.form');
Route::post('carts/shipping/create', 'ShippingController@create')->name('shipping.create');
Route::get('carts/shipping/edit/{id}', 'ShippingController@showEditForm')->name('edit.form');
Route::post('carts/shipping/edit/{id}', 'ShippingController@edit')->name('shipping.edit');
Route::post('carts/shipping/delete', 'ShippingController@destroy')->name('shipping.delete');
Route::resource('carts', 'CartController');
Route::get('user/profile/', 'EditProfileController@index')->name('profile.index');
Route::post('user/profile', 'EditProfileController@store')->name('profile.edit');
Route::get('/user/userEmailUpdate/', 'EditProfileController@userEmailUpdate');
Route::get('/scraping','ScrapingController@index')->name('scraping');
//Route::get('/scraping/form','ScrapingController@getLoginInformation')->name('login.scraping');



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
	//Route::resource('items', 'Admin\ItemController', ['except' => 'destroy']);
	Route::get('home/members', 'RegisterMembersController@index')->name('admin.members');
	Route::get('home/members/{id}', 'RegisterMembersController@detail')->name('admin.detail');

});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function() {
	Route::resource('items', 'Admin\ItemController', ['except' => 'destroy']);
});

?>
