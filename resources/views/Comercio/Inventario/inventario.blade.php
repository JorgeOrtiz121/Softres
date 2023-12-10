@extends('Comercio.Panel')

@section('titulo', 'Inventario')

@section('ubicacion')
<div class="shiftnav-content-wrap">
    <section class="content-header">
        <h1>
            INVENTARIO
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('panel') }}"><i class="fa fa-dashboard fa-fw"></i>Panel /</a></li>
            <li class="active">Inventario</li>
        </ol>
    </section>
</div>
@endsection

@section('content')
<div class="row">
    <div onclick=location.href="{{ asset('comercio/inventario/articulos')}}" class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-shopping-basket"></i>
            </div>
            <div class="count">&nbsp;</div>
            <h3>Artículos</h3>
        </div>
    </div>
    <div onclick=location.href="{{ asset('comercio/inventario/clasificadores')}}" title="Clasificadores para los artículos" class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-check-square-o"></i>
            </div>
            <div class="count">&nbsp;</div>
            <h3>Clasificadores</h3>
        </div>
    </div>
</div>
@endsection
