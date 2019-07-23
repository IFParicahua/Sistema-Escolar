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
////ADMINISTRADOR//////
Route::get('/Administrador', 'AdministradorController@index');
//TUTOR
Route::get('/AdminTutor', 'AdministradorController@tutor')->name('AdminTutor');
Route::post('/AdminTutor/create', 'AdministradorController@TutorCreate');

//USUARIO
Route::get('/AdminUser', 'AdministradorController@usuario')->name('AdminUser');
Route::post('/AdminUser/create', 'AdministradorController@UserCreate');
Route::post('/AdminUser/fetch', 'AdministradorController@tutorsearch')->name('AdminUser.fetch');

//PROFESOR
Route::get('/AdminProfesor', 'AdministradorController@profesor')->name('AdminProfesor');
Route::post('/AdminProfesor/create', 'AdministradorController@ProfesorCreate');

//GESTION
Route::get('/AdminGestion', 'AdministradorController@gestion')->name('AdminGestion');
Route::post('/AdminGestion/create', 'AdministradorController@GestionCreate');

//NIVELES
Route::get('/AdminNivel', 'AdministradorController@nivel')->name('AdminNivel');
Route::post('/AdminNiveles/create', 'AdministradorController@NivelesCreate');

//CURSOS
Route::get('/AdminCurso', 'AdministradorController@curso')->name('AdminCurso');
Route::post('/AdminCursos/create', 'AdministradorController@CursosCreate');

//TURNOS
Route::get('/AdminTurno', 'AdministradorController@turno')->name('AdminTurno');
Route::post('/AdminTurnos/create', 'AdministradorController@TurnosCreate');

//PARALELO
Route::get('/AdminParalelo', 'AdministradorController@paralelo')->name('AdminParalelo');
Route::post('/AdminParalelos/create', 'AdministradorController@ParalelosCreate');

//INSCRIPCION
Route::get('/AdminInscripcion', 'AdministradorController@inscripcion')->name('AdminInscripcion');
Route::post('/AdminInscripcion/create', 'AdministradorController@InscripcionCreate');
Route::post('/AdminAlumno/fetch', 'AdministradorController@alumnosearch')->name('AdminAlumno.fetch');

Route::get('/Contador', function () { return view('Contador'); });
Route::get('/Regente', function () { return view('Regente'); });
Route::get('/Profesor', function () { return view('Profesor'); });
Route::get('/Padre', function () { return view('Padre'); });