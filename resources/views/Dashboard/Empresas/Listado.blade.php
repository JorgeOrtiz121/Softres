@extends('Dashboard.dashboard')

@section('titulo', 'Empresas')

@section('ubicacion')
<div class="shiftnav-content-wrap">
    <section class="content-header">
        <h1>
            LISTADO EMPRESAS
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i>Dashboard /</a></li>
            <li class="active">Listado emprsas</li>
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
            <a href="{{asset('empresas/crear')}}"  title="Crear nuevo registro" class="btn .btn-lg btn-primary">CREAR NUEVO</a>
            <a href="{{asset('dashboard')}}" title="Volver al menú inicio" class="btn .btn-lg btn-danger" >
                REGRESAR
            </a>
        </div>
        <div class="x_title">
            <h2> Listado de Empresas </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="listado" class="table table-striped table-bordered dataTable no-footer table-hover" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" aria-sort="ascending" style="width: 6%;">CÉDULA/RUC</th>
                                    <th class="sorting" style="width: 30%;">RAZÓN SOCIAL</th>
                                    <th class="sorting" style="width: 8%;"><center>FECHA REGISTRO</center></th>
                                    <th class="sorting" style="width: 5%;"><center>DÍAS RESTANTES</center></th>
                                    <th class="sorting" style="width: 5%;">ESTADO</th>
                                    <th class="sorting" style="width: 3%;"><center>ENTORNO</center></th>
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
@endsection

@section('imports')
<!-- DataTables -->
<script src="{{ asset('gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- extension responsive -->
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script>
   $(document).ready(function () {
        $('#listado').DataTable({
            "language":{url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
            "processing":true,
            "serverSide":true,
            "ajax":{
                url:"{{route('GetEmpresas')}}",
            },
            "columns":[
                {data:'identificacion'},
                {data:'razon_social'},
                {data:'created_at'},
                {data:'restantes'},
                {data:'state'},
                {data:'entorno'},
                {data:'acciones'},
            ]
        });
    });

    // Administrar empresas
    function submitform(id){
        var form = 'form_administrar'+id;
        document.getElementById(form).submit();
    }
</script>


@endsection
