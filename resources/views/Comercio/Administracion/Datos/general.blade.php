@extends('Comercio.Panel')

@section('titulo', 'Datos')

@section('ubicacion')
<div class="shiftnav-content-wrap">
    <section class="content-header">
        <h1>
            DATOS
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('panel') }}"><i class="fa fa-dashboard fa-fw"></i>Panel /</a></li>
            <li><a href="{{ url('comercio/administracion') }}"><i class="fa fa-cogs fa-fw"></i>Administracion /</a></li>
            <li class="active">Datos</li>
        </ol>
    </section>
</div>
@endsection

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Datos de la empresa</h2>
                    <div class="clearfix"></div>
                </div>
                    <form id="Crear" method="POST">
                        <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Tipo de negocio<span class="required">*</span></label>
                                <select class="form-control" id="tipo_negocio" name="tipo_negocio">
                                    <option>Seleccione...</option>
                                    @foreach ($TiposNegocios as $item)
                                        @if ($item->id == $empresa->tipo_negocio)
                                            <option selected value="{{$item->id}}">{{$item->nombre}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->nombre}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Nombre de la empresa<span class="required">*</span></label>
                                <input class="form-control" id="empresa" name="empresa" value="{{$empresa->empresa}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Razón social<span class="required">*</span></label>
                                <div>
                                    <input class="form-control" id="razon_social" name="razon_social" value="{{$empresa->razon_social}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Cédula o RUC<span class="required">*</span></label>
                                <div >
                                    <input class="form-control" id="identificacion" name="identificacion" value="{{$empresa->identificacion}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Respresentante<span class="required">*</span></label>
                                <div >
                                    <input class="form-control" id="representante" name="representante" value="{{$empresa->representante->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">ID representante legal<span class="required">*</span></label>
                                <div >
                                    <input class="form-control" id="doc_representante" name="doc_representante" value="{{$empresa->representante->user}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Teléfono <span class="required">*</span></label>
                                <input class="form-control" id="telefono" name="telefono" type="number" class='number' data-validate-minmax="10,100" value="{{$empresa->telefono}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Fax <span class="required">*</span></label>
                                <input class="form-control" id="fax" name="fax" type="number" class='number'data-validate-minmax="10,100" value="{{$empresa->fax}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Email<span class="required">*</span></label>
                                <input class="form-control" id="email" name="email" class='email' type="email" value="{{$empresa->email}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label label-align">Dirección<span class="required">*</span></label>
                                <div >
                                    <input class="form-control" id="direccion" name="direccion" value="{{$empresa->direccion}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label label-align">País<span class="required">*</span></label>
                                <select name="pais" id="pais" class="form-control select2" required onchange="seleccion_pais();">
                                    <option value="" selected disabled>Seleccione...</option>
                                    @foreach ($paises as $pais)
                                        <option  @if ($pais->id == $empresa->pais_id) selected @endif  value="{{$pais->id}}">{{$pais->nombre_pais}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label label-align">Provincia<span class="required">*</span></label>
                                <select name="provincia" id="provincia" class="form-control select2" required onchange="seleccion_provincia();">
                                    <option value="" selected disabled>Seleccione...</option>
                                    @foreach ($provincias as $provincia)
                                        <option @if ($provincia->id == $empresa->provincia_id) selected @endif value="{{$provincia->id}}">{{$provincia->nombre_provincia}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label label-align">Ciudad<span class="required">*</span></label>
                                <select name="ciudad" id="ciudad" class="form-control select2" required>
                                    <option value="" selected disabled>Seleccione...</option>
                                    @foreach ($ciudades as $ciudad)
                                        <option @if ($ciudad->id == $empresa->ciudad_id) selected @endif value="{{$ciudad->id}}">{{$ciudad->nombre_ciudad}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Resolución contibuyente especial<span class="required">*</span></label>
                                <input class="form-control" id="resolucion" name="resolucion" value="{{$empresa->resolucion}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Fecha vencimiento<span class="required">*</span></label>
                                <input class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" type="date" value="{{$empresa->fecha_vencimiento}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">RUC Contador<span class="required">*</span></label>
                                <input class="form-control" id="ruc_contador" name="ruc_contador" value="{{$empresa->ruc_contador}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Generar operaciones en ambiente de<span class="required">*</span></label>
                                <select class="form-control" id="ambiente" name="ambiente">
                                    <option>Seleccione...</option>
                                    @if ($empresa->ambiente == 1)
                                        <option value="0">Pruebas</option>
                                        <option selected value="1">Producción</option>
                                    @else
                                        <option selected value="0">Pruebas</option>
                                        <option value="1">Producción</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="TipoRegimen">Tipo régimen:</label>
                                <select name="TipoRegimen" id="TipoRegimen" class="form-control select2">
                                    <option value="">Seleccione...</option>
                                    @foreach ($TipoRegimen as $regimen)
                                        @if ($regimen->id == $empresa->tipo_regimen_id)
                                            <option selected value="{{$regimen->id}}" >{{$regimen->nombre}}</option>
                                        @else
                                            <option value="{{$regimen->id}}" >{{$regimen->nombre}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="x_content">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" value="" id="artesano" name="artesano" @if($empresa->artesano == 1) checked @endif> Artesano calificado
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" id="contabilidad" name="contabilidad" @if($empresa->contabilidad == 1) checked @endif> Obligado a llevar contabilidad
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" id="reteiva" name="reteiva" @if($empresa->reteiva == 1) checked @endif> Agente retención IVA
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" id="reterenta" name="reterenta" @if($empresa->reterenta == 1) checked @endif> Agente retención renta
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="x_content">
                            <div class="ln_solid">
                                <div class="form-group"><br>
                                    <button type='submit' id="save"  style="display:none;"  class="btn btn-success">GUARDAR</button>
                                    <a href="{{asset('comercio/administracion')}}" class="btn btn-danger">REGRESAR</a>
                                    <label style="color: grey" for="editar">
                                        <input type="checkbox" name="editar" id="editar" title="Editar datos de la empresa"> Seleccione si desea editar los datos
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><br>
            </div>
        </div>
    </div>
</div>
@endsection

@section('imports')
{{-- CARGUES INICIALES --}}
<script>
    $(document).ready( function() {
       descativarCampos();
    });

    // Habilitar o desabilitar Form
    $("#editar").change(function(){
        if(this.checked){
            document.getElementById("save").style.display = "";
            var form = document.getElementById("Crear");
            var elements = form.elements;
            for (var i = 0, len = elements.length; i < len; ++i) {
                elements[i].readOnly = false;
            }
            document.getElementById("identificacion").disabled = true;
            document.getElementById("representante").disabled = true;
            document.getElementById("doc_representante").disabled = true;
            document.getElementById("tipo_negocio").disabled = false;
            document.getElementById("pais").disabled = false;
            document.getElementById("provincia").disabled = false;
            document.getElementById("ciudad").disabled = false;
            document.getElementById("ruc_contador").disabled = false;
            document.getElementById("ambiente").disabled = false;
            document.getElementById("artesano").disabled = false;
            document.getElementById("contabilidad").disabled = false;
            document.getElementById("reteiva").disabled = false;
            document.getElementById("reterenta").disabled = false;
            document.getElementById("TipoRegimen").disabled = false;

        }else{
            descativarCampos();
        }
    });
</script>

{{-- GUARDADO --}}
<script>
    $("#Crear").on("submit", function(e){
        e.preventDefault();
        envio();
    });

    // FUNCIÓN DE ENVIO INFO
    function envio(){
        // loading();

        var formData = new FormData(document.getElementById("Crear"));

        // ENVIO AJAX
        var routeEnvio = "{{asset('comercio_empresa_editar')}}";
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
            // loading();
            if(res.codigo == 0){
                toastr["error"](res.mensaje, "¡Error!");
            }else{
                toastr["success"](res.mensaje,"Registrado");
                descativarCampos();
                document.getElementById("editar").checked = false;
            }
        }).fail(function(msg){
            // loading();
            $.each(msg.responseJSON.errors, function(key, value){
                toastr["error"](value,"Error");
            });
        });
    }
</script>

{{-- DESACTIVAR CAMPOS --}}
<script>
    function descativarCampos(){
        document.getElementById("save").style.display = "none";
        var form = document.getElementById("Crear");
        var elements = form.elements;
        for (var i = 0, len = elements.length; i < len; ++i) {
            elements[i].readOnly = true;
        }
        document.getElementById("identificacion").disabled = true;
        document.getElementById("representante").disabled = true;
        document.getElementById("doc_representante").disabled = true;
        document.getElementById("tipo_negocio").setAttribute("disabled","disabled");
        document.getElementById("ambiente").setAttribute("disabled","disabled");
        document.getElementById("pais").setAttribute("disabled","disabled");
        document.getElementById("provincia").setAttribute("disabled","disabled");
        document.getElementById("ciudad").setAttribute("disabled","disabled");
        document.getElementById("ruc_contador").setAttribute("disabled","disabled");
        document.getElementById("artesano").disabled = true;
        document.getElementById("contabilidad").disabled = true;
        document.getElementById("reteiva").disabled = true;
        document.getElementById("reterenta").disabled = true;
        document.getElementById("TipoRegimen").setAttribute("disabled","disabled");
    }
</script>

// {{-- CARGAR PROVINCIAS Y CIUDADES  --}}
<script>
    function seleccion_pais(){
        $('#provincia').prop('disabled', false);
    }
    function seleccion_provincia(){
        $('#ciudad').prop('disabled', false);
    }

    $("#provincia").change(function(event){
            url = "{{asset('empresas/ciudades/')}}"+"/"+event.target.value+"";
            $.get(url,function(response,state){
                // console.log(response);
                if(response.length > "0"){
                    $("#ciudad").prop("disabled",false);
                    $("#ciudad").empty();
                    for(i=0; i<response.length; i++){
                        $("#ciudad").append("<option value='"+response[i].id+"'>"+response[i].nombre_ciudad+"</option>");
                    }
                }else{
                    $("#ciudad").prop("disabled",true);
                    $("#ciudad").empty();
                    $("#ciudad").append("<option value='' selected disabled> Seleccione...</option>");
                }
            });
        });

</script>
@endsection
