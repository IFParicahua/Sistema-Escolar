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

Route::get('/', function () {
    return view('index');
});

Route::get('/rec/{id}','LoginController@rec');
Route::get('/login','LoginController@view')->middleware('guest');
Route::post('/login','LoginController@login')->name('login');
Route::get('/dashboard','DashboardController@index')->name('dashboard');
