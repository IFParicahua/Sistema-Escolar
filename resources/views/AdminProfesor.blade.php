@extends('layout.menuadmin')
@section('content')

<div class="col-11" style="margin: auto;">

    <div class="bg-primary" style="color:#ffffff"><h2 style="text-align: center;margin-bottom: 0px;margin-top: 50px;">Registro de Profesores</h2></div>
    <div>
        <table class="table table-striped" style="background:#ffffff;">
            <thead class="bg-primary" style="color:#ffffff">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">Direccion</th>
                <th scope="col">CI</th>
                <th scope="col">Telefono</th>
                <th scope="col">Sexo</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($profesores as $profesor)
            <tr>
                <td>{{$profesor->nombre}}</td>
                <td>{{$profesor->apellidopat}}</td>
                <td>{{$profesor->apellidomat}}</td>
                <td>{{$profesor->direcciones}}</td>
                <td>{{$profesor->cis}}</td>
                <td>{{$profesor->telefonos}}</td>
                <td>{{$profesor->sexos}}</td>
                <td>Iconos</td>
            </tr>
            @endforeach
              
            </tbody>
        </table>
    </div>
</div>
@endsection