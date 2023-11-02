@extends('Dashboard.dashboard')

@section('titulo', 'Crear Empresas')

@section('ubicacion')
<div class="shiftnav-content-wrap">
    <section class="content-header">
        @if (isset($empresa) && $empresa!=null)
            <h1>
                EDITAR EMPRESAS
            </h1>
        @else
            <h1>
                CREAR EMPRESAS
            </h1>
        @endif

        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i>Dashboard /</a></li>
            <li><a href="{{ url('empresas') }}"><i class="fa fa-desktop fa-fw"></i>Empresas /</a></li>
            @if (isset($empresa) && $empresa!=null)
                <li class="active">Editar</li>
            @else
                <li class="active">Crear</li>
            @endif
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
                    @if (isset($empresa) && $empresa!=null)
                        <h2>Formulario información de la empresa</h2>
                    @else
                        <h2>Formulario de creación de empresas </h2>
                    @endif
                    <div class="clearfix"></div>
                </div>
                    <form id="Crear" method="POST">
                        <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Tipo de negocio<span class="required">*</span></label>
                                <select class="form-control select2" id="tipo_negocio" name="tipo_negocio">
                                    <option>Seleccione...</option>
                                    @if (isset($empresa) && $empresa!=null)
                                        @foreach ($TiposNegocios as $item)
                                            <option value="{{$item->id}}" {{(isset($empresa->tipo_negocio) && $empresa->tipo_negocio == $item->id) ? 'selected' : ''}}>{{$item->nombre}}</option>
                                        @endforeach
                                    @else
                                        @foreach ($TiposNegocios as $item)
                                            <option value="{{$item->id}}">{{$item->nombre}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Nombre de la empresa<span class="required">*</span></label>
                                @if (isset($empresa) && $empresa!=null)
                                    <input class="form-control" id="empresa" name="empresa" value="{{$empresa->empresa}}">
                                @else
                                    <input class="form-control" id="empresa" name="empresa" >
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Razón social<span class="required">*</span></label>
                                <div>
                                    @if (isset($empresa) && $empresa!=null)
                                        <input class="form-control" id="razon_social" name="razon_social" name="name" value="{{$empresa->razon_social}}">
                                    @else
                                        <input class="form-control" id="razon_social" name="razon_social" name="name" >
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Cédula o RUC<span class="required">*</span></label>
                                <div >
                                    @if (isset($empresa) && $empresa!=null)
                                        <input class="form-control" id="identificacion" name="identificacion" name="name" value="{{$empresa->identificacion}}">
                                    @else
                                        <input class="form-control" id="identificacion" name="identificacion" name="name" >
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Respresentante<span class="required">*</span></label>
                                <div >
                                    @if (isset($empresa) && $empresa!=null)
                                        <select class="form-control select2" id="representante" name="representante" onchange="asignar_doc_representante();">
                                            {{-- <option disabled>Seleccione...</option> --}}
                                            @foreach ($usuarios as $usuario)
                                                <option value="{{$usuario->users->id}}" documento="{{$usuario->users->user}}" {{$empresa->representante_id == $usuario->id ? 'selected' : ''}} >{{$usuario->users->name}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input class="form-control" id="representante" name="representante" name="name" >
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">ID representante legal<span class="required">*</span></label>
                                <div >
                                    @if (isset($empresa) && $empresa!=null)
                                        <input class="form-control" id="doc_representante" name="doc_representante" name="name" value="{{$empresa->representante->user}}" readonly>
                                    @else
                                        <input class="form-control" id="doc_representante" name="doc_representante" name="name" >
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Teléfono <span class="required">*</span></label>
                                @if (isset($empresa) && $empresa!=null)
                                    <input class="form-control" id="telefono" name="telefono" type="number" class='number' name="number" value="{{$empresa->telefono}}" data-validate-minmax="10,100" >
                                @else
                                    <input class="form-control" id="telefono" name="telefono" type="number" class='number' name="number" data-validate-minmax="10,100" >
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Fax</label>
                                @if (isset($empresa) && $empresa!=null)
                                    <input class="form-control" id="fax" name="fax" type="number" class='number' name="number" value="{{$empresa->fax}}" data-validate-minmax="10,100" >
                                @else
                                    <input class="form-control" id="fax" name="fax" type="number" class='number' name="number" data-validate-minmax="10,100" >
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Email<span class="required">*</span></label>
                                @if (isset($empresa) && $empresa!=null)
                                    <input class="form-control" id="email" name="email" name="email" class='email' type="email" value="{{$empresa->email}}">
                                @else
                                    <input class="form-control" id="email" name="email" name="email" class='email' type="email" >
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label label-align">Dirección<span class="required">*</span></label>
                                <div >
                                    @if (isset($empresa) && $empresa!=null)
                                        <input class="form-control" id="direccion" name="direccion" name="name" value="{{$empresa->direccion}}">
                                    @else
                                        <input class="form-control" id="direccion" name="direccion" name="name" >

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label label-align">País<span class="required">*</span></label>
                                <select name="pais" id="pais" class="form-control select2" required onchange="seleccion_pais();">
                                    <option value="" selected disabled>Seleccione...</option>
                                    @foreach ($paises as $pais)
                                        @if (isset($empresa) && $empresa!=null)
                                            <option value="{{$pais->id}}" {{$empresa->pais_id == $pais->id ? 'selected' : ''}}>{{$pais->nombre_pais}}</option>
                                        @else
                                            <option value="{{$pais->id}}">{{$pais->nombre_pais}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label label-align">Provincia<span class="required">*</span></label>
                                @if (isset($empresa) && $empresa!=null)
                                    <select name="provincia" id="provincia" class="form-control select2" required onchange="seleccion_provincia();">
                                @else
                                    <select name="provincia" id="provincia" class="form-control select2" required disabled onchange="seleccion_provincia();">
                                @endif
                                    <option value="" selected disabled>Seleccione...</option>
                                    @foreach ($provincias as $provincia)
                                        @if (isset($empresa) && $empresa!=null)
                                            <option value="{{$provincia->id}}" {{$empresa->provincia_id == $provincia->id ? 'selected' : ''}} >{{$provincia->nombre_provincia}}</option>
                                        @else
                                            <option value="{{$provincia->id}}">{{$provincia->nombre_provincia}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label label-align">Ciudad<span class="required">*</span></label>
                                <select name="ciudad" id="ciudad" class="form-control select2" required disabled>
                                    <option value="" selected disabled>Seleccione...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Resolución contribuyente especial</label>
                                @if (isset($empresa) && $empresa!=null)
                                    <input class="form-control" id="resolucion" name="resolucion" name="name" value="{{$empresa->resolucion}}">
                                @else
                                    <input class="form-control" id="resolucion" name="resolucion" name="name" >
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label label-align">Fecha vencimiento<span class="required">*</span></label>
                                @if (isset($empresa) && $empresa!=null)
                                    <input class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" class='date' type="date" name="date" value="{{$empresa->fecha_vencimiento}}">
                                @else
                                    <input class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" class='date' type="date" name="date" value="{{date('Y-m-d')}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Generar operaciones en ambiente de<span class="required">*</span></label>
                                <select class="form-control select2" id="ambiente" name="ambiente">
                                    <option>Seleccione...</option>
                                    @if (isset($empresa) && $empresa!=null)
                                        <option value="0" {{$empresa->ambiente == 0 ? 'selected' : ''}} >Pruebas</option>
                                        <option value="1" {{$empresa->ambiente == 1 ? 'selected' : ''}}>Producción</option>
                                    @else
                                        <option value="0">Pruebas</option>
                                        <option value="1">Producción</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="x_content">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="" for="TipoRegimen">Tipo régimen:</label>
                                    <select name="TipoRegimen" id="TipoRegimen" class="form-control select2">
                                        <option value="">Seleccione...</option>
                                        @foreach ($TipoRegimen as $regimen)
                                            @if (isset($empresa) && $empresa!=null)
                                                <option value="{{$regimen->id}}" {{$empresa->tipo_regimen_id == $regimen->id ? 'selected' : ''}} >{{$regimen->nombre}}</option>
                                            @else
                                                <option value="{{$regimen->id}}" >{{$regimen->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="x_content">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>
                                    @if (isset($empresa) && $empresa!=null)
                                        <input type="checkbox" value="" id="artesano" name="artesano" {{$empresa->artesano == 1 ? 'checked' : ''}}> Artesano calificado
                                    @else
                                        <input type="checkbox" value="" id="artesano" name="artesano"> Artesano calificado
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        @if (isset($empresa) && $empresa!=null)
                                            <input type="checkbox" value="" id="contabilidad" name="contabilidad" {{$empresa->contabilidad == 1 ? 'checked' : ''}}> Obligado a llevar contabilidad
                                        @else
                                            <input type="checkbox" value="" id="contabilidad" name="contabilidad"> Obligado a llevar contabilidad
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        @if (isset($empresa) && $empresa!=null)
                                            <input type="checkbox" value="" id="reteiva" name="reteiva" {{$empresa->reteiva == 1 ? 'checked' : ''}}> Agente retención IVA
                                        @else
                                            <input type="checkbox" value="" id="reteiva" name="reteiva"> Agente retención IVA
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        @if (isset($empresa) && $empresa!=null)
                                            <input type="checkbox" value="" id="reterenta" name="reterenta" {{$empresa->reterenta == 1 ? 'checked' : ''}}> Agente retención renta
                                        @else
                                            <input type="checkbox" value="" id="reterenta" name="reterenta"> Agente retención renta
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="x_content">
                            <div class="ln_solid">
                                <div class="form-group"><br>
                                    <button type='submit' class="btn btn-success">GUARDAR</button>
                                    <a href="{{asset('empresas')}}" class="btn btn-danger">REGRESAR</a>
                                </div>
                            </div>
                        </div>

                        {{-- Ocultos --}}
                        @if (isset($empresa) && $empresa!=null)
                            <input type="hidden" name="ciudad_empresa" id="ciudad_empresa" value="{{$empresa->ciudad_id}}">
                            <input type="hidden" name="id_empresa" id="id_empresa" value="{{$empresa->id}}">
                        @endif
                    </form>
                </div><br>
            </div>
        </div>
    </div>
</div>
@endsection

@section('imports')
<script>
    $(document).ready( function() {
      $('.select2').select2();
    });
</script>
{{-- GUARDADO --}}
<script>
    $("#Crear").on("submit", function(e){
        e.preventDefault();
        // Métodos del guardado...
        envio();
    });

    // FUNCIÓN DE ENVIO INFO
    function envio(){
        // loading();

        var formData = new FormData(document.getElementById("Crear"));
        formData.append("id_empresa", $("#id_empresa").val());

        // ENVIO AJAX
        var routeEnvio = "{{asset('empresa_create')}}";
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
                limpiarCampos();
                toastr["success"](res.mensaje,"Registrado");
                setTimeout( function() { window.location="{{asset('empresas')}}"; }, 2000 );
            }
        }).fail(function(msg){
            // loading();
            $.each(msg.responseJSON.errors, function(key, value){
                toastr["error"](value,"Error");
            });
        });
    }
</script>
<script>
    //Cargar Provincias y Ciudades
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

{{-- Cargar Ciudades cuando viene de modificar empresa --}}
<script>
    $(document).ready(function(){
        var provincia = $('#provincia').val();
        var ciudad = $("#ciudad_empresa").val();
        url = "{{asset('empresas/ciudades/')}}"+"/"+provincia+"";
        $.get(url,function(response,state){
        // console.log(response);
            if(response.length > "0"){
                $("#ciudad").prop("disabled",false);
                for(i=0; i<response.length; i++){
                    if (ciudad == response[i].id) {
                        $("#ciudad").append("<option value='"+response[i].id+"' selected >"+response[i].nombre_ciudad+"</option>");
                    } else {
                        $("#ciudad").append("<option value='"+response[i].id+"'>"+response[i].nombre_ciudad+"</option>");
                    }
                }
            }else{
                $("#ciudad").prop("disabled",true);
                $("#ciudad").empty();
                $("#ciudad").append("<option value='' selected disabled> Seleccione...</option>");
            }
        });
    });
</script>
<script>
    function asignar_doc_representante() {
        var doc_representante = $("#representante option:selected").attr('documento');
        $('#doc_representante').val(doc_representante);
    }
</script>

{{-- Limpiar el formulario --}}
<script>function limpiarCampos(){document.getElementById("Crear").reset();}</script>
@endsection
