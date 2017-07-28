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

Route::get('/', 'Controller@band');

Route::get('/band', 'Controller@band');
Route::get('/album', 'Controller@album');
Route::post('/delete/{type}/{id}', 'Controller@delete');
Route::get('filter_albums/{id}', 'Controller@filter_albums');
Route::get('/album_details/{acion}/{id?}', 'Controller@album_details');
Route::get('/band_details/{action}/{id?}', 'Controller@band_details');
Route::post('update_band', 'Controller@update_band');
Route::post('create_band', 'Controller@create_band');
Route::post('update_album', 'Controller@update_album');
Route::post('create_album', 'Controller@create_album');
Route::get('get_bands', 'Controller@get_bands');
Route::get('get_band_name/{id}', 'Controller@get_band_name');
Route::get('get_albums', 'Controller@get_albums');