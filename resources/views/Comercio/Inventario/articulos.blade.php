@extends('Comercio.Panel')

@section('titulo', 'Artículos')

@section('ubicacion')
<div class="shiftnav-content-wrap">
    <section class="content-header">
        <h1>
            Inventario de Artículos
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('panel') }}"><i class="fa fa-dashboard fa-fw"></i>Panel /</a></li>
            <li><a href="{{ url('comercio/inventario') }}"><i class="fa fa-shopping-basket fa-fw"></i>Inventario /</a></li>
            <li class="active">Inventario de Artículos</li>
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
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        {{-- Boton para crear un nuevo registro --}}
        <div class="text-left">
            <a href="{{asset('comercio/inventario/articulos/nuevo')}}"  title="Crear nuevo registro" class="btn .btn-lg btn-primary" style="color:white; cursor: pointer;">CREAR NUEVO</a>
            <a href="{{asset('comercio/inventario')}}" title="Volver a Clasificadores" class="btn .btn-lg btn-danger" >REGRESAR</a>
        </div>
        <div class="x_title">
            <h2> Listado de los Artículos </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="tabla_listado" class="table table-striped table-bordered dataTable no-footer table-hover" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" aria-sort="ascending" style="width: 2%;">N°</th>
                                    <th class="sorting" style="width: 4%;">CÓDIGO</th>
                                    <th class="sorting" style="width: 30%;">NOMBRE</th>
                                    <th class="sorting" style="width: 30%;">NOMBRE FACTURA</th>
                                    <th class="sorting" style="width: 30%;">P. COMPRA(IVA)</th>
                                    {{-- <th class="sorting" style="width: 30%;">PRESENTACIÓN</th> --}}
                                    <th class="sorting" style="width: 30%;">STOCK ACTUAL</th>
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
@component('Comercio.Componentes.modal_eliminar_clasificadores')
    @slot('titulo')
        Eliminar Artículo
    @endslot
    @slot('descripcion')
        ¿Realmente desea eliminar el Artículo?
    @endslot
@endcomponent
@endsection

@section('imports')
<!-- DataTables -->
<script src="{{ asset('gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- extension responsive -->
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script>
   $(document).ready(function () {
        $('#tabla_listado').DataTable({
            "language":{url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
            "processing":true,
            "serverSide":true,
            "ajax":{
                url:"{{route('articulos')}}",
            },
            "columns":[
                {data:'DT_RowIndex'},
                {data:'codigo'},
                {data:'nombre'},
                {data:'nombre_factura'},
                {data:'precio_compra_con_iva'},
                {data:'stock_actual'},
                {data:'actions'},
            ]
        });
    });

    //############### FUNCIÓN MODAL PARA ELIMINAR ARTÍCULOS  #############
    function modalEliminar(id_articulo){
        $("#id_clasificador").val(id_articulo);
        $("#modalEliminar").modal('show');
    }

    //Submit de la confirmación de eliminar
    $("#frmConfirmarEliminar").on("submit", function(e){
        e.preventDefault();
        envioEliminar();
        $('#modalEliminar').modal('hide');
    });

    // FUNCIÓN DE ENVIO INFO
    function envioEliminar(){

        var formData = new FormData();
        // var id_articulo = $('#id_clasificador').val();
        formData.append('id_articulo',$('#id_clasificador').val());

        // ENVIO AJAX
        var routeModificar = "{{asset('comercio/inventario/articulos/eliminar')}}";
        var token = $("#_token").val();

        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: routeModificar,
            type: "POST",
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            if (res.respuesta == 0) {
                toastr["error"](res.mensaje,"Eliminar Articulos");
            } else {
                $('#modalEliminar').modal('hide');
                toastr["success"](res.mensaje,"Eliminar Articulos");
                $("#tabla_listado").DataTable().ajax.reload();
            }
        })
        .fail(function(msg){
            $('#modalEliminar').modal('hide');
            $.each(msg.responseJSON.errors, function(key, value){
                toastr["error"](value,"Error");
            });
        });
    }
    //############### FIN FUNCIÓN MODAL PARA ELIMINAR ARTÍCULOS  #############
</script>
@endsection
