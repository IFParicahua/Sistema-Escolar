@extends('layout.menuadmin')
@section('content')

<div class="col-11" style="margin: auto;">

  <div class="row">
    <div class="col-md-10 bg-primary">
      <h3 style="text-align: center;color:#ffffff">Registro de Paralelos</h3>
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
<!-- Modal Gestion new -->
<div class="modal fade col-lg-12" id="new-alumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" style="height: 50px;" role="document">
      <div class="modal-content card-body" >
          <div>
              <h5 class="modal-title">Guardar Gestion</h5>
          </div>
          <div class="modal-body">
              <form data-toggle="validator" method="post" action="{{url('AdminParalelos/create')}}" role="form" id="form-new">
                  {!! csrf_field() !!}
                  <div class="panel-body">

                      <div class="row">
                          <div id="nombre" class="form-group col-md-6 pl-1">
                              <label for="nombre" class="control-label">Nombre:</label>
                              <input type="text" class="form-control" id="nombre" name="nombre" maxlength="40" required>
                          </div>
                          <div id="cupo" class="form-group col-md-6 pl-1">
                              <label for="cupo" class="control-label">Cupo:</label>
                              <input type="number" class="form-control" id="cupo" name="cupo" required>
                          </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4 pl-1">
                          <label for="turno_id">Turnos:</label>
                          <select class="form-control" id="turno_id" name="turno_id">
                            @foreach ($turnos as $turno)
                              <option value="{{$turno->id}}">{{$turno->nombre}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-4 pl-1">
                          <label for="curso_id">Curso:</label>
                          <select class="form-control" id="curso_id" name="curso_id">
                              @foreach ($cursos as $curso)
                                <option value="{{$curso->id}}">{{$curso->nombre}}</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-4 pl-1">
                          <label for="gestion_id">Gestion:</label>
                          <select class="form-control" id="gestion_id" name="gestion_id">
                            @foreach ($gestiones as $gestion)
                              <option value="{{$gestion->id}}">{{$gestion->nombre}}</option>
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


