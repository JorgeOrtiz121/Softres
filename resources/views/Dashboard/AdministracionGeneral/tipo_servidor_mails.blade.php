@extends('Dashboard.dashboard')

@section('titulo', 'Tipos servidor de correo')

@section('ubicacion')
<div class="shiftnav-content-wrap">
    <section class="content-header">
        <h1>
            LISTADO TIPOS SERVIDOR DE CORREO
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i>Dashboard /</a></li>
            <li class="active">Listado Tipos servidor de correo</li>
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
<input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        {{-- Boton para crear un nuevo registro --}}
        <div class="text-left">
            <input type="button" value="Crear Nuevo" id="Crear Nuevo" class="btn btn-success NewTipo">
            <a href="{{asset('dashboard')}}" title="Volver al menú inicio" class="btn .btn-lg btn-danger" >
                REGRESAR
            </a>
        </div>
        <div class="x_title">
            <h2> Listado de Tipos</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="listado" class="table table-striped table-bordered dataTable no-footer table-hover" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" aria-sort="ascending" style="width: 6%;">#</th>
                                    <th class="sorting" style="width: 30%;">NOMBRE</th>
                                    <th class="sorting" style="width: 15%;"><center>ACCCIONES</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Inicio modal TIPOS --}}
<div id="ModalStoreUpdateTipo" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><span id="ModalType"></span> registro</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Nombre</label>
                            <input type="text" id="TipoNombre" name="TipoNombre" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" id="TipoId" name="id_register">
                    <input type="hidden" id="TipoAction" name="ActionModal">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <input type="button" value="Guardar" id="Guardar" class="btn btn-success StoreUpdateTipo">
            </div>
        </div>
    </div>
</div>

<div id="ModalDeleteTipo" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Eliminación de registros</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>¿Esta seguro que desea eliminar el registro <b><span id="dataTipoModal" aria-hidden="true"></span></b> ?</p>
                <input type="hidden" id="idTipoModal" name="idTipoModal">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <input type="button" value="Confirmar" id="Confirmar" class="btn btn-success DeleteTypeRegistration">
            </div>
        </div>
    </div>
</div>
{{-- Fin modal TIPOS --}}
@endsection

@section('imports')
<!-- DataTables -->
<script src="{{ asset('gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- extension responsive -->
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

// {{-- ADMINISTRAR TIPOS --}}
    <script>
        // {{-- Ver listado resgistros --}}
        $(document).ready(function () {
            GetTable();
        });

        function GetTable() {
            $("#listado").dataTable().fnDestroy();
            $('#listado').DataTable({
                "language":{url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                "responsive": true,
                "processing":true,
                "serverSide": true,
                "ajax":{
                    url:"{{route('GetServidorMail')}}",
                },
                "columns":[
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'actions'}
                ]
            });
        }

        // {{-- Cargar creacion de registros --}}
        $('.NewTipo').click(function() {
            $("#ModalType").html('Crear');
            $("#TipoNombre").val('');
            $("#TipoId").val('');
            $("#TipoAction").val('crear');
            $("#ModalStoreUpdateTipo").modal("show");
        });

        // {{-- Cargar edicion de registro --}}
        function EditTipo(id) {
            var routeGet = "{{asset('dashboard/GetServidorMail/unico')}}"+'/'+id;
            $.ajax({
                url: routeGet,
                type: 'GET',
                dataType: 'json',
            }).done(function(res){
                if(res.codigo == 0){
                    toastr["error"](res.message,"Error");
                }else{
                    $("#ModalType").html('Editar');
                    $("#TipoNombre").val(res.data.nombre);
                    $("#TipoId").val(res.data.id);
                    $("#TipoAction").val('editar');
                    $("#ModalStoreUpdateTipo").modal("show");
                }
            })
            .fail(function(msg){
                $.each(msg.responseJSON.errors, function(key, value){
                    toastr["error"](value,"Error");
                    $("#ModalStoreUpdateTipo").modal('show');
                }); 
            });
        }

        // {{-- GuardarEditar registro --}}
        $('#ModalStoreUpdateTipo .StoreUpdateTipo').click(function(){
            var routeSend = "{{asset('dashboard/tipos/')}}";
            var token = $("#token").val();
            var formData = new FormData();
            formData.append("nombre", $("#TipoNombre").val());
            formData.append("id", $("#TipoId").val());
            formData.append("action",$("#TipoAction").val());

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
                    $("#ModalStoreUpdateTipo").modal("hide");
                    $("#listado").DataTable().ajax.reload();
                }
            })
            .fail(function(msg){
                $.each(msg.responseJSON.errors, function(key, value){
                    toastr["error"](value,"Error");
                    $("#ModalStoreUpdateTipo").modal('show');
                }); 
            });
        });

        // {{-- Eliminar registro --}}
        function DeleteType(fila) {
            var id = $(this).attr("id");
            // {{-- Abrir modal --}}
            $("#idTipoModal").val($(fila).attr('id'));
            $("#dataTipoModal").html($(fila).attr('data'));
            $("#ModalDeleteTipo").modal("show");

            // {{-- Eliminar registro --}}
            $('#ModalDeleteTipo .DeleteTypeRegistration').click(function(){
                if(id != ""){
                    var routeSend = "{{asset('dashboard/tipos/')}}";
                    var token = $("#token").val();
                    var formData = new FormData();
                    formData.append("id", $("#idTipoModal").val());
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
                            $("#ModalDeleteTipo").modal("hide");
                            $("#listado").DataTable().ajax.reload();
                        }
                    })
                    .fail(function(msg){
                        $.each(msg.responseJSON.errors, function(key, value){
                            toastr["error"](value,"Error");
                            $("#ModalDeleteTipo").modal('show');
                        }); 
                    });
                }
            });
        }

        // {{-- Regresar --}}
        $('#ModalTipos .CancelTipo').click(function(){
            GetTable();
        });
    </script>
@endsection
