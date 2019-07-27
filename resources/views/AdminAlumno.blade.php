@extends('layout.menuadmin')
@section('content')

<div class="col-11" style="margin: auto;">

  <div class="row">
    <div class="col-md-10 bg-primary">
      <h3 style="text-align: center;color:#ffffff">Registro de Alumnos</h3>
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
                <td>{{date("d/m/Y",strtotime($usuario->nacimiento))}}</td>
                <td>{{$usuario->rudes}}</td>
                <td>
                    <a  style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil " id="edit-item"  title="Editar" 
                    data-id="{{$usuario->id}}"
                    data-nombre="{{$usuario->nombre}}"
                    data-paterno="{{$usuario->apellidopat}}"
                    data-materno="{{$usuario->apellidomat}}"
                    data-direccion="{{$usuario->direcciones}}"
                    data-ci="{{$usuario->cis}}"
                    data-telefono="{{$usuario->telefonos}}"
                    data-sexo="{{$usuario->sexos}}"
                    data-nacimiento="{{date("Y-m-d",strtotime($usuario->nacimiento))}}"
                    data-rude="{{$usuario->rudes}}"
                    data-idtutor="{{$usuario->idtutor}}"
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
                    <h5 class="modal-title">Guardar Alumno</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminUser/create')}}" role="form" id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">

                            <div class="row">
                                <div id="nombre" class="form-group col-md-6 pl-1">
                                    <label for="nombre" class="control-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" maxlength="40" required>
                                </div>
                                <div id="rude" class="form-group col-md-6 pl-1">
                                    <label for="rude" class="control-label">Rude:</label>
                                    <input type="text" class="form-control" id="rude" name="rude" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                                </div>
                            </div>

                            <div class="row">
                                <div id="apaterno" class="form-group col-md-6 pl-1">
                                    <label for="apaterno" class="control-label">Apellido Paterno:</label>
                                    <input type="text" class="form-control" id="apaterno" name="apaterno" maxlength="40" required>
                                </div>
                                <div id="amaterno" class="form-group col-md-6 pl-1">
                                    <label for="amaterno" class="control-label">Apellido Materno:</label>
                                    <input type="text" class="form-control" id="amaterno" name="amaterno" maxlength="40" required>
                                </div>
                            </div>

                            <div class="row">
                                <div id="direccion" class="form-group col-md-12 pl-1">
                                    <label for="direccion" class="control-label">Direccion:</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" maxlength="40" required>
                                </div>
                            </div>

                            <div class="row">
                                
                                <div id="telefono" class="form-group col-md-6 pl-1">
                                    <label for="telefono" class="control-label">Telefono:</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" maxlength="10" required>
                                </div>
                                <div class="form-group col-md-6 pl-1">
                                    <label for="tutor_name" class="form-label">Tutor:</label>
                                    <input type="text" name="tutor_name" id="tutor_name" class="form-control" required/>
                                    <input type="hidden" name="tutor_id" id="tutor_id" class="form-control" />
                                    <div id="tutorList">
                                    </div>
                                    {{ csrf_field() }}
                                    <script>
                                        $(document).ready(function(){
                                            $('#tutor_name').keyup(function(){
                                                var query = $(this).val();
                                                if(query != '')
                                                {
                                                    var _token = $('input[name="_token"]').val();
                                                    $.ajax({
                                                        url:"{{ route('AdminUser.fetch') }}",
                                                        method:"POST",
                                                        data:{query:query, _token:_token},
                                                        success:function(data){
                                                            $('#tutorList').fadeIn();
                                                            $('#tutorList').html(data);
                                                        }
                                                    });
                                                }
                                            });
                                            $(document).on('click', '.caja', function(){
                                                $('#tutor_name').val($(this).text());
                                                $('#tutor_id').val($(this).attr("id"));                            
                                                $('#tutorList').fadeOut();
                                            });
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4 pl-1">
                                    <label for="sexo">Sexo:</label>
                                    <select class="form-control" id="sexo" name="sexo">
                                      <option value="M">Masculino</option>
                                      <option value="F">Femenino</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-5 pl-1">
                                    <label for="nacimiento" class="control-label">Fecha de Nacimiento:</label>
                                    <input type="date" class="form-control" id="nacimiento" name="nacimiento" required>
                                </div>
                                <div id="ci" class="form-group col-md-3 pl-1">
                                        <label for="ci" class="control-label">CI:</label>
                                        <input type="text" class="form-control" id="ci" name="ci" maxlength="40" required>
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
     <!-- Modal Gestion edit -->
     <div class="modal fade col-lg-12" id="edit-alumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" style="height: 50px;" role="document">
                <div class="modal-content card-body" >
                    <div>
                        <h5 class="modal-title">Guardar Alumno</h5>
                    </div>
                    <div class="modal-body">
                        <form data-toggle="validator" method="post" action="{{url('AdminUser/editar')}}" role="form" id="form-new">
                            {!! csrf_field() !!}
                            <div class="panel-body">
                                    <input type="hidden" class="form-control" id="pkpersona" name="pkpersona" maxlength="40" required>
                                <div class="row">
                                    <div id="nombre" class="form-group col-md-6 pl-1">
                                        <label for="editnombre" class="control-label">Nombre:</label>
                                        <input type="text" class="form-control" id="editnombre" name="editnombre" maxlength="40" required>
                                    </div>
                                    <div class="form-group col-md-6 pl-1">
                                        <label for="editrude" class="control-label">Rude:</label>
                                        <input type="text" class="form-control" id="editrude" name="editrude" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="form-group col-md-6 pl-1">
                                        <label for="editpaterno" class="control-label">Apellido Paterno:</label>
                                        <input type="text" class="form-control" id="editpaterno" name="editpaterno" maxlength="40" required>
                                    </div>
                                    <div class="form-group col-md-6 pl-1">
                                        <label for="editmaterno" class="control-label">Apellido Materno:</label>
                                        <input type="text" class="form-control" id="editmaterno" name="editmaterno" maxlength="40" required>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="form-group col-md-12 pl-1">
                                        <label for="editdireccion" class="control-label">Direccion:</label>
                                        <input type="text" class="form-control" id="editdireccion" name="editdireccion" maxlength="40" required>
                                    </div>
                                </div>
    
                                <div class="row">
                                    
                                    <div class="form-group col-md-6 pl-1">
                                        <label for="edittelefono" class="control-label">Telefono:</label>
                                        <input type="text" class="form-control" id="edittelefono" name="edittelefono" maxlength="10" required>
                                    </div>
                                    <div class="form-group col-md-6 pl-1">
                                        <label for="editutor_name" class="form-label">Tutor:</label>
                                        <input type="text" name="editutor_name" id="editutor_name" class="form-control" required/>
                                        <input type="hidden" name="editutor_id" id="editutor_id" class="form-control" />
                                        <div id="editutorList">
                                        </div>
                                        {{ csrf_field() }}
                                        <script>
                                            $(document).ready(function(){
                                                $('#editutor_name').keyup(function(){
                                                    var query = $(this).val();
                                                    if(query != '')
                                                    {
                                                        var _token = $('input[name="_token"]').val();
                                                        $.ajax({
                                                            url:"{{ route('AdminUser.fetch') }}",
                                                            method:"POST",
                                                            data:{query:query, _token:_token},
                                                            success:function(data){
                                                                $('#editutorList').fadeIn();
                                                                $('#editutorList').html(data);
                                                            }
                                                        });
                                                    }
                                                });
                                                $(document).on('click', '.caja', function(){
                                                    $('#editutor_name').val($(this).text());
                                                    $('#editutor_id').val($(this).attr("id"));                            
                                                    $('#editutorList').fadeOut();
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="form-group col-md-4 pl-1">
                                        <label for="editsexo">Sexo:</label>
                                        <select class="form-control" id="editsexo" name="editsexo">
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5 pl-1">
                                        <label for="editnacimiento" class="control-label">Fecha de Nacimiento:</label>
                                        <input type="date" class="form-control" id="editnacimiento" name="editnacimiento" required>
                                    </div>
                                    <div id="ci" class="form-group col-md-3 pl-1">
                                            <label for="editci" class="control-label">CI:</label>
                                            <input type="text" class="form-control" id="editci" name="editci" maxlength="40" required>
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
      $("#editsexo").empty();
        var id = $(this).data("id");
        var nombre = $(this).data("nombre");
        var ap = $(this).data("paterno");
        var am = $(this).data("materno");
        var dir = $(this).data("direccion");
        var ci = $(this).data("ci");
        var telf = $(this).data("telefono");
        var sexo = $(this).data("sexo");
        var nacimiento = $(this).data("nacimiento");
        var rude = $(this).data("rude");
        var idtutor = $(this).data("idtutor");

        var valor;
        var valor2;
        var valor3;
        if(sexo == 'M'){
            valor = "Masculino";
            valor2 = "Femenino";
            valor3 = "F";
        }else{
            valor = "Femenino";
            valor2 = "Masculino";
            valor3 = "M";
        }
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ route('tutor.buscar') }}",
            method:"POST",
            data:{query:idtutor, _token:_token},
            success:function(data){
                $("#editutor_name").val(data);
            }});
        $("#editutor_id").val(idtutor);
        $("#pkpersona").val(id);
        $("#editnombre").val(nombre);
        $("#editrude").val(rude);
        $("#editpaterno").val(ap);
        $("#editmaterno").val(am);
        $("#editdireccion").val(dir);
        $("#edittelefono").val(telf);
        $("#editsexo").append('<option value="'+sexo+'">'+valor+'</option><option value="'+valor3+'">'+valor2+'</option>');
        $("#editnacimiento").val(nacimiento);
        $("#editci").val(ci);
        

        $("#edit-alumno").modal('show');
    
    })
</script>
@endsection