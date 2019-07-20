<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AdministradorController extends Controller
{
    public function index(){
        return view('Administrador');
    }
    //Vistas de tablas
    public function usuario(){
        $roles = DB::table('personas')
            ->join('alumnos', 'personas.id', '=', 'alumnos.id_persona')
            ->select('personas.nombre as nombre',
                'personas.apellidopat as apellidopat', 
                'personas.apellidomat as apellidomat',
                'personas.direccion as direcciones',
                'personas.ci as cis',
                'personas.telefono as telefonos',
                'personas.sexo as sexos',
                'alumnos.fecha_nacimiento as nacimiento',
                'alumnos.rude as rudes'
                )
            ->get();
        return view('AdminAlumno',['roles' => $roles]);
    }

    public function profesor(){
        $profesores = DB::table('personas')
            ->join('profesores', 'personas.id', '=', 'profesores.id_persona')
            ->select('personas.nombre as nombre',
                'personas.apellidopat as apellidopat', 
                'personas.apellidomat as apellidomat',
                'personas.direccion as direcciones',
                'personas.ci as cis',
                'personas.telefono as telefonos',
                'personas.sexo as sexos'
                )
            ->get();
        return view('AdminProfesor',['profesores' => $profesores]);
    }
    public function gestion(){
        $gestiones = DB::table('gestiones')->get();
        return view('AdminGestion',['gestiones' => $gestiones]);
    }
    public function nivel(){
        $niveles = DB::table('niveles')->get();
        return view('AdminNivel',['niveles' => $niveles]);
    }
    public function curso(){
        $cursos = DB::table('niveles')
            ->join('cursos', 'niveles.id', '=', 'cursos.id_nivel')
            ->select(
                'cursos.nombre as nombre',
                'cursos.grado as grado', 
                'cursos.estado as estado',
                'niveles.nombre as nivel'
                )
            ->get();
        return view('AdminCurso',['cursos' => $cursos]);
    }
    public function turno(){
        $turnos = DB::table('turnos')->get();
        return view('AdminTurno',['turnos' => $turnos]);
    }
    public function paralelo(){
        $paralelos = DB::table('curso_paralelos')
            ->join('turnos', 'turnos.id', '=', 'curso_paralelos.id_turno')
            ->join('cursos', 'cursos.id', '=', 'curso_paralelos.id_curso')
            ->join('gestiones', 'gestiones.id', '=', 'curso_paralelos.id_gestion')
            ->select(
                'turnos.nombre as turno',
                'cursos.nombre as curso', 
                'gestiones.nombre as gestion',
                'curso_paralelos.cupo_maximo as cupo',
                'curso_paralelos.nombre as nombre'
                )
            ->get();
        return view('AdminParalelo',['paralelos' => $paralelos]);
    }
    public function inscripcion(){
        $inscripciones = DB::table('inscripciones')
            ->join('curso_paralelos', 'curso_paralelos.id', '=', 'inscripciones.id_cursos_paralelos')
            ->join('alumnos', 'inscripciones.id_alumno', '=', 'alumnos.id')
            ->join('personas', 'alumnos.id_persona', '=', 'personas.id')
            ->select(
                'personas.nombre as alumno',
                'curso_paralelos.nombre as curso', 
                'inscripciones.fecha as fecha',
                'inscripciones.observacion as observacion'
                )
            ->get();
        return view('AdminInscripcion',['inscripciones' => $inscripciones]);
    }
}
