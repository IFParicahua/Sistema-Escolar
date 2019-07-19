@extends('layout.app')
@section('content')
<style>
</style>
<div class="menu">
    <ul>
        @foreach ($roles as $rol)
            <li><a href="rol/{{$rol->idroles}}"><img src="{{ asset('iconos/icono'.$rol->idroles.'.svg') }}" style="width: 100px" alt="">{{$rol->roluser}}</a></li>
        @endforeach
    </ul>
</div>
@endsection