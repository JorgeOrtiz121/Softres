@extends('Comercio.Panel')

@section('titulo', 'Panel compras')

@section('ubicacion')
<div class="shiftnav-content-wrap">
    <section class="content-header">
        <h1>
            PANEL COMPRAS
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('panel')}}"><i class="fa fa-dashboard fa-fw"></i>Panel /</a></li>
            <li class="active">Panel compras</li>
        </ol>
    </section>
</div>
@endsection

@section('content')
<div class="row">
    <div onclick=location.href="{{route('RegistrarCompra')}}" title="Registrar compras" class="animated flipInY col-md-3">
        <div class="tile-stats">
            <div class="icon">
                <i class="fa fa-folder"></i>
            </div>
            <div class="count">&nbsp;</div>
            <h3>Registrar compras</h3>
        </div>
    </div>

    <div onclick=location.href="#" title="Anulación / devolución de compra" class="animated flipInY col-md-3">
        <div class="tile-stats">
            <div class="icon">
                <i class="fa fa-folder"></i>
            </div>
            <div class="count">&nbsp;</div>
            <h3>Anulación / devolución de compra</h3>
        </div>
    </div>
</div>
@endsection