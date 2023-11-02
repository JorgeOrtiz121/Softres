@extends('Comercio.Panel')

@section('titulo', ''.$type.' Proveedor')

@section('ubicacion')
<div class="shiftnav-content-wrap">
    <section class="content-header">
        <h1>
            {{strtoupper($type)}} PROVEEDORES
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('panel') }}"><i class="fa fa-dashboard fa-fw"></i>Panel /</a></li>       
            <li><a href="{{ url('comercio/proveedores') }}"><i class="fa fa-truck fa-fw"></i>Proveedores /</a></li>
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
                                <option value="" >Seleccione...</option>
                                @foreach ($genericTypes->where('id_tipo',1) as $genericType)
                                    <option value="{{$genericType->id}}" @if ((isset($model)) && ($genericType->id == $model->tipo_documento)) selected @endif >{{$genericType->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_documento">
                            <label class="col-form-label label-align">Documento<span style="color: red">*</span></label>
                            <input id="documento" name="documento" @if (isset($model)) value="{{$model->documento}}" @endif required class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
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
                        <div class="form-group" id="grupo_representante">
                            <label class="col-form-label label-align">Representante</label>
                            <input id="representante" name="representante"  @if (isset($model)) value="{{$model->representante}}" @endif required class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Categoria</label><span style="color: red">*</span>
                            <select name="id_categoria" id="id_categoria" class="form-control select2" required>
                                <option value="" >Seleccione</option>
                                @foreach ($genericTypes->where('id_tipo',2) as $genericType)
                                    <option value="{{$genericType->id}}" @if ((isset($model)) && ($genericType->id == $model->id_categoria)) selected @endif >{{$genericType->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Tipo </label><span style="color: red">*</span>
                            <select name="id_tipos" id="id_tipos" class="form-control select2" required>
                                <option value="" >Seleccione</option>
                                @foreach ($genericTypes->where('id_tipo',3) as $genericType)
                                    <option value="{{$genericType->id}}" @if ((isset($model)) && ($genericType->id == $model->id_tipos)) selected @endif >{{$genericType->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_artesano">
                            <label class="col-form-label label-align">Artesano IVA 0%</label>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="artesano" name="artesano" @if (isset($model)) checked @endif class="flat">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Ubicación</label>
                            <select name="id_ubicacion" id="id_ubicacion" class="form-control select2" >
                                <option value="" >Seleccione</option>
                                @foreach ($genericTypes->where('id_tipo',4) as $genericType)
                                    <option value="{{$genericType->id}}" @if ((isset($model)) && ($genericType->id == $model->id_ubicacion)) selected @endif >{{$genericType->nombre}}</option>
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
                        <div class="form-group" id="grupo_telefono">
                            <label class="col-form-label label-align">Teléfono</label>
                            <input required id="telefono" name="telefono" @if (isset($model)) value="{{$model->telefono}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_web">
                            <label class="col-form-label label-align">Página web</label>
                            <input  id="web" name="web" @if (isset($model)) value="{{$model->web}}" @endif required class="form-control">
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

                    <div class="col-md-4">
                        <div class="form-group" id="grupo_cupo_credito">
                            <label class="col-form-label label-align">Cupo de crédito</label>
                            <input id="cupo_credito" name="cupo_credito" @if (isset($model)) value="{{$model->cupo_credito}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" id="grupo_cxp">
                            <label class="col-form-label label-align">Cuentas por pagar</label>
                            <input class="form-control" id="cxp" name="cxp" @if (isset($model)) value="{{$model->cxp}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" id="grupo_notas">
                            <label class="col-form-label label-align">N/C</label>
                            <input id="notas" name="notas" @if (isset($model)) value="{{$model->notas}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_observaciones">
                            <label class="col-form-label label-align">Observaciones</label>
                            <input id="observaciones" name="observaciones" @if (isset($model)) value="{{$model->observaciones}}" @endif class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Subproveedor de</label>
                            <select name="id_subproveedor" id="id_subproveedor" class="form-control select2" >
                                <option value="" >Seleccione</option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{$proveedor->id}}" @if ((isset($model)) && ($proveedor->id == $model->id_subproveedor)) selected @endif >{{$pais->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">Códigos y porcentajes de retenciones fijas que se realizan a este proveedor</label>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">Retención IR</label>
                            <select name="id_retencion" id="id_retencion" class="form-control select2" >
                                <option value="" >Seleccione</option>
                                @foreach ($genericTypes->where('id_tipo',5) as $genericType)
                                    <option value="{{$genericType->id}}" @if ((isset($model)) && ($genericType->id == $model->id_retencion)) selected @endif >{{$genericType->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_retencion_iva_bienes">
                            <label class="col-form-label label-align">Retencion iva bienes</label>
                            <input id="retencion_iva_bienes" name="retencion_iva_bienes" @if (isset($model)) value="{{$model->retencion_iva_bienes}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="grupo_retencion_iva_servicios">
                            <label class="col-form-label label-align">Retencion iva servicios</label>
                            <input id="retencion_iva_servicios" name="retencion_iva_servicios" @if (isset($model)) value="{{$model->retencion_iva_servicios}}" @endif class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 46">
                        </div>
                    </div>
                </div>

                <div class="ln_solid">
                    <div class="x_content">
                        <button type='button' class="btn btn-success" onclick="envio();">GUARDAR</button>
                        <a href="{{asset('comercio/proveedores')}}" class="btn btn-danger">REGRESAR</a>
                    </div>
                </div>

                <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" id="id" @if (isset($model)) value="{{$model->id}}" @endif>
                <input type="hidden" name="action" id="action" value="{{$type}}">
            </form>
        </div>
    </div>
</div>

@if (isset($model))
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Historial de compra de los ultimos 6 meses</h2>
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
                                <th class="sorting_asc" aria-sort="ascending" style="width: 15%;">FECHA</th>
                                <th class="sorting" style="width: 30%;">NÚMERO FACTURA</th>
                                <th class="sorting" style="width: 25%;"><center>TOTAL</center></th>
                                <th class="sorting" style="width: 25%;"><center>SALDO</center></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>00/00/0000</td>
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
    </script>

    // {{-- GUARDAR DATOS --}}
    <script>
        function envio(){
            var formData = new FormData();
            var formData = new FormData(document.getElementById("FormData"));
            var action = $("#action").val();

            var routeSend = "{{asset('comercio/proveedores/')}}";
            var token = $("#token").val();
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