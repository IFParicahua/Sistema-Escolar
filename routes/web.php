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

Route::get('/Administrador', 'AdministradorController@index');
Route::get('/AdminUser', 'AdministradorController@usuario')->name('AdminUser');

Route::get('/AdminProfesor', 'AdministradorController@profesor')->name('AdminProfesor');
Route::get('/AdminGestion', 'AdministradorController@gestion')->name('AdminGestion');
Route::get('/AdminNivel', 'AdministradorController@nivel')->name('AdminNivel');
Route::get('/AdminCurso', 'AdministradorController@curso')->name('AdminCurso');
Route::get('/AdminTurno', 'AdministradorController@turno')->name('AdminTurno');
Route::get('/AdminParalelo', 'AdministradorController@paralelo')->name('AdminParalelo');
Route::get('/AdminInscripcion', 'AdministradorController@inscripcion')->name('AdminInscripcion');

Route::get('/Contador', function () { return view('Contador'); });
Route::get('/Regente', function () { return view('Regente'); });
Route::get('/Profesor', function () { return view('Profesor'); });
Route::get('/Padre', function () { return view('Padre'); });