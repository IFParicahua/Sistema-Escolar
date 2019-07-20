@extends('layout.menuadmin')
@section('content')

<div class="col-11" style="margin: auto;">

    <div class="bg-primary" style="color:#ffffff"><h2 style="text-align: center;margin-bottom: 0px;margin-top: 50px;">Registro de Profesores</h2></div>
    <div>
        <table class="table table-striped" style="background:#ffffff;">
            <thead class="bg-primary" style="color:#ffffff">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Grado</th>
                <th scope="col">Estado</th>
                <th scope="col">Nivel</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($cursos as $curso)
            <tr>
                <td>{{$curso->nombre}}</td>
                <td>{{$curso->grado}}</td>
                <td>{{$curso->estado}}</td>
                <td>{{$curso->nivel}}</td>
                <td>Iconos</td>
            </tr>
            @endforeach
              
            </tbody>
        </table>
    </div>
</div>
@endsection