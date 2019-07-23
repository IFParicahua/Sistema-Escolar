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
            <th scope="col">Cupos</th>
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
            <td>{{$inscripcion->fecha}}</td>
            <td>{{$inscripcion->observacion}}</td>
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
@endsection




