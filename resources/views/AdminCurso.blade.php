@extends('layout.menuadmin')
@section('content')

<div class="col-11" style="margin: auto;">

  <div class="row">
    <div class="col-md-10 bg-primary">
      <h3 style="text-align: center;color:#ffffff">Registro de Cursos</h3>
    </div>
    <div class="col-md-2 bg-primary" style="text-align: right;">
        <button type="button" class="btn btn-primary icon-plus" data-toggle="modal" data-target="#new-alumno" data-toggle="tooltip" title="Agregar" id="nuevo">Registrar</button>
    </div>
  </div>
    <div class="row">
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
<!-- Modal Gestion new -->
<div class="modal fade col-lg-12" id="new-alumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" style="height: 50px;" role="document">
      <div class="modal-content card-body" >
          <div>
              <h5 class="modal-title">Guardar Gestion</h5>
          </div>
          <div class="modal-body">
              <form data-toggle="validator" method="post" action="{{url('AdminCursos/create')}}" role="form" id="form-new">
                  {!! csrf_field() !!}
                  <div class="panel-body">

                      <div class="row">
                          <div id="nombre" class="form-group col-md-12 pl-1">
                              <label for="nombre" class="control-label">Nombre:</label>
                              <input type="text" class="form-control" id="nombre" name="nombre" maxlength="40" required>
                          </div>
                      </div>

                      <div class="row">
                        <div id="grado" class="form-group col-md-6 pl-1">
                          <label for="grado" class="control-label">Grado:</label>
                          <input type="number" class="form-control" id="grado" name="grado" required>
                        </div>
                        <div class="form-group col-md-6 pl-1">
                          <label for="nivel">Nivel:</label>
                          <select class="form-control" id="nivel" name="nivel">
                            @foreach ($niveles as $nivel)
                              <option value="{{$nivel->id}}">{{$nivel->nombre}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary btn-fill">Guardar</button>
                  </div>
                  
              </form>
          </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
@endsection
