@extends('Comercio.Panel')

@section('titulo', 'Clasificadores')

@section('ubicacion')
<div class="shiftnav-content-wrap">
    <section class="content-header">
        <h1>
            Administrar Presentaciones
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('panel') }}"><i class="fa fa-dashboard fa-fw"></i>Panel /</a></li>
            <li><a href="{{ url('comercio/inventario') }}"><i class="fa fa-shopping-basket fa-fw"></i>Inventario /</a></li>
            <li><a href="{{ url('comercio/inventario/clasificadores') }}"><i class="fa fa-check-square-o fa-fw"></i>Clasificadores /</a></li>
            <li class="active">Administrar Presentaciones</li>
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
            <a onclick="modalCrear()"  title="Crear nuevo registro" class="btn .btn-lg btn-primary" style="color:white; cursor: pointer;">CREAR NUEVA</a>
            <a href="{{asset('comercio/inventario/clasificadores')}}" title="Volver a Clasificadores" class="btn .btn-lg btn-danger" >REGRESAR</a>
        </div>
        <div class="x_title">
            <h2> Listado de las Presentaciones </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="tabla_listado" class="table table-striped table-bordered dataTable no-footer table-hover" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" aria-sort="ascending" style="width: 6%;">N°</th>
                                    <th class="sorting" style="width: 30%;">NOMBRE PRESENTACIONES</th>
                                    <th class="sorting" style="width: 30%;">ABREVIATURAS</th>
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


{{-- #################### MODAL CREAR PRESENTACION ######################## --}}
@component('Comercio.Componentes.modal_crear_clasificadores')
    @slot('titulo')
        Crear Presentaciones
    @endslot
    @slot('descripcion')
        Describa el nombre de la Presentación a crear
    @endslot
    @slot('columna')
        -8
    @endslot
    @slot('abreviatura')
        <label for="abreviaturaClasificador" class="" >Abreviatura</label>
        <input type="text" class="form-control" name="abreviaturaClasificador" id="abreviaturaClasificador" value="" required>
    @endslot
@endcomponent
{{-- ####################FINAL MODAL CREAR PRESENTACION ######################## --}}

{{-- #################### MODAL EDITAR PRESENTACION ######################## --}}
@component('Comercio.Componentes.modal_editar_clasificadores')
    @slot('titulo')
        Editar Presentaciones
    @endslot
    @slot('descripcion')
        Modifique el nombre de la Presentación
    @endslot
    @slot('columna')
        -8
    @endslot
    @slot('abreviatura')
        <label for="abreviaturaClasificador" class="" >Abreviatura</label>
        <input type="text" class="form-control" name="nuevaAbreviaturaClasificador" id="nuevaAbreviaturaClasificador" value="" required>
    @endslot
@endcomponent
{{-- #################### FINAL MODAL EDITAR PRESENTACION ######################## --}}

{{-- #################### MODAL ELIMINAR PRESENTACION ######################## --}}
@component('Comercio.Componentes.modal_eliminar_clasificadores')
    @slot('titulo')
        Eliminar Presentaciones
    @endslot
    @slot('descripcion')
        ¿Realmente desea eliminar la Presentación?
    @endslot
@endcomponent
{{-- #################### FINAL MODAL ELIMINAR MARCA ######################## --}}

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
                url:"{{route('presentaciones_articulos')}}",
            },
            "columns":[
                {data:'DT_RowIndex'},
                {data:'nombre'},
                {data:'abreviatura'},
                {data:'acciones'},
            ]
        });
    });

    //###############  FUNCIÓN MODAL PARA CREAR MARCAS   #############
    function modalCrear(){
        $("#nombreClasificador").val('');
        $("#abreviaturaClasificador").val('');
        $("#modalCrear").modal('show');
    }

    //Submit de la confirmación de crear
    $("#frmConfirmar").on("submit", function(e){
        e.preventDefault();
        envioCrear();
        $('#modalCrear').modal('hide');
    });

    // FUNCIÓN DE ENVIO INFO
    function envioCrear(){

        var formData = new FormData();
        formData.append('nombre_presentacion',$('#nombreClasificador').val())
        formData.append('abreviatura_presentacion',$('#abreviaturaClasificador').val())

        // ENVIO AJAX
        var routeCrear = "{{asset('comercio/inventario/clasificadores/presentaciones/crear')}}";
        var token = $("#_token").val();

        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: routeCrear,
            type: "POST",
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            if (res.respuesta == 0) {
                toastr["error"](res.mensaje,"Crear Presentación");
            } else {
                $('#modalCrear').modal('hide');
                $('#nombreClasificador').val('');
                toastr["success"](res.mensaje,"Crear Presentación");
                $("#tabla_listado").DataTable().ajax.reload();
            }
        })
        .fail(function(msg){
            $('#modalCrear').modal('hide');
            $('#nombreClasificador').val('');
            $.each(msg.responseJSON.errors, function(key, value){
                toastr["error"](value,"Error");
            });
        });
    }
    //############### FIN FUNCIÓN MODAL PARA CREAR PRESENTACIONES  #############


    //###############  FUNCIÓN MODAL PARA EDITAR PRESENTACIONES   #############
    function modalEditar(id_presentacion,nombre,abreviatura){
        console.log(id_presentacion,nombre,abreviatura);
        $("#nombreNuevoClasificador").val(nombre);
        $("#nuevaAbreviaturaClasificador").val(abreviatura);
        $("#id_clasificador").val(id_presentacion);

        $("#modalEditar").modal('show');
    }

    //Submit de la confirmación de modificar
    $("#frmConfirmarEditar").on("submit", function(e){
        e.preventDefault();
        envioModificar();
        $('#modalEditar').modal('hide');
    });

    // FUNCIÓN DE ENVIO INFO
    function envioModificar(){

        var formData = new FormData();
        formData.append('abreviatura_presentacion',$('#nuevaAbreviaturaClasificador').val())
        formData.append('nombre_presentacion',$('#nombreNuevoClasificador').val())
        formData.append('id_presentacion',$('#id_clasificador').val())

        // ENVIO AJAX
        var routeModificar = "{{asset('comercio/inventario/clasificadores/presentaciones/modificar')}}";
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
                toastr["error"](res.mensaje,"Modificar Presentaciones");
            } else {
                $('#modalEditar').modal('hide');
                $('#nombreNuevoClasificador').val('');
                toastr["success"](res.mensaje,"Modificar Presentaciones");
                $("#tabla_listado").DataTable().ajax.reload();
            }
        })
        .fail(function(msg){
            $('#modalEditar').modal('hide');
            $('#nombreNuevoClasificador').val('');
            $.each(msg.responseJSON.errors, function(key, value){
                toastr["error"](value,"Error");
            });
        });
    }
    //############### FIN FUNCIÓN MODAL PARA EDITAR PRESENTACIONES  #############

    //############### FUNCIÓN MODAL PARA ELIMINAR PRESENTACIONES  #############
    function modalEliminar(id_presentacion){
        $("#id_clasificador").val(id_presentacion);
        $("#modalEliminar").modal('show');
    }

    //Submit de la confirmación de modificar
    $("#frmConfirmarEliminar").on("submit", function(e){
        e.preventDefault();
        envioEliminar();
        $('#modalEliminar').modal('hide');
    });

    // FUNCIÓN DE ENVIO INFO
    function envioEliminar(){

        var formData = new FormData();
        formData.append('id_presentacion',$('#id_clasificador').val())

        // ENVIO AJAX
        var routeEliminar = "{{asset('comercio/inventario/clasificadores/presentaciones/eliminar')}}";
        var token = $("#_token").val();

        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: routeEliminar,
            type: "POST",
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            if (res.respuesta == 0) {
                toastr["error"](res.mensaje,"Eliminar Presentación");
            } else {
                $('#modalEliminar').modal('hide');
                toastr["success"](res.mensaje,"Eliminar Presentación");
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
    //############### FIN FUNCIÓN MODAL PARA ELIMINAR PRESENTACIONES  #############
</script>
@endsection
