@extends('Comercio.Panel')

@section('titulo', 'Clasificadores')

@section('ubicacion')
<div class="shiftnav-content-wrap">
    <section class="content-header">
        <h1>
            Clasificadores
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('panel') }}"><i class="fa fa-dashboard fa-fw"></i>Panel /</a></li>
            <li><a href="{{ url('comercio/inventario') }}"><i class="fa fa-shopping-basket fa-fw"></i>Inventario /</a></li>
            <li class="active">Clasificadores</li>
        </ol>
    </section>
</div>
@endsection

@section('content')
<div class="row">
    <div onclick=location.href="{{ asset('comercio/inventario/clasificadores/categorias')}}" title="Categorías de artículos" class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-sitemap"></i>
            </div>
            <div class="count">&nbsp;</div>
            <h3>Categorías</h3>
        </div>
    </div>
    <div onclick=location.href="{{ asset('comercio/inventario/clasificadores/tipos')}}" title="Tipos de artículos" class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-check-square-o"></i>
            </div>
            <div class="count">&nbsp;</div>
            <h3>Tipos</h3>
        </div>
    </div>
    <div onclick=location.href="{{ asset('comercio/inventario/clasificadores/marcas')}}" title="Marcas de artículos" class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-tags"></i>
            </div>
            <div class="count">&nbsp;</div>
            <h3>Marcas</h3>
        </div>
    </div>
    <div onclick=location.href="{{ asset('comercio/inventario/clasificadores/presentaciones')}}" title="Presentación de artículos" class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-houzz"></i>
            </div>
            <div class="count">&nbsp;</div>
            <h3>Presentación</h3>
        </div>
    </div>
</div>
@endsection
