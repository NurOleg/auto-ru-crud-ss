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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::match(['post', 'get'], '/', 'AdvertController@index');

Route::get('/advert/{id}', 'AdvertController@show')->name('advert.detail');

Route::get('/advert-form/{id?}', 'AdvertController@getForm')->name('form');

Route::post('/store', 'AdvertController@store');

Route::post('/edit', 'AdvertController@edit');
