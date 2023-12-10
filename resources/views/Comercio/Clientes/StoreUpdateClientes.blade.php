@extends('Comercio.Panel')

@section('titulo', ''.$type.' Clientes')

@section('ubicacion')
<div class="shiftnav-content-wrap">
    <section class="content-header">
        <h1>
            {{strtoupper($type)}} CLIENTES
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('panel') }}"><i class="fa fa-dashboard fa-fw"></i>Panel /</a></li>       
            <li><a href="{{ url('comercio/clientes') }}"><i class="fa fa-truck fa-fw"></i>Clientes /</a></li>
            <li class="active">&nbsp;{{$type}}</li>
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
                <h2>{{$type}} registro</h2>
                <div class="clearfix"></div>
            </div>
            <form id="FormData" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Tipo documento</label><span style="color: red">*</span>
                            <select name="tipo_documento" id="tipo_documento" required class="form-control select2">
                                <option value="">Seleccione...</option>
                                @foreach ($genericTypes->where('id_tipo',6) as $genericType)
                                    <option value="{{$genericType->id}}" @if ((isset($model)) && ($genericType->id == $model->tipo_documento)) selected @endif >{{$genericType->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_parte_relacionada">
                            <label class="col-form-label label-align">Parte relacionada</label>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="parte_relacionada" name="parte_relacionada" @if (isset($model)) checked @endif class="flat">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_documento">
                            <label class="col-form-label label-align">Documento<span style="color: red">*</span></label>
                            <input id="documento" name="documento" onkeyup="ValidateTypeDoc()" onchange="ValidateDoc();" @if (isset($model)) value="{{$model->documento}}" @endif required class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                            <span class="help-block" id="message"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_cod_auxiliar">
                            <label class="col-form-label label-align">Código auxiliar</label>
                            <input id="cod_auxiliar" name="cod_auxiliar" @if (isset($model)) value="{{$model->cod_auxiliar}}" @endif required class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Nombre<span style="color: red">*</span></label>
                            <div>
                                <input id="nombre" name="nombre" @if (isset($model)) value="{{$model->nombre}}" @endif  @if (!isset($model)) onkeyup="CopyValue();" @endif required class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_razon_social">
                            <label class="col-form-label label-align">Razon social<span style="color: red">*</span></label>
                            <input id="razon_social" name="razon_social" @if (isset($model)) value="{{$model->razon_social}}" @endif required class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_telefono1">
                            <label class="col-form-label label-align">Teléfono 1</label>
                            <input required id="telefono1" name="telefono1" @if (isset($model)) value="{{$model->telefono1}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_telefono2">
                            <label class="col-form-label label-align">Teléfono 2</label>
                            <input required id="telefono2" name="telefono2" @if (isset($model)) value="{{$model->telefono2}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Categoria</label><span style="color: red">*</span>
                            <select name="id_categoria" id="id_categoria" class="form-control select2" required>
                                <option value="">Seleccione</option>
                                @foreach ($genericTypes->where('id_tipo',7) as $genericType)
                                    <option value="{{$genericType->id}}" @if ((isset($model)) && ($genericType->id == $model->id_categoria)) selected @endif >{{$genericType->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Tipo de cliente </label><span style="color: red">*</span>
                            <select name="id_tipos" id="id_tipos" class="form-control select2" required>
                                <option value="">Seleccione</option>
                                @foreach ($genericTypes->where('id_tipo',8) as $genericType)
                                    <option value="{{$genericType->id}}" @if ((isset($model)) && ($genericType->id == $model->id_tipos)) selected @endif >{{$genericType->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_direccion">
                            <label class="col-form-label label-align">Dirección<span style="color: red">*</span></label>
                            <input id="direccion" name="direccion" @if (isset($model)) value="{{$model->direccion}}" @endif required class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Ubicación</label>
                            <select name="id_ubicacion" id="id_ubicacion" class="form-control select2" >
                                <option value="">Seleccione</option>
                                @foreach ($genericTypes->where('id_tipo',4) as $genericType)
                                    <option value="{{$genericType->id}}" @if ((isset($model)) && ($genericType->id == $model->id_ubicacion)) selected @endif >{{$genericType->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align Zone" title="Presione doble clic para administrar">Zona</label>
                            <select name="id_zona" id="id_zona" class="form-control select2" required>
                                <option value="">Seleccione</option>
                                @foreach ($zonas as $zona)
                                    <option value="{{$zona->id}}" @if ((isset($model)) && ($zona->id == $model->id_zona)) selected @endif >{{$zona->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align Place" title="Presione doble clic para administrar">Lugar</label>
                            <select name="id_lugar" id="id_lugar" class="form-control select2" >
                                <option value="">Seleccione</option>
                                @foreach ($lugares as $lugar)
                                    <option value="{{$lugar->id}}" @if ((isset($model)) && ($lugar->id == $model->id_lugar)) selected @endif >{{$lugar->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-form-label label-align">País<span class="required">*</span></label>
                            <select name="id_pais" id="id_pais" class="form-control select2" required onchange="seleccion_pais();">
                                <option value="" selected disabled>Seleccione...</option>
                                @foreach ($paises as $pais)
                                    @if (isset($model))
                                        <option value="{{$pais->id}}" {{$model->id_pais == $pais->id ? 'selected' : ''}}>{{$pais->nombre_pais}}</option>
                                    @else
                                        <option value="{{$pais->id}}">{{$pais->nombre_pais}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-form-label label-align">Provincia<span class="required">*</span></label>
                            @if (isset($model))
                                <select name="id_provincia" id="id_provincia" class="form-control select2" required onchange="seleccion_provincia();">
                            @else
                                <select name="id_provincia" id="id_provincia" class="form-control select2" required disabled onchange="seleccion_provincia();">
                            @endif
                                <option value="" selected disabled>Seleccione...</option>
                                @foreach ($provincias as $provincia)
                                    @if (isset($model))
                                        <option value="{{$provincia->id}}" {{$model->id_provincia == $provincia->id ? 'selected' : ''}} >{{$provincia->nombre_provincia}}</option>
                                    @else
                                        <option value="{{$provincia->id}}">{{$provincia->nombre_provincia}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-form-label label-align">Ciudad<span class="required">*</span></label>
                            <select name="id_ciudad" id="id_ciudad" class="form-control select2" required disabled>
                                @if (isset($model))
                                    @foreach ($ciudades as $ciudad)
                                        @if (isset($model))
                                            <option value="{{$ciudad->id}}" {{$model->id_ciudad == $ciudad->id ? 'selected' : ''}}>{{$ciudad->nombre_ciudad}}</option>
                                        @else
                                            <option value="{{$pais->id}}">{{$pais->nombre_ciudad}}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="" selected disabled>Seleccione...</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_representante">
                            <label class="col-form-label label-align">Representante</label>
                            <input id="representante" name="representante"  @if (isset($model)) value="{{$model->representante}}" @endif required class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Cuenta bancaria</label>
                            <select name="id_cuenta" id="id_cuenta" class="form-control select2">
                                <option value="">Seleccione</option>
                                {{-- @foreach ($cuentasBancarias as $cuentasBancaria)
                                    <option value="{{$cuentasBancaria->id}}" @if ((isset($model)) && ($cuentasBancaria->id == $model->id_cuenta)) selected @endif >{{$pais->nombre }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" id="grupo_puntos">
                            <label class="col-form-label label-align">Puntos</label>
                            <input id="puntos" name="puntos" @if (isset($model)) value="{{$model->puntos}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" id="grupo_deuda">
                            <label class="col-form-label label-align">Deuda</label>
                            <input class="form-control" id="deuda" name="deuda" @if (isset($model)) value="{{$model->deuda}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" id="grupo_afavor">
                            <label class="col-form-label label-align">A favor</label>
                            <input id="afavor" name="afavor" @if (isset($model)) value="{{$model->afavor}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_email1">
                            <label class="col-form-label label-align">Email 1</label>
                            <input type="email" id="email1" name="email1" @if (isset($model)) value="{{$model->email1}}" @endif class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_email2">
                            <label class="col-form-label label-align">Email 2</label>
                            <input type="email" id="email2" name="email2" @if (isset($model)) value="{{$model->email2}}" @endif class="form-control">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">Información de crédito aplicable</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_credito_max">
                            <label class="col-form-label label-align">Crédito maximo</label>
                            <input id="credito_max" name="credito_max" @if (isset($model)) value="{{$model->credito_max}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_max_plazo">
                            <label class="col-form-label label-align">Maximo plazo días</label>
                            <input class="form-control" id="max_plazo" name="max_plazo" @if (isset($model)) value="{{$model->max_plazo}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_descuento">
                            <label class="col-form-label label-align">% Descuento</label>
                            <input id="descuento" name="descuento" @if (isset($model)) value="{{$model->descuento}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_intereses_mora">
                            <label class="col-form-label label-align">% Intereses_mora</label>
                            <input id="intereses_mora" name="intereses_mora" @if (isset($model)) value="{{$model->intereses_mora}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Estado</label>
                            <select name="id_estado" id="id_estado" class="form-control select2">
                                <option value="">Seleccione</option>
                                @foreach ($genericTypes->where('id_tipo',9) as $genericType)
                                    <option value="{{$genericType->id}}" @if ((isset($model)) && ($genericType->id == $model->id_estado)) selected @endif >{{$genericType->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Asignar PVP</label>
                            <select name="id_pvp" id="id_pvp" class="form-control select2">
                                <option value="">Seleccione</option>
                                {{-- @foreach ($pvps as $pvp)
                                    <option value="{{$pvp->id}}" @if ((isset($model)) && ($pvp->id == $model->id_pvp)) selected @endif >{{$pais->nombre }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_observaciones">
                            <label class="col-form-label label-align">Observaciones</label>
                            <input id="observaciones" name="observaciones" @if (isset($model)) value="{{$model->observaciones}}" @endif class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_ref_vivienda">
                            <label class="col-form-label label-align">Ref vivienda</label>
                            <input id="ref_vivienda" name="ref_vivienda" @if (isset($model)) value="{{$model->ref_vivienda}}" @endif class="form-control">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">Usar Información adicional</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Sexo</label>
                            <select name="id_sexo" id="id_sexo" class="form-control select2">
                                <option value="">Seleccione</option>
                                @foreach ($genericTypes->where('id_tipo',10) as $genericType)
                                    <option value="{{$genericType->id}}" @if ((isset($model)) && ($genericType->id == $model->id_sexo)) selected @endif >{{$genericType->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_fecha_nacimiento">
                            <label class="col-form-label label-align">Fecha de Nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" @if (isset($model)) value="{{$model->fecha_nacimiento}}" @endif class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Estado Civil</label>
                            <select name="id_estado_civil" id="id_estado_civil" class="form-control select2">
                                <option value="">Seleccione</option>
                                @foreach ($genericTypes->where('id_tipo',11) as $genericType)
                                    <option value="{{$genericType->id}}" @if ((isset($model)) && ($genericType->id == $model->id_estado_civil)) selected @endif >{{$genericType->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_num_hijos">
                            <label class="col-form-label label-align">Número de hijos</label>
                            <input class="form-control" id="num_hijos" name="num_hijos" @if (isset($model)) value="{{$model->num_hijos}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_profesion">
                            <label class="col-form-label label-align">Profesión</label>
                            <input id="profesion" name="profesion" @if (isset($model)) value="{{$model->profesion}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_ingreso_mensual">
                            <label class="col-form-label label-align">Ingreso mensual</label>
                            <input id="ingreso_mensual" name="ingreso_mensual" @if (isset($model)) value="{{$model->ingreso_mensual}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_empresa_lab">
                            <label class="col-form-label label-align">Empresa lab.</label>
                            <input id="empresa_lab" name="empresa_lab" @if (isset($model)) value="{{$model->empresa_lab}}" @endif class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_referido_por">
                            <label class="col-form-label label-align">Referido por</label>
                            <input id="referido_por" name="referido_por" @if (isset($model)) value="{{$model->referido_por}}" @endif class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Vendedor asociado</label>
                            <select name="id_vendedor" id="id_vendedor" class="form-control select2">
                                <option value="">Seleccione</option>
                                {{-- @foreach ($vendedores as $vendedor)
                                    <option value="{{$vendedor->id}}" @if ((isset($model)) && ($vendedor->id == $model->id_vendedor)) selected @endif >{{$vendedor->nombre }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                </div>

                <div class="ln_solid">
                    <div class="x_content">
                        <button type='button' class="btn btn-success" onclick="envio();">GUARDAR</button>
                        <a href="{{asset('comercio/clientes')}}" class="btn btn-danger">REGRESAR</a>
                    </div>
                </div>

                <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" id="id" @if (isset($model)) value="{{$model->id}}" @endif>
                <input type="hidden" name="action" id="action" value="{{$type}}">
            </form>
        </div>
    </div>
</div>

{{-- Tabla compras --}}
@if (isset($model))
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Historial de compra de los ultimos 3 meses</h2>
                    <div class="clearfix"></div>
                </div>
                <hr>
                {{-- Tabla --}}
                <div class="x_content">
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                        <table id="listado" class="table table-striped table-bordered dataTable no-footer table-hover" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" aria-sort="ascending" style="width:20%;">FECHA</th>
                                <th class="sorting" style="width:15%;">DOCUMENTO</th>
                                <th class="sorting" style="width:15%;">NÚMERO</th>
                                <th class="sorting" style="width:15%;"><center>TOTAL</center></th>
                                <th class="sorting" style="width:15%;"><center>SALDO</center></th>
                                <th class="sorting" style="width:20%;"><center>VENCE</center></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>00/00/0000</td>
                                    <td>00</td>
                                    <td>00</td>
                                    <td>00</td>
                                    <td>00</td>
                                    <td>00</td>
                                </tr>
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
@endif

{{-- Inicio modal Zonas --}}
    <div id="ModalZonas" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Administración de zonas</h4>
                </div>
                <div class="modal-body">
                    <div class="clearfix"></div>
                    <input type="button" value="Crear Nuevo" id="Crear Nuevo" class="btn btn-success NewZone">
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
                                        <table id="listadoZonas" class="table table-striped table-bordered dataTable no-footer table-hover" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" aria-sort="ascending" style="width:5%;">N°</th>
                                                <th class="sorting_asc" aria-sort="ascending" style="width:35%;">ZONA</th>
                                                <th class="sorting" style="width:50%;">DESCRIPCIÓN</th>
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
                    <button type="button" class="btn btn-secondary CancelZone" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="ModalStoreUpdateZonas" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><span id="ZoneType"></span> registro</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label label-align">Zona</label>
                                <input id="ZoneName" name="ZoneName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label label-align">Descripción</label>
                                <textarea name="ZoneDescription" id="ZoneDescription" cols="52" rows="5"></textarea>
                            </div>
                        </div>
                        <input type="hidden" id="ZoneId" name="id_register">
                        <input type="hidden" id="ZoneAction" name="ActionModal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="button" value="Guardar" id="Guardar" class="btn btn-success StoreUpdateZonas">
                </div>
            </div>
        </div>
    </div>

    <div id="ModalDeleteZone" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Eliminación de registros</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>¿Esta seguro que desea eliminar el registro <b><span id="dataZoneModal" aria-hidden="true"></span></b> ?</p>
                    <input type="hidden" id="idZoneModal" name="idZoneModal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="button" value="Confirmar" id="Confirmar" class="btn btn-success DeleteZoneRegistration">
                </div>
            </div>
        </div>
    </div>
{{-- Fin modal Zonas --}}

{{-- Inicio modal Lugares --}}
    <div id="ModalLugares" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Administración de lugares</h4>
                </div>
                <div class="modal-body">
                    <div class="clearfix"></div>
                    <input type="button" value="Crear Nuevo" id="Crear Nuevo" class="btn btn-success NewPlace">
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
                                        <table id="listadoLugares" class="table table-striped table-bordered dataTable no-footer table-hover" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" aria-sort="ascending" style="width:5%;">N°</th>
                                                <th class="sorting_asc" aria-sort="ascending" style="width:30%;">LUGAR</th>
                                                <th class="sorting" style="width:30%;">DESCRIPCIÓN</th>
                                                <th class="sorting_asc" aria-sort="ascending" style="width:15%;">ZONA ASOCIADA</th>
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
                    <button type="button" class="btn btn-secondary CancelPlace" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="ModalStoreUpdateLugares" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><span id="PlaceType"></span> registro</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label label-align">Lugar</label>
                                <input id="PlaceName" name="PlaceName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label label-align">Descripción</label>
                                <textarea name="PlaceDescription" id="PlaceDescription" cols="52" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label label-align">Zona asociada</label>
                            </div>
                            <div class="form-group">
                                <select name="PlaceZones" id="PlaceZones" class="form-control select2"></select>
                            </div>
                        </div>
                        <input type="hidden" id="PlaceId" name="id_register">
                        <input type="hidden" id="PlaceAction" name="ActionModal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="button" value="Guardar" id="Guardar" class="btn btn-success StoreUpdateLugares">
                </div>
            </div>
        </div>
    </div>

    <div id="ModalDeletePlace" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Eliminación de registros</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>¿Esta seguro que desea eliminar el registro <b><span id="dataPlaceModal" aria-hidden="true"></span></b> ?</p>
                    <input type="hidden" id="idPlaceModal" name="idPlaceModal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="button" value="Confirmar" id="Confirmar" class="btn btn-success DeletePlaceRegistration">
                </div>
            </div>
        </div>
    </div>
{{-- Fin modal Lugares --}}

@endsection

@section('imports')
    <script src="{{asset('js/ap.js')}}"></script>
    <!-- DataTables -->
    <script src="{{ asset('gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- extension responsive -->
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

    // {{-- Acciones adicionales --}}
    <script>
        $(document).ready( function() {
            $('.select2').select2();
        });

        function CopyValue() {
            var nombre = $('#nombre').val();
            $('#razon_social').val(nombre);
        }

        function ValidateTypeDoc() {
            var TypeDoc = $('#tipo_documento option:selected').val();
            var documento = $('#documento').val();
            if (TypeDoc == 14) { // RUC
                if (documento.length > 13) {
                    toastr["error"]("Solo se permite un máximo de 13 caracteres en el documento","Error");
                    $('#documento').val('');
                }
            }
            if (TypeDoc == 13) { // Cedula
                if (documento.length > 10) {
                    toastr["error"]("Solo se permite un máximo de 10 caracteres en el documento","Error");
                    $('#documento').val('');
                }
            }
        }

        function ValidateDoc(){
            var document = $('#documento').val();
            var datos = $("#FormData").serialize();
            if(document != ""){
                var routeGet = "{{asset('comercio/clientes/consultar')}}" + "?" + datos;

                $.ajax({
                    url: routeGet,
                    type: 'GET',
                    dataType: 'json',
                }).done(function(res){
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        $("#message").html(res.mensaje);
                        if(res.state == "0"){
                            $("#grupo_documento").removeClass("has-success");
                            $("#grupo_documento").addClass("has-error");
                            $("#message").addClass("error");
                        }else{
                            $("#grupo_documento").removeClass("has-error");
                            $("#grupo_documento").addClass("has-success");
                            $("#message").addClass("success");
                        }
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                    }); 
                });
            }else{
                $("#message").html("");
                $("#grupo_documento").removeClass("has-success");
                $("#grupo_documento").removeClass("has-error");
            }
        }

        function seleccion_pais(){
            $('#id_provincia').prop('disabled', false);
        }
        function seleccion_provincia(){
            $('#id_ciudad').prop('disabled', false);
        }

        $("#id_provincia").change(function(event){
            url = "{{asset('empresas/ciudades/')}}"+"/"+event.target.value+"";
            $.get(url,function(response,state){
                // console.log(response);
                if(response.length > "0"){
                    $("#id_ciudad").prop("disabled",false);
                    $("#id_ciudad").empty();
                    for(i=0; i<response.length; i++){
                        $("#id_ciudad").append("<option value='"+response[i].id+"'>"+response[i].nombre_ciudad+"</option>");
                    }
                }else{
                    $("#id_ciudad").prop("disabled",true);
                    $("#id_ciudad").empty();
                    $("#id_ciudad").append("<option value='' selected disabled> Seleccione...</option>");
                }
            });
        });

        // {{-- Gestionar Zonas --}}
            // {{-- Ver listado resgistros --}}
            $('.Zone').dblclick(function() {
                $("#listadoZonas").dataTable().fnDestroy();
                $('#listadoZonas').DataTable({
                    "language":{url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                    "responsive": true,
                    "processing":true,
                    "serverSide": true,
                    "ajax":{
                        url:"{{route('GetZonas')}}",
                    },
                    "columns":[
                        {data: 'id'},
                        {data: 'nombre'},
                        {data: 'descripcion'},
                        {data: 'actions'}
                    ]
                });
                $("#ModalZonas").modal("show");
            });

            // {{-- Cargar creacion de registros --}}
            $('.NewZone').click(function() {
                $("#ZoneType").html('Crear');
                $("#ZoneName").val('');
                $("#ZoneDescription").val('');
                $("#ZoneId").val('');
                $("#ZoneAction").val('crear');
                $("#ModalStoreUpdateZonas").modal("show");
            });

            // {{-- Cargar edicion de registro --}}
            function EditZone(id) {
                var routeGet = "{{asset('comercio/GetZonas/unico')}}"+'/'+id;
                $.ajax({
                    url: routeGet,
                    type: 'GET',
                    dataType: 'json',
                }).done(function(res){
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        $("#ZoneType").html('Editar');
                        $("#ZoneName").val(res.data.nombre);
                        $("#ZoneDescription").val(res.data.descripcion);
                        $("#ZoneId").val(res.data.id);
                        $("#ZoneAction").val('editar');
                        $("#ModalStoreUpdateZonas").modal("show");
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalStoreUpdateZonas").modal('show');
                    }); 
                });
            }

            // {{-- GuardarEditar registro --}}
            $('#ModalStoreUpdateZonas .StoreUpdateZonas').click(function(){
                var routeSend = "{{asset('comercio/zonas/')}}";
                var token = $("#token").val();
                var formData = new FormData();
                formData.append("nombre", $("#ZoneName").val());
                formData.append("descripcion", $("#ZoneDescription").val());
                formData.append("id", $("#ZoneId").val());
                formData.append("action",$("#ZoneAction").val());

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
                        $("#ModalStoreUpdateZonas").modal("hide");
                        $("#listadoZonas").DataTable().ajax.reload();
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalStoreUpdateZonas").modal('show');
                    }); 
                });
            });

            // {{-- Eliminar registro --}}
            function DeleteZone(fila) {
                var id = $(this).attr("id");
                // {{-- Abrir modal --}}
                $("#idZoneModal").val($(fila).attr('id'));
                $("#dataZoneModal").html($(fila).attr('data'));
                $("#ModalDeleteZone").modal("show");

                // {{-- Eliminar registro --}}
                $('#ModalDeleteZone .DeleteZoneRegistration').click(function(){
                    if(id != ""){
                        var routeSend = "{{asset('comercio/zonas/')}}";
                        var token = $("#token").val();
                        var formData = new FormData();
                        formData.append("id", $("#idZoneModal").val());
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
                                $("#ModalDeleteZone").modal("hide");
                                $("#listadoZonas").DataTable().ajax.reload();
                            }
                        })
                        .fail(function(msg){
                            $.each(msg.responseJSON.errors, function(key, value){
                                toastr["error"](value,"Error");
                                $("#ModalDeleteZone").modal('show');
                            }); 
                        });
                    }
                });
            }

            // {{-- Regresar --}}
            $('#ModalZonas .CancelZone').click(function(){
                var routeGet = "{{asset('comercio/GetZonas/select')}}";
                $.ajax({
                    url: routeGet,
                    type: 'GET',
                    dataType: 'json',
                }).done(function(res){
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        $("#id_zona").empty();
                        $("#id_zona").append('<option value="">Seleccione</option>');
                        $.each(res, function(key, value){
                            $("#id_zona").append('<option value='+value.id+'>'+value.nombre+'</option>');
                        });
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalZonas").modal('show');
                    }); 
                });
            });
        // {{-- Fin Gestionar Zonas --}}
        
        // {{-- Gestionar Lugares --}}
            // {{-- Ver listado resgistros --}}
            $('.Place').dblclick(function() {
                $("#listadoLugares").dataTable().fnDestroy();
                $('#listadoLugares').DataTable({
                    "language":{url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                    "responsive": true,
                    "processing":true,
                    "serverSide": true,
                    "ajax":{
                        url:"{{route('GetLugares')}}",
                    },
                    "columns":[
                        {data: 'id'},
                        {data: 'nombre'},
                        {data: 'descripcion'},
                        {data: "zonas",render: function (data, type, row) {return(data === null) ?  '' : data.nombre ;}},
                        {data: 'actions'}
                    ]
                });
                $("#ModalLugares").modal("show");
            });

            // {{-- Cargar creacion de registros --}}
            $('.NewPlace').click(function() {
                $("#PlaceType").html('Crear');
                $("#PlaceName").val('');
                $("#PlaceDescription").val('');
                $("#PlaceId").val('');
                $("#PlaceAction").val('crear');

                // {{-- Llenar select zonas modal --}}
                var routeGet = "{{asset('comercio/GetZonas/select')}}";
                $.ajax({
                    url: routeGet,
                    type: 'GET',
                    dataType: 'json',
                }).done(function(res){
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        $("#PlaceZones").empty();
                        $("#PlaceZones").append('<option value="">Seleccione</option>');
                        $.each(res, function(key, value){
                            $("#PlaceZones").append('<option value='+value.id+'>'+value.nombre+'</option>');
                        });
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalLugares").modal('show');
                    }); 
                });

                $("#ModalStoreUpdateLugares").modal("show");
            });

            // {{-- Cargar edicion de registro --}}
            function EditPlace(id) {
                var routeGet = "{{asset('comercio/GetLugares/unico')}}"+'/'+id;
                $.ajax({
                    url: routeGet,
                    type: 'GET',
                    dataType: 'json',
                }).done(function(res){
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        $("#PlaceType").html('Editar');
                        $("#PlaceName").val(res.data.nombre);
                        $("#PlaceDescription").val(res.data.descripcion);
                        $("#PlaceId").val(res.data.id);
                        $("#PlaceAction").val('editar');

                        // {{-- Llenar select zonas modal --}}
                        var routeGet = "{{asset('comercio/GetZonas/select')}}";
                        $.ajax({
                            url: routeGet,
                            type: 'GET',
                            dataType: 'json',
                        }).done(function(resp){
                            if(resp.codigo == 0){
                                toastr["error"](resp.message,"Error");
                            }else{
                                $("#PlaceZones").empty();
                                $("#PlaceZones").append('<option value="">Seleccione</option>');
                                $.each(resp, function(key, value){
                                    if(value.id == res.data.id_zona){
                                        $("#PlaceZones").append('<option value='+value.id+' selected>'+value.nombre+'</option>');
                                    }else{
                                        $("#PlaceZones").append('<option value='+value.id+'>'+value.nombre+'</option>');
                                    }
                                });
                            }
                        })
                        .fail(function(msg){
                            $.each(msg.responseJSON.errors, function(key, value){
                                toastr["error"](value,"Error");
                                $("#ModalLugares").modal('show');
                            }); 
                        });

                        $("#ModalStoreUpdateLugares").modal("show");
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalStoreUpdateLugares").modal('show');
                    }); 
                });
            }

            // {{-- GuardarEditar registro --}}
            $('#ModalStoreUpdateLugares .StoreUpdateLugares').click(function(){
                var routeSend = "{{asset('comercio/lugares/')}}";
                var token = $("#token").val();
                var formData = new FormData();
                formData.append("nombre", $("#PlaceName").val());
                formData.append("descripcion", $("#PlaceDescription").val());
                formData.append("id_zona",$("#PlaceZones option:selected").val());
                formData.append("id", $("#PlaceId").val());
                formData.append("action",$("#PlaceAction").val());

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
                        $("#ModalStoreUpdateLugares").modal("hide");
                        $("#listadoLugares").DataTable().ajax.reload();
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalStoreUpdateLugares").modal('show');
                    }); 
                });
            });

            // {{-- Eliminar registro --}}
            function DeletePlace(fila) {
                var id = $(this).attr("id");
                // {{-- Abrir modal --}}
                $("#idPlaceModal").val($(fila).attr('id'));
                $("#dataPlaceModal").html($(fila).attr('data'));
                $("#ModalDeletePlace").modal("show");

                // {{-- Eliminar registro --}}
                $('#ModalDeletePlace .DeletePlaceRegistration').click(function(){
                    if(id != ""){
                        var routeSend = "{{asset('comercio/lugares/')}}";
                        var token = $("#token").val();
                        var formData = new FormData();
                        formData.append("id", $("#idPlaceModal").val());
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
                                $("#ModalDeletePlace").modal("hide");
                                $("#listadoLugares").DataTable().ajax.reload();
                            }
                        })
                        .fail(function(msg){
                            $.each(msg.responseJSON.errors, function(key, value){
                                toastr["error"](value,"Error");
                                $("#ModalDeletePlace").modal('show');
                            }); 
                        });
                    }
                });
            }

            // {{-- Regresar --}}
            $('#ModalLugares .CancelPlace').click(function(){
                var routeGet = "{{asset('comercio/GetLugares/select')}}";
                $.ajax({
                    url: routeGet,
                    type: 'GET',
                    dataType: 'json',
                }).done(function(res){
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        $("#id_lugar").empty();
                        $("#id_lugar").append('<option value="">Seleccione</option>');
                        $.each(res, function(key, value){
                            $("#id_lugar").append('<option value='+value.id+'>'+value.nombre+'</option>');
                        });
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalLugares").modal('show');
                    }); 
                });
            });
        // {{-- Fin Gestionar Lugares --}}
    </script>

    // {{-- GUARDAR DATOS --}}
    <script>
        function envio(){
            var formData = new FormData();
            var formData = new FormData(document.getElementById("FormData"));
            var routeSend = "{{asset('comercio/clientes/')}}";
            var token = $("#token").val();
            var action = $("#action").val();

            $.ajax({
                url:routeSend,
                headers: {'X-CSRF-TOKEN':token},
                type: 'POST',
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(res){
                if (res.codigo == 0) {
                    toastr["error"](res.message,"Error");
                } else {
                    toastr["success"](res.message,"Éxito");
                    if (action == 'Crear') {
                        document.getElementById("FormData").reset();
                        $('#FormData').trigger("reset");
                    }
                }
            })
            .fail(function(msg){
                $.each(msg.responseJSON.errors, function(key, value){
                    toastr["error"](value,"Error");
                });
            });

        }
    </script>
@endsection