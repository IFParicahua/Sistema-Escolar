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
            <td>
                <a  style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil " id="edit-item"  title="Editar" 
                data-id="{{$paralelo->id}}"
                data-nombre="{{$paralelo->nombre}}"
                data-cupo="{{$paralelo->cupo}}"
                data-idturno="{{$paralelo->idturno}}"
                data-idcurso="{{$paralelo->idcurso}}"
                data-idgestion="{{$paralelo->idgestion}}"
                data-turno="{{$paralelo->turno}}"
                data-curso="{{$paralelo->curso}}"
                data-gestion="{{$paralelo->gestion}}"
                ></a>
                <button type="button" class="btn btn-danger icon-bin"></button>
            </td>
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
              <h5 class="modal-title">Guardar Curso Paralelo</h5>
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
<!-- Modal Gestion new -->
<div class="modal fade col-lg-12" id="edit-paralelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" style="height: 50px;" role="document">
        <div class="modal-content card-body" >
            <div>
                <h5 class="modal-title">Editar Curso Paralelo</h5>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" method="post" action="{{url('AdminParalelos/edit')}}" role="form" id="form-new">
                    {!! csrf_field() !!}
                    <div class="panel-body">
                        <input type="hidden" class="form-control" id="pkparalelo" name="pkparalelo">

                        <div class="row">
                            <div class="form-group col-md-6 pl-1">
                                <label for="editnombre" class="control-label">Nombre:</label>
                                <input type="text" class="form-control" id="editnombre" name="editnombre" maxlength="40" required>
                            </div>
                            <div class="form-group col-md-6 pl-1">
                                <label for="editcupo" class="control-label">Cupo:</label>
                                <input type="number" class="form-control" id="editcupo" name="editcupo" required>
                            </div>
                        </div>
  
                        <div class="row">
                          <div class="form-group col-md-4 pl-1">
                            <label for="editurno_id">Turnos:</label>
                            <select class="form-control" id="editurno_id" name="editurno_id">
                              
                            </select>
                          </div>
                          <div class="form-group col-md-4 pl-1">
                            <label for="editcurso_id">Curso:</label>
                            <select class="form-control" id="editcurso_id" name="editcurso_id">
                                
                            </select>
                          </div>
                          <div class="form-group col-md-4 pl-1">
                            <label for="editgestion_id">Gestion:</label>
                            <select class="form-control" id="editgestion_id" name="editgestion_id">
                              
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
  <script>
  $(document).on('click', "#edit-item", function() {
    $("#editurno_id").empty();
    $("#editcurso_id").empty();
    $("#editgestion_id").empty();
    var id = $(this).data("id");
    var nombre = $(this).data("nombre");
    var cupo = $(this).data("cupo");
    var idturno = $(this).data("idturno");
    var idcurso = $(this).data("idcurso");
    var idgestion = $(this).data("idgestion");
    var turno = $(this).data("turno");
    var curso = $(this).data("curso");
    var gestion = $(this).data("gestion");

    $("#pkparalelo").val(id);
    $("#editnombre").val(nombre);
    $("#editcupo").val(cupo);
    $("#editurno_id").append('<option value="'+idturno+'">'+turno+'</option>');
    $("#editcurso_id").append('<option value="'+idcurso+'">'+curso+'</option>');
    $("#editgestion_id").append('<option value="'+idgestion+'">'+gestion+'</option>');
    var _token = $('input[name="_token"]').val();
    $.ajax({
          url:"{{ route('turno.buscar') }}",
          method:"POST",
          data:{query:idturno, _token:_token},
          success:function(data){
            $("#editurno_id").append(data);
    }});
    $.ajax({
          url:"{{ route('curso.buscar') }}",
          method:"POST",
          data:{query:idcurso, _token:_token},
          success:function(data){
            $("#editcurso_id").append(data);
    }});
    $.ajax({
          url:"{{ route('gestion.buscar') }}",
          method:"POST",
          data:{query:idgestion, _token:_token},
          success:function(data){
            $("#editgestion_id").append(data);
    }});
    
    $("#edit-paralelo").modal('show');
  
  })
  </script>
@endsection


