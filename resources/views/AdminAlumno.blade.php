@extends('layout.menuadmin')
@section('content')

<div class="col-11" style="margin: auto;">

    <div class="bg-primary" style="color:#ffffff"><h2 style="text-align: center;margin-bottom: 0px;margin-top: 50px;">Registro de Alumnos</h2></div>
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
                <th scope="col">Fecha de Nacimiento</th>
                <th scope="col">Rude</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($roles as $usuario)
            <tr>
                <td>{{$usuario->nombre}}</td>
                <td>{{$usuario->apellidopat}}</td>
                <td>{{$usuario->apellidomat}}</td>
                <td>{{$usuario->direcciones}}</td>
                <td>{{$usuario->cis}}</td>
                <td>{{$usuario->telefonos}}</td>
                <td>{{$usuario->sexos}}</td>
                <td>{{$usuario->nacimiento}}</td>
                <td>{{$usuario->rudes}}</td>
                <td>Iconos</td>
            </tr>
            @endforeach
              
            </tbody>
        </table>
    </div>
</div>
@endsection