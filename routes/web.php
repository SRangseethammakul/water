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
Route::get('/banner/updatesequence', 'BannerController@updateSequence')->name('banner.updatesequence');

Route::get('/store/search', 'AjaxSearchController@index');
Route::get('/store/detail/{id}', 'AjaxSearchController@show');

Route::get('/search', 'AjaxSearchController@generalSearch')->name('search');

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/search_product', 'WelcomeController@search_product');

Route::get('/test', 'WelcomeController@test');

Route::get('/profile', 'ProfileController@index');


Route::get('/store/staff_create', 'StoreController@staff_create')->name('store.staff_create');
Route::post('/store/store_staff_add', 'StoreController@store_staff_add')->name('store.store_staff_add');


// Route::get('/storetype/destroy', 'StoreTypeController@destroy');

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

    
        Route::resource('/store', 'StoreController');
        
        Route::get('/store/edit/{id}', 'StoreController@edit')->name('store.edit');
        Route::put('/store/update', 'StoreController@update')->name('store.update');
        
    
        Route::resource('/promotion', 'PromotionController');
        Route::get('/promotion/edit/{id}', 'PromotionController@edit')->name('promotion.edit');
        Route::put('/promotion/update', 'PromotionController@update')->name('promotion.update');
        
    
        Route::resource('/storetype', 'StoreTypeController');
        Route::get('/storetype/edit/{id}', 'StoreTypeController@edit')->name('storetype.edit');
        Route::put('/storetype/update', 'StoreTypeController@update')->name('storetype.update');
    
        Route::resource('/product', 'ProductController');
        Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::put('/product/update', 'ProductController@update')->name('product.update');
        

        Route::resource('/order', 'OrderController');
        Route::get('/order/edit/{id}', 'OrderController@edit')->name('order.edit');
        Route::put('/order/update', 'OrderController@update')->name('order.update');
        Route::get('/order/destroy/{id}', 'OrderController@destroy')->name('order.destroy');

        Route::resource('/banner', 'BannerController');
        Route::get('/banner/edit/{id}', 'BannerController@edit')->name('banner.edit');
        Route::put('/banner/update', 'BannerController@update')->name('banner.update');
        Route::get('/banner/destroy/{id}', 'BannerController@destroy')->name('banner.destroy');

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserManagementController@index')->name('user.index');
            Route::get('/edit/{id}', 'UserManagementController@edit')->name('user.edit');
            Route::put('/update', 'UserManagementController@update')->name('user.update');
        });
    
        Route::group(['prefix' => 'role'], function () {
            Route::get('/', 'RoleManagementController@index')->name('role.index');
            Route::get('/create', 'RoleManagementController@create')->name('role.create');
            Route::post('/store', 'RoleManagementController@store')->name('role.store');
        });
    });

});

