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


Route::get('/', 'AjaxSearchController@index');
Route::get('/detail/{id}', 'AjaxSearchController@show');

Route::get('/search', 'AjaxSearchController@generalSearch')->name('search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/type', 'TypeController')->middleware('auth');
Route::get('/type/edit/{id}', 'TypeController@edit')->middleware('auth')->name('type.edit');
Route::put('/type/update', 'TypeController@update')->middleware('auth')->name('type.update');

Route::resource('/promotion', 'PromotionController')->middleware('auth');
Route::get('/promotion/edit/{id}', 'PromotionController@edit')->middleware('auth')->name('promotion.edit');
Route::put('/promotion/update', 'PromotionController@update')->middleware('auth')->name('promotion.update');

Route::resource('/store', 'StoreController')->middleware('auth');
Route::get('/store/edit/{id}', 'StoreController@edit')->middleware('auth')->name('store.edit');
Route::put('/store/update', 'StoreController@update')->middleware('auth')->name('store.update');

