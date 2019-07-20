@extends('layout.menuadmin')
@section('content')

<div class="col-11" style="margin: auto;">

    <div class="bg-primary" style="color:#ffffff"><h2 style="text-align: center;margin-bottom: 0px;margin-top: 50px;">Registro de Profesores</h2></div>
    <div>
        <table class="table table-striped" style="background:#ffffff;">
            <thead class="bg-primary" style="color:#ffffff">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha Inicial</th>
                <th scope="col">Fecha Final</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Estado</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($gestiones as $gestion)
            <tr>
                <td>{{$gestion->nombre}}</td>
                <td>{{$gestion->fecha_inicial}}</td>
                <td>{{$gestion->fecha_final}}</td>
                <td>{{$gestion->descripcion}}</td>
                <td>{{$gestion->estado}}</td>
                <td>Iconos</td>
            </tr>
            @endforeach
              
            </tbody>
        </table>
    </div>
</div>
@endsection