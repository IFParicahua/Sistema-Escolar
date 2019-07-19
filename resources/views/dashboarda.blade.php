<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>dashboard</title>
</head>
<body>
    <div class="sidebar">
        <h2>{{Auth::user()->username}}</h2>
        <h4>Administrador</h4>
        <ul>
            <li><a href="">Alumno</a></li>
            <li><a href="">Profesor</a></li>
            <li><a href="">Gestion</a></li>
            <li><a href="">Nivel</a></li>
            <li><a href="">Curso</a></li>
            <li><a href="">Turno</a></li>
            <li><a href="">Curso paralelo</a></li>
            <li><a href="">Inscripcion</a></li>
        </ul>
    </div>
    <div class="contenido">
        <img src="{{ asset('menuicon.png') }}" style="width: 40px" class="menu-bar">
    </div>
</body>
</html>