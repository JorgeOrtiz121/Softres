@extends('Comercio.Panel')

@section('titulo', 'Registro de compras')

@section('ubicacion')
<div class="shiftnav-content-wrap">
    <section class="content-header">
        <h1>
           REGISTRO DE COMPRAS
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('panel')}}"><i class="fa fa-dashboard fa-fw"></i>Panel /</a></li>       
            <li><a href="{{route('panel_compras')}}"><i class="fa fa-shopping-cart fa-fw"></i>Compras /</a></li>
            <li class="active">&nbsp; Registro de compras</li>
        </ol>
    </section>
</div>
@endsection

@section('headers')
    <link rel="stylesheet" href="{{asset('css/busqueda.css')}}">
    <!-- DataTables -->
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
                <h2>Registro de compras</h2>
                <div class="clearfix"></div>
            </div>
            <form id="FormData" method="POST">
                <div class="row">
                    {{-- Tipo de compra --}}
                    <div class="col-md-8 col-sm-8 ">
                       <div class="x_panel" >
                          <div class="x_content">
                            <br>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 label-align">Tipo de compra</label>
                                <div class="col-md-4 col-sm-4">
                                    <select class="form-control" id="tipo_compra" name="tipo_compra" onchange="SelectTipoCompra()">
                                        <option value="1">Mercadería</option>
                                        <option value="2">Compras varias</option>
                                    </select>
                                </div>

                                <div class="col-md-4 col-sm-4" id="TipoCompra1">
                                    <select class="form-control" id="id_tipo_compras_varias" name="id_tipo_compras_varias">
                                        <option value="">Seleccione...</option>
                                        @foreach ($TiposComprasVarias as $TipoCompraVaria)
                                            <option value="{{$TipoCompraVaria->id}}">{{$TipoCompraVaria->detalle}}</option>
                                        @endforeach
                                    </select>
                                </div>
                
                                <div class="col-md-3 col-sm-3" id="TipoCompra2">
                                    <a title="Agregar mas tipos de compras varias" class="btn btn-round btn-secondary ModalTiposComprasVarias"><i class="fa fa-plus-square"></i></a>
                                </div>

                                <div class="col-md-4" id="TipoCompra3">
                                    <label>ULTIMO COSTO</label>
                                </div>

                            </div>
                
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 label-align">Sustento tributario</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control" id="id_sustento_tributario" name="id_sustento_tributario" onchange="SelectSustentoTributario()">
                                        <option value="">Seleccione...</option>
                                        @foreach ($SustentoTributario as $Sustento)
                                            <option value="{{$Sustento->id}}">{{$Sustento->codigo}}:{{$Sustento->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <a title="Agregar mas sustentos tributarios" class="btn btn-round btn-secondary ModalSustentoTributario"><i class="fa fa-plus-square"></i></a>
                                </div>
                            </div>
                
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 label-align">Doc sustento</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control" id="id_documento_autorizado" name="id_documento_autorizado">
                                        <option value="">Seleccione...</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <a title="Agregar mas sustentos doc autorizados" class="btn btn-round btn-secondary ModalDocumentoAutorizado"><i class="fa fa-plus-square"></i></a>
                                </div>
                            </div>
                
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 label-align">Tipo de gasto</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control" id="tipo_gasto" name="tipo_gasto">
                                        <option value="">Seleccione...</option>
                                        <option value="1">Deducible</option>
                                        <option value="2">No deducible</option>
                                    </select>
                                </div>
                            </div>
                          </div>
                       </div>
                    </div>

                    {{-- Proveedor --}}
                    <div class="col-md-8 col-sm-8 ">
                       <div class="x_panel" >
                          <div class="x_content">
                            <br>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 label-align">Proveedor</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="id_proveedor" class="form-control" onchange="ValidateProveedor();">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 label-align">RUC</label>
                                <div class="col-md-2">
                                    <input type="text" id="ruc" class="form-control ">
                                </div>
                                <label class="col-form-label col-md-1 label-align">Teléfono</label>
                                <div class="col-md-2">
                                    <input type="text" id="telefono" class="form-control ">
                                </div>
                                <label class="col-form-label col-md-1 label-align">Ciudad</label>
                                <div class="col-md-2">
                                    <input type="text" id="ciudad" class="form-control ">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 label-align">Subproveedor</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="subproveedor" class="form-control ">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 label-align">Num comprobante</label>
                                <div class="col-md-2">
                                    <input type="text" id="num1" class="form-control ">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" id="num2" class="form-control ">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="num3" class="form-control ">
                                </div>
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <label class="">
                                            <div class="icheckbox_flat-green checked" style="position: relative;">
                                                <input type="checkbox" d="uni_paq" class="flat">
                                            </div> Uni. --> Paq
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 label-align">Autorización SRI</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="autorizacion_sri" class="form-control">
                                </div>49
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 label-align">Fecha Emisión</label>
                                <div class="col-md-3">
                                    <input id="f_emision" class="date-picker form-control" type="date">
                                </div>
                                <label class="col-form-label col-md-2 label-align">Registro</label>
                                <div class="col-md-3">
                                    <input id="f_registro" class="date-picker form-control" type="date">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 label-align">Cargar desde XML</label>
                                <div class="col-md-3 col-sm-3">
                                    <a title="Importar datos de un XML" class="btn btn-secondary ModalImportXML"><i class="fa fa-cloud-download"></i></a>
                                </div>
                            </div>
                          </div>
                       </div>
                    </div>

                    {{-- Tipo de producto --}}
                    <div class="col-md-8 col-sm-8 ">
                        <div class="x_panel" >
                            <div class="x_content">
                                <br>
                                <div class="item form-group">
                                    <div class="col-md-3">
                                        <select class="form-control" id="tipo_prodcuto" name="tipo_prodcuto">
                                            <option value="1">Producto</option>
                                            <option value="2">Servicio</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <select class="form-control" id="tipo_iva" name="tipo_iva">
                                            <option value="1">IVA 0%</option>
                                            <option value="2">IVA 12%</option>
                                            <option value="3">No obj. IVA</option>
                                            <option value="4">Excento</option>
                                        </select>
                                    </div>
                    
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" id="detalle_producto">
                                    </div>

                                    <div class="col-md-3">
                                        <input type="button" value="+">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tabla detalles --}}
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                        <div class="x_title">
                            <h2>Detalles del documento</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="tb_detalles" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="row"></th>
                                        <th>CÓDIGO</th>
                                        <th>NOMBRE DEL ARTICULO</th>
                                        <th>MARCA</th>
                                        <th>xUNI.</th>
                                        <th>xCAJ.</th>
                                        <th>BONO</th>
                                        <th>PRECIO</th>
                                        <th>DES. %</th>
                                        <th>SUBTOT</th>
                                        <th>IVA</th>
                                        <th>TOTAL</th>
                                        <th>UTIL. %</th>
                                        <th>PVP 1</th>
                                    </tr>
                                </thead>
                                <tbody class="detalles_articulos">
                                    <tr>
                                        <th scope="row">1</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="checkbox" name="iva1" id="iva1" class="flat"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>

                    {{--  Inferior izquierdo --}}
                    <div class="col-md-6 col-sm-6">
                        <div class="x_panel">
                        <div class="x_title">
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="bonos-tab" data-toggle="tab" href="#bonos" role="tab" aria-controls="bonos" aria-selected="true">Manejo de bonos</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="bonos" role="tabpanel" aria-labelledby="bonos-tab">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label>
                                            <input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios"> Recalcular costo (cant+bono)/total
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                            <input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"> Calcular descuento para clientes 
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                            <input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"> Solo incrementar stock sin variar precios
                                            </label>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Costo actual: nuevo 0.00">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    {{-- Inferior derecho --}}
                    <div class="col-md-6 col-sm-6 ">
                        <div class="x_panel" >
                            <div class="x_content">
                                <br>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-2 label-align">Descuento recibido</label>
                                    <div class="col-md-4 col-sm-4">
                                        <select class="form-control" id="tipo_compra" name="tipo_compra">
                                            <option value="1">Al subtotal</option>
                                            <option value="2">Al total</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3">
                                        <input id="" type="text" class="form-control" placeholder="0.00">
                                    </div>
                    
                                    <div class="col-md-3 col-sm-3">
                                        <select class="form-control" id="tipo_compra" name="tipo_compra">
                                            <option value="1">%</option>
                                            <option value="2">$</option>
                                        </select>
                                    </div>
                                </div>
                    
                                <div class="item form-group">
                                    <label class="col-form-label col-md-7 label-align">Flete a cancelar al proveedor</label>
                                    <div class="col-md-5">
                                        <input id="" type="text" class="form-control" placeholder="0.00">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-7 label-align">Otros cargos a cancelar al proveedor</label>
                                    <div class="col-md-5">
                                        <input id="" type="text" class="form-control" placeholder="0.00">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-7 label-align">Descuento sobre el subtotal con clic derecho</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Totales --}}
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel" >
                            <div class="x_content">
                                <br>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-2 label-align">Subtotal </label>
                                    <div class="col-md-5">
                                        <input id="" type="text" class="form-control" placeholder="0.00">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-2 label-align">Descuento </label>
                                    <div class="col-md-5">
                                        <input id="" type="text" class="form-control" placeholder="0.00">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-2 label-align">Valor IVA </label>
                                    <div class="col-md-5">
                                        <input id="" type="text" class="form-control" placeholder="0.00">
                                    </div>
                                </div>
                    
                                <div class="item form-group">
                                    <label class="col-form-label col-md-2 label-align">Total </label>
                                    <div class="col-md-5">
                                        <input id="" type="text" class="form-control" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    

                </div>
                <div class="ln_solid">
                    <div class="x_content">
                        <button type='button' class="btn btn-success" onclick="envio();">GUARDAR</button>
                        <a href="{{route('panel_compras')}}" class="btn btn-danger">REGRESAR</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Inicio ModalTiposComprasVarias --}}
    <div id="ModalTiposComprasVarias" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Administración de Tipos Compras Varias</h4>
                </div>
                <div class="modal-body">
                    <div class="clearfix"></div>
                    <input type="button" value="Crear Nuevo" id="Crear Nuevo" class="btn btn-success NewTiposComprasVarias">
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
                                        <table id="listadoTiposComprasVarias" class="table table-striped table-bordered dataTable no-footer table-hover" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" aria-sort="ascending" style="width:5%;">N°</th>
                                                <th class="sorting_asc" aria-sort="ascending" style="width:35%;">TIPO DE COMPRA O SERVICIO</th>
                                                <th class="sorting" style="width:20%;">CUENTA CONTABLE ASOCIADA</th>
                                                <th class="sorting" style="width:20%;">CUENTA PARA EL IVA</th>
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
                    <button type="button" class="btn btn-secondary CancelTiposComprasVarias" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="ModalStoreUpdateTiposComprasVarias" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><span id="TiposComprasVariasType"></span> registro</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label label-align">Tipo de compra</label>
                                <input id="TiposComprasVariasDetalle" name="TiposComprasVariasDetalle" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label label-align">Cuenta contable</label>
                                <input id="TiposComprasVariasCuenta" name="TiposComprasVariasCuenta" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label label-align">Cuenta contable IVA</label>
                                <input id="TiposComprasVariasCuentaIva" name="TiposComprasVariasCuentaIva" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" id="TiposComprasVariasId" name="id_register">
                        <input type="hidden" id="TiposComprasVariasAction" name="ActionModal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="button" value="Guardar" id="Guardar" class="btn btn-success StoreUpdateTiposComprasVarias">
                </div>
            </div>
        </div>
    </div>

    <div id="ModalDeleteTiposComprasVarias" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Eliminación de registros</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>¿Esta seguro que desea eliminar el registro <b><span id="dataTiposComprasVariasModal" aria-hidden="true"></span></b> ?</p>
                    <input type="hidden" id="idTiposComprasVariasModal" name="idTiposComprasVariasModal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="button" value="Confirmar" id="Confirmar" class="btn btn-success DeleteTiposComprasVariasRegistration">
                </div>
            </div>
        </div>
    </div>
{{-- Fin ModalTiposComprasVarias --}}

{{-- Inicio ModalSustentoTributario --}}
    <div id="ModalSustentoTributario" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Administración de sustentos tributarios</h4>
                </div>
                <div class="modal-body">
                    <div class="clearfix"></div>
                    <input type="button" value="Crear Nuevo" id="Crear Nuevo" class="btn btn-success NewSustentoTributario">
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
                                        <table id="listadoSustentoTributario" class="table table-striped table-bordered dataTable no-footer table-hover" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" aria-sort="ascending" style="width:10%;">N°</th>
                                                <th class="sorting_asc" aria-sort="ascending" style="width:20%;">CÓDIGO</th>
                                                <th class="sorting" style="width:40%;">NOMBRE DEL SUSTENTO TRIBUTATIO</th>
                                                <th class="sorting" style="width:20%;">DOC. SUSTENTO</th>
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
                    <button type="button" class="btn btn-secondary CancelSustentoTributario" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="ModalStoreUpdateSustentoTributario" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><span id="SustentoTributarioType"></span> registro</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label label-align">Código SRI</label>
                                <input id="SustentoTributarioCodigo" name="SustentoTributarioCodigo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label label-align">Nombre del sustento</label>
                                <input id="SustentoTributarioNombre" name="SustentoTributarioNombre" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" id="SustentoTributarioId" name="id_register">
                        <input type="hidden" id="SustentoTributarioAction" name="ActionModal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="button" value="Guardar" id="Guardar" class="btn btn-success StoreUpdateSustentoTributario">
                </div>
            </div>
        </div>
    </div>

    <div id="ModalDeleteSustentoTributario" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Eliminación de registros</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>¿Esta seguro que desea eliminar el registro <b><span id="dataSustentoTributarioModal" aria-hidden="true"></span></b> ?</p>
                    <input type="hidden" id="idSustentoTributarioModal" name="idSustentoTributarioModal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="button" value="Confirmar" id="Confirmar" class="btn btn-success DeleteSustentoTributarioRegistration">
                </div>
            </div>
        </div>
    </div>
{{-- Fin ModalSustentoTributario --}}

{{-- Inicio ModalDocumentoAutorizado --}}
    <div id="ModalDocumentoAutorizado" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Administración de sustentos tributarios</h4>
                </div>
                <div class="modal-body">
                    <div class="clearfix"></div>
                    <input type="button" value="Crear Nuevo" id="Crear Nuevo" class="btn btn-success NewDocumentoAutorizado">
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
                                        <table id="listadoDocumentoAutorizado" class="table table-striped table-bordered dataTable no-footer table-hover" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" aria-sort="ascending" style="width:10%;">N°</th>
                                                <th class="sorting_asc" aria-sort="ascending" style="width:20%;">CÓDIGO</th>
                                                <th class="sorting" style="width:40%;">NOMBRE DEL DOCUMENTO</th>
                                                <th class="sorting" style="width:40%;">SUSTENTO ASOCIADO</th>
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
                    <button type="button" class="btn btn-secondary CancelDocumentoAutorizado" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="ModalStoreUpdateDocumentoAutorizado" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><span id="DocumentoAutorizadoType"></span> registro</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label label-align">Código SRI</label>
                                <input id="DocumentoAutorizadoCodigo" name="DocumentoAutorizadoCodigo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label label-align">Nombre del Documento</label>
                                <input id="DocumentoAutorizadoNombre" name="DocumentoAutorizadoNombre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label label-align">Sustento tributario</label>
                                <select class="form-control" id="DocumentoAutorizadoSustento" name="DocumentoAutorizadoSustento" onchange="SelectSustentoTributario()">
                                    <option value="">Seleccione...</option>
                                    @foreach ($SustentoTributario as $Sustento)
                                        <option value="{{$Sustento->id}}">{{$Sustento->codigo}}:{{$Sustento->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="DocumentoAutorizadoId" name="id_register">
                        <input type="hidden" id="DocumentoAutorizadoAction" name="ActionModal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="button" value="Guardar" id="Guardar" class="btn btn-success StoreUpdateDocumentoAutorizado">
                </div>
            </div>
        </div>
    </div>

    <div id="ModalDeleteDocumentoAutorizado" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Eliminación de registros</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>¿Esta seguro que desea eliminar el registro <b><span id="dataDocumentoAutorizadoModal" aria-hidden="true"></span></b> ?</p>
                    <input type="hidden" id="idDocumentoAutorizadoModal" name="idDocumentoAutorizadoModal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="button" value="Confirmar" id="Confirmar" class="btn btn-success DeleteDocumentoAutorizadoRegistration">
                </div>
            </div>
        </div>
    </div>
{{-- Fin ModalDocumentoAutorizado --}}

{{-- Inicio ModalImportXML --}}
<div id="ModalImportXML" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Importar XML de factura eletrónica</h4>
            </div>
            <div class="modal-body">
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            <hr>
                            <div class="x_content">
                                <div class="row">
                                    <form id="frmImportXML" method="POST" enctype="multipart/form-data">
                                        <div class="col-sm-12">
                                            <label class="col-form-label col-md-2 label-align">Tipo de compra</label>
                                            <div class="radio">
                                                <label>
                                                <input type="radio" checked="" value="1" id="mercaderia" name="optionRadio"> Mercadería
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                <input type="radio" checked="" value="2" id="comprasVarias" name="optionRadio"> Compras varias
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <input type="file" name="archivo" id="archivo" accept=".xml" required>
                                        </div>
                                        <div class="col-sm-12">
                                            &nbsp;
                                        </div>

                                        <div class="col-sm-12">
                                            <input type="submit" value="Inportar datos" id="cargarDd1" class="btn btn-success">
                                        </div>
                                    </form>
                                </div>

                                <div class="x_title">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 label-align">Proveedor</label>
                                    <div class="col-md-8">
                                        <input type="text" id="id_proveedorModal" class="form-control" onchange="ValidateProveedor();">
                                    </div>
                                </div>
    
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 label-align">RUC</label>
                                    <div class="col-md-3">
                                        <input type="text" id="rucModal" class="form-control">
                                    </div>
                                    <label class="col-form-label col-md-1 label-align">Fecha</label>
                                    <div class="col-md-4">
                                        <input type="date" id="f_emisionModal" class="date-picker form-control">
                                    </div>
                                </div>
        
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 label-align">Num comprobante</label>
                                    <div class="col-md-2">
                                        <input type="text" id="num1Modal" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="num2Modal" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="num3Modal" class="form-control">
                                    </div>
                                </div>
    
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 label-align">Autorización SRI</label>
                                    <div class="col-md-8">
                                        <input type="text" id="autorizacion_sriModal" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    &nbsp;
                                </div>

                                <table id="tb_listadoXml" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>CÓDIGO</th>
                                            <th>NOMBRE DEL ARTICULO SEGÚN XML FACTURA</th>
                                            <th>CANT.</th>
                                            <th>PRECIO</th>
                                            <th>IVA</th>
                                            <th>ASOCIADO</th>
                                            <th>COD.LOCAL</th>
                                            <th>NOMBRE DEL ARTICULO EN EL SISTEMA</th>
                                        </tr>
                                    </thead>
                                    <tbody class="detalles_xml">

                                    </tbody>
                                </table>
                                <div class="col-sm-12">
                                    <input type="button" value="Guardar info" id="CrearNuevo" class="btn btn-success NewDocumentoAutorizado">
                                </div>
                            </div>
                        </div><br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary CancelImportXML" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
{{-- Fin ModalImportXML --}}

<input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

@endsection

@section('imports')
    <!-- DataTables -->
    <script src="{{ asset('gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- extension responsive -->
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

    // {{-- FUNCIONES PRINCIPALES --}}
    <script>
        $(document).ready( function() {
            SelectTipoCompra();
            SelectSustentoTributario();
            FindProveedores('id_proveedor')
        });

        function SelectTipoCompra() {
            let data = $('#tipo_compra').val();
            $('#id_tipo_compras_varias').val('').trigger("change");
            if (data == 1) {
                $('#TipoCompra1').hide();
                $('#TipoCompra2').hide();
                $('#TipoCompra3').show();
            } else {
                $('#TipoCompra1').show();
                $('#TipoCompra2').show();
                $('#TipoCompra3').hide();
            }
        }

        function SelectSustentoTributario() {
            let data = $('#id_sustento_tributario').val();
            $("#id_documento_autorizado").empty();
            if (data != '') {
                var routeGet = "{{route('GetDocumentoAutorizado')}}"+'/select/'+data;
                $.ajax({
                    url: routeGet,
                    type: 'GET',
                    dataType: 'json',
                }).done(function(res){
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        $("#id_documento_autorizado").empty();
                        $("#id_documento_autorizado").append('<option value="">Seleccione...</option>');
                        $.each(res, function(key, value){
                            $("#id_documento_autorizado").append('<option value='+value.id+'>'+value.codigo+':'+value.nombre+'</option>');
                        });
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                    }); 
                });
            } else {
                $("#id_documento_autorizado").empty();
                $("#id_documento_autorizado").append('<option value="">Seleccione...</option>');
            }
        }

        function FindProveedores(id){
            $(document).ready(function() {
                var engine, remoteHost, template, empty;
                $.support.cors = true;
                empty = '<div class="EmptyMessage label label-info">Su búsqueda retornó 0 resultados!</div>';
                engine = new Bloodhound({
                    remote:{
                        url: "{{ asset('comercio/buscar-proveedores?q=%QUERY%')}}",
                        wildcard: '%QUERY%'
                    },
                    identify: function(o) { return o.documento; },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('documento', 'nombre')
                });

                engine.get('a', 'b')
                function engineWithDefaults(q, sync, async) {
                    if (q === '') {
                        sync(engine.get('a','b'));
                        async([]);
                    }
                    else {
                        engine.search(q, sync, async);
                    }
                }

                $('#id_proveedor').typeahead({
                    hint: $('.Typeahead-hint'),
                    menu: $('.Typeahead-menu'),
                    minLength: 0,
                    classNames: {
                        open: 'is-open',
                        empty: 'is-empty',
                        cursor: 'is-active',
                        suggestion: 'Typeahead-suggestion',
                        selectable: 'Typeahead-selectable',
                        input: '.form-control'
                    }
                }, {
                    source: engineWithDefaults,
                    displayKey: 'documento',
                    templates: {
                        suggestion: function (data) {
                                    return '<div class="ProfileCard u-cf"> \
                                        <div class="ProfileCard-details-product"> \
                                            <div class="ProfileCard-realName">'+data.documento+'</div> \
                                            <div class="ProfileCard-screenName">'+data.nombre+'</div> \
                                        </div> \
                                    </div'},
                        empty: empty
                    },
                    limit: 10
                })
                .on('typeahead:asyncrequest', function() {
                    $('.Typeahead-spinner').show();
                })
                .on('typeahead:asynccancel typeahead:asyncreceive', function() {
                    $('.Typeahead-spinner').hide();
                })
                .on('typeahead:select', function(ev, suggestion) {
                    $(this).attr('valorid',suggestion.id);
                    $("#ruc").val(suggestion.documento);
                    $("#telefono").val(suggestion.telefono);
                    $("#ciudad").val(suggestion.ciudades?.nombre_ciudad);
                    $("#subproveedor").val(suggestion.subproveedores?.nombre);
                });
            });
        }

        function ValidateProveedor() {
            let id_proveedor = $('#id_proveedor').val();
            if (!id_proveedor) {
                $('#id_proveedor').attr('valorid','');
                $("#ruc").val('');
                $("#telefono").val('');
                $("#ciudad").val('');
                $("#subproveedor").val('');
            }
        }
    </script>

    // {{-- GESTION GENERAL --}}
    <script>
        // {{-- Gestionar TiposComprasVarias --}}
            // {{-- Ver listado resgistros --}}
            $('.ModalTiposComprasVarias').click(function() {
                $("#listadoTiposComprasVarias").dataTable().fnDestroy();
                $('#listadoTiposComprasVarias').DataTable({
                    "language":{url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                    "responsive": true,
                    "processing":true,
                    "serverSide": true,
                    "ajax":{
                        url:"{{route('GetTiposComprasVarias')}}",
                    },
                    "columns":[
                        {data: 'id'},
                        {data: 'detalle'},
                        {data: 'cuenta_contable'},
                        {data: 'cuenta_contable_iva'},
                        {data: 'actions'}
                    ]
                });
                $("#ModalTiposComprasVarias").modal("show");
            });

            // {{-- Cargar creacion de registros --}}
            $('.NewTiposComprasVarias').click(function() {
                $("#TiposComprasVariasType").html('Crear');
                $("#TiposComprasVariasDetalle").val('');
                $("#TiposComprasVariasCuenta").val('');
                $("#TiposComprasVariasCuentaIva").val('');
                $("#TiposComprasVariasId").val('');
                $("#TiposComprasVariasAction").val('crear');
                $("#ModalStoreUpdateTiposComprasVarias").modal("show");
            });

            // {{-- Cargar edicion de registro --}}
            function EditTiposComprasVarias(id) {
                var routeGet = "{{route('GetTiposComprasVarias')}}"+'/unico/'+id;
                $.ajax({
                    url: routeGet,
                    type: 'GET',
                    dataType: 'json',
                }).done(function(res){
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        $("#TiposComprasVariasType").html('Editar');
                        $("#TiposComprasVariasDetalle").val(res.data.detalle);
                        $("#TiposComprasVariasCuenta").val(res.data.cuenta_contable);
                        $("#TiposComprasVariasCuentaIva").val(res.data.cuenta_contable_iva);
                        $("#TiposComprasVariasId").val(res.data.id);
                        $("#TiposComprasVariasAction").val('editar');
                        $("#ModalStoreUpdateTiposComprasVarias").modal("show");
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalStoreUpdateTiposComprasVarias").modal('show');
                    }); 
                });
            }

            // {{-- GuardarEditar registro --}}
            $('#ModalStoreUpdateTiposComprasVarias .StoreUpdateTiposComprasVarias').click(function(){
                var routeSend = "{{route('AdminTiposComprasVarias')}}";
                var token = $("#token").val();
                var formData = new FormData();
                formData.append("detalle", $("#TiposComprasVariasDetalle").val());
                formData.append("cuenta_contable", $("#TiposComprasVariasCuenta").val());
                formData.append("cuenta_contable_iva", $("#TiposComprasVariasCuentaIva").val());
                formData.append("id", $("#TiposComprasVariasId").val());
                formData.append("action",$("#TiposComprasVariasAction").val());

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
                    console.log(res.codigo);
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        toastr["success"](res.message,"Éxito");
                        $("#ModalStoreUpdateTiposComprasVarias").modal("hide");
                        $("#listadoTiposComprasVarias").DataTable().ajax.reload();
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalStoreUpdateTiposComprasVarias").modal('show');
                    }); 
                });
            });

            // {{-- Eliminar registro --}}
            function DeleteTiposComprasVarias(fila) {
                var id = $(this).attr("id");
                // {{-- Abrir modal --}}
                $("#idTiposComprasVariasModal").val($(fila).attr('id'));
                $("#dataTiposComprasVariasModal").html($(fila).attr('data'));
                $("#ModalDeleteTiposComprasVarias").modal("show");

                // {{-- Eliminar registro --}}
                $('#ModalDeleteTiposComprasVarias .DeleteTiposComprasVariasRegistration').click(function(){
                    if(id != ""){
                        var routeSend = "{{route('AdminTiposComprasVarias')}}";
                        var token = $("#token").val();
                        var formData = new FormData();
                        formData.append("id", $("#idTiposComprasVariasModal").val());
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
                                $("#ModalDeleteTiposComprasVarias").modal("hide");
                                $("#listadoTiposComprasVarias").DataTable().ajax.reload();
                            }
                        })
                        .fail(function(msg){
                            $.each(msg.responseJSON.errors, function(key, value){
                                toastr["error"](value,"Error");
                                $("#ModalDeleteTiposComprasVarias").modal('show');
                            }); 
                        });
                    }
                });
            }

            // {{-- Regresar --}}
            $('#ModalTiposComprasVarias .CancelTiposComprasVarias').click(function(){
                var routeGet = "{{route('GetTiposComprasVarias')}}"+'/select';
                $.ajax({
                    url: routeGet,
                    type: 'GET',
                    dataType: 'json',
                }).done(function(res){
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        $("#id_tipo_compras_varias").empty();
                        $("#id_tipo_compras_varias").append('<option value="">Seleccione...</option>');
                        $.each(res, function(key, value){
                            $("#id_tipo_compras_varias").append('<option value='+value.id+'>'+value.detalle+'</option>');
                        });
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalTiposComprasVarias").modal('show');
                    }); 
                });
            });
        // {{-- Fin Gestionar TiposComprasVarias --}}

        // {{-- Gestionar SustentoTributario --}}
            // {{-- Ver listado resgistros --}}
            $('.ModalSustentoTributario').click(function() {
                $("#listadoSustentoTributario").dataTable().fnDestroy();
                $('#listadoSustentoTributario').DataTable({
                    "language":{url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                    "responsive": true,
                    "processing":true,
                    "serverSide": true,
                    "ajax":{
                        url:"{{route('GetSustentoTributario')}}",
                    },
                    "columns":[
                        {data: 'id'},
                        {data: 'codigo'},
                        {data: 'nombre'},
                        {data: 'asociados'},
                        {data: 'actions'}
                    ]
                });
                $("#ModalSustentoTributario").modal("show");
            });

            // {{-- Cargar creacion de registros --}}
            $('.NewSustentoTributario').click(function() {
                $("#SustentoTributarioType").html('Crear');
                $("#SustentoTributarioCodigo").val('');
                $("#SustentoTributarioNombre").val('');
                $("#SustentoTributarioId").val('');
                $("#SustentoTributarioAction").val('crear');
                $("#ModalStoreUpdateSustentoTributario").modal("show");
            });

            // {{-- Cargar edicion de registro --}}
            function EditSustentoTributario(id) {
                var routeGet = "{{route('GetSustentoTributario')}}"+'/unico/'+id;
                $.ajax({
                    url: routeGet,
                    type: 'GET',
                    dataType: 'json',
                }).done(function(res){
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        $("#SustentoTributarioType").html('Editar');
                        $("#SustentoTributarioCodigo").val(res.data.codigo);
                        $("#SustentoTributarioNombre").val(res.data.nombre);
                        $("#SustentoTributarioId").val(res.data.id);
                        $("#SustentoTributarioAction").val('editar');
                        $("#ModalStoreUpdateSustentoTributario").modal("show");
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalStoreUpdateSustentoTributario").modal('show');
                    }); 
                });
            }

            // {{-- GuardarEditar registro --}}
            $('#ModalStoreUpdateSustentoTributario .StoreUpdateSustentoTributario').click(function(){
                var routeSend = "{{route('AdminSustentoTributario')}}";
                var token = $("#token").val();
                var formData = new FormData();
                formData.append("codigo", $("#SustentoTributarioCodigo").val());
                formData.append("nombre", $("#SustentoTributarioNombre").val());
                formData.append("id", $("#SustentoTributarioId").val());
                formData.append("action",$("#SustentoTributarioAction").val());

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
                    console.log(res.codigo);
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        toastr["success"](res.message,"Éxito");
                        $("#ModalStoreUpdateSustentoTributario").modal("hide");
                        $("#listadoSustentoTributario").DataTable().ajax.reload();
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalStoreUpdateSustentoTributario").modal('show');
                    }); 
                });
            });

            // {{-- Eliminar registro --}}
            function DeleteSustentoTributario(fila) {
                var id = $(this).attr("id");
                // {{-- Abrir modal --}}
                $("#idSustentoTributarioModal").val($(fila).attr('id'));
                $("#dataSustentoTributarioModal").html($(fila).attr('data'));
                $("#ModalDeleteSustentoTributario").modal("show");

                // {{-- Eliminar registro --}}
                $('#ModalDeleteSustentoTributario .DeleteSustentoTributarioRegistration').click(function(){
                    if(id != ""){
                        var routeSend = "{{route('AdminSustentoTributario')}}";
                        var token = $("#token").val();
                        var formData = new FormData();
                        formData.append("id", $("#idSustentoTributarioModal").val());
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
                                $("#ModalDeleteSustentoTributario").modal("hide");
                                $("#listadoSustentoTributario").DataTable().ajax.reload();
                            }
                        })
                        .fail(function(msg){
                            $.each(msg.responseJSON.errors, function(key, value){
                                toastr["error"](value,"Error");
                                $("#ModalDeleteSustentoTributario").modal('show');
                            }); 
                        });
                    }
                });
            }

            // {{-- Regresar --}}
            $('#ModalSustentoTributario .CancelSustentoTributario').click(function(){
                var routeGet = "{{route('GetSustentoTributario')}}"+'/select';
                $.ajax({
                    url: routeGet,
                    type: 'GET',
                    dataType: 'json',
                }).done(function(res){
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        $("#id_sustento_tributario").empty();
                        $("#id_sustento_tributario").append('<option value="">Seleccione...</option>');
                        $.each(res, function(key, value){
                            $("#id_sustento_tributario").append('<option value='+value.id+'>'+value.codigo+':'+value.nombre+'</option>');
                        });
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalSustentoTributario").modal('show');
                    }); 
                });
            });
        // {{-- Fin Gestionar SustentoTributario --}}

        // {{-- Gestionar DocumentoAutorizado --}}
            // {{-- Ver listado resgistros --}}
            $('.ModalDocumentoAutorizado').click(function() {
                $("#listadoDocumentoAutorizado").dataTable().fnDestroy();
                $('#listadoDocumentoAutorizado').DataTable({
                    "language":{url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                    "responsive": true,
                    "processing":true,
                    "serverSide": true,
                    "ajax":{
                        url:"{{route('GetDocumentoAutorizado')}}",
                    },
                    "columns":[
                        {data: 'id'},
                        {data: 'codigo'},
                        {data: 'nombre'},
                        {data: 'asociados'},
                        {data: 'actions'}
                    ]
                });
                $("#ModalDocumentoAutorizado").modal("show");
            });

            // {{-- Cargar creacion de registros --}}
            $('.NewDocumentoAutorizado').click(function() {
                $("#DocumentoAutorizadoType").html('Crear');
                $("#DocumentoAutorizadoCodigo").val('');
                $("#DocumentoAutorizadoNombre").val('');
                $("#DocumentoAutorizadoId").val('');
                $("#DocumentoAutorizadoAction").val('crear');
                $("#ModalStoreUpdateDocumentoAutorizado").modal("show");
            });

            // {{-- Cargar edicion de registro --}}
            function EditDocumentoAutorizado(id) {
                var routeGet = "{{route('GetDocumentoAutorizado')}}"+'/unico/'+id;
                $.ajax({
                    url: routeGet,
                    type: 'GET',
                    dataType: 'json',
                }).done(function(res){
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        $("#DocumentoAutorizadoType").html('Editar');
                        $("#DocumentoAutorizadoCodigo").val(res.data.codigo);
                        $("#DocumentoAutorizadoNombre").val(res.data.nombre);
                        $("#DocumentoAutorizadoSustento").val(res.data.id_sustento_tributario).trigger("change");
                        $("#DocumentoAutorizadoId").val(res.data.id);
                        $("#DocumentoAutorizadoAction").val('editar');
                        $("#ModalStoreUpdateDocumentoAutorizado").modal("show");
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalStoreUpdateDocumentoAutorizado").modal('show');
                    }); 
                });
            }

            // {{-- GuardarEditar registro --}}
            $('#ModalStoreUpdateDocumentoAutorizado .StoreUpdateDocumentoAutorizado').click(function(){
                var routeSend = "{{route('AdminDocumentoAutorizado')}}";
                var token = $("#token").val();
                var formData = new FormData();
                formData.append("codigo", $("#DocumentoAutorizadoCodigo").val());
                formData.append("nombre", $("#DocumentoAutorizadoNombre").val());
                formData.append("id_sustento_tributario",$("#DocumentoAutorizadoSustento option:selected").val());
                formData.append("id", $("#DocumentoAutorizadoId").val());
                formData.append("action",$("#DocumentoAutorizadoAction").val());

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
                    console.log(res.codigo);
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        toastr["success"](res.message,"Éxito");
                        $("#ModalStoreUpdateDocumentoAutorizado").modal("hide");
                        $("#listadoDocumentoAutorizado").DataTable().ajax.reload();
                    }
                })
                .fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalStoreUpdateDocumentoAutorizado").modal('show');
                    }); 
                });
            });

            // {{-- Eliminar registro --}}
            function DeleteDocumentoAutorizado(fila) {
                var id = $(this).attr("id");
                // {{-- Abrir modal --}}
                $("#idDocumentoAutorizadoModal").val($(fila).attr('id'));
                $("#dataDocumentoAutorizadoModal").html($(fila).attr('data'));
                $("#ModalDeleteDocumentoAutorizado").modal("show");

                // {{-- Eliminar registro --}}
                $('#ModalDeleteDocumentoAutorizado .DeleteDocumentoAutorizadoRegistration').click(function(){
                    if(id != ""){
                        var routeSend = "{{route('AdminDocumentoAutorizado')}}";
                        var token = $("#token").val();
                        var formData = new FormData();
                        formData.append("id", $("#idDocumentoAutorizadoModal").val());
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
                                $("#ModalDeleteDocumentoAutorizado").modal("hide");
                                $("#listadoDocumentoAutorizado").DataTable().ajax.reload();
                            }
                        })
                        .fail(function(msg){
                            $.each(msg.responseJSON.errors, function(key, value){
                                toastr["error"](value,"Error");
                                $("#ModalDeleteDocumentoAutorizado").modal('show');
                            }); 
                        });
                    }
                });
            }

            // {{-- Regresar --}}
            $('#ModalDocumentoAutorizado .CancelDocumentoAutorizado').click(function(){
                SelectSustentoTributario();
            });
        // {{-- Fin Gestionar DocumentoAutorizado --}}

         // {{-- Gestionar ModalImportXML --}}
            // {{-- Ver listado resgistros --}}
            $('.ModalImportXML').click(function() {
                $('#archivo').val('');
                $("#id_proveedorModal").val('');
                $("#rucModal").val('');
                $("#f_emisionModal").val('');
                $("#num1Modal").val('');
                $("#num2Modal").val('');
                $("#num3Modal").val('');
                $("#autorizacion_sriModal").val('');
                $("#tb_listadoXml tbody").empty();

                $("#ModalImportXML").modal("show");
            });

            $("#frmImportXML").on("submit", function(e){
                e.preventDefault();

                var f = $(this);
                var route = "{{asset('comercio/import_xml')}}";
                var token = $("#token").val();
                var formData = new FormData(document.getElementById("frmImportXML"));

                $.ajax({
                    url: route,
                    headers: {'X-CSRF-TOKEN':token},
                    type: "POST",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false

                }).done(function(res){
                    if(res.codigo == 0){
                        toastr["error"](res.message,"Error");
                    }else{
                        $("#id_proveedorModal").val(res.message.cabeza.proveedor);
                        $("#rucModal").val(res.message.cabeza.rcu);
                        $("#f_emisionModal").val(res.message.cabeza.fecha);
                        $("#num1Modal").val(res.message.cabeza.NumComprobante1);
                        $("#num2Modal").val(res.message.cabeza.NumComprobante2);
                        $("#num3Modal").val(res.message.cabeza.NumComprobante3);
                        $("#autorizacion_sriModal").val(res.message.cabeza.autorizacion);
                        let count = 0;
                        $.each(res.message.detalles, function(key, value){
                            count++;
                            $(".detalles_xml").append(
                                '<tr>'+
                                    '<td align="right">'+count+'</td>'+
                                    '<td align="left">'+value.codigo+'</td>'+
                                    '<td align="left">'+value.nombre+'</td>'+
                                    '<td align="right">'+value.cantidad+'</td>'+
                                    '<td align="right">'+value.precio+'</td>'+
                                    '<td align="right">'+value.iva+'</td>'+
                                    '<td align="left">'+value.asocidao+'</td>'+
                                    '<td align="left">'+value.cod_local+'</td>'+
                                    '<td align="left">'+value.nombre_interno+'</td>'+
                                '</tr>'
                            );
                        });
                        $("#ModalImportXML").modal("show");                
                    }
                }).fail(function(msg){
                    $.each(msg.responseJSON.errors, function(key, value){
                        toastr["error"](value,"Error");
                        $("#ModalImportXML").modal('show');
                    }); 
                });
            });
        // {{-- Fin Gestionar ModalImportXML --}}

    </script>
@endsection