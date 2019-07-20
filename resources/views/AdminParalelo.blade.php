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
                <th scope="col">Turno</th>
                <th scope="col">Curso</th>
                <th scope="col">Gestion</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($paralelos as $paralelo)
            <tr>
                <td>{{$paralelo->nombre}}</td>
                <td>{{$paralelo->cupo}}</td>
                <td>{{$paralelo->turno}}</td>
                <td>{{$paralelo->curso}}</td>
                <td>{{$paralelo->gestion}}</td>
                <td>Iconos</td>
            </tr>
            @endforeach
              
            </tbody>
        </table>
    </div>
</div>
@endsection