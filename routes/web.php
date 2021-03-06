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
Route::get('/show/banners', 'BannerAPIController@showbanner');
Route::get('/product/updatesequence', 'ProductController@updateSequence')->name('product.updatesequence');
Route::get('/banner/updatesequence', 'BannerController@updateSequence')->name('banner.updatesequence');
Route::get('/banner/getContent', 'BannerAPIController@showbanner')->name('banner.updatesequence');
Route::get('/getAQi', 'AjaxSearchController@getAQi')->name('getAQi');

Route::get("/page", function(){
    return view("frontend.new_design");
 });

 Route::group(['prefix' => 'linebotweb'], function () {
    Route::get('/reply', 'LineBotController@reply')->name('linebot.reply');
});

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/search_product', 'WelcomeController@search_product');

// Route::get('/example/pdf', 'WelcomeController@pdf_index');

Route::get('/auth/github', 'Auth\LoginController@redirectToGithub');
Route::get('/auth/github/callback', 'Auth\LoginController@handleGithubCallback');
Route::get('/auth/facebook', 'Auth\LoginController@redirectToFaceBook');
Route::get('/auth/facebook/callback', 'Auth\LoginController@handleFaceBookCallback');
Route::get('/auth/line', 'Auth\LoginController@redirectToLine');
Route::get('/auth/line/callback', 'Auth\LoginController@handleLineCallback');

Route::group(['prefix' => 'ajax'], function () {
    Route::get('/getamphuresbyprovince/{province_id}', 'AjaxSearchController@getAmphuresByProvinceID');
    Route::get('/getsubdistrictbydistrict/{district_id}', 'AjaxSearchController@getSubDistrictByDistrictID');
    Route::get('/getzipcodebysubdistrict/{subdistrict}', 'AjaxSearchController@getZipCodeBySubDistrictID');
});

Auth::routes();

Route::group(['middleware' => 'Verify'], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/getOrderHistory', 'AjaxSearchController@getHistoryOrder')->name('orderHistory');
    
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'ProfileController@index')->name('profile.index');
        Route::get('/create', 'ProfileController@create')->name('profile.create');
        Route::post('/store', 'ProfileController@store')->name('profile.store');
    });

    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::get('/cart/{product_id}', 'CartController@store')->name('cart.store');
    Route::get('/cart/{product_id}/delete', 'CartController@delete')->name('cart.delete');
    Route::get('/cart/checkout/cart', 'CartController@confirm')->name('cart.confirm');
    Route::post('/cart/checkout/newcart', 'CartController@newConfirm')->name('cart.newConfirm');


    Route::group(['middleware' => ['role:Admin|Staff']], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('home');
        Route::group(['prefix' => 'staff'], function () {
            Route::group(['prefix' => 'store'], function () {
                Route::get('/', 'Staff\StoreController@index')->name('store.staff_index');
                Route::get('/create', 'Staff\StoreController@create')->name('store.staff_create');
                Route::post('/store', 'Staff\StoreController@store')->name('store.store_staff_add');
            });
        });
        Route::get('/store/search', 'AjaxSearchController@index');
        Route::get('/store/detail/{id}', 'AjaxSearchController@show');

        Route::get('/search', 'AjaxSearchController@generalSearch')->name('search');
    });


    Route::group(['middleware' => ['role:Admin']], function () {

        Route::resource('/type', 'TypeController');
        Route::get('/type/edit/{id}', 'TypeController@edit')->name('type.edit');
        Route::put('/type/update', 'TypeController@update')->name('type.update');

        Route::group(['prefix' => 'permission'], function () {
            Route::get('/', 'PermissionController@index')->name('permission.index');
            Route::get('/create', 'PermissionController@create')->name('permission.create');
            Route::post('/store', 'PermissionController@store')->name('permission.store');
            Route::get('/edit/{id}', 'PermissionController@edit')->name('permission.edit');
            Route::put('/update', 'PermissionController@update')->name('permission.update');
            Route::get('/destroy', 'PermissionController@destroy')->name('permission.destroy');
        });
    
        Route::resource('/store', 'StoreController');
        Route::get('/store/edit/{id}', 'StoreController@edit')->name('store.edit');
        Route::put('/store/update', 'StoreController@update')->name('store.update');
        Route::get('/store/ajax/updatePublish', 'StoreController@updatePublish');
        
    
        Route::resource('/promotion', 'PromotionController');
        Route::get('/promotion/edit/{id}', 'PromotionController@edit')->name('promotion.edit');
        Route::put('/promotion/update', 'PromotionController@update')->name('promotion.update');
        Route::get('/promotion/ajax/updatePublish', 'PromotionController@updatePublish');
        
    
        Route::resource('/storetype', 'StoreTypeController');
        Route::get('/storetype/edit/{id}', 'StoreTypeController@edit')->name('storetype.edit');
        Route::put('/storetype/update', 'StoreTypeController@update')->name('storetype.update');
    
        Route::resource('/product', 'ProductController');
        Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::put('/product/update', 'ProductController@update')->name('product.update');
        Route::get('/product/ajax/updatePublish', 'ProductController@updatePublish');
        

        Route::resource('/order', 'OrderController');
        Route::get('/order/edit/{id}', 'OrderController@edit')->name('order.edit');
        Route::put('/order/update', 'OrderController@update')->name('order.update');
        Route::get('/order/destroy/{id}', 'OrderController@destroy')->name('order.destroy');

        Route::resource('/banner', 'BannerController');
        Route::get('/banner/edit/{id}', 'BannerController@edit')->name('banner.edit');
        Route::put('/banner/update', 'BannerController@update')->name('banner.update');
        Route::get('/banner/destroy/{id}', 'BannerController@destroy')->name('banner.destroy');
        Route::get('/banner/ajax/updatePublish', 'BannerController@updatePublish');

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserManagementController@index')->name('user.index');
            Route::get('/edit/{id}', 'UserManagementController@edit')->name('user.edit');
            Route::put('/update', 'UserManagementController@update')->name('user.update');
            Route::get('/destroy', 'UserManagementController@destroy')->name('user.destroy');
            Route::get('/ajax/updatePublish', 'UserManagementController@updatePublish')->name('user.updatePublish');
        });

        Route::group(['prefix' => 'dailyreport'], function () {
            Route::get('/', 'DailyReportController@index')->name('dailyreport.index');
            Route::get('/create', 'DailyReportController@create')->name('dailyreport.create');
            Route::post('/store', 'DailyReportController@store')->name('dailyreport.store');
            Route::get('/edit/{id}', 'DailyReportController@edit')->name('dailyreport.edit');
            Route::put('/update', 'DailyReportController@update')->name('dailyreport.update');
            Route::get('/destroy', 'DailyReportController@destroy')->name('dailyreport.destroy');
        });
    
        Route::group(['prefix' => 'role'], function () {
            Route::get('/', 'RoleManagementController@index')->name('role.index');
            Route::get('/create', 'RoleManagementController@create')->name('role.create');
            Route::post('/store', 'RoleManagementController@store')->name('role.store');
            Route::get('/edit/{id}', 'RoleManagementController@edit')->name('role.edit');
            Route::put('/update', 'RoleManagementController@update')->name('role.update');
        });

        Route::group(['prefix' => 'emstracking'], function () {
            Route::get('/', 'AjaxSearchController@EmsTracking')->name('emstracking.index');
            Route::get('/search', 'AjaxSearchController@EmsTrackingConnect');
        });

        Route::group(['prefix' => 'healthcare'], function () {
            Route::get('/', 'HealthCareController@index')->name('healthcare.index');
            Route::get('/create', 'HealthCareController@create')->name('healthcare.create');
            Route::post('/store', 'HealthCareController@store')->name('healthcare.store');
            Route::get('/edit/{id}', 'HealthCareController@edit')->name('healthcare.edit');
            Route::put('/update', 'HealthCareController@update')->name('healthcare.update');
            Route::get('/destroy', 'HealthCareController@destroy')->name('healthcare.destroy');
        });
    });


});

