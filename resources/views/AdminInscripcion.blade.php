@extends('layout.menuadmin')
@section('content')

<div class="col-11" style="margin: auto;">

  <div class="row">
    <div class="col-md-10 bg-primary">
      <h3 style="text-align: center;color:#ffffff">Registro de Inscripciones</h3>
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
            <th scope="col">Curso</th>
            <th scope="col">Inscripcion</th>
            <th scope="col">Observacion</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($inscripciones as $inscripcion)
          <tr>
            <td>{{$inscripcion->alumno}}</td>
            <td>{{$inscripcion->curso}}</td>
            <td>{{date("d/m/Y",strtotime($inscripcion->fecha))}}</td>
            <td>{{$inscripcion->observacion}}</td>
            <td>
                <a  style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil " id="edit-item"  title="Editar" 
                data-id="{{$inscripcion->id}}"
                data-observacion="{{$inscripcion->observacion}}"
                data-idcurso="{{$inscripcion->idcurso}}"
                data-curso="{{$inscripcion->curso}}"
                data-idalumno="{{$inscripcion->idalumno}}"
                data-alumno="{{$inscripcion->alumno}}"
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
        <h5 class="modal-title">Guardar Inscripcion</h5>
      </div>
      <div class="modal-body">
        <form data-toggle="validator" method="post" action="{{url('AdminInscripcion/create')}}" role="form" id="form-new">
        {!! csrf_field() !!}
          <div class="panel-body">

            <div class="row">
              <div id="observacion" class="form-group col-md-12 pl-1">
                <label for="observacion" class="control-label">Observacion:</label>
                <input type="text" class="form-control" id="observacion" name="observacion" maxlength="40" required>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6 pl-1">
                <label for="paralelos_id">Cursos Paralelos:</label>
                <select class="form-control" id="paralelos_id" name="paralelos_id">
                  @foreach ($paralelos as $paralelo)
                  <option value="{{$paralelo->id}}">{{$paralelo->nombre}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6 pl-1">
                <label for="alumno_name" class="form-label">Alumno:</label>
                <input type="text" name="alumno_name" id="alumno_name" class="form-control" autocomplete="off" required/>
                <input type="hidden" name="alumno_id" id="alumno_id" class="form-control" />
                <div id="alumnoList">
                </div>
                {{ csrf_field() }}
                <script>
                  $(document).ready(function(){
                    $('#alumno_name').keyup(function(){
                      var query = $(this).val();
                      if(query != '')
                      {
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                          url:"{{ route('AdminAlumno.fetch') }}",
                          method:"POST",
                          data:{query:query, _token:_token},
                          success:function(data){
                            $('#alumnoList').fadeIn();
                            $('#alumnoList').html(data);
                          }
                        });
                      }
                    });
                    $(document).on('click', '.caja', function(){
                      $('#alumno_name').val($(this).text());
                      $('#alumno_id').val($(this).attr("id"));                            
                      $('#alumnoList').fadeOut();
                    });
                  });
                </script>
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
<!-- Modal Inscripciones edit -->
<div class="modal fade col-lg-12" id="edit-inscripciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" style="height: 50px;" role="document">
      <div class="modal-content card-body" >
        <div>
          <h5 class="modal-title">Inscripciones Inscripcion</h5>
        </div>
        <div class="modal-body">
          <form data-toggle="validator" method="post" action="{{url('AdminInscripcion/edit')}}" role="form" id="form-new">
          {!! csrf_field() !!}
            <div class="panel-body">
                <input type="hidden" class="form-control" id="pkinscripcion" name="pkinscripcion" maxlength="40" required>

              <div class="row">
                <div class="form-group col-md-12 pl-1">
                  <label for="editobservacion" class="control-label">Observacion:</label>
                  <input type="text" class="form-control" id="editobservacion" name="editobservacion" maxlength="40" required>
                </div>
              </div>
  
              <div class="row">
                <div class="form-group col-md-6 pl-1">
                  <label for="editparalelos_id">Cursos Paralelos:</label>
                  <select class="form-control" id="editparalelos_id" name="editparalelos_id">
                    
                  </select>
                </div>
                <div class="form-group col-md-6 pl-1">
                  <label for="editalumno_name" class="form-label">Alumno:</label>
                  <input type="text" name="editalumno_name" id="editalumno_name" class="form-control" autocomplete="off" required/>
                  <input type="hidden" name="editalumno_id" id="editalumno_id" class="form-control" />
                  <div id="editalumnoList">
                  </div>
                  {{ csrf_field() }}
                  <script>
                    $(document).ready(function(){
                      $('#editalumno_name').keyup(function(){
                        var query = $(this).val();
                        if(query != '')
                        {
                          var _token = $('input[name="_token"]').val();
                          $.ajax({
                            url:"{{ route('AdminAlumno.fetch') }}",
                            method:"POST",
                            data:{query:query, _token:_token},
                            success:function(data){
                              $('#editalumnoList').fadeIn();
                              $('#editalumnoList').html(data);
                            }
                          });
                        }
                      });
                      $(document).on('click', '.caja', function(){
                        $('#editalumno_name').val($(this).text());
                        $('#editalumno_id').val($(this).attr("id"));                            
                        $('#editalumnoList').fadeOut();
                      });
                    });
                  </script>
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
        $("#editparalelos_id").empty();
        var id = $(this).data("id");
        var observacion = $(this).data("observacion");
        var idcurso = $(this).data("idcurso");
        var curso = $(this).data("curso");
        var idalumno = $(this).data("idalumno");
        var alumno = $(this).data("alumno");
    
        $("#pkinscripcion").val(id);
        $("#editobservacion").val(observacion);
        $("#editalumno_name").val(alumno);
        $("#editalumno_id").val(idalumno);
        $("#editparalelos_id").append('<option value="'+idcurso+'">'+curso+'</option>');
        var _token = $('input[name="_token"]').val();
        
        $.ajax({
              url:"{{ route('paralelo.buscar') }}",
              method:"POST",
              data:{query:idcurso, _token:_token},
              success:function(data){
                $("#editparalelos_id").append(data);
        }});
        
        $("#edit-inscripciones").modal('show');
      
      })
      </script>
@endsection




