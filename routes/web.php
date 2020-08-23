<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/store/search', 'AjaxSearchController@index');
Route::get('/detail/{id}', 'AjaxSearchController@show');

Route::get('/search', 'AjaxSearchController@generalSearch')->name('search');

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/search_product', 'WelcomeController@search_product');

Route::get('/profile', 'ProfileController@index');

Route::get('/new/geo', 'JsonStoreController@index');
Route::get('/new/province', 'JsonStoreController@province');
Route::get('/new/districts', 'JsonStoreController@districts');
Route::get('/new/subdistricts', 'JsonStoreController@subdistricts');
Route::get('/new/zipcode', 'JsonStoreController@zipcode');

Route::group(['prefix' => 'ajax'], function () {
    Route::get('/getamphuresbyprovince/{province_id}', 'AjaxSearchController@getAmphuresByProvinceID');
    Route::get('/getsubdistrictbydistrict/{district_id}', 'AjaxSearchController@getSubDistrictByDistrictID');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'DashboardController@index')->name('home');


Route::get('/cart', 'CartController@index')->middleware('auth')->name('cart.index');
Route::get('/cart/{product_id}', 'CartController@store')->middleware('auth')->name('cart.store');
Route::get('/cart/{product_id}/delete', 'CartController@delete')->middleware('auth')->name('cart.delete');
Route::get('/cart/checkout/cart', 'CartController@confirm')->middleware('auth')->name('cart.confirm');


Route::resource('/type', 'TypeController')->middleware('auth');
Route::get('/type/edit/{id}', 'TypeController@edit')->middleware('auth')->name('type.edit');
Route::put('/type/update', 'TypeController@update')->middleware('auth')->name('type.update');
Route::get('/type/destroy/{id}', 'TypeController@destroy')->middleware('auth')->name('type.destroy');

Route::resource('/promotion', 'PromotionController')->middleware('auth');
Route::get('/promotion/edit/{id}', 'PromotionController@edit')->middleware('auth')->name('promotion.edit');
Route::put('/promotion/update', 'PromotionController@update')->middleware('auth')->name('promotion.update');

Route::resource('/store', 'StoreController')->middleware('auth');
Route::get('/store/edit/{id}', 'StoreController@edit')->middleware('auth')->name('store.edit');
Route::put('/store/update', 'StoreController@update')->middleware('auth')->name('store.update');
Route::get('/store/destroy/{id}', 'StoreController@destroy')->middleware('auth')->name('store.destroy');

Route::resource('/storetype', 'StoreTypeController')->middleware('auth');
Route::get('/storetype/edit/{id}', 'StoreTypeController@edit')->middleware('auth')->name('storetype.edit');
Route::put('/storetype/update', 'StoreTypeController@update')->middleware('auth')->name('storetype.update');

Route::resource('/product', 'ProductController')->middleware('auth');
Route::get('/product/edit/{id}', 'ProductController@edit')->middleware('auth')->name('product.edit');
Route::put('/product/update', 'ProductController@update')->middleware('auth')->name('product.update');
Route::get('/product/destroy/{id}', 'ProductController@destroy')->middleware('auth')->name('product.destroy');

Route::resource('/order', 'OrderController')->middleware('auth');
Route::get('/order/edit/{id}', 'OrderController@edit')->middleware('auth')->name('order.edit');
Route::put('/order/update', 'OrderController@update')->middleware('auth')->name('order.update');
Route::get('/order/destroy/{id}', 'OrderController@destroy')->middleware('auth')->name('order.destroy');

