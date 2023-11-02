@extends('Comercio.Panel')

@section('titulo', 'Administración')

@section('ubicacion')
<div class="shiftnav-content-wrap">
    <section class="content-header">
        <h1>
            ADMINISTRACIÓN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('panel') }}"><i class="fa fa-dashboard fa-fw"></i>Panel /</a></li>
            <li class="active">Administración</li>
        </ol>
    </section>
</div>
@endsection

@section('content')
<div class="row">
    <div onclick=location.href="{{ asset('comercio/datos')}}" class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-folder"></i>
            </div>
            <div class="count">&nbsp;</div>
            <h3>Datos</h3>
        </div>
    </div>

    <div onclick=location.href="{{ asset('comercio/parametros')}}" title="Parámetros generales" class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-cog"></i>
            </div>
            <div class="count">&nbsp;</div>
            <h3>Parametros</h3>
        </div>
    </div>
</div>
@endsection