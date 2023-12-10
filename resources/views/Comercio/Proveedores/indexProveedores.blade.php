@extends('Comercio.Panel')

@section('titulo', 'Proveedores')

@section('ubicacion')
<div class="shiftnav-content-wrap">
  <section class="content-header">
    <h1>
        PROVEEDORES
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('panel') }}"><i class="fa fa-dashboard fa-fw"></i>Panel /</a></li>
        <li class="active">&nbsp;Proveedores</li>
    </ol>
  </section>
</div>
@endsection

@section('headers')
    <link rel="stylesheet" href="{{asset('gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!--  extension responsive  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
@endsection

@section('content')

<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Administración de Proveedores</h2>
                <div class="clearfix"></div>
            </div>
            <a href="{{asset('comercio/proveedores/crear/')}}" class="btn btn-success">Crear nuevo</a>
            <a href="{{asset('panel')}}" class="btn btn-danger">Regresar</a>
            <hr>
            {{-- Tabla --}}
            <div class="x_content">
                <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                    <table id="listado" class="table table-striped table-bordered dataTable no-footer table-hover" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" aria-sort="ascending" style="width: 15%;">DOCUMENTO</th>
                            <th class="sorting" style="width: 30%;">NOMBRE/RAZÓN SOCIAL</th>
                            <th class="sorting" style="width: 25%;"><center>CATEGORIA</center></th>
                            <th class="sorting" style="width: 25%;"><center>TIPO</center></th>
                            <th class="sorting" style="width: 30%;"><center>CIUDAD</center></th>
                            <th class="sorting" style="width: 25%;"><center>ACCCIONES</center></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
            {{-- Fin Tabla --}}
        </div><br>
    </div>
</div>

{{-- Inicio modal --}}
<div id="myModalDelete" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Eliminación de registros</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>¿Esta seguro que desea eliminar el registro <b><span id="dataModal" aria-hidden="true"></span></b> ?</p>
                <input type="hidden" id="idModal" name="idModal">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <input type="button" value="Confirmar" id="Confirmar" class="btn btn-success DeleteRegister">
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
{{-- Fin Inicio modal --}}
            
@endsection

@section('imports')
<!-- DataTables -->
<script src="{{ asset('gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- extension responsive -->
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

// {{-- CARGUES INICALES --}}
<script>
    $(document).ready(function () {
        $('#listado').DataTable({
            "language":{url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"}, 
            "responsive": true,
            "processing":true,
            "serverSide": true,
            "ajax":{
                url:"{{route('GetProveedores')}}",
            },
            "columns":[
                {data: 'documento'},
                {data: 'nombre_razon'},
                {data: 'categorias.nombre'},
                {data: "tipos",render: function (data, type, row) {return(data === null) ?  '' : data.nombre ;}},
                {data: "ciudades",render: function (data, type, row) {return(data === null) ?  '' : data.nombre_ciudad ;}},
                {data: 'actions'}
            ]
        });
    });
</script>

// {{-- ELIMINAR REGISTROS --}}
<script>
    $(document).on('click', '.ShowDelete', function(event){
        // {{-- Abrir modal --}}
        var id = $(this).attr("id");
        $("#idModal").html($(this).attr("id"));
        $("#dataModal").html($(this).attr("data"));
        $("#myModalDelete").modal("show");

        // {{-- Eliminar registro --}}
        $('#myModalDelete .DeleteRegister').click(function(){
            if(id != ""){
                var routeSend = "{{asset('comercio/proveedores/')}}";
                var token = $("#token").val();
                var formData = new FormData();
                formData.append("id", id);
                formData.append("action", 'eliminar');

                $.ajax({
                    url: routeSend,
                    headers: {'X-CSRF-TOKEN':token},
                    type: "POST",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(res){
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        toastr["success"](res.message,"Éxito");
                        $("#myModalDelete").modal("hide");
                        $("#listado").DataTable().ajax.reload();
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#myModalDelete").modal('show');
                    }); 
                });
            }
        });
    });
</script>
@endsection
