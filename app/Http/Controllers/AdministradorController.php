<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Faker\Provider\DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Validation\Rule;


class AdministradorController extends Controller
{
    public function index(){
        return view('Administrador');
    }
    //Vistas de tablas
    public function tutor(){
        $tutores = DB::table('personas')
            ->join('tutores', 'personas.id', '=', 'tutores.id_persona')
            ->select(
                'personas.id as id',
                'personas.nombre as nombre',
                'personas.apellidopat as apellidopat', 
                'personas.apellidomat as apellidomat',
                'personas.direccion as direcciones',
                'personas.ci as cis',
                'personas.telefono as telefonos',
                'personas.sexo as sexos'
                )
            ->get();
        return view('AdminTutor',['tutores' => $tutores]);
    }
    public function usuario(){
        $roles = DB::table('personas')
            ->join('alumnos', 'personas.id', '=', 'alumnos.id_persona')
            ->select(
                'personas.id as id',
                'personas.nombre as nombre',
                'personas.apellidopat as apellidopat', 
                'personas.apellidomat as apellidomat',
                'personas.direccion as direcciones',
                'personas.ci as cis',
                'personas.telefono as telefonos',
                'personas.sexo as sexos',
                'alumnos.fecha_nacimiento as nacimiento',
                'alumnos.idtutor as idtutor',
                'alumnos.rude as rudes'
                )
            ->get();
        return view('AdminAlumno',['roles' => $roles]);
    }
    
    public function profesor(){
        $profesores = DB::table('personas')
            ->join('profesores', 'personas.id', '=', 'profesores.id_persona')
            ->select(
                'personas.id as id',
                'personas.nombre as nombre',
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
                'cursos.id as id',
                'cursos.nombre as nombre',
                'cursos.grado as grado', 
                'cursos.estado as estado',
                'niveles.nombre as nivel',
                'cursos.id_nivel as idnivel'
                )
            ->get();
        $niveles = DB::table('niveles')->get();
        return view('AdminCurso',['cursos' => $cursos],['niveles' => $niveles]);
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
                'curso_paralelos.id as id',
                'curso_paralelos.id_turno as idturno',
                'curso_paralelos.id_curso as idcurso',
                'curso_paralelos.id_gestion as idgestion',
                'curso_paralelos.cupo_maximo as cupo',
                'curso_paralelos.nombre as nombre'
                )
            ->get();
        $turnos = DB::table('turnos')->get();
        $cursos = DB::table('cursos')->get();
        $gestiones = DB::table('gestiones')->get();
        return view('AdminParalelo',compact('paralelos','turnos','cursos','gestiones'));
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
                'inscripciones.id as id',
                'inscripciones.observacion as observacion',
                'inscripciones.id_cursos_paralelos as idcurso',
                'inscripciones.id_alumno as idalumno'
                )
            ->get();
        $paralelos = DB::table('curso_paralelos')->get();
        return view('AdminInscripcion',compact('inscripciones','paralelos'));
    }
    //Search
    public function tutorsearch(Request $request){
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('personas')
                ->join('tutores', 'personas.id', '=', 'tutores.id_persona')
                ->where([['ci', 'like', "%{$query}%"]])
                ->orWhere([['nombre', 'like', "%{$query}%"]])
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li class="pl-1 caja" id="'. $row->id.'"><a href="#" style="color: #1b1e21">' . $row->ci . ' - ' . $row->nombre . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function tutorname(Request $request){
        if ($request->get('query')) {
            $query = $request->get('query');
            $tutores = DB::table('personas')
            ->join('tutores', 'personas.id', '=', 'tutores.id_persona')->select('personas.nombre as nombre','personas.ci as cis')
            ->where('tutores.id','=',$query)->get();
            foreach ($tutores as $row) {
                $output = ''.$row->cis.'-'.$row->nombre;
            };
            echo $output;
        }
    }

    public function alumnosearch(Request $request){
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('personas')
                ->join('alumnos', 'personas.id', '=', 'alumnos.id_persona')
                ->where([['ci', 'like', "%{$query}%"]])
                ->orWhere([['nombre', 'like', "%{$query}%"]])
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li class="pl-1 caja" id="'. $row->id.'"><a href="#" style="color: #1b1e21">' . $row->ci . ' - ' . $row->nombre . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    
    public function nivelsearch(Request $request){
        if ($request->get('query')) {
            $query = $request->get('query');
            $niveles = DB::table('niveles')->where('id','!=',$query)->get();
            $output = ' ';
            foreach ($niveles as $nivel) {
                $output .= '<option value="'.$nivel->id.'">'.$nivel->nombre.'</option>';
            }
            echo $output;
        }
    }

    public function turnosearch(Request $request){
        if ($request->get('query')) {
            $query = $request->get('query');
            $turnos = DB::table('turnos')->where('id','!=',$query)->get();
            $output = ' ';
            foreach ($turnos as $turno) {
                $output .= '<option value="'.$turno->id.'">'.$turno->nombre.'</option>';
            }
            echo $output;
        }
    }
    public function cursosearch(Request $request){
        if ($request->get('query')) {
            $query = $request->get('query');
            $cursos = DB::table('cursos')->where('id','!=',$query)->get();
            $output = ' ';
            foreach ($cursos as $curso) {
                $output .= '<option value="'.$curso->id.'">'.$curso->nombre.'</option>';
            }
            echo $output;
        }
    }
    public function gestionsearch(Request $request){
        if ($request->get('query')) {
            $query = $request->get('query');
            $gestiones = DB::table('gestiones')->where('id','!=',$query)->get();
            $output = ' ';
            foreach ($gestiones as $gestion) {
                $output .= '<option value="'.$gestion->id.'">'.$gestion->nombre.'</option>';
            }
            echo $output;
        }
    }
    public function paralelosearch(Request $request){
        if ($request->get('query')) {
            $query = $request->get('query');
            $paralelos = DB::table('curso_paralelos')->where('id','!=',$query)->get();
            $output = ' ';
            foreach ($paralelos as $paralelo) {
                $output .= '<option value="'.$paralelo->id.'">'.$paralelo->nombre.'</option>';
            }
            echo $output;
        }
    }

    //Post Crear del Admin
    public function TutorCreate(Request $request){
        DB::table('personas')->insert([
            'nombre'=>$request->input('nombre'),
            'apellidopat'=>$request->input('apaterno'),
            'apellidomat'=>$request->input('amaterno'),
            'direccion'=>$request->input('direccion'),
            'ci'=>$request->input('ci'),
            'telefono'=>$request->input('telefono'),
            'sexo'=>$request->input('sexo')
            ]
        );
        $cis = $request->input('ci');
        $niv = DB::table('personas')->where('ci','=', $cis)->value('id');
        DB::table('tutores')->insert([
            'id_persona'=>$niv
            ]
        );
        return back();
    }

    public function UserCreate(Request $request){
        DB::table('personas')->insert([
            'nombre'=>$request->input('nombre'),
            'apellidopat'=>$request->input('apaterno'),
            'apellidomat'=>$request->input('amaterno'),
            'direccion'=>$request->input('direccion'),
            'ci'=>$request->input('ci'),
            'telefono'=>$request->input('telefono'),
            'sexo'=>$request->input('sexo')
            ]
        );

        $cis = $request->input('ci');

        $niv = DB::table('personas')->where('ci','=', $cis)->value('id');
        
        DB::table('alumnos')->insert([
            'fecha_nacimiento'=>$request->input('nacimiento'),
            'id_persona'=>$niv,
            'idtutor'=>$request->input('tutor_id'),
            'rude'=>$request->input('rude')
            ]
        );
        return back();
    }

    public function ProfesorCreate(Request $request){
        DB::table('personas')->insert([
            'nombre'=>$request->input('nombre'),
            'apellidopat'=>$request->input('apaterno'),
            'apellidomat'=>$request->input('amaterno'),
            'direccion'=>$request->input('direccion'),
            'ci'=>$request->input('ci'),
            'telefono'=>$request->input('telefono'),
            'sexo'=>$request->input('sexo')
            ]
        );
        $cis = $request->input('ci');
        $niv = DB::table('personas')->where('ci','=', $cis)->value('id');
        DB::table('profesores')->insert([
            'id_persona'=>$niv
            ]
        );
        return back();
    }

    public function GestionCreate(Request $request){
        DB::table('gestiones')->insert([
            'nombre'=>$request->input('nombre'),
            'fecha_inicial'=>$request->input('inicio'),
            'fecha_final'=>$request->input('fin'),
            'descripcion'=>$request->input('descripcion'),
            'estado'=>'0'
            ]
        );
        return back();
    }

    public function NivelesCreate(Request $request){
        DB::table('niveles')->insert([
            'nombre'=>$request->input('nombre'),
            'estado'=>'0'
            ]
        );
        return back();
    }

    public function CursosCreate(Request $request){
        DB::table('cursos')->insert([
            'nombre'=>$request->input('nombre'),
            'grado'=>$request->input('grado'),
            'id_nivel'=>$request->input('nivel'),
            'estado'=>'0'
            ]
        );
        return back();
    }

    public function TurnosCreate(Request $request){
        DB::table('turnos')->insert([
            'nombre'=>$request->input('nombre'),
            'estado'=>'0'
            ]
        );
        return back();
    }

    public function ParalelosCreate(Request $request){
        DB::table('curso_paralelos')->insert([
            'id_turno'=>$request->input('turno_id'),
            'id_curso'=>$request->input('curso_id'),
            'id_gestion'=>$request->input('gestion_id'),
            'nombre'=>$request->input('nombre'),
            'cupo_maximo'=>$request->input('cupo')
            ]
        );
        return back();
    }

    public function InscripcionCreate(Request $request){
        DB::table('inscripciones')->insert([
            'fecha'=>date("Ymd"),
            'observacion'=>$request->input('observacion'),
            'id_cursos_paralelos'=>$request->input('paralelos_id'),
            'id_alumno'=>$request->input('alumno_id')
            ]
        );
        return back();
    }
    //Post Editar Admin
    public function tutorEditar(Request $request){
        $id = $request->input('PKpersona');
        DB::table('personas')->where('id', $id)->update([
            'nombre'=>$request->input('editnombre'),
            'apellidopat'=>$request->input('editapaterno'),
            'apellidomat'=>$request->input('editamaterno'),
            'direccion'=>$request->input('editdireccion'),
            'ci'=>$request->input('editci'),
            'telefono'=>$request->input('edittelefono'),
            'sexo'=>$request->input('editsexo')
            ]
        );
    return back();
    }
    public function userEditar(Request $request){
        $id = $request->input('pkpersona');
        DB::table('personas')->where('id', $id)->update([
            'nombre'=>$request->input('editnombre'),
            'apellidopat'=>$request->input('editpaterno'),
            'apellidomat'=>$request->input('editmaterno'),
            'direccion'=>$request->input('editdireccion'),
            'ci'=>$request->input('editci'),
            'telefono'=>$request->input('edittelefono'),
            'sexo'=>$request->input('editsexo')
            ]
        );
        DB::table('alumnos')->where('id_persona', $id)->update([
            'fecha_nacimiento'=>$request->input('editnacimiento'),
            'idtutor'=>$request->input('editutor_id'),
            'rude'=>$request->input('editrude')
            ]
        );
    return back();
    }

    public function profesorEditar(Request $request){
        $id = $request->input('pkpersona');
        DB::table('personas')->where('id', $id)->update([
            'nombre'=>$request->input('editnombre'),
            'apellidopat'=>$request->input('editpaterno'),
            'apellidomat'=>$request->input('editmaterno'),
            'direccion'=>$request->input('editdireccion'),
            'ci'=>$request->input('editci'),
            'telefono'=>$request->input('edittelefono'),
            'sexo'=>$request->input('editsexo')
            ]
        );
    return back();
    }

    public function gestionEditar(Request $request){
        $id = $request->input('pkgestion');
        DB::table('gestiones')->where('id', $id)->update([
            'nombre'=>$request->input('editnombre'),
            'descripcion'=>$request->input('editdescripcion'),
            'fecha_inicial'=>$request->input('editinicio'),
            'fecha_final'=>$request->input('editfin')
            ]
        );
    return back();
    }
    public function nivelEditar(Request $request){
        $id = $request->input('pknivel');
        DB::table('niveles')->where('id', $id)->update([
            'nombre'=>$request->input('editnombre')
            ]
        );
    return back();
    }
    public function cursoEditar(Request $request){
        $id = $request->input('pkcurso');
        DB::table('cursos')->where('id', $id)->update([
            'nombre'=>$request->input('editnombre'),
            'grado'=>$request->input('editgrado'),
            'id_nivel'=>$request->input('editnivel')
            ]
        );
    return back();
    }
    public function turnoEditar(Request $request){
        $id = $request->input('pkturno');
        DB::table('turnos')->where('id', $id)->update([
            'nombre'=>$request->input('editnombre')
            ]
        );
    return back();
    }
    
    public function paraleloEditar(Request $request){
        $id = $request->input('pkparalelo');
        DB::table('curso_paralelos')->where('id', $id)->update([
            'id_turno'=>$request->input('editurno_id'),
            'id_curso'=>$request->input('editcurso_id'),
            'id_gestion'=>$request->input('editgestion_id'),
            'nombre'=>$request->input('editnombre'),
            'cupo_maximo'=>$request->input('editcupo')
            ]
        );
    return back();
    }
    public function inscripcionEditar(Request $request){
        $id = $request->input('pkinscripcion');
        DB::table('inscripciones')->where('id', $id)->update([
            'observacion'=>$request->input('editobservacion'),
            'id_cursos_paralelos'=>$request->input('editparalelos_id'),
            'id_alumno'=>$request->input('editalumno_id')
            ]
        );
    return back();
    }
}


