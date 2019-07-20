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
    return view('logs');
})->middleware('guest');
Route::post('/login','LoginController@login')->name('login');

Route::get('/inicio','LoginController@inicio');
Route::get('rol/{id}', 'LoginController@redirect')->name('rol');




Route::get('/Administrador', function () { return view('Administrador'); });
Route::get('/Contador', function () { return view('Contador'); });
Route::get('/Regente', function () { return view('Regente'); });
Route::get('/Profesor', function () { return view('Profesor'); });
Route::get('/Padre', function () { return view('Padre'); });