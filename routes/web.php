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

Route::get('/', 'GuestController@index');

Route::get('/create', 'GuestController@create');

Route::post('/create', 'GuestController@submitCreate');

Route::get('/edit/{id}', 'GuestController@edit');

Route::post('/edit/{id}', 'GuestController@submitEdit');

Route::get('/detail/{id}', 'GuestController@detail');
