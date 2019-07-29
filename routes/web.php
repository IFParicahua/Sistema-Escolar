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
Route::post('/AdminTutor/editar', 'AdministradorController@tutorEditar');
Route::get('/AdminTutor/{id}/delete','AdministradorController@tutorDelete' );

//USUARIO
Route::get('/AdminUser', 'AdministradorController@usuario')->name('AdminUser');
Route::post('/AdminUser/create', 'AdministradorController@UserCreate');
Route::post('/AdminUser/fetch', 'AdministradorController@tutorsearch')->name('AdminUser.fetch');
Route::post('/AdminUser/editar', 'AdministradorController@userEditar');
Route::post('/tutor/buscar', 'AdministradorController@tutorname')->name('tutor.buscar');
Route::get('/AdminUser/{id}/delete','AdministradorController@alumnoDelete' );

//PROFESOR
Route::get('/AdminProfesor', 'AdministradorController@profesor')->name('AdminProfesor');
Route::post('/AdminProfesor/create', 'AdministradorController@ProfesorCreate');
Route::post('/AdminProfesor/editar', 'AdministradorController@profesorEditar');
Route::get('/AdminProfesor/{id}/delete','AdministradorController@profesorDelete' );

//GESTION
Route::get('/AdminGestion', 'AdministradorController@gestion')->name('AdminGestion');
Route::post('/AdminGestion/create', 'AdministradorController@GestionCreate');
Route::post('/AdminGestion/edit', 'AdministradorController@gestionEditar');
Route::get('/AdminGestion/{id}/delete','AdministradorController@gestionDelete' );

//NIVELES
Route::get('/AdminNivel', 'AdministradorController@nivel')->name('AdminNivel');
Route::post('/AdminNiveles/create', 'AdministradorController@NivelesCreate');
Route::post('/AdminNiveles/edit', 'AdministradorController@nivelEditar');
Route::get('/AdminNiveles/{id}/delete','AdministradorController@niveleDelete' );

//CURSOS
Route::get('/AdminCurso', 'AdministradorController@curso')->name('AdminCurso');
Route::post('/AdminCursos/create', 'AdministradorController@CursosCreate');
Route::post('/nivel/buscar', 'AdministradorController@nivelsearch')->name('nivel.buscar');
Route::post('/AdminCursos/edit', 'AdministradorController@cursoEditar');
Route::get('/AdminCursos/{id}/delete','AdministradorController@cursoDelete' );

//TURNOS
Route::get('/AdminTurno', 'AdministradorController@turno')->name('AdminTurno');
Route::post('/AdminTurnos/create', 'AdministradorController@TurnosCreate');
Route::post('/AdminTurnos/edit', 'AdministradorController@turnoEditar');
Route::get('/AdminTurnos/{id}/delete','AdministradorController@turnoDelete' );

//PARALELO
Route::get('/AdminParalelo', 'AdministradorController@paralelo')->name('AdminParalelo');
Route::post('/AdminParalelos/create', 'AdministradorController@ParalelosCreate');
Route::post('/turno/buscar', 'AdministradorController@turnosearch')->name('turno.buscar');
Route::post('/curso/buscar', 'AdministradorController@cursosearch')->name('curso.buscar');
Route::post('/gestion/buscar', 'AdministradorController@gestionsearch')->name('gestion.buscar');
Route::post('/AdminParalelos/edit', 'AdministradorController@paraleloEditar');
Route::get('/AdminParalelos/{id}/delete','AdministradorController@paralelosDelete' );

//INSCRIPCION
Route::get('/AdminInscripcion', 'AdministradorController@inscripcion')->name('AdminInscripcion');
Route::post('/AdminInscripcion/create', 'AdministradorController@InscripcionCreate');
Route::post('/AdminAlumno/fetch', 'AdministradorController@alumnosearch')->name('AdminAlumno.fetch');
Route::post('/paralelo/buscar', 'AdministradorController@paralelosearch')->name('paralelo.buscar');
Route::post('/AdminInscripcion/edit', 'AdministradorController@inscripcionEditar');
Route::get('/AdminInscripcion/{id}/delete','AdministradorController@inscripcionDelete' );


Route::get('/Contador', function () { return view('Contador'); });
Route::get('/Regente', function () { return view('Regente'); });
Route::get('/Profesor', function () { return view('Profesor'); });
Route::get('/Padre', function () { return view('Padre'); });