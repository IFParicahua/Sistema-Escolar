@extends('layout.menuadmin')
@section('content')

<div class="col-11" style="margin: auto;">

  <div class="row">
    <div class="col-md-10 bg-primary">
      <h3 style="text-align: center;color:#ffffff">Registro de Turnos</h3>
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
            <th scope="col">Estado</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
        @foreach ($turnos as $turno)
          <tr>
            <td>{{$turno->nombre}}</td>
            <td>
                @if ($turno->estado == 0)
                    Abierto
                @else
                    Cerrado
                @endif
              </td>
            <td>
                <a  style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil " id="edit-item"  title="Editar" 
                data-id="{{$turno->id}}"
                data-nombre="{{$turno->nombre}}"
                ></a>
                <a class="btn btn-danger icon-bin" data-toggle="tooltip" title="Eliminar" href="AdminTurnos/{{$turno->id}}/delete" data-confirm="¿Estas seguro que quieres eliminar a {{$turno->nombre}}?"></a>
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
              <h5 class="modal-title">Guardar Turno</h5>
          </div>
          <div class="modal-body">
              <form data-toggle="validator" method="post" action="{{url('AdminTurnos/create')}}" role="form" id="form-new">
                  {!! csrf_field() !!}
                  <div class="panel-body">
                      <div class="row">
                          <div id="nombre" class="form-group col-md-12 pl-1">
                              <label for="nombre" class="control-label">Nombre:</label>
                              <input type="text" class="form-control" id="nombre" name="nombre" maxlength="40" required>
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
<div class="modal fade col-lg-12" id="edit-turno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" style="height: 50px;" role="document">
        <div class="modal-content card-body" >
            <div>
                <h5 class="modal-title">Editar Turno</h5>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" method="post" action="{{url('AdminTurnos/edit')}}" role="form" id="form-new">
                    {!! csrf_field() !!}
                    <div class="panel-body">
                        <input type="hidden" class="form-control" id="pkturno" name="pkturno" >

                        <div class="row">
                            <div class="form-group col-md-12 pl-1">
                                <label for="editnombre" class="control-label">Nombre:</label>
                                <input type="text" class="form-control" id="editnombre" name="editnombre" maxlength="40" required>
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
        var nombre = $(this).data("nombre");
        
    
        $("#pkturno").val(id);
        $("#editnombre").val(nombre);
        
        $("#edit-turno").modal('show');
      
      })
      </script>
@endsection

