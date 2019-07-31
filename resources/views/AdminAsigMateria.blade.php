@extends('layout.menuadmin')
@section('content')

<div class="col-11" style="margin: auto;">

  <div class="row">
    <div class="col-md-10 bg-primary">
      <h3 style="text-align: center;color:#ffffff">Asignacion de Materias</h3>
    </div>
    <div class="col-md-2 bg-primary" style="text-align: right;">
        <button type="button" class="btn btn-primary icon-plus" data-toggle="modal" data-target="#new-asignar" data-toggle="tooltip" title="Agregar" id="nuevo">Registrar</button>
    </div>
  </div>
    <div class="row">
      <table class="table table-striped" style="background:#ffffff;">
        <thead class="bg-primary" style="color:#ffffff">
          <tr>
            <th scope="col">Fecha</th>
            <th scope="col">Materia</th>
            <th scope="col">Profesor</th>
            <th scope="col">Curso</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
        @foreach ($asignaciones as $asignacion)
          <tr>
            <td>{{date("d/m/Y",strtotime($asignacion->fecha))}}</td>
            <td>{{$asignacion->nombremateria}}</td>
            <td>{{$asignacion->nombreprofesor}} {{$asignacion->paternoprofesor}} {{$asignacion->maternoprofesor}}</td>
            <td>{{$asignacion->turno}} - {{$asignacion->curso}} - {{$asignacion->nombreparalelo}}</td>
            <td>
                <a  style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil " id="edit-item"  title="Editar" 
                data-id="{{$asignacion->id}}"
                data-fecha="{{date("Y-m-d",strtotime($asignacion->fecha))}}"
                data-idmateria="{{$asignacion->idmateria}}"
                data-materia="{{$asignacion->nombremateria}}"
                data-idprofesor="{{$asignacion->idprofesor}}"
                data-profesor="{{$asignacion->nombreprofesor}} {{$asignacion->paternoprofesor}} {{$asignacion->maternoprofesor}}"
                data-idparalelo="{{$asignacion->idparalelo}}"
                data-paralelo="{{$asignacion->turno}} - {{$asignacion->curso}} - {{$asignacion->nombreparalelo}}"
                ></a>
            <a class="btn btn-danger icon-bin" data-toggle="tooltip" title="Eliminar" href="AdminAsignarMateria/{{$asignacion->id}}/delete" data-confirm="¿Desea eliminar la asignacion de {{$asignacion->nombremateria}} a {{$asignacion->nombreprofesor}} {{$asignacion->paternoprofesor}} {{$asignacion->maternoprofesor}} para el curso {{$asignacion->curso}} - {{$asignacion->nombreparalelo}} turno {{$asignacion->turno}}?"></a>
            </td>
          </tr>
        @endforeach
      
        </tbody>
      </table>
        
    </div>
</div>


<!-- Modal Asignar Materia new -->
<div class="modal fade col-lg-12" id="new-asignar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" style="height: 50px;" role="document">
        <div class="modal-content card-body" >
            <div>
                <h5 class="modal-title">Guardar Asignacion de Materia</h5>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" method="post" action="{{url('AdminAsignarMateria/create')}}" role="form" id="form-new">
                    {!! csrf_field() !!}
                    <div class="panel-body">
                        <div class="row">
                          <div class="form-group col-md-12 pl-1">
                              <label for="profesor_name" class="form-label">Profesor:</label>
                              <input type="text" name="profesor_name" id="profesor_name" class="form-control" autocomplete="off" required/>
                              <input type="hidden" name="profesor_id" id="profesor_id" class="form-control" />
                              <div id="profesorList">
                              </div>
                              {{ csrf_field() }}
                              <script>
                                  $(document).ready(function(){
                                      $('#profesor_name').keyup(function(){
                                          var query = $(this).val();
                                          if(query != '')
                                          {
                                              var _token = $('input[name="_token"]').val();
                                              $.ajax({
                                                  url:"{{ route('AdminProfesor.fetch') }}",
                                                  method:"POST",
                                                  data:{query:query, _token:_token},
                                                  success:function(data){
                                                      $('#profesorList').fadeIn();
                                                      $('#profesorList').html(data);
                                                  }
                                              });
                                          }
                                      });
                                      $(document).on('click', '.teacher', function(){
                                          $('#profesor_name').val($(this).text());
                                          $('#profesor_id').val($(this).attr("id"));                            
                                          $('#profesorList').fadeOut();
                                      });
                                  });
                              </script>
                          </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 pl-1">
                                <label for="materia_name" class="form-label">Materia:</label>
                                <input type="text" name="materia_name" id="materia_name" class="form-control" autocomplete="off" required/>
                                <input type="hidden" name="materia_id" id="materia_id" class="form-control" />
                                <div id="materiaList">
                                </div>
                                {{ csrf_field() }}
                                <script>
                                    $(document).ready(function(){
                                        $('#materia_name').keyup(function(){
                                            var query = $(this).val();
                                            if(query != '')
                                            {
                                                var _token = $('input[name="_token"]').val();
                                                $.ajax({
                                                    url:"{{ route('AdminMateria.fetch') }}",
                                                    method:"POST",
                                                    data:{query:query, _token:_token},
                                                    success:function(data){
                                                        $('#materiaList').fadeIn();
                                                        $('#materiaList').html(data);
                                                    }
                                                });
                                            }
                                        });
                                        $(document).on('click', '.materia', function(){
                                            $('#materia_name').val($(this).text());
                                            $('#materia_id').val($(this).attr("id"));                            
                                            $('#materiaList').fadeOut();
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 pl-1">
                                <label for="curso_name" class="form-label">Curso:</label>
                                <input type="text" name="curso_name" id="curso_name" class="form-control" autocomplete="off" required/>
                                <input type="hidden" name="curso_id" id="curso_id" class="form-control" />
                                <div id="cursoList">
                                </div>
                                {{ csrf_field() }}
                                <script>
                                    $(document).ready(function(){
                                        $('#curso_name').keyup(function(){
                                            var query = $(this).val();
                                            if(query != '')
                                            {
                                                var _token = $('input[name="_token"]').val();
                                                $.ajax({
                                                    url:"{{ route('AdminParalelo.fetch') }}",
                                                    method:"POST",
                                                    data:{query:query, _token:_token},
                                                    success:function(data){
                                                        $('#cursoList').fadeIn();
                                                        $('#cursoList').html(data);
                                                    }
                                                });
                                            }
                                        });
                                        $(document).on('click', '.paralelo', function(){
                                            $('#curso_name').val($(this).text());
                                            $('#curso_id').val($(this).attr("id"));                            
                                            $('#cursoList').fadeOut();
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
  
<!-- Modal Asignar Materia edit -->
<div class="modal fade col-lg-12" id="edit-asignar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" style="height: 50px;" role="document">
      <div class="modal-content card-body" >
          <div>
              <h5 class="modal-title">Editar Asignacion de Materia</h5>
          </div>
          <div class="modal-body">
              <form data-toggle="validator" method="post" action="{{url('AdminAsignarMateria/edit')}}" role="form" id="form-new">
                  {!! csrf_field() !!}
                  <div class="panel-body">
                        <input type="hidden" name="pkasignar" id="pkasignar" class="form-control" />

                      <div class="row">
                        <div class="form-group col-md-12 pl-1">
                            <label for="editprofesor_name" class="form-label">Profesor:</label>
                            <input type="text" name="editprofesor_name" id="editprofesor_name" class="form-control" autocomplete="off" required/>
                            <input type="hidden" name="editprofesor_id" id="editprofesor_id" class="form-control" />
                            <div id="editprofesorList">
                            </div>
                            {{ csrf_field() }}
                            <script>
                                $(document).ready(function(){
                                    $('#editprofesor_name').keyup(function(){
                                        var query = $(this).val();
                                        if(query != '')
                                        {
                                            var _token = $('input[name="_token"]').val();
                                            $.ajax({
                                                url:"{{ route('AdminProfesor.fetch') }}",
                                                method:"POST",
                                                data:{query:query, _token:_token},
                                                success:function(data){
                                                    $('#editprofesorList').fadeIn();
                                                    $('#editprofesorList').html(data);
                                                }
                                            });
                                        }
                                    });
                                    $(document).on('click', '.teacher', function(){
                                        $('#editprofesor_name').val($(this).text());
                                        $('#editprofesor_id').val($(this).attr("id"));                            
                                        $('#editprofesorList').fadeOut();
                                    });
                                });
                            </script>
                        </div>
                      </div>
                      <div class="row">
                          <div class="form-group col-md-12 pl-1">
                              <label for="editmateria_name" class="form-label">Materia:</label>
                              <input type="text" name="editmateria_name" id="editmateria_name" class="form-control" autocomplete="off" required/>
                              <input type="hidden" name="editmateria_id" id="editmateria_id" class="form-control" />
                              <div id="editmateriaList">
                              </div>
                              {{ csrf_field() }}
                              <script>
                                  $(document).ready(function(){
                                      $('#editmateria_name').keyup(function(){
                                          var query = $(this).val();
                                          if(query != '')
                                          {
                                              var _token = $('input[name="_token"]').val();
                                              $.ajax({
                                                  url:"{{ route('AdminMateria.fetch') }}",
                                                  method:"POST",
                                                  data:{query:query, _token:_token},
                                                  success:function(data){
                                                      $('#editmateriaList').fadeIn();
                                                      $('#editmateriaList').html(data);
                                                  }
                                              });
                                          }
                                      });
                                      $(document).on('click', '.materia', function(){
                                          $('#editmateria_name').val($(this).text());
                                          $('#editmateria_id').val($(this).attr("id"));                            
                                          $('#editmateriaList').fadeOut();
                                      });
                                  });
                              </script>
                          </div>
                      </div>
                      <div class="row">
                          <div class="form-group col-md-12 pl-1">
                              <label for="editcurso_name" class="form-label">Curso:</label>
                              <input type="text" name="editcurso_name" id="editcurso_name" class="form-control" autocomplete="off" required/>
                              <input type="hidden" name="editcurso_id" id="editcurso_id" class="form-control" />
                              <div id="editcursoList">
                              </div>
                              {{ csrf_field() }}
                              <script>
                                  $(document).ready(function(){
                                      $('#editcurso_name').keyup(function(){
                                          var query = $(this).val();
                                          if(query != '')
                                          {
                                              var _token = $('input[name="_token"]').val();
                                              $.ajax({
                                                  url:"{{ route('AdminParalelo.fetch') }}",
                                                  method:"POST",
                                                  data:{query:query, _token:_token},
                                                  success:function(data){
                                                      $('#editcursoList').fadeIn();
                                                      $('#editcursoList').html(data);
                                                  }
                                              });
                                          }
                                      });
                                      $(document).on('click', '.paralelo', function(){
                                          $('#editcurso_name').val($(this).text());
                                          $('#editcurso_id').val($(this).attr("id"));                            
                                          $('#editcursoList').fadeOut();
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
    $(document).ready(function() {
            $('a[data-confirm]').click(function(ev) {
                var href = $(this).attr('href');
                if (!$('#dataConfirmModal').length) {
                    $('body').append('<div class="modal fade in" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"></div><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancelar</button><a style="color: #ffffff" class="btn btn-primary btn-fill" id="dataConfirmOK">Aceptar</a></div></div></div></div>');
                }
                $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
                $('#dataConfirmOK').attr('href', href);
                $('#dataConfirmModal').modal({show:true});
                return false;
            });
        });
  $(document).on('click', "#edit-item", function() {
    var id = $(this).data("id");
    var fecha = $(this).data("fecha");
    var idmateria = $(this).data("idmateria");
    var materia = $(this).data("materia");
    var idprofesor = $(this).data("idprofesor");
    var profesor = $(this).data("profesor");
    var idparalelo = $(this).data("idparalelo");
    var paralelo = $(this).data("paralelo");

    $("#pkasignar").val(id);
    $("#editnombre").val(fecha);
    $("#editmateria_id").val(idmateria);
    $("#editmateria_name").val(materia);
    $("#editprofesor_id").val(idprofesor);
    $("#editprofesor_name").val(profesor);
    $("#editcurso_id").val(idparalelo);
    $("#editcurso_name").val(paralelo);

    $("#edit-asignar").modal('show');
  
  })
  </script>
@endsection


