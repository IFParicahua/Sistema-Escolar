@extends('layout.menuadmin')
@section('content')

<div class="col-11" style="margin: auto;">

  <div class="row">
    <div class="col-md-10 bg-primary">
      <h3 style="text-align: center;color:#ffffff">Registro de Gestiones</h3>
    </div>
    <div class="col-md-2 bg-primary" style="text-align: right;">
        <button type="button" class="btn btn-primary icon-plus" data-toggle="modal" data-target="#new-gestion" data-toggle="tooltip" title="Agregar" id="nuevo">Registrar</button>
    </div>
  </div>
    <div class="row">
      <table class="table table-striped" style="background:#ffffff;">
        <thead class="bg-primary" style="color:#ffffff">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Fecha Inicial</th>
            <th scope="col">Fecha Final</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Estado</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
        @foreach ($gestiones as $gestion)
        <tr>
            <td>{{$gestion->nombre}}</td>
            <td>{{date("d/m/Y",strtotime($gestion->fecha_inicial))}}</td>
            <td>{{date("d/m/Y",strtotime($gestion->fecha_final))}}</td>
            <td>{{$gestion->descripcion}}</td>
            <td>{{$gestion->estado}}</td>
            <td>
                <a  style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil " id="edit-item"  title="Editar" 
                data-id="{{$gestion->id}}"
                data-nombre="{{$gestion->nombre}}"
                data-descripcion="{{$gestion->descripcion}}"
                data-inicio="{{date("Y-m-d",strtotime($gestion->fecha_inicial))}}"
                data-fin="{{date("Y-m-d",strtotime($gestion->fecha_final))}}"
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
<div class="modal fade col-lg-12" id="new-gestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" style="height: 50px;" role="document">
      <div class="modal-content card-body" >
          <div>
              <h5 class="modal-title">Guardar Gestion</h5>
          </div>
          <div class="modal-body">
              <form data-toggle="validator" method="post" action="{{url('AdminGestion/create')}}" role="form" id="form-new">
                  {!! csrf_field() !!}
                  <div class="panel-body">

                      <div class="row">
                          <div id="nombre" class="form-group col-md-12 pl-1">
                              <label for="nombre" class="control-label">Nombre:</label>
                              <input type="text" class="form-control" id="nombre" name="nombre" maxlength="40" required>
                          </div>
                      </div>
                      <div class="row">
                        <div id="descripcion" class="form-group col-md-12 pl-1">
                            <label for="descripcion" class="control-label">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="40" required>
                        </div>
                    </div>

                      <div class="row">
                        <div id="inicio" class="form-group col-md-6 pl-1">
                            <label for="inicio" class="control-label">Fecha Inicio:</label>
                            <input type="date" class="form-control" id="inicio" name="inicio" required>
                        </div>
                        <div id="fin" class="form-group col-md-6 pl-1">
                            <label for="fin" class="control-label">Fecha Fin:</label>
                            <input type="date" class="form-control" id="fin" name="fin" required>
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
<div class="modal fade col-lg-12" id="edit-gestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" style="height: 50px;" role="document">
      <div class="modal-content card-body" >
          <div>
              <h5 class="modal-title">Editar Gestion</h5>
          </div>
          <div class="modal-body">
              <form data-toggle="validator" method="post" action="{{url('AdminGestion/edit')}}" role="form" id="form-new">
                  {!! csrf_field() !!}
                  <div class="panel-body">
                      <input type="hidden" class="form-control" id="pkgestion" name="pkgestion">

                      <div class="row">
                          <div class="form-group col-md-12 pl-1">
                              <label for="editnombre" class="control-label">Nombre:</label>
                              <input type="text" class="form-control" id="editnombre" name="editnombre" maxlength="40" required>
                          </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-12 pl-1">
                            <label for="editdescripcion" class="control-label">Descripcion:</label>
                            <input type="text" class="form-control" id="editdescripcion" name="editdescripcion" required>
                        </div>
                    </div>

                      <div class="row">
                        <div class="form-group col-md-6 pl-1">
                            <label for="editinicio" class="control-label">Fecha Inicio:</label>
                            <input type="date" class="form-control" id="editinicio" name="editinicio" required>
                        </div>
                        <div class="form-group col-md-6 pl-1">
                            <label for="editfin" class="control-label">Fecha Fin:</label>
                            <input type="date" class="form-control" id="editfin" name="editfin" required>
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
    var id = $(this).data("id");
    var nombre = $(this).data("nombre");
    var descripcion = $(this).data("descripcion");
    var inicio = $(this).data("inicio");
    var fin = $(this).data("fin");
    

    $("#pkgestion").val(id);
    $("#editnombre").val(nombre);
    $("#editdescripcion").val(descripcion);
    $("#editinicio").val(inicio);
    $("#editfin").val(fin);
    
    $("#edit-gestion").modal('show');
  
  })
  </script>
@endsection
