@extends('Comercio.Panel')

@section('titulo', 'Artículos')

@section('ubicacion')
<div class="shiftnav-content-wrap">
    <section class="content-header">
        <h1>
            Administrar Artículos
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('panel') }}"><i class="fa fa-dashboard fa-fw"></i>Panel /</a></li>
            <li><a href="{{ url('comercio/inventario') }}"><i class="fa fa-shopping-basket fa-fw"></i>Inventario /</a></li>
            <li><a href="{{ url('comercio/inventario/articulos') }}"><i class="fa fa-shopping-basket fa-fw"></i>Artículos /</a></li>
            <li class="active">Crear Artículos</li>
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
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    @if (isset($articulo))
                        <h2>Modificar artículo</h2>
                    @else
                        <h2>Registrar nuevo artículo</h2>
                    @endif
                    <div class="clearfix"></div>
                </div>
                <form id="Crear" method="POST">
                    <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
                    <div class="x_content">
                    <div class="col-md-4">
                        <div class="form-group" id="grupo_codigo">
                            <label class="col-form-label label-align">Código<span style="color: red">*</span></label>
                            <a title="Obtener codigo personalizado" class="CustomCode"><i class="fa  fa-cloud-download"></i></a>
                            @if (isset($articulo))
                                <input class="form-control" id="codigo" name="codigo" value="{{$articulo->codigo}}" required>
                            @else
                                <span class="help-block" style="" id="message"></span>
                                <input class="form-control" id="codigo" name="codigo" onchange="validar_codigo();" required>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-form-label label-align">Nombre<span style="color: red">*</span></label>
                            <div>
                                @if (isset($articulo))
                                    <input class="form-control" id="nombre" name="nombre" value="{{$articulo->nombre}}" required>
                                @else
                                    <input class="form-control" id="nombre" name="nombre" onkeyup="set_nombre_factura();" required>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-form-label label-align">Nombre en factura<span style="color: red">*</span></label>
                            <div >
                                @if (isset($articulo))
                                    <input class="form-control" id="nombre_factura" name="nombre_factura" value="{{$articulo->nombre_factura}}" required>
                                @else
                                    <input class="form-control" id="nombre_factura" name="nombre_factura" required>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group AdminIva" title="Presione doble clic para administrar">
                            <label class="col-form-label label-align">Porcentaje IVA<span style="color: red">*</span></label>
                            <select name="id_iva" id="id_iva" class="form-control select2" onchange="obtener_iva(this)" ondblclick="" required>
                                <option value="" >Seleccione...</option>
                                @foreach ($TipoIva as $porcentaje)
                                    <option @if (isset($articulo)) {{$articulo->tipo_iva->id == $porcentaje->id ? 'selected' : ''}}  @endif value="{{$porcentaje->id}}" porcentaje="{{$porcentaje->porcentaje}}" >{{$porcentaje->porcentaje}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="col-form-label label-align">Gravado ICE<span style="color: red">*</span></label>
                            <select name="grava_ice" id="grava_ice" class="form-control select2" onchange="gravado_ice()" required>
                                @if (isset($articulo))
                                    <option value="0" {{$articulo->grava_ice == 0 ? 'selected' : ''}} >No</option>
                                    <option value="1" {{$articulo->grava_ice == 1 ? 'selected' : ''}} >Porcentaje</option>
                                    <option value="2" {{$articulo->grava_ice == 2 ? 'selected' : ''}}>Valor</option>
                                @else
                                    <option value="0" selected >No</option>
                                    <option value="1" >Porcentaje</option>
                                    <option value="2" >Valor</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="col-form-label label-align">Factor ICE</label>
                            <div >
                                @if (isset($articulo))
                                    <input type="text" value="{{$articulo->factor_ice}}" class="form-control num" id="factor_ice" name="factor_ice" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46" max="100">
                                @else
                                    <input type="text" class="form-control num" id="factor_ice" name="factor_ice" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46" max="100" disabled>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="col-form-label label-align">Stock actual<span style="color: red">*</span></label>
                            <div >
                                @if (isset($articulo))
                                    <input class="form-control" id="stock_actual" name="stock_actual" value="{{$articulo->stock_actual}}" required>
                                @else
                                    <input class="form-control" id="stock_actual" name="stock_actual" required>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-form-label label-align">Venta fraccionada</label>
                            <select name="venta_fracionada" id="venta_fracionada" class="form-control select2" >
                                @if (isset($articulo))
                                    <option value="0" {{$articulo == '0' ? 'selected' : ''}}>No</option>
                                    <option value="1" {{$articulo == '1' ? 'selected' : ''}}>Sí</option>
                                @else
                                    <option value="0" selected >No</option>
                                    <option value="1" >Sí</option>
                
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-form-label label-align">Precio de compra sin IVA<span style="color: red">*</span></label>
                            @if (isset($articulo))
                                <input class="form-control num" value="{{$articulo->precio_compra_sin_iva}}" id="precio_compra_sin_iva" name="precio_compra_sin_iva" type="" onKeyUp="calcular_con_iva();" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46 ">
                            @else
                                <input class="form-control num" id="precio_compra_sin_iva" name="precio_compra_sin_iva" type="" onKeyUp="calcular_con_iva();" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46 ">
                            @endif
                            {{-- <input class="form-control" id="fax" name="fax" type="number" class='number' name="number" data-validate-minmax="10,100" > --}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-form-label label-align">Precio de compra con IVA<span style="color: red">*</span></label>
                            @if (isset($articulo))
                                <input class="form-control num" value="{{$articulo->precio_compra_con_iva}}" id="precio_compra_con_iva" name="precio_compra_con_iva" onKeyUp="calcular_sin_iva();" type="" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                            @else
                                <input class="form-control num" id="precio_compra_con_iva" name="precio_compra_con_iva" onKeyUp="calcular_sin_iva();" type="" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>
                                @if (isset($articulo))
                                    <input type="checkbox" value="" {{$articulo->venta_restringida == '1' ? 'checked' : ''}} id="venta_restringida" name="venta_restringida"> Venta restringida
                                @else
                                    <input type="checkbox" value="" id="venta_restringida" name="venta_restringida"> Venta restringida
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="vehiculo">
                                @if (isset($articulo))
                                    <input type="checkbox" {{$articulo->vehiculo == '1' ? 'checked' : ''}} value="" id="vehiculo" name="vehiculo"> Vehículo
                                @else
                                    <input type="checkbox" value="" id="vehiculo" name="vehiculo"> Vehículo
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs bar_tabs">
                                            <li class="nav-item"><a class="nav-link active" href="#tab_precios" data-toggle="tab">Precios de venta</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#tab_clasificadores" data-toggle="tab">Clasificadores</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#tab_adicional" data-toggle="tab">Información ad.</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#tab_ubicacion" data-toggle="tab">Ubicación</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#tab_caducidad" data-toggle="tab">Caducidad</a></li>
                                        </ul>
                                            <div class="tab-content">
                                                {{-- Tab Precio de venta --}}
                                                <div class="tab-pane active" id="tab_precios">
                                                    <strong>Escriba los precios de venta del artículo:</strong>
                                                    <div>
                                                        <button type="button" class="btn btn-primary" onclick="agregar_precio()" id="agregar_nuevo">AGREGAR NUEVO</button>
                                                    </div>
                                                    <hr>
                                                    <table class="table table-striped table-bordered" id="tablaPrecios">
                                                        <thead>
                                                            <tr>
                                                                <th width="3%"></th>
                                                                <th width="20%">Incluido IVA</th>
                                                                <th width="20%">Utilidad (%)</th>
                                                                <th width="20%">Ganancia</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (isset($articulo))
                                                                @foreach ( $precios_venta as $precio )
                                                                    <tr>
                                                                        <td>
                                                                            <a><i class="fa fa-times-circle text-red delete"></i></a>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" id="precio_iva" name="precio_iva" value="{{$precio->precio_con_iva}}" ondblclick="" class="form-control num calc" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46" style="text-align: right"/>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" id="utilidad" name="utilidad" value="{{$precio->utilidad}}" ondblclick="" class="form-control num util" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46" style="text-align: right"/>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" id="ganacia" name="ganacia" value="{{$precio->ganancia}}" ondblclick="" class="form-control num" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46" style="text-align: right" readonly/>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td>
                                                                        <a><i class="fa fa-times-circle text-red delete"></i></a>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" id="precio_iva" name="precio_iva" ondblclick="" class="form-control num calc" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46" style="text-align: right"/>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" id="utilidad" name="utilidad" ondblclick="" class="form-control num util" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46" style="text-align: right"/>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" id="ganacia" name="ganacia" ondblclick="" class="form-control num" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46" style="text-align: right" readonly/>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                
                
                                                </div>
                                                {{-- Tab clasificadores --}}
                                                <div class="tab-pane" id="tab_clasificadores">
                                                    {{-- <strong>Clasificadores:</strong> --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label label-align">Categoría</label>
                                                            <select name="id_categoria" id="id_categoria" class="form-control select2">
                                                                @if (isset($articulo))
                                                                    <option value="" {{$articulo->id_categoria ?? 'selected'}} disabled>Seleccione...</option>
                                                                    @foreach ($categorias as $categoria)
                                                                        <option value="{{$categoria->id}}" {{$articulo->id_categoria == $categoria->id ? 'selected' : ''}}>{{$categoria->nombre}}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="" selected disabled>Seleccione...</option>
                                                                    @foreach ($categorias as $categoria)
                                                                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label label-align">Tipo</label>
                                                            <select name="id_tipo" id="id_tipo" class="form-control select2">
                                                                @if (isset($articulo))
                                                                    <option value="" {{$articulo->id_tipo ?? 'selected'}} disabled>Seleccione...</option>
                                                                    @foreach ($tipos as $tipo)
                                                                        <option value="{{$tipo->id}}" {{$articulo->id_tipo == $tipo->id ? 'selected' : ''}}>{{$tipo->nombre}}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="" selected disabled>Seleccione...</option>
                                                                    @foreach ($tipos as $tipo)
                                                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label label-align">Marca</label>
                                                            <select name="id_marca" id="id_marca" class="form-control select2">
                                                                @if (isset($articulo))
                                                                    <option value="" {{$articulo->id_marca ?? 'selected'}} disabled>Seleccione...</option>
                                                                    @foreach ($marcas as $marca)
                                                                        <option value="{{$marca->id}}" {{$articulo->id_marca == $marca->id ? 'selected' : ''}}>{{$marca->nombre}}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="" selected disabled>Seleccione...</option>
                                                                    @foreach ($marcas as $marca)
                                                                        <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label label-align">Presentación</label>
                                                            <select name="id_presentacion" id="id_presentacion" class="form-control select2">
                                                                @if (isset($articulo))
                                                                    <option value="" {{$articulo->id_presentacion ?? 'selected'}} disabled>Seleccione...</option>
                                                                    @foreach ($presentaciones as $presentacion)
                                                                        <option value="{{$presentacion->id}}" {{$articulo->id_presentacion == $presentacion->id ? 'selected' : ''}}>{{$presentacion->nombre}} - {{$presentacion->abreviatura}}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="" selected disabled>Seleccione...</option>
                                                                    @foreach ($presentaciones as $presentacion)
                                                                        <option value="{{$presentacion->id}}">{{$presentacion->nombre}} - {{$presentacion->abreviatura}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label label-align">Deducible IR</label>
                                                            <select name="id_deducible_ir" id="id_deducible_ir" class="form-control select2">
                                                                @if (isset($articulo))
                                                                    <option value="" {{$articulo->id_deducible_ir ?? 'selected'}} disabled>Seleccione...</option>
                                                                    @foreach ($deducible_ir as $deducible)
                                                                        <option value="{{$deducible->id}}" {{$articulo->id_deducible_ir == $deducible->id ? 'selected' : ''}}>{{$deducible->nombre}}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="" selected disabled>Seleccione...</option>
                                                                    @foreach ($deducible_ir as $deducible)
                                                                        <option value="{{$deducible->id}}" {{$deducible->id == 1 ? 'selected' : ''}} >{{$deducible->nombre}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label label-align">Fabricación</label>
                                                            <select name="id_fabricacion" id="id_fabricacion" class="form-control select2">
                                                                @if (isset($articulo))
                                                                    <option value="" {{$articulo->id_fabricacion ?? 'selected'}} disabled>Seleccione...</option>
                                                                    @foreach ($fabricacion as $item)
                                                                        <option value="{{$item->id}}" {{$articulo->id_fabricacion == $item->id ? 'selected' : ''}}>{{$item->nombre}}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="" selected disabled>Seleccione...</option>
                                                                    @foreach ($fabricacion as $item)
                                                                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                                                                    @endforeach
                
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label label-align">País origen</label>
                                                            <div >
                                                                @if (isset($articulo))
                                                                    <input class="form-control" id="pais_origen" name="pais_origen" value="{{$articulo->pais_origen}}">
                                                                @else
                                                                    <input class="form-control" id="pais_origen"name="pais_origen">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                
                                                {{-- Tab info adicional --}}
                                                <div class="tab-pane" id="tab_adicional">
                                                    {{-- <strong>asdsdfg:</strong> --}}
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label label-align">Stock máximo</label>
                                                                <div>
                                                                    @if (isset($articulo))
                                                                        <input class="form-control" id="stock_max" name="stock_max" value="{{$articulo->stock_max}}">
                                                                    @else
                                                                        <input class="form-control" id="stock_max" name="stock_max">
                
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label label-align">Stock mínimo</label>
                                                                <div>
                                                                    @if (isset($articulo))
                                                                        <input class="form-control" id="stock_min" name="stock_min" value="{{$articulo->stock_min}}">
                                                                    @else
                                                                        <input class="form-control" id="stock_min" name="stock_min">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label label-align">Descripción</label>
                                                                <div>
                                                                    @if (isset($articulo))
                                                                        <textarea class="form-control" id="descripcion" name="descripcion">{{$articulo->descripcion}}</textarea>
                                                                    @else
                                                                    <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label label-align">Observaciones</label>
                                                                <div>
                                                                    @if (isset($articulo))
                                                                        <textarea class="form-control" id="observaciones" name="observaciones">{{$articulo->observaciones}}</textarea>
                                                                    @else
                                                                        <textarea class="form-control" id="observaciones" name="observaciones"></textarea>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Tab Caducidad --}}
                                                <div class="tab-pane" id="tab_caducidad">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="col-form-label label-align">Caducable</label>
                                                                <select name="caduca" id="caduca" class="form-control select2" onchange="caducidad(this.value);">
                                                                    @if (isset($articulo))
                                                                        <option value="0" {{$articulo->caduca == 0 ? 'selected' : ''}} >No</option>
                                                                        <option value="1" {{$articulo->caduca == 1 ? 'selected' : ''}}>Sí</option>
                                                                    @else
                                                                        <option value="0" selected >No</option>
                                                                        <option value="1" >Sí</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="col-form-label label-align" for="">Días notificación caducidad</label>
                                                                <div>
                                                                    @if (isset($caducidades) && $caducidades->count() != 0)
                                                                        <input type="number" maxlength="2" min="1" max="30" step="1" class="form-control" id="dias_notificacion" name="dias_notificacion" value="{{$caducidades[0]->dias_notificacion}}">
                                                                    @else
                                                                        <input type="number" maxlength="2" min="1" max="30" step="1" class="form-control" id="dias_notificacion" name="dias_notificacion" disabled>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div><br><br>
                                                            <button type="button" class="btn btn-primary" onclick="agregar_caducidad();" id="agregar_caducidad_articulo" disabled>AGREGAR</button>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <table class="table table-striped table-bordered" id="tablaCaducidad">
                                                        <thead>
                                                            <tr>
                                                                <th width="3%"></th>
                                                                <th width="20%">Cantidad</th>
                                                                <th width="20%">Fecha de caducidad</th>
                                                                <th width="20%">Lote N°</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (isset($caducidades))
                                                                @foreach ( $caducidades as $caducidad )
                                                                    <tr>
                                                                        <td>
                                                                            <a><i class="fa fa-times-circle text-red delete"></i></a>
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" step="1" id="cantidad" name="cantidad" value="{{$caducidad->cantidad}}" ondblclick="" class=""  style="text-align: right" />
                                                                        </td>
                                                                        <td>
                                                                            <input type="date" id="fecha_caducidad" name="fecha_caducidad" value="{{$caducidad->fecha_caducidad}}" ondblclick="" class=""  style="text-align: right" />
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" id="lote" name="lote" value="{{$caducidad->lote}}" ondblclick="" class=""  style="text-align: right" />
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td>
                                                                        <a><i class="fa fa-times-circle text-red delete"></i></a>
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" step="1" id="cantidad" name="cantidad" ondblclick="" class=""  style="text-align: right" disabled/>
                                                                    </td>
                                                                    <td>
                                                                        <input type="date" id="fecha_caducidad" name="fecha_caducidad" ondblclick="" class=""  style="text-align: right" disabled/>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" id="lote" name="lote" ondblclick="" class=""  style="text-align: right" disabled/>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                
                                                </div>
                                                {{-- Tab Ubicación --}}
                                                <div class="tab-pane" id="tab_ubicacion">
                                                    <strong>Describa la ubicación del Artículo.</strong>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="col-form-label label-align" for="">Estante</label>
                                                                <div>
                                                                    @if (isset($articulo) && $articulo->ubicacion != null)
                                                                        <input class="form-control" id="estante" name="estante" value="{{$articulo->ubicacion->estante != null ? $articulo->ubicacion->estante : ''}}">
                                                                    @else
                                                                        <input class="form-control" id="estante" name="estante">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-form-label label-align" for="">Lado</label>
                                                                <div>
                                                                    @if (isset($articulo) && $articulo->ubicacion != null)
                                                                        <input class="form-control" id="lado" name="lado" value="{{$articulo->ubicacion->lado != null ? $articulo->ubicacion->lado : ''}}">
                                                                    @else
                                                                        <input class="form-control" id="lado" name="lado">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="col-form-label label-align" for="">Fila</label>
                                                                <div>
                                                                    @if (isset($articulo) && $articulo->ubicacion != null)
                                                                        <input class="form-control" id="fila" name="fila" value="{{$articulo->ubicacion->fila != null ? $articulo->ubicacion->fila : ''}}">
                                                                    @else
                                                                        <input class="form-control" id="fila" name="fila">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-form-label label-align" for="">Columna</label>
                                                                <div>
                                                                    @if (isset($articulo) && $articulo->ubicacion != null)
                                                                        <input class="form-control" id="columna" name="columna" value="{{$articulo->ubicacion->columna != null ? $articulo->ubicacion->columna : ''}}">
                                                                    @else
                                                                        <input class="form-control" id="columna" name="columna">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label label-align" for="">Adicional</label>
                                                                <div>
                                                                    @if (isset($articulo) && $articulo->ubicacion != null)
                                                                        <input class="form-control" id="adicional" name="adicional" value="{{$articulo->ubicacion->adicional != null ? $articulo->ubicacion->adicional : ''}}">
                                                                    @else
                                                                        <input class="form-control" id="adicional" name="adicional">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                
                                    </div>
                                </div>
                            </div>
                        </div>
                
                    </div>
                    <div class="x_content">
                        <div class="ln_solid">
                            <div class="form-group"><br>
                                <button type='button' class="btn btn-success" onclick="envio();">GUARDAR</button>
                                <a href="{{asset('comercio/inventario/articulos')}}" class="btn btn-danger">REGRESAR</a>
                                <input type="hidden" name="num" id="num" value="1">
                                <input type="hidden" name="num2" id="num2" value="1">
                                <input type="hidden" name="iva" id="iva" value="">
                                @if (isset($modificacion))
                                    <input type="hidden" name="modificacion" id="modificacion" value="{{$modificacion}}">
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div><br>
        </div>
    </div>
</div>
</div>

{{-- Inicio modal IVA --}}
    <div id="ModalIva" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Administración de IVA</h4>
                </div>
                <div class="modal-body">
                    <div class="clearfix"></div>
                    <input type="button" value="Crear Nuevo" id="Crear Nuevo" class="btn btn-success NewIva">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Listado de registros guardados</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <hr>
                                {{-- Tabla --}}
                                <div class="x_content">
                                    <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-box table-responsive">
                                        <table id="listadoIVA" class="table table-striped table-bordered dataTable no-footer table-hover" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" aria-sort="ascending" style="width:5%;">N°</th>
                                                <th class="sorting_asc" aria-sort="ascending" style="width:35%;">PORCENTAJE</th>
                                                <th class="sorting" style="width:10%;">ACCIONES</th>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary CancelIva" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="ModalStoreUpdateIva" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><span id="IvaType"></span> registro</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label label-align">Porcentaje</label>
                                <input type="number" id="IvaPorcent" name="IvaPorcent" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" id="IvaId" name="id_register">
                        <input type="hidden" id="IvaAction" name="ActionModal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="button" value="Guardar" id="Guardar" class="btn btn-success StoreUpdateIVA">
                </div>
            </div>
        </div>
    </div>

    <div id="ModalDeleteIva" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Eliminación de registros</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>¿Esta seguro que desea eliminar el registro <b><span id="dataIvaModal" aria-hidden="true"></span></b> ?</p>
                    <input type="hidden" id="idIvaModal" name="idIvaModal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="button" value="Confirmar" id="Confirmar" class="btn btn-success DeleteIvaRegistration">
                </div>
            </div>
        </div>
    </div>
{{-- Fin modal IVA --}}
@endsection

@section('imports')
    <script src="{{asset('js/ap.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script src="{{asset('AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

    {{-- Agregar Precios en venta del producto --}}
    <script>
        function agregar_precio() {
            var num = $('#num').val();
            var fila =  '<tr>'+
                            '<td><a><i class="fa fa-times-circle text-red delete"></i></a></td>'+
                            '<td><input type="text" id="precio_iva'+num+'" name="precio_iva'+num+'" ondblclick="" class="form-control num calc" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46" style="text-align: right"/></td>'+
                            '<td><input type="text" id="utilidad'+num+'" name="utilidad'+num+'" ondblclick="" class="form-control num util" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46" style="text-align: right"/></td>'+
                            '<td><input type="text" id="ganacia'+num+'" name="ganacia'+num+'" ondblclick="" class="form-control num " onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46" style="text-align: right" readonly/></td>'+
                        '</tr>';
            $('#tablaPrecios tbody').append(fila);
            num = parseInt(num)+1;
            $('#num').val(num);

            // Actualizar campos de los precios del artículo
            $('.calc').keyup(function(){
            calcular_precios_articulo();
            });

            $('.util').keyup(function(){
            calcular_precios_utilidad();
            });
        }
        $(document).on('click','.delete', function(event){
             var tr = this;
             $(tr).closest('tr').remove();
        });

        // Formato de los números
        formato_numeros();

        function obtener_iva(iva){
            var porcentaje = $('option:selected', iva).attr('porcentaje');
            // console.log(porcentaje);
        }
    </script>
    {{-- Control para digitar el Factor de ICE --}}
    <script>
        function gravado_ice() {
            var value = $('#grava_ice').val();
            if (value == 0) {
                $("#factor_ice").prop('disabled', true);
                $("#factor_ice").val('');
            } else if(value == 1) {
                // document.getElementById('factor_ice').type = 'number';
                $("#factor_ice").prop('disabled', false);
                $("#factor_ice").val('');
            } else {
                // document.getElementById('factor_ice').type = 'text';
                $("#factor_ice").prop('disabled', false);
                $("#factor_ice").val('');
            }
            // $("#factor_ice").setAttribute('type', 'number');

        }
    </script>

    {{-- Valores en la tabla de precios de venta --}}
    <script>
        $('.calc').keyup(function(){
            calcular_precios_articulo();
        });

        function calcular_precios_articulo() {
            $('#tablaPrecios tbody tr').each(function(){
                var iva = $("#id_iva option:selected").attr('porcentaje');
                var precio_compra_sin_iva = $("#precio_compra_sin_iva").val();
                var precio_compra_con_iva = $("#precio_compra_con_iva").val();
                precio_compra_sin_iva = precio_compra_sin_iva.replace(/,/g,'');
                precio_compra_con_iva = precio_compra_con_iva.replace(/,/g,'');
                var precio_venta_con_iva = ($(this.children[1].children).val());
                precio_venta_con_iva = precio_venta_con_iva.replace(/,/g,'');
                var utilidad = precio_venta_con_iva - precio_compra_con_iva;
                var porcentaje_utilidad = (utilidad * 100) / precio_compra_con_iva;
                var ganancia = parseFloat((precio_compra_sin_iva * (porcentaje_utilidad / 100)) + precio_compra_sin_iva);
                ganancia = ganancia.toFixed(2);

                $(this.children[2].children).val(porcentaje_utilidad);
                $(this.children[3].children).val(ganancia);
                formato_numeros();
            })
        }

        $('.util').keyup(function () {
            calcular_precios_utilidad();
        })
        function calcular_precios_utilidad() {
            $('#tablaPrecios tbody tr').each(function(){
                var iva = $("#id_iva option:selected").attr('porcentaje');
                var precio_compra_sin_iva = $("#precio_compra_sin_iva").val();
                var precio_compra_con_iva = $("#precio_compra_con_iva").val();
                precio_compra_sin_iva = precio_compra_sin_iva.replace(/,/g,'');
                precio_compra_con_iva = precio_compra_con_iva.replace(/,/g,'');
                var porcentaje_utilidad = ($(this.children[2].children).val());
                var utilidad = (parseFloat(porcentaje_utilidad) * parseFloat(precio_compra_con_iva)) / 100;
                var precio_venta_con_iva = utilidad + parseFloat(precio_compra_con_iva);
                var ganancia = parseFloat((precio_compra_sin_iva * (porcentaje_utilidad / 100)) + precio_compra_sin_iva);
                ganancia = ganancia.toFixed(2);
                precio_venta_con_iva = precio_venta_con_iva.toFixed(2);

                $(this.children[1].children).val(precio_venta_con_iva);
                $(this.children[3].children).val(ganancia);
                formato_numeros();
            })
        }

        function formato_numeros() {
            // Formato de los números
            $('.num').each(function(){
                n = $(this).val()
                n = n.replace(/,/g,'');
                while (true) {
                    var n2 = n.replace(/(\d)(\d{3})($|,|\.)/g, '$1,$2$3')
                    if (n == n2)
                    {
                        break
                    }
                    n = n2
                }
                $(this).val(n)
            })
        }

    </script>

    <script>
        function caducidad(opcion) {
            if (opcion == 1) {
                $("#dias_notificacion").prop('disabled', false);
                $("#cantidad").prop('disabled', false);
                $("#fecha_caducidad").prop('disabled', false);
                $("#lote").prop('disabled', false);
                $("#agregar_caducidad_articulo").prop('disabled', false);
            }else{
                $("#dias_notificacion").prop('disabled', true);
                $("#cantidad").prop('disabled', true);
                $("#fecha_caducidad").prop('disabled', true);
                $("#lote").prop('disabled', true);
                $("#agregar_caducidad_articulo").prop('disabled', true);
            }
        }
    </script>

    {{-- Calcular valores de precios de compra --}}
    <script>
        function calcular_sin_iva() {
            var valor_con_iva = $("#precio_compra_con_iva").val();
            valor_con_iva = valor_con_iva.replace(/,/g,'');
            // console.log(valor_con_iva);
            var iva = $("#id_iva option:selected").attr('porcentaje');
            iva = ($.isNumeric(iva)) ? iva : 0;
            var valor_sin_iva = parseFloat(valor_con_iva / (1 + (iva / 100)));
            valor_sin_iva = valor_sin_iva.toFixed(2);
            valor_sin_iva = valor_sin_iva.toLocaleString('en');
            $("#precio_compra_sin_iva").val((valor_sin_iva));
            formato_numeros();

        }

        function calcular_con_iva() {
            var valor_sin_iva = $("#precio_compra_sin_iva").val();
            valor_sin_iva = valor_sin_iva.replace(/,/g,'');
            var iva = $("#id_iva option:selected").attr('porcentaje');
            iva = ($.isNumeric(iva)) ? iva : 0;
            var valor_con_iva = parseFloat(valor_sin_iva * (1 + (iva / 100)));
            valor_con_iva = valor_con_iva.toFixed(2);
            valor_con_iva = valor_con_iva.toLocaleString('en');
            // console.log(valor_con_iva);
            $("#precio_compra_con_iva").val((valor_con_iva));
            formato_numeros();

        }
    </script>

    <script>
        // Obtener datos de la tabla precios
        function datosTablaPrecios(){
            var arreglo_mayor = new Array();
            var lineas = new Array();

            $('#tablaPrecios tbody tr').each(function(){
                lineas.push({otros: $(this)});
            });
            for(var i=0; i < lineas.length; i++){
                if( lineas[i].otros[0].children[1] ){
                    arreglo_mayor.push({
                        indice:                 i+1,
                        precio_venta_con_iva:   $(lineas[i].otros[0].children[1].children).val(),
                        utilidad:               $(lineas[i].otros[0].children[2].children).val(),
                        ganancia:               $(lineas[i].otros[0].children[3].children).val(),
                    })
                }

            }
            return arreglo_mayor;
        }

        // Obtener datos de la tabla caducidad
        function datosTablaCaducidad(){
            // var caducable = $('option:selected', iva).attr('porcentaje');
            var caducable = $("#caduca option:selected").attr('value');
            if (caducable == 1) { //validamos que esté seleccionado SI
                var arreglo_mayor_caducidad = new Array();
                var lineas = new Array();

                $('#tablaCaducidad tbody tr').each(function(){
                    lineas.push({otros: $(this)});
                });
                for(var i=0; i < lineas.length; i++){
                    if( lineas[i].otros[0].children[1] ){
                        arreglo_mayor_caducidad.push({
                            indice:              i+1,
                            cantidad:            $(lineas[i].otros[0].children[1].children).val(),
                            fecha_caducidad:     $(lineas[i].otros[0].children[2].children).val(),
                            lote:                $(lineas[i].otros[0].children[3].children).val(),
                        })
                    }

                }
                return arreglo_mayor_caducidad;
            }else{ // si está seleccionado NO, así tenga datos la tabla se manda null
                return null;
            }
        }

    </script>
    <script>
        function set_nombre_factura() {
            nombre = $('#nombre').val();
            $('#nombre_factura').val(nombre);
        }
    </script>

    <script>
        function agregar_caducidad(){
            var num2 = $('#num2').val();
            var fila = '<tr>'+
                            '<td><a><i class="fa fa-times-circle text-red delete"></i></a></td>'+
                            '<td><input type="number" step="1" id="cantidad'+num2+'" name="cantidad'+num2+'" ondblclick="" class=""  style="text-align: right"/></td>'+
                            '<td><input type="date" id="fecha_caducidad'+num2+'" name="fecha_caducidad'+num2+'" ondblclick="" class=""  style="text-align: right"/></td>'+
                            '<td><input type="text" id="lote'+num2+'" name="lote'+num2+'" ondblclick="" class=""  style="text-align: right"/></td>'+
                        '</tr>';
            $('#tablaCaducidad tbody').append(fila);
            num2 = parseInt(num2)+1;
            $('#num2').val(num2);
        }
    </script>

    <script>
        function validar_codigo(){
            var codigo = $('#codigo').val();
            /*se valida si el campo cod si esta vacio o no para el manejo de estilos y el mensaje de confirmación de tercero*/
            if(codigo != ""){
                $.ajax({
                    url:'validar_codigo/'+codigo,

                    type:"GET",
                    success: function(response){
                        /*se muestra el mensaje de validación del codigo*/
                        $("#message").html(response.mensaje);

                        /*si el estado de la respuesta es 0 entonces el codigo ya existe y se manejan estilos de input y mensaje*/
                        if(response.state == "0"){
                            $("#grupo_codigo").removeClass("has-success");
                            $("#grupo_codigo").addClass("has-error");
                            style = 'color: red'
                            $("#message").attr("style",style);
                        }else{
                            $("#grupo_codigo").removeClass("has-error");
                            $("#grupo_codigo").addClass("has-success");
                            style = 'color: green'
                            $("#message").attr("style",style);
                        }
                    }
                });
            }else{
                $("#message").html("");
                $("#grupo_codigo").removeClass("has-success");
                $("#grupo_codigo").removeClass("has-error");
            }
        }

    </script>

    // {{-- GUARDAR REGISTRO --}}
    <script>
        function envio(){
            var arreglo_mayor = datosTablaPrecios();
            var arreglo_mayor_caducidad = datosTablaCaducidad();
            var formData = new FormData();
            var formData = new FormData(document.getElementById("Crear"));
            formData.append("tabla_precios", JSON.stringify(arreglo_mayor));
            formData.append("tabla_caducidad", JSON.stringify(arreglo_mayor_caducidad));

            var routeEnvio = "{{asset('comercio/inventario/articulos/guardar')}}";
            var token = $("#token").val();
            $.ajax({
                url:routeEnvio,
                headers: {'X-CSRF-TOKEN':token},
                type: 'POST',
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(res){
                if (res.respuesta == 0) {
                    toastr["error"](res.mensaje,"¡Error!");
                } else {
                    toastr["success"](res.mensaje,"¡Exito!");
                    setTimeout( function() { window.location="{{asset('comercio/inventario/articulos')}}"; }, 2000 );
                }
            })
            .fail(function(msg){
                $.each(msg.responseJSON.errors, function(key, value){
                    toastr["error"](value,"Error");
                });
            });
        }
    </script>

    // {{-- ADMINISTRAR IVA --}}
    <script>
        // {{-- Ver listado resgistros --}}
        $('.AdminIva').dblclick(function() {
            $("#listadoIVA").dataTable().fnDestroy();
            $('#listadoIVA').DataTable({
                "language":{url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                "responsive": true,
                "processing":true,
                "serverSide": true,
                "ajax":{
                    url:"{{route('GetIva')}}",
                },
                "columns":[
                    {data: 'id'},
                    {data: 'porcentaje'},
                    {data: 'actions'}
                ]
            });
            $("#ModalIva").modal("show");
        });

        // {{-- Cargar creacion de registros --}}
        $('.NewIva').click(function() {
            $("#IvaType").html('Crear');
            $("#IvaPorcent").val('');
            $("#IvaId").val('');
            $("#IvaAction").val('crear');
            $("#ModalStoreUpdateIva").modal("show");
        });

        // {{-- Cargar edicion de registro --}}
        function EditIva(id) {
            var routeGet = "{{asset('comercio/GetIva/unico')}}"+'/'+id;
            $.ajax({
                url: routeGet,
                type: 'GET',
                dataType: 'json',
            }).done(function(res){
                if(res.codigo == 0){
                    toastr["error"](res.message,"Error");
                }else{
                    $("#IvaType").html('Editar');
                    $("#IvaPorcent").val(res.data.porcentaje);
                    $("#IvaId").val(res.data.id);
                    $("#IvaAction").val('editar');
                    $("#ModalStoreUpdateIva").modal("show");
                }
            })
            .fail(function(msg){
                $.each(msg.responseJSON.errors, function(key, value){
                    toastr["error"](value,"Error");
                    $("#ModalStoreUpdateIva").modal('show');
                }); 
            });
        }

        // {{-- GuardarEditar registro --}}
        $('#ModalStoreUpdateIva .StoreUpdateIVA').click(function(){
            var routeSend = "{{asset('comercio/iva/')}}";
            var token = $("#token").val();
            var formData = new FormData();
            formData.append("porcentaje", $("#IvaPorcent").val());
            formData.append("id", $("#IvaId").val());
            formData.append("action",$("#IvaAction").val());

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
                    $("#ModalStoreUpdateIva").modal("hide");
                    $("#listadoIVA").DataTable().ajax.reload();
                }
            })
            .fail(function(msg){
                $.each(msg.responseJSON.errors, function(key, value){
                    toastr["error"](value,"Error");
                    $("#ModalStoreUpdateIva").modal('show');
                }); 
            });
        });

        // {{-- Eliminar registro --}}
        function DeleteIva(fila) {
            var id = $(this).attr("id");
            // {{-- Abrir modal --}}
            $("#idIvaModal").val($(fila).attr('id'));
            $("#dataIvaModal").html($(fila).attr('data'));
            $("#ModalDeleteIva").modal("show");

            // {{-- Eliminar registro --}}
            $('#ModalDeleteIva .DeleteIvaRegistration').click(function(){
                if(id != ""){
                    var routeSend = "{{asset('comercio/iva/')}}";
                    var token = $("#token").val();
                    var formData = new FormData();
                    formData.append("id", $("#idIvaModal").val());
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
                            $("#ModalDeleteIva").modal("hide");
                            $("#listadoIVA").DataTable().ajax.reload();
                        }
                    })
                    .fail(function(msg){
                        $.each(msg.responseJSON.errors, function(key, value){
                            toastr["error"](value,"Error");
                            $("#ModalDeleteIva").modal('show');
                        }); 
                    });
                }
            });
        }

        // {{-- Regresar --}}
        $('#ModalIva .CancelIva').click(function(){
            var routeGet = "{{asset('comercio/GetIva/select')}}";
            $.ajax({
                url: routeGet,
                type: 'GET',
                dataType: 'json',
            }).done(function(res){
                if(res.codigo == 0){
                    toastr["error"](res.message,"Error");
                }else{
                    $("#id_iva").empty();
                    $("#id_iva").append('<option value="">Seleccione</option>');
                    $.each(res, function(key, value){
                        $("#id_iva").append('<option value='+value.id+'>'+value.porcentaje+'</option>');
                    });
                }
            })
            .fail(function(msg){
                $.each(msg.responseJSON.errors, function(key, value){
                    toastr["error"](value,"Error");
                    $("#ModalIva").modal('show');
                }); 
            });
        });
    </script>

    // {{-- ADMINISTRAR IVA --}}
    <script>
        // {{-- Ver listado resgistros --}}
        $('.CustomCode').click(function() {
            var routeGet = "{{route('GetCustomCode')}}";
            $.ajax({
                url: routeGet,
                type: 'GET',
                dataType: 'json',
            }).done(function(res){
                if(res.codigo == 0){
                    toastr["error"](res.message,"Error");
                }else{
                    $("#codigo").val(res);
                }
            })
            .fail(function(msg){
                $.each(msg.responseJSON.errors, function(key, value){
                    toastr["error"](value,"Error");
                }); 
            });
        });       
    </script>
@endsection
