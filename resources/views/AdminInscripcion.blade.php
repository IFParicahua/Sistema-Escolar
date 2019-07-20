@extends('layout.menuadmin')
@section('content')

<div class="col-11" style="margin: auto;">

    <div class="bg-primary" style="color:#ffffff"><h2 style="text-align: center;margin-bottom: 0px;margin-top: 50px;">Registro de Profesores</h2></div>
    <div>
        <table class="table table-striped" style="background:#ffffff;">
            <thead class="bg-primary" style="color:#ffffff">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Cupos</th>
                <th scope="col">Inscripcion</th>
                <th scope="col">Observacion</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($inscripciones as $inscripcion)
            <tr>
                <td>{{$inscripcion->alumno}}</td>
                <td>{{$inscripcion->curso}}</td>
                <td>{{$inscripcion->fecha}}</td>
                <td>{{$inscripcion->observacion}}</td>
                <td>Iconos</td>
            </tr>
            @endforeach
              
            </tbody>
        </table>
    </div>
</div>
@endsection