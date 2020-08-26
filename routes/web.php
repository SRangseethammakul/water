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
Route::get('/product/updatesequence', 'ProductController@updateSequence')->name('product.updatesequence');

Route::get('/store/search', 'AjaxSearchController@index');
Route::get('/detail/{id}', 'AjaxSearchController@show');

Route::get('/search', 'AjaxSearchController@generalSearch')->name('search');

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/search_product', 'WelcomeController@search_product');

Route::get('/profile', 'ProfileController@index');

// Route::get('/new/geo', 'JsonStoreController@index');
// Route::get('/new/province', 'JsonStoreController@province');
// Route::get('/new/districts', 'JsonStoreController@districts');
// Route::get('/new/subdistricts', 'JsonStoreController@subdistricts');
// Route::get('/new/zipcode', 'JsonStoreController@zipcode');

Route::group(['prefix' => 'ajax'], function () {
    Route::get('/getamphuresbyprovince/{province_id}', 'AjaxSearchController@getAmphuresByProvinceID');
    Route::get('/getsubdistrictbydistrict/{district_id}', 'AjaxSearchController@getSubDistrictByDistrictID');
    Route::get('/getzipcodebysubdistrict/{subdistrict}', 'AjaxSearchController@getZipCodeBySubDistrictID');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');


    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::get('/cart/{product_id}', 'CartController@store')->name('cart.store');
    Route::get('/cart/{product_id}/delete', 'CartController@delete')->name('cart.delete');
    Route::get('/cart/checkout/cart', 'CartController@confirm')->name('cart.confirm');



    Route::group(['middleware' => ['role:Admin']], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('home');

        Route::resource('/type', 'TypeController');
        Route::get('/type/edit/{id}', 'TypeController@edit')->name('type.edit');
        Route::put('/type/update', 'TypeController@update')->name('type.update');
        Route::get('/type/destroy/{id}', 'TypeController@destroy')->name('type.destroy');
    
        Route::resource('/store', 'StoreController');
        Route::get('/store/edit/{id}', 'StoreController@edit')->name('store.edit');
        Route::put('/store/update', 'StoreController@update')->name('store.update');
        Route::get('/store/destroy/{id}', 'StoreController@destroy')->name('store.destroy');
    
        Route::resource('/promotion', 'PromotionController');
        Route::get('/promotion/edit/{id}', 'PromotionController@edit')->name('promotion.edit');
        Route::put('/promotion/update', 'PromotionController@update')->name('promotion.update');
        
    
        Route::resource('/storetype', 'StoreTypeController');
        Route::get('/storetype/edit/{id}', 'StoreTypeController@edit')->name('storetype.edit');
        Route::put('/storetype/update', 'StoreTypeController@update')->name('storetype.update');
    
        Route::resource('/product', 'ProductController');
        Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::put('/product/update', 'ProductController@update')->name('product.update');
        Route::get('/product/destroy/{id}', 'ProductController@destroy')->name('product.destroy');
        

        Route::resource('/order', 'OrderController');
        Route::get('/order/edit/{id}', 'OrderController@edit')->name('order.edit');
        Route::put('/order/update', 'OrderController@update')->name('order.update');
        Route::get('/order/destroy/{id}', 'OrderController@destroy')->name('order.destroy');
    });

});

