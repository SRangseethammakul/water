<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/storetype/destroy', 'StoreTypeController@destroy');
Route::get('/product/destroy', 'ProductController@destroy');
Route::get('/type/destroy', 'TypeController@destroy');
Route::get('/store/destroy', 'StoreController@destroy');
Route::get('/promotion/destroy', 'PromotionController@destroy');
Route::get('/order/destroy', 'OrderController@destroy');
Route::get('/getorder', 'AjaxSearchController@getOrderById');
Route::get('/ajax/coutetype', 'AjaxSearchController@count_store_type');
Route::get('/store/testAPI', 'StoreController@testAPI');
Route::get('/show/banners', 'BannerAPIController@showbanner')->name('bannerAPI');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
