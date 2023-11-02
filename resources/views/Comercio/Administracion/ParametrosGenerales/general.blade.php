@extends('Comercio.Panel')

@section('titulo', 'Parametros generales')

@section('ubicacion')
<div class="shiftnav-content-wrap">
  <section class="content-header">
    <h1>
      PARAMETROS GENERALES
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('panel') }}"><i class="fa fa-dashboard fa-fw"></i>Panel /</a></li>
      <li><a href="{{ url('comercio/administracion') }}"><i class="fa fa-cogs fa-fw"></i>Administracion /</a></li>
      <li class="active">Parametros generales</li>
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

<form id="guardadoGeneral" method="POST" files="true" enctype="multipart/form-data" >
<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Formularios Parametros generales</h2>
            <div class="clearfix"></div>
        </div>
          <input type="submit" value="Guardar" id="guardadoG" class="btn btn-success">
        </div><br>
    </div>
</div>

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_content">
        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="confg_docs-tab" data-toggle="tab" href="#confg_docs" role="tab" aria-controls="confg_docs" aria-selected="true">Configuración de Documentos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="generales-tab" data-toggle="tab" href="#generales" role="tab" aria-controls="generales" aria-selected="false">Generales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="impresiones-tab" data-toggle="tab" href="#impresiones" role="tab" aria-controls="impresiones" aria-selected="false">Impresiones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="fe-tab" data-toggle="tab" href="#fe" role="tab" aria-controls="fe" aria-selected="false">Facturación Electronica</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          {{-- Pestaña Configuracion de documentos --}}
          <div class="tab-pane fade show active" id="confg_docs" role="tabpanel" aria-labelledby="confg_docs-tab">
            {{-- Boton --}}
            <div class="text-left">
              <a href="" data-toggle="modal" data-remote="false" data-toggle="tooltip"  title="Crear nuevo registro" class="btn .btn-lg btn-primary crearConfg_docs">CREAR NUEVO</a>

            </div>
            <hr>
            {{-- Tabla Docs --}}
            <div class="x_content">
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-box table-responsive">
                    <table id="listado" class="table table-striped table-bordered dataTable no-footer table-hover" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                      <thead>
                        <tr role="row">
                            <th class="sorting_asc" aria-sort="ascending" style="width: 25%;">TIPO DOCUMENTO</th>
                            <th class="sorting" style="width: 25%;">ESTABLECIMIENTO</th>
                            <th class="sorting" style="width: 25%;"><center>PUNTO EMISIÓN</center></th>
                            <th class="sorting" style="width: 25%;"><center>AUTORIZACIÓN SRI</center></th>
                            <th class="sorting" style="width: 25%;">MAX NÚMERO</th>
                            <th class="sorting" style="width: 25%;"><center>CADUCIADAD</center></th>
                            <th class="sorting" style="width: 25%;"><center>ACCCIONES</center></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            {{-- Fin Tabla Docs --}}
            &nbsp;
            <table id="TableConfigDocs">
              <tr>
                <td>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Facturas locales</label>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <select class="form-control" id="facturasLocales" name="facturasLocales">
                          <option value="">Seleccione...</option>
                          @foreach ($comprobantes as $item)
                            @if ($item->comprobante_id == 1)
                              @if ($item->id == $ConfigDocPredeterminados->facturas_id)
                                <option selected value="{{$item->id}}" valorid="{{$item->comprobante_id}}">{{$item->num_serie1}} - {{$item->num_serie2}}</option>
                              @else
                                <option value="{{$item->id}}" valorid="{{$item->comprobante_id}}">{{$item->num_serie1}} - {{$item->num_serie2}}</option>
                              @endif
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Retenciones locales</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <select class="form-control" id="retencionesLocales" name="retencionesLocales">
                          <option value="">Seleccione...</option>
                          @foreach ($comprobantes as $item)
                            @if ($item->comprobante_id == 3)
                              @if ($item->id == $ConfigDocPredeterminados->retenciones_id)
                                <option selected value="{{$item->id}}" valorid="{{$item->comprobante_id}}">{{$item->num_serie1}} - {{$item->num_serie2}}</option>
                              @else
                                <option value="{{$item->id}}" valorid="{{$item->comprobante_id}}">{{$item->num_serie1}} - {{$item->num_serie2}}</option>
                              @endif
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Notas de créditos locales</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <select class="form-control" id="notaCreditoLocales" name="notaCreditoLocales">
                          <option value="">Seleccione...</option>
                          @foreach ($comprobantes as $item)
                            @if ($item->comprobante_id == 4)
                              @if ($item->id == $ConfigDocPredeterminados->nota_credito_id)
                                <option selected value="{{$item->id}}" valorid="{{$item->comprobante_id}}">{{$item->num_serie1}} - {{$item->num_serie2}}</option>
                              @else
                                <option value="{{$item->id}}" valorid="{{$item->comprobante_id}}">{{$item->num_serie1}} - {{$item->num_serie2}}</option>
                              @endif
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Guias de remisión locales</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <select class="form-control" id="guiasLocales" name="guiasLocales">
                          <option value="">Seleccione...</option>
                          @foreach ($comprobantes as $item)
                            @if ($item->comprobante_id == 5)
                              @if ($item->id == $ConfigDocPredeterminados->guias_id)
                                <option selected value="{{$item->id}}" valorid="{{$item->comprobante_id}}">{{$item->num_serie1}} - {{$item->num_serie2}}</option>
                              @else
                                <option value="{{$item->id}}" valorid="{{$item->comprobante_id}}">{{$item->num_serie1}} - {{$item->num_serie2}}</option>
                              @endif
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Liquidacion de compras locales</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <select class="form-control" id="liquidacionLocales" name="liquidacionLocales">
                          <option value="">Seleccione...</option>
                          @foreach ($comprobantes as $item)
                            @if ($item->comprobante_id == 6)
                              @if ($item->id == $ConfigDocPredeterminados->liq_compra_id)
                                <option selected value="{{$item->id}}" valorid="{{$item->comprobante_id}}">{{$item->num_serie1}} - {{$item->num_serie2}}</option>
                              @else
                                <option value="{{$item->id}}" valorid="{{$item->comprobante_id}}">{{$item->num_serie1}} - {{$item->num_serie2}}</option>
                              @endif
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          {{-- Fin Pestaña Configuracion de documentos --}}

          {{-- Pestaña Generales --}}
          <div class="tab-pane fade" id="generales" role="tabpanel" aria-labelledby="generales-tab">
            <div class="col-md-6 ">
              {{-- subOpcion Generales --}}
              <div class="x_panel">
                <div class="x_title">
                  <h2>Generales</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="TableGenerales">
                    @foreach ($generalesEmpresa as $general)
                      @if ($general->generales->modulo == 'generales')
                        <tr>
                          <td>
                            @if ($general->generales->checkbox == 1)
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="generales_check{{$general->id}}" name="generales_check{{$general->id}}" valorid="{{$general->id}}" @if($general->estado == true) checked @endif class="flat">&nbsp; {{$general->generales->nombre}}
                                </label>
                              </div>
                            @endif
                            @if ($general->generales->number == 1)
                              <div class="number">
                                <div class="col-md-2 col-sm-2" style="padding-left: 0px;">
                                  <input type="number" id="generales_number{{$general->id}}" name="generales_number{{$general->id}}" valorid="{{$general->id}}" value="{{$general->valor}}" class="form-control">
                                </div>
                                <div class="col-md-9 col-sm-9">
                                  <label>{{$general->generales->nombre}}</label>
                                </div>
                              </div>
                            @endif
                            @if ($general->generales->select == 1)
                              <div class="select">
                                <div class="form-group row">
                                  <div class="col-md-3 col-sm-3">
                                    <label>{{$general->generales->nombre}}</label>
                                  </div>
                                  <div class="col-md-7 col-sm-7">
                                    <select class="form-control" id="generales_select{{$general->id}}" name="generales_select{{$general->id}}" valorid="{{$general->id}}">
                                      <option value="">Seleccione...</option>
                                      <option value="1">Generales1</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            @endif
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  </table>
                </div>
              </div>
              {{-- Fin subOpcion Generales --}}

              {{-- Ventas --}}
              <div class="x_panel">
                <div class="x_title">
                  <h2>Ventas</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="TableVentas">
                    @foreach ($generalesEmpresa as $ventas)
                      @if ($ventas->generales->modulo == 'ventas')
                        <tr>
                          <td>
                            @if ($ventas->generales->checkbox == 1 && $ventas->generales->number == 0 && $ventas->generales->select == 0)
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="ventas_check{{$ventas->id}}" name="ventas_check{{$ventas->id}}" valorid="{{$ventas->id}}" @if($ventas->estado == true) checked @endif class="flat">&nbsp; {{$ventas->generales->nombre}}
                                </label>
                              </div>
                            @endif

                            @if ($ventas->generales->number == 1 && $ventas->generales->checkbox == 0 && $ventas->generales->select == 0)
                              <div class="number">
                                <div class="col-md-2 col-sm-2">
                                  <input type="number" id="ventas_number{{$ventas->id}}" name="ventas_number{{$ventas->id}}" valorid="{{$ventas->id}}" value="{{$ventas->valor}}" class="form-control">
                                </div>
                                @if ($ventas->generales->checkbox == 0)
                                  <div class="col-md-9 col-sm-9">
                                    <label>{{$ventas->generales->nombre}}</label>
                                  </div>
                                @endif
                              </div>
                            @endif

                            @if ($ventas->generales->select == 1 && $ventas->generales->checkbox == 0 && $ventas->generales->number == 0)
                              <div class="select">
                                <div class="form-group row">
                                  @if ($ventas->generales->checkbox == 0)
                                    <div class="col-md-3 col-sm-3">
                                      <label>{{$ventas->generales->nombre}}</label>
                                    </div>
                                  @endif
                                  <div class="col-md-7 col-sm-7">
                                    <select class="form-control" id="ventas_select{{$ventas->id}}" name="ventas_select{{$ventas->id}}" valorid="{{$ventas->id}}">
                                      <option value="">Seleccione...</option>
                                      @if ($ventas->nombre_id == 9)
                                        @for ($i = 1; $i <= $preciosVenta; $i++)
                                          <option @if ($i == $ventas->dato) selected @endif value="{{$i}}">Precio {{$i}}</option>
                                        @endfor
                                      @endif
                                    </select>
                                  </div>
                                </div>
                              </div>
                            @endif

                            @if ($ventas->generales->checkbox == 1 && $ventas->generales->number == 1 && $ventas->generales->select == 0)
                              <div class="checkbox number">
                                <div class="form-group">
                                  <div class="col-md-9 col-sm-9" style="padding-left: 0px;">
                                    <label>
                                      <input type="checkbox" id="ventas_check{{$ventas->id}}" name="ventas_check{{$ventas->id}}" valorid="{{$ventas->id}}" @if($ventas->estado == true) checked @endif class="flat">&nbsp; {{$ventas->generales->nombre}}
                                    </label>
                                  </div>
                                  <div class="col-md-2 col-sm-2">
                                    <input type="number" id="ventas_number{{$ventas->id}}" name="ventas_number{{$ventas->id}}" value="{{$ventas->valor}}" class="form-control">
                                  </div>
                                </div>
                              </div>
                            @endif

                            @if ($ventas->generales->checkbox == 1 && $ventas->generales->select == 1 && $ventas->generales->number == 0)
                              <div class="checkbox select">
                                <div class="form-group ">
                                  <div class="col-md-8 col-sm-8" style="padding-left: 0px;">
                                    <label>
                                        <input type="checkbox" id="ventas_check{{$ventas->id}}" name="ventas_check{{$ventas->id}}" valorid="{{$ventas->id}}" @if($ventas->estado == true) checked @endif class="flat">&nbsp; {{$ventas->generales->nombre}}
                                    </label>
                                  </div>
                                  <div class="col-md-4 col-sm-4">
                                    <select class="form-control" id="ventas_select{{$ventas->id}}" name="ventas_select{{$ventas->id}}">
                                      <option value="">Seleccione...</option>
                                      <option value="1">Opcion 1</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            @endif
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  </table>
                </div>
              </div>
              {{-- Fin Ventas --}}

            </div>
            <div class="col-md-6 ">
              {{-- Clientes y cuentas por cobrar --}}
							<div class="x_panel">
								<div class="x_title">
									<h2>Clientes y cuentas por cobrar</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
                  <table id="TableClientesCXC">
                    @foreach ($generalesEmpresa as $clientesCXC)
                      @if ($clientesCXC->generales->modulo == 'clientes y cuentas por cobrar')
                        <tr>
                          <td>
                            @if ($clientesCXC->generales->checkbox == 1 && $clientesCXC->generales->number == 0 && $clientesCXC->generales->select == 0)
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="clientesCXC_check{{$clientesCXC->id}}" name="clientesCXC_check{{$clientesCXC->id}}" valorid="{{$clientesCXC->id}}" @if($clientesCXC->estado == true) checked @endif class="flat">&nbsp; {{$clientesCXC->generales->nombre}}
                                </label>
                              </div>
                            @endif

                            @if ($clientesCXC->generales->number == 1 && $clientesCXC->generales->checkbox == 0 && $clientesCXC->generales->select == 0)
                              <div class="number">
                                @if ($clientesCXC->generales->checkbox == 0)
                                  <div class="col-md-5 col-sm-5" style="padding-left: 0px;">
                                    <label>{{$clientesCXC->generales->nombre}}</label>
                                  </div>
                                @endif
                                  <div class="col-md-2 col-sm-2">
                                  <input type="number" id="clientesCXC_number{{$clientesCXC->id}}" name="clientesCXC_number{{$clientesCXC->id}}" valorid="{{$clientesCXC->id}}" class="form-control">
                                </div>
                              </div>
                            @endif

                            @if ($clientesCXC->generales->select == 1 && $clientesCXC->generales->checkbox == 0 && $clientesCXC->generales->number == 0)
                              <div class="select">
                                <div class="form-group row">
                                  @if ($clientesCXC->generales->checkbox == 0)
                                    <div class="col-md-5 col-sm-5">
                                      <label>{{$clientesCXC->generales->nombre}}</label>
                                    </div>
                                  @endif
                                  <div class="col-md-7 col-sm-7">
                                    <select class="form-control" id="clientesCXC_select{{$clientesCXC->id}}" name="clientesCXC_select{{$clientesCXC->id}}" valorid="{{$clientesCXC->id}}">
                                      <option value="">Seleccione...</option>
                                      <option value="1">Opcion 1</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            @endif

                            @if ($clientesCXC->generales->checkbox == 1 && $clientesCXC->generales->number == 1 && $clientesCXC->generales->select == 0)
                              <div class="checkbox number">
                                <div class="form-group">
                                  <div class="col-md-9 col-sm-9" style="padding-left: 0px;">
                                    <label>
                                      <input type="checkbox" id="clientesCXC_check{{$clientesCXC->id}}" name="clientesCXC_check{{$clientesCXC->id}}" valorid="{{$clientesCXC->id}}" @if($clientesCXC->estado == true) checked @endif class="flat">&nbsp; {{$clientesCXC->generales->nombre}}
                                    </label>
                                  </div>
                                  <div class="col-md-2 col-sm-2">
                                      <input type="number" id="clientesCXC_number{{$clientesCXC->id}}" name="clientesCXC_number{{$clientesCXC->id}}" valorid="{{$clientesCXC->id}}" class="form-control">
                                  </div>
                                </div>
                              </div>

                            @endif

                            @if ($clientesCXC->generales->checkbox == 1 && $clientesCXC->generales->select == 1 && $clientesCXC->generales->number == 0)
                              <div class="checkbox select">
                                <div class="form-group ">
                                  <div class="col-md-8 col-sm-8" style="padding-left: 0px;">
                                    <label>
                                        <input type="checkbox" id="clientesCXC_check{{$clientesCXC->id}}" name="clientesCXC_check{{$clientesCXC->id}}" valorid="{{$clientesCXC->id}}" @if($clienteCXC->estado == true) checked @endif class="flat">&nbsp; {{$clientesCXC->generales->nombre}}
                                    </label>
                                  </div>
                                  <div class="col-md-4 col-sm-4">
                                    <select class="form-control" id="clientesCXC_select{{$clientesCXC->id}}" name="clientesCXC_select{{$clientesCXC->id}}" valorid="{{$clientesCXC->id}}">
                                      <option value="">Seleccione...</option>
                                      <option value="1">Opcion 1</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            @endif
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  </table>
                </div>
              </div>
              {{-- Fin Clientes y cuentas por cobrar --}}

              {{-- Inventarios y compras --}}
              <div class="x_panel">
                <div class="x_title">
                  <h2>Inventarios y compras</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="TableInventariosCompras">
                    @foreach ($generalesEmpresa as $inventariosCompras)
                      @if ($inventariosCompras->generales->modulo == 'inventarios y compras')
                        <tr>
                          <td>
                            @if ($inventariosCompras->generales->checkbox == 1 && $inventariosCompras->generales->number == 0 && $inventariosCompras->generales->select == 0)
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="inventariosCompras_check{{$inventariosCompras->id}}" name="inventariosCompras_check{{$inventariosCompras->id}}" valorid="{{$inventariosCompras->id}}" @if($inventariosCompras->estado == true) checked @endif class="flat">&nbsp; {{$inventariosCompras->generales->nombre}}
                                </label>
                              </div>
                            @endif

                            @if ($inventariosCompras->generales->number == 1 && $inventariosCompras->generales->checkbox == 0 && $inventariosCompras->generales->select == 0)
                              <div class="number">
                                @if ($inventariosCompras->generales->checkbox == 0)
                                  <div class="col-md-5 col-sm-5" style="padding-left: 0px;">
                                    <label>{{$inventariosCompras->generales->nombre}}</label>
                                  </div>
                                @endif
                                  <div class="col-md-2 col-sm-2">
                                  <input type="number" id="inventariosCompras_number{{$inventariosCompras->id}}" name="inventariosCompras_number{{$inventariosCompras->id}}" valorid="{{$inventariosCompras->id}}" class="form-control">
                                </div>
                              </div>
                            @endif

                            @if ($inventariosCompras->generales->select == 1 && $inventariosCompras->generales->checkbox == 0 && $inventariosCompras->generales->number == 0)
                              <div class="select">
                                <div class="form-group row">
                                  @if ($inventariosCompras->generales->checkbox == 0)
                                    <div class="col-md-5 col-sm-5">
                                      <label>{{$inventariosCompras->generales->nombre}}</label>
                                    </div>
                                  @endif
                                  <div class="col-md-7 col-sm-7">
                                    <select class="form-control" id="inventariosCompras_select{{$inventariosCompras->id}}" name="inventariosCompras_select{{$inventariosCompras->id}}" valorid="{{$inventariosCompras->id}}">
                                      <option value="">Seleccione...</option>
                                      <option value="1">Opcion 1</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            @endif

                            @if ($inventariosCompras->generales->checkbox == 1 && $inventariosCompras->generales->number == 1 && $inventariosCompras->generales->select == 0)
                              <div class="checkbox number">
                                <div class="form-group">
                                  <div class="col-md-9 col-sm-9" style="padding-left: 0px;">
                                    <label>
                                      <input type="checkbox" id="inventariosCompras_check{{$inventariosCompras->id}}" name="inventariosCompras_check{{$inventariosCompras->id}}" valorid="{{$inventariosCompras->id}}" @if($inventariosCompras->estado == true) checked @endif class="flat">&nbsp; {{$inventariosCompras->generales->nombre}}
                                    </label>
                                  </div>
                                  <div class="col-md-2 col-sm-2">
                                      <input type="number" id="inventariosCompras_number{{$inventariosCompras->id}}" name="inventariosCompras_number{{$inventariosCompras->id}}" valorid="{{$inventariosCompras->id}}" class="form-control">
                                  </div>
                                </div>
                              </div>
                            @endif

                            @if ($inventariosCompras->generales->checkbox == 1 && $inventariosCompras->generales->select == 1 && $inventariosCompras->generales->number == 0)
                              <div class="checkbox select">
                                <div class="form-group ">
                                  <div class="col-md-8 col-sm-8" style="padding-left: 0px;">
                                    <label>
                                        <input type="checkbox" id="inventariosCompras_check{{$inventariosCompras->id}}" name="inventariosCompras_check{{$inventariosCompras->id}}" valorid="{{$inventariosCompras->id}}" class="flat">&nbsp; {{$inventariosCompras->generales->nombre}}
                                    </label>
                                  </div>
                                  <div class="col-md-4 col-sm-4">
                                    <select class="form-control" id="inventariosCompras_select{{$inventariosCompras->id}}" name="inventariosCompras_select{{$inventariosCompras->id}}" valorid="{{$inventariosCompras->id}}">
                                      <option value="">Seleccione...</option>
                                      <option value="1">Opcion 1</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            @endif
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  </table>
                </div>
              </div>
              {{--  Fin Inventarios y compras --}}

              {{-- Alertas --}}
              <div class="x_panel">
                <div class="x_title">
                  <h2>Alertas</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="TableAlertas">
                    @foreach ($generalesEmpresa as $alerta)
                      @if ($alerta->generales->modulo == 'alertas')
                        <tr>
                          <td>
                            @if ($alerta->generales->checkbox == 1)
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="alertas_check{{$alerta->id}}" name="alertas_check{{$alerta->id}}" valorid="{{$alerta->id}}" @if($alerta->estado == true) checked @endif class="flat">&nbsp; {{$alerta->generales->nombre}}
                                </label>
                              </div>
                            @endif
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  </table>
                </div>
              </div>
              {{-- Alertas --}}

              {{-- Actualizaciones personalizadas --}}
              <div class="x_panel">
                  {{-- <div class="x_title"> --}}
                    {{-- <h2>Alertas</h2> --}}
                    {{-- <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul> --}}
                    {{-- <div class="clearfix"></div> --}}
                    <input type="button" value="Actualizaciones personalizadas">
                  {{-- </div> --}}
              </div>
              {{-- Fin Actualizaciones personalizadas --}}
            </div>
          </div>
          {{-- Fin Pestaña Generales --}}

          {{-- Pestaña Impresiones --}}
          <div class="tab-pane fade" id="impresiones" role="tabpanel" aria-labelledby="impresiones-tab">
            {{-- Boton --}}
            <div class="text-left">
              <a href="" data-toggle="modal" data-remote="false" data-toggle="tooltip"  title="Crear nuevo registro" class="btn .btn-lg btn-primary crearConfg_impresora">CREAR NUEVO</a>
              @include('Comercio.Administracion.ParametrosGenerales.crearConfigImpresora')
              @include('Comercio.Administracion.ParametrosGenerales.editarConfigImpresora')
            </div>
            <hr>

            &nbsp;
            {{-- Tabla impresiones --}}
            <div class="x_content">
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-box table-responsive">
                    <table id="listadoImpresiones" class="table table-striped table-bordered dataTable no-footer table-hover" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                      <thead>
                        <tr role="row">
                            <th class="sorting_asc" aria-sort="ascending" style="width: 25%;">DOCUMENTO</th>
                            <th class="sorting" style="width: 25%;">SERIE</th>
                            <th class="sorting" style="width: 25%;"><center>DISEÑO A USAR</center></th>
                            <th class="sorting" style="width: 25%;"><center>IMPRESORA A USAR</center></th>
                            <th class="sorting" style="width: 25%;">MARGEN SUP</th>
                            <th class="sorting" style="width: 25%;"><center>MARGEN IZQ</center></th>
                            <th class="sorting" style="width: 25%;"><center>COPIAS</center></th>
                            <th class="sorting" style="width: 25%;"><center>EN 1 HOJA</center></th>
                            <th class="sorting" style="width: 25%;"><center>USAR RIDE</center></th>
                            <th class="sorting" style="width: 25%;"><center>NOMBRES COMPLETOS</center></th>
                            <th class="sorting" style="width: 25%;"><center>ACCCIONES</center></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            {{-- Fin Tabla impresiones --}}
          </div>
          {{-- Fin Pestaña Impresiones --}}

          {{-- Pestaña Facturación Electrónica --}}
          <div class="tab-pane fade" id="fe" role="tabpanel" aria-labelledby="fe-tab">
            <div class="col-md-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Rutas para comprobantes electrónicos</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                {{-- <div class="x_content">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Ruta RIDE:</label>
                          </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="form-group">
                            </label><input type="file" id="ruta_ride" name="ruta_ride">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Ruta firma:</label>
                          </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="form-group">
                            </label><input type="file" id="ruta_firma" name="ruta_firma">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Ruta logo RIDE:</label>
                          </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="form-group">
                            </label><input type="file" id="ruta_logo" name="ruta_logo">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Certificado</label>
                          </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="form-group">
                            <select class="form-control" id="certificado" name="certificado">
                              <option>Seleccione...</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <input type="button" value="Ver info">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Password firma:</label>
                          </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="form-group">
                            <input class="form-control" id="password" name="password" type="password">
                          </div>
                          <div class="form-group">
                            <label class="control-label">Fecha caducidad firma:</label>
                          </div>
                          <div class="form-group">
                            <input class="form-control" id="fecha_caducidad_pass" name="fecha_caducidad_pass" class='date' type="date">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Ocultar el código de los productos facturados:</label>
                          </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="form-group">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" id="ocultar_cod_product" name="ocultar_cod_product" class="flat">
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Firmar y enviar manualmente:</label>
                          </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="form-group">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" id="firmar_enviar" name="firmar_enviar" class="flat">
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> --}}
                <div class="x_content">
                  <table id="TableFeCbte">
                    @foreach ($generalesEmpresa as $FeCbte)
                      @if ($FeCbte->generales->modulo == 'fe_cbte')
                        <tr>
                          <td>
                            @if ($FeCbte->generales->file == 1)
                              <div class="file">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>{{$FeCbte->generales->nombre}}</label>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <input type="file" id="FeCbte_file{{$FeCbte->id}}" name="FeCbte_file{{$FeCbte->id}}" valorid="{{$FeCbte->id}}">
                                  </div>
                                </div>
                                @if ($FeCbte->file != Null)
                                  <div class="col-lg-4">
                                    <a target="_blank" href="{{asset('files/'.$FeCbte->file)}}">Descargar archivo {{$FeCbte->file}} - {{$FeCbte->generales->nombre}}</a>
                                  </div>
                                @endif

                              </div>
                            @endif

                            @if ($FeCbte->generales->select == 1)
                              <div class="select">
                                <div class="form-group">
                                  @if ($FeCbte->generales->checkbox == 0)
                                    <div class="col-md-4">
                                      <label>{{$FeCbte->generales->nombre}}</label>
                                    </div>
                                  @endif
                                    <div class="col-lg-5">
                                      <select class="form-control" id="FeCbte_select{{$FeCbte->id}}" name="FeCbte_select{{$FeCbte->id}}" valorid="{{$FeCbte->id}}">
                                        <option value="">Seleccione...</option>
                                        <option value="1">Opcion 1</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <input type="button" value="Ver info">
                                    </div>
                                </div>
                              </div>
                            @endif

                            @if ($FeCbte->generales->password == 1)
                              <div class="password">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>{{$FeCbte->generales->nombre}}</label>
                                  </div>
                                </div>
                                <div class="col-lg-5">
                                  <div class="form-group">
                                    <input type="password" id="FeCbte_password{{$FeCbte->id}}" name="FeCbte_password{{$FeCbte->id}}" valorid="{{$FeCbte->id}}" class="form-control">
                                  </div>
                                </div>
                              </div>
                            @endif

                            @if ($FeCbte->generales->date == 1)
                              <div class="date">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>{{$FeCbte->generales->nombre}}</label>
                                  </div>
                                </div>
                                <div class="col-lg-5">
                                  <div class="form-group">
                                    <input type="date" id="FeCbte_date{{$FeCbte->id}}" name="FeCbte_date{{$FeCbte->id}}" valorid="{{$FeCbte->id}}" value="{{$FeCbte->date}}" class="form-control">
                                  </div>
                                </div>
                              </div>
                            @endif

                            @if ($FeCbte->generales->checkbox == 1)
                              <div class="checkbox">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="control-label">{{$FeCbte->generales->nombre}}</label>
                                  </div>
                                </div>
                                <div class="col-lg-5">
                                  <div class="form-group">
                                    <input type="checkbox" id="FeCbte_checkbox{{$FeCbte->id}}" name="FeCbte_checkbox{{$FeCbte->id}}" valorid="{{$FeCbte->id}}"  @if($FeCbte->estado == 1) checked @endif  class="flat">
                                  </div>
                                </div>
                              </div>
                            @endif
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Información de la cuenta de correo electrónico</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  {{-- <table id="TableInfoCuentasEmail">
                      <tr>
                        <td>
                          <div class="select">
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-group">
                                  <label class="control-label">Servidor de correo:</label>
                                </div>
                              </div>
                              <div class="col-lg-7">
                                <div class="form-group">
                                  <select class="form-control" id="servidor_correo" name="servidor_correo">
                                      <option>Seleccione...</option>
                                    </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="number">
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-group">
                                  <label class="control-label">Puerto del servidor:</label>
                                </div>
                              </div>
                              <div class="col-lg-7">
                                <div class="form-group">
                                  <input type="number" id="puerto_servidor" name="puerto_servidor" valorid="" value="" class="form-control">
                                </div>
                              </div>
                            </div>
                          </div>

                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="number">
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-group">
                                  <label class="control-label">Tiempo de espera:</label>
                                </div>
                              </div>
                              <div class="col-lg-7">
                                <div class="form-group">
                                  <input type="number" id="tiempo_espera" name="tiempo_espera" valorid="" value="" class="form-control">Segundos
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="text">
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-group">
                                  <label class="control-label">Nombre del remitente:</label>
                                </div>
                              </div>
                              <div class="col-lg-7">
                                <div class="form-group">
                                  <input type="text" id="nombre_remitente" name="nombre_remitente" value="" class="form-control">
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="text">
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-group">
                                  <label class="control-label">Dirección del remitente:</label>
                                </div>
                              </div>
                              <div class="col-lg-7">
                                <div class="form-group">
                                  <input type="email" id="direccion_remitente" name="direccion_remitente" value="" class="form-control">
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="text">
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-group">
                                  <label class="control-label">Nombre de usuario:</label>
                                </div>
                              </div>
                              <div class="col-lg-7">
                                <div class="form-group">
                                  <input type="email" id="nombre_usuario" name="nombre_usuario" value="" class="form-control">
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="text">
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-group">
                                  <label class="control-label">Contraseña:</label>
                                </div>
                              </div>
                              <div class="col-lg-7">
                                <div class="form-group">
                                  <input type="password" id="password_usuario" name="password_usuario" value="" class="form-control">
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="select">
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-group">
                                  <label class="control-label">Usar SSL:</label>
                                </div>
                              </div>
                              <div class="col-lg-7">
                                <div class="form-group">
                                  <select class="form-control" id="ssl" name="ssl">
                                      <option value="">Seleccione...</option>
                                      <option value="1">SI</option>
                                      <option value="0">NO</option>
                                    </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-group">
                            <input type="button" value="Enviar email de prueba">
                          </div>
                        </td>
                      </tr>
                  </table> --}}
                </div>
                <div class="x_content">
                  <table id="TableInfoCuentasEmail">
                    @foreach ($generalesEmpresa as $Fe_info_acount_email)
                      @if ($Fe_info_acount_email->generales->modulo == 'fe_info_acount_email')
                        <tr>
                          <td>
                            @if ($Fe_info_acount_email->generales->select == 1)
                              <div class="select">
                                <div class="form-group">
                                  @if ($Fe_info_acount_email->generales->checkbox == 0)
                                    <div class="col-md-5">
                                      <label>{{$Fe_info_acount_email->generales->nombre}}</label>
                                    </div>
                                  @endif
                                  @if ($Fe_info_acount_email->nombre_id == 55) {{-- Servidor de correo --}}
                                  <div class="col-lg-7">
                                    <select class="form-control" id="Fe_info_acount_email_select{{$Fe_info_acount_email->id}}" name="Fe_info_acount_email_select{{$Fe_info_acount_email->id}}" valorid="{{$Fe_info_acount_email->id}}">
                                      <option value="">Seleccione...</option>
                                      @foreach ($TipoServidorMail as $ServidorMail)
                                        <option @if ($ServidorMail->id == $generalesEmpresa->firstWhere('nombre_id', 55)->dato) selected @endif value="{{$ServidorMail->id}}" valorid="{{$ServidorMail->id}}">{{$ServidorMail->nombre}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  @endif
                                  @if ($Fe_info_acount_email->nombre_id == 62) {{-- Usar SSL --}}
                                  <div class="col-lg-7">
                                    <select class="form-control" id="Fe_info_acount_email_select{{$Fe_info_acount_email->id}}" name="Fe_info_acount_email_select{{$Fe_info_acount_email->id}}" valorid="{{$Fe_info_acount_email->id}}">
                                      <option value="">Seleccione...</option>
                                      <option @if (1 == $generalesEmpresa->firstWhere('nombre_id', 62)->dato) selected @endif  value="1">SI</option>
                                      <option @if (0 == $generalesEmpresa->firstWhere('nombre_id', 62)->dato) selected @endif value="0">NO</option>
                                    </select>
                                  </div>
                                  @endif
                                </div>
                              </div>
                            @endif

                            @if ($Fe_info_acount_email->generales->number == 1)
                              <div class="number">
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label>{{$Fe_info_acount_email->generales->nombre}}</label>
                                  </div>
                                </div>
                                <div class="col-lg-7">
                                  <div class="form-group">
                                    <input type="number" id="Fe_info_acount_email_number{{$Fe_info_acount_email->id}}" name="Fe_info_acount_email_password{{$Fe_info_acount_email->id}}" valorid="{{$Fe_info_acount_email->id}}" value="{{$Fe_info_acount_email->valor}}" class="form-control">
                                  </div>
                                </div>
                              </div>
                            @endif

                            @if ($Fe_info_acount_email->generales->text == 1)
                              <div class="text">
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label>{{$Fe_info_acount_email->generales->nombre}}</label>
                                  </div>
                                </div>
                                <div class="col-lg-7">
                                  <div class="form-group">
                                    <input type="text" id="Fe_info_acount_email_text{{$Fe_info_acount_email->id}}" name="Fe_info_acount_email_password{{$Fe_info_acount_email->id}}" valorid="{{$Fe_info_acount_email->id}}" value="{{$Fe_info_acount_email->file}}" class="form-control">
                                  </div>
                                </div>
                              </div>
                            @endif

                            @if ($Fe_info_acount_email->generales->password == 1)
                              <div class="password">
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label>{{$Fe_info_acount_email->generales->nombre}}</label>
                                  </div>
                                </div>
                                <div class="col-lg-7">
                                  <div class="form-group">
                                    <input type="password" id="Fe_info_acount_email_password{{$Fe_info_acount_email->id}}" name="Fe_info_acount_email_password{{$Fe_info_acount_email->id}}" valorid="{{$Fe_info_acount_email->id}}" class="form-control">
                                  </div>
                                </div>
                              </div>
                            @endif
                          </td>
                        </tr>
                      @endif
                    @endforeach
                    <tr>
                      <td>
                        <div class="form-group">
                          <input type="button" value="Enviar email de prueba">
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Emitir comprobante de correo electrónico para</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  {{-- <table id="TableCbteElectronico">
                    <tr>
                      <td>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" id="facturas_cbte_venta" name="facturas_cbte_venta"  class="flat" @if($FacturacionElectronica3->facturas_cbte_venta == 1) checked @endif>&nbsp;Facturas o comprobantes de venta
                            </label>
                          </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" id="retencion_compras" name="retencion_compras"  class="flat" @if($FacturacionElectronica3->retencion_compras == 1) checked @endif>&nbsp;Retención sobre compras
                            </label>
                          </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" id="guias_remision" name="guias_remision"  class="flat" @if($FacturacionElectronica3->guias_remision == 1) checked @endif>&nbsp;Guias de remisión
                            </label>
                          </div>
                      </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" id="notas_credito" name="notas_credito"  class="flat" @if($FacturacionElectronica3->notas_credito == 1) checked @endif>&nbsp;Notas de crédito
                              </label>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="number">
                            No. decimales factura <input type="number" id="decimales_factura" name="decimales_factura" class="flat" value="{{$FacturacionElectronica3->decimales_factura}}">
                          </div>
                        </td>
                      </tr>
                  </table> --}}
                  <table id="TableCbteElectronico">
                    @foreach ($generalesEmpresa as $fe_emitir_cbte)
                      @if ($fe_emitir_cbte->generales->modulo == 'fe_emitir_cbte')
                        <tr>
                          <td>
                            @if ($fe_emitir_cbte->generales->checkbox == 1)
                              <div class="checkbox">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label">{{$fe_emitir_cbte->generales->nombre}}</label>
                                  </div>
                                </div>
                                <div class="col-lg-5">
                                  <div class="form-group">
                                    <input type="checkbox" id="fe_emitir_cbte_checkbox{{$fe_emitir_cbte->id}}" name="fe_emitir_cbte_checkbox{{$fe_emitir_cbte->id}}" valorid="{{$fe_emitir_cbte->id}}"  @if($fe_emitir_cbte->estado == 1) checked @endif class="flat">
                                  </div>
                                </div>
                              </div>
                            @endif
                            @if ($fe_emitir_cbte->generales->number == 1)
                            <div class="number">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">{{$fe_emitir_cbte->generales->nombre}}</label>
                                </div>
                              </div>
                              <div class="col-lg-5">
                                <div class="form-group">
                                  <input type="number" id="fe_emitir_cbte_number{{$Fe_info_acount_email->id}}" name="fe_emitir_cbte_number{{$Fe_info_acount_email->id}}" valorid="{{$Fe_info_acount_email->id}}" value="{{$fe_emitir_cbte->valor}}" class="form-control">
                                </div>
                              </div>
                            </div>
                          @endif
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  </table>
                </div>
              </div>
            </div>
          {{-- Fin Pestaña Facturación Electrónica --}}

        </div>
      </div>
  </div>
  <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
</div>

</form>

@include('Comercio.Administracion.ParametrosGenerales.crearConfgDocs')
@include('Comercio.Administracion.ParametrosGenerales.editarConfgDocs')
@endsection

@section('imports')
<!-- DataTables -->
<script src="{{ asset('gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- extension responsive -->
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script>
//   $(document).ready( function() {
//     $('.select2').select2();
//   });
// </script>

{{-- CARGUES INICALES --}}
<script>
  $(document).ready(function () {
    habilitar(0);
    $('#listado').DataTable({
      "language":{url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
      "processing":true,
      "serverSide":true,
      "ajax":{
        url:"{{route('GetDocumentos')}}",
      },
      "columns":[
        {data:'comprobantes.nombre'},
        {data:'num_serie2'},
        {data:'num_serie1'},
        {data:'autorizacion_sri'},
        {data:'ultimo_num'},
        {data:'fecha_caducidad'},
        {data:'acciones'},

      ]
    });
  });
</script>

{{-- IMPRESIONES --}}
<script>
  $('.comprobante').change(function(){
    var comprobante = $('#comprobanteImpresion').val();
    if (comprobante != '') {
      var ruta = "{{asset('comercio/consultar_series')}}"+'/'+comprobante;
      $.ajax({
        url: ruta,
        type:'GET',
        dataType: 'json',
      }).done(function(res){
        $("#series").empty();
        $.each(res, function(key, value){
          $("#series").append('<option value='+value.id+'>'+value.num_serie1+' - '+value.num_serie2+'</option>');
        });
      }).fail(function(msg){
        toastr["error"]("Fallo al cargar series", "Error");
      });
    } else {
      $("#series").empty();
      $("#series").append('<option value="" selected >SELECCIONE...</option>');
    }
  });
  $('.comprobante2').change(function(){
    var comprobante = $('#comprobanteImpresion2').val();
    if (comprobante != '') {
      var ruta = "{{asset('comercio/consultar_series')}}"+'/'+comprobante;
      $.ajax({
        url: ruta,
        type:'GET',
        dataType: 'json',
      }).done(function(res){
        $("#series2").empty();
        $.each(res, function(key, value){
          $("#series2").append('<option value='+value.id+'>'+value.num_serie1+' - '+value.num_serie2+'</option>');
        });
      }).fail(function(msg){
        toastr["error"]("Fallo al cargar series", "Error");
      });
    } else {
      $("#series2").empty();
      $("#series2").append('<option value="" selected >SELECCIONE...</option>');
    }
  });
</script>
{{-- IMPRESIONES --}}

{{-- GUARDADO GENERAL --}}
<script>
  $("#guardadoGeneral").on("submit", function(e){
    e.preventDefault();
    // Métodos del guardado...
    envio();
  });

  // FUNCIÓN DE ENVIO INFO
  function envio(){
    // loading();
    var formData = new FormData($('#guardadoGeneral')[0]);

    var ConfigDocs = new Array();
    var ConfigDocs = TableConfigDocs();

    var GeneralesGenerales = new Array();
    var GeneralesGenerales = TableGenerales();

    var GeneralesVentas = new Array();
    var GeneralesVentas = TableVentas();

    var GeneralesClientesCXC = new Array();
    var GeneralesClientesCXC = TableClientesCXC();

    var GeneralesInventariosCompras = new Array();
    var GeneralesInventariosCompras = TableInventariosCompras();

    var GeneralesAlertas = new Array();
    var GeneralesAlertas = TableAlertas();

    var FeCbte = new Array();
    var FeCbte = TableFeCbte();

    var InfoCuentasEmail = new Array();
    var InfoCuentasEmail = TableInfoCuentasEmail();

    var FECbteElectronico = new Array();
    var FECbteElectronico = TableCbteElectronico();

    formData.append("ConfigDocs",JSON.stringify(ConfigDocs));
    formData.append("GeneralesGenerales",JSON.stringify(GeneralesGenerales));
    formData.append("GeneralesVentas",JSON.stringify(GeneralesVentas));
    formData.append("GeneralesClientesCXC",JSON.stringify(GeneralesClientesCXC));
    formData.append("GeneralesInventariosCompras",JSON.stringify(GeneralesInventariosCompras));
    formData.append("GeneralesAlertas",JSON.stringify(GeneralesAlertas));
    formData.append("FeCbte",JSON.stringify(FeCbte));
    formData.append("InfoCuentasEmail",JSON.stringify(InfoCuentasEmail));
    formData.append("FECbteElectronico",JSON.stringify(FECbteElectronico));
    formData.append("rutaRIDE",document.getElementById('FeCbte_file48'));
    formData.append("rutaFirma",document.getElementById('FeCbte_file49'));
    formData.append("rutaFirma",document.getElementById('FeCbte_file50'));

    // ENVIO AJAX
    var routeEnvio = "{{asset('parametros_generales_guardar')}}";
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
        $('#FeCbte_file48').val('');
        $('#FeCbte_file49').val('');
        $('#FeCbte_file50').val('');
        toastr["success"](res.mensaje,"Guardado");
      }
    }).fail(function(msg){
      // loading();
      $.each(msg.responseJSON.errors, function(key, value){
          toastr["error"](value,"Error");
      });
    });
  }
</script>
{{-- FIN GUARDADO GENERAL --}}

{{-- CAPTURAR DATOS DE TABLAS PESTAÑA CONFIG DE DOCS --}}
<script>
  // CONSTRUCCIÓN DE ARRAY DE REGISTROS TABLA TableConfigDocs
  function TableConfigDocs(){
    var arreglo_mayor = new Array();
    var lineas = new Array();

    $('#TableConfigDocs tbody tr').each(function(){
      lineas.push({otros: $(this)});
    });
    // Cargar los datos
    for(var i=0; i < lineas.length; i++){
      arreglo_mayor.push({
        indice: i+1,
        select: $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).val(),
        tipo:   $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).attr('id'),
      })
    }
    return arreglo_mayor;
  }
</script>
{{-- CAPTURAR DATOS DE TABLAS PESTAÑA GENERALES --}}
<script>
  // CONSTRUCCIÓN DE ARRAY DE REGISTROS TABLA TableGenerales
  function TableGenerales(){
    var arreglo_mayor = new Array();
    var lineas = new Array();

    $('#TableGenerales tbody tr').each(function(){
      lineas.push({otros: $(this)});
    });
    // Cargar los datos
    for(var i=0; i < lineas.length; i++){
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'checkbox' ||$(lineas[i].otros[0].children[0].children[0]).attr("class") == 'checkbox selected') {
        arreglo_mayor.push({
          indice: i+1,
          check:  $(lineas[i].otros[0].children[0].children[0].children[0].children[0].children[0]).prop('checked'),
          id:     $(lineas[i].otros[0].children[0].children[0].children[0].children[0].children[0]).attr("valorid"),
        })
      }
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'number'){
        arreglo_mayor.push({
          indice: i+1,
          number: $(lineas[i].otros[0].children[0].children[0].children[0].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[0].children[0]).attr("valorid"),
        })
      }
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'select'){
        arreglo_mayor.push({
          indice: i+1,
          select: $(lineas[i].otros[0].children[0].children[0].children[0].children[1].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[0].children[1].children[0]).attr("valorid"),
        })
      }
    }
    return arreglo_mayor;
  }

  // CONSTRUCCIÓN DE ARRAY DE REGISTROS TABLA TableVentas
  function TableVentas(){
    var arreglo_mayor = new Array();
    var lineas = new Array();

    $('#TableVentas tbody tr').each(function(){
      lineas.push({otros: $(this)});
    });
    // Cargar los datos
    for(var i=0; i < lineas.length; i++){
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'checkbox' ||$(lineas[i].otros[0].children[0].children[0]).attr("class") == 'checkbox selected') {
        arreglo_mayor.push({
          indice: i+1,
          check:  $(lineas[i].otros[0].children[0].children[0].children[0].children[0].children[0]).prop('checked'),
          id:     $(lineas[i].otros[0].children[0].children[0].children[0].children[0].children[0]).attr("valorid"),
        })
      }
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'select'){
        arreglo_mayor.push({
          indice: i+1,
          select: $(lineas[i].otros[0].children[0].children[0].children[0].children[1].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[0].children[1].children[0]).attr("valorid"),
        })
      }
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'checkbox number'){
        arreglo_mayor.push({
          indice: i+1,
          check:  $(lineas[i].otros[0].children[0].children[0].children[0].children[0].children[0].children[0].children[0]).prop('checked'),
          number: $(lineas[i].otros[0].children[0].children[0].children[0].children[1].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[0].children[0].children[0].children[0].children[0]).attr("valorid"),
        })
      }
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'checkbox select'){
        arreglo_mayor.push({
          indice: i+1,
          check:  $(lineas[i].otros[0].children[0].children[0].children[0].children[0].children[0].children[0].children[0]).prop('checked'),
          select: $(lineas[i].otros[0].children[0].children[0].children[0].children[1].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[0].children[0].children[0].children[0].children[0]).attr("valorid"),
        })
      }

    }
    return arreglo_mayor;
  }

  // CONSTRUCCIÓN DE ARRAY DE REGISTROS TABLA TableClientesCXC
  function TableClientesCXC(){
    var arreglo_mayor = new Array();
    var lineas = new Array();

    $('#TableClientesCXC tbody tr').each(function(){
      lineas.push({otros: $(this)});
    });
    // Cargar los datos
    for(var i=0; i < lineas.length; i++){
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'checkbox' ||$(lineas[i].otros[0].children[0].children[0]).attr("class") == 'checkbox selected') {
        arreglo_mayor.push({
          indice: i+1,
          check:  $(lineas[i].otros[0].children[0].children[0].children[0].children[0].children[0]).prop('checked'),
          id:     $(lineas[i].otros[0].children[0].children[0].children[0].children[0].children[0]).attr("valorid"),
        })
      }
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'number'){
        arreglo_mayor.push({
          indice: i+1,
          number: $(lineas[i].otros[0].children[0].children[0].children[1].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[1].children[0]).attr("valorid"),
        })
      }
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'select'){
        arreglo_mayor.push({
          indice: i+1,
          select: $(lineas[i].otros[0].children[0].children[0].children[0].children[1].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[0].children[1].children[0]).attr("valorid"),
        })
      }
    }
    return arreglo_mayor;
  }

  // CONSTRUCCIÓN DE ARRAY DE REGISTROS TABLA TableInventariosCompras
  function TableInventariosCompras(){
    var arreglo_mayor = new Array();
    var lineas = new Array();

    $('#TableInventariosCompras tbody tr').each(function(){
      lineas.push({otros: $(this)});
    });
    // Cargar los datos
    for(var i=0; i < lineas.length; i++){
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'checkbox' ||$(lineas[i].otros[0].children[0].children[0]).attr("class") == 'checkbox selected') {
        arreglo_mayor.push({
          indice: i+1,
          check:  $(lineas[i].otros[0].children[0].children[0].children[0].children[0].children[0]).prop('checked'),
          id:     $(lineas[i].otros[0].children[0].children[0].children[0].children[0].children[0]).attr("valorid"),
        })
      }
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'number'){
        arreglo_mayor.push({
          indice: i+1,
          number: $(lineas[i].otros[0].children[0].children[0].children[1].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[1].children[0]).attr("valorid"),
        })
      }
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'select'){
        arreglo_mayor.push({
          indice: i+1,
          select: $(lineas[i].otros[0].children[0].children[0].children[0].children[1].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[0].children[1].children[0]).attr("valorid"),
        })
      }
    }
    return arreglo_mayor;
  }

  // CONSTRUCCIÓN DE ARRAY DE REGISTROS TABLA TableAlertas
  function TableAlertas(){
      var arreglo_mayor = new Array();
      var lineas = new Array();

      $('#TableAlertas tbody tr').each(function(){
        lineas.push({otros: $(this)});
      });

      // Cargar los datos
      for(var i=0; i < lineas.length; i++){
        arreglo_mayor.push({
          indice: i+1,
          check:  $(lineas[i].otros[0].children[0].children[0].children[0].children[0].children[0]).prop('checked'),
          id:     $(lineas[i].otros[0].children[0].children[0].children[0].children[0].children[0]).attr("valorid"),
        })
      }
      return arreglo_mayor;
  }

  // CONSTRUCCIÓN DE ARRAY DE REGISTROS TABLA TableInfoCuentasEmail
  function TableFeCbte(){
    var arreglo_mayor = new Array();
    var lineas = new Array();

    $('#TableFeCbte tbody tr').each(function(){
      lineas.push({otros: $(this)});
    });
    // Cargar los datos
    for(var i=0; i < lineas.length; i++){
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'file'){
        arreglo_mayor.push({
          indice: i+1,
          file:   $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).prop('files'),
          id:     $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).attr("valorid"),
        })
      }
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'select' ){
        arreglo_mayor.push({
          indice: i+1,
          select: $(lineas[i].otros[0].children[0].children[0].children[0].children[1].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[0].children[1].children[0]).attr("valorid"),
        })
      }
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'password' ){
        arreglo_mayor.push({
          indice:   i+1,
          password: $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).val(),
          id:       $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).attr("valorid"),
        })
      }

      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'date' ){
        arreglo_mayor.push({
          indice: i+1,
          date:   $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).attr("valorid"),
        })
      }
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'checkbox' ){
        arreglo_mayor.push({
          indice: i+1,
          check:  $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0].children[0]).prop('checked'),
          id:     $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0].children[0]).attr("valorid"),
        })
      }
    }
    return arreglo_mayor;
  }

  // CONSTRUCCIÓN DE ARRAY DE REGISTROS TABLA TableInfoCuentasEmail
  function TableInfoCuentasEmail(){
    var arreglo_mayor = new Array();
    var lineas = new Array();

    $('#TableInfoCuentasEmail tbody tr').each(function(){
      lineas.push({otros: $(this)});
    });
    // Cargar los datos
    for(var i=0; i < lineas.length; i++){
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'select' ){
        arreglo_mayor.push({
          indice: i+1,
          select: $(lineas[i].otros[0].children[0].children[0].children[0].children[1].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[0].children[1].children[0]).attr("valorid"),
        })
      }

      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'number' ){
        arreglo_mayor.push({
          indice: i+1,
          number: $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).attr("valorid"),
        })
      }

      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'text' ){
        arreglo_mayor.push({
          indice: i+1,
          text: $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).attr("valorid"),
        })
      }
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'password' ){
        arreglo_mayor.push({
          indice:   i+1,
          password: $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).val(),
          id:       $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).attr("valorid"),
        })
      }
    }
    return arreglo_mayor;
  }

  // CONSTRUCCIÓN DE ARRAY DE REGISTROS TABLA TableCbteElectronico
  function TableCbteElectronico(){
    var arreglo_mayor = new Array();
    var lineas = new Array();

    $('#TableCbteElectronico tbody tr').each(function(){
      lineas.push({otros: $(this)});
    });
    // Cargar los datos
    for(var i=0; i < lineas.length; i++){
      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'checkbox' ){
        arreglo_mayor.push({
          indice: i+1,
          check:  $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0].children[0]).prop('checked'),
          id:     $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0].children[0]).attr("valorid"),
        })
      }

      if($(lineas[i].otros[0].children[0].children[0]).attr("class") == 'number' ){
        arreglo_mayor.push({
          indice: i+1,
          number: $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).val(),
          id:     $(lineas[i].otros[0].children[0].children[0].children[1].children[0].children[0]).attr("valorid"),
        })
      }
    }
    return arreglo_mayor;
  }
</script>

{{-- CONFIGURACION DE DOCUMENTOS --}}
{{-- CREACION CONFIG DOCS --}}
<script>
  // Funcion para abrir modal crear
  $(document).on('click', '.crearConfg_docs', function(event){
    $("#myModalCrear1").modal('show');
    // Cancelar creacion
    $("#myModalCrear1 .modalCLose1").click(function(){
      limpiarCampos1();
    });
  });
//   $("#crearConfgDocs").on("submit", function(e){
  $(document).on('click','#crearConfg', function(e){
    e.preventDefault();
    // loading();
    var f = $(this);
    var formData = new FormData(document.getElementById("crearConfgDocumentos"));
    var route = "{{asset('comercio/parametros/config_docs/crear')}}";
    var token = $("#token").val();

    $.ajax({
      url: route,
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
        // loading();
        toastr["error"](res.mensaje, "Error");
        $("#myModalCrear1").modal('show');
      }else{
        // loading();
        limpiarCampos1();
        $("#myModalCrear1").modal('hide');
        toastr["success"](res.mensaje,"Registro exitoso");
        $("#listado").DataTable().ajax.reload();
      }
    })
    .fail(function(msg){
      // loading();
      $.each(msg.responseJSON.errors, function(key, value){
        toastr["error"](value,"Error");
        $("#myModalCrear1").modal('show');
      });
    });
  });
  function limpiarCampos1(){
    document.getElementById("crearConfgDocumentos").reset();
  }
</script>
{{-- EDICION CONFIG DOCS --}}
<script>
  // Funcion para abrir modal editar
  function add(dato) {
    // ENVIO AJAX
    var id = $("#id").val();
    var routeEnvio = "{{asset('comercio/paramteros/config_docs/editar')}}"+'/'+dato.id;
    var token = $("#token").val();
    limpiarCampos1_1();
    $.ajax({
        url: routeEnvio,
        type: 'GET',
        dataType: 'json',
    }).done(function(res){
      if(res.respuesta == 0){
        toastr["error"](res.mensaje, "Fallo al cargar edición de Documento", "¡Error!");
      }else{
        $("#comprobante2").empty();
        $("#tipo_comprobante2").empty();
        $.each(res.comprobantes, function(key, value){
          $("#comprobante2").append('<option value='+value.id+'>'+value.nombre+'</option>');
        });
        $("#tipo_comprobante2").append('<option value=1>Comprobante Electrónico</option>');
        $("#tipo_comprobante2").append('<option value=0>Comprobante Físico</option>');

        $("#comprobante2").val(res.comprobante).trigger("change");
        $("#numSerie12").val(res.numSerie1);
        $("#numSerie22").val(res.numSerie2);
        $("#tipo_comprobante2").val(res.tipo_comprobante).trigger("change");
        $("#autorizacionSRI2").val(res.autorizacion_sri);
        $("#ultimoNum2").val(res.ultimo_num);
        $("#fechaCaducidad2").val(res.fecha_caducidad);
        $("#id2").val(res.id);
        $("#myModalEditar1").modal('show');
      }

    }).fail(function(msg){
      $.each(msg.responseJSON.errors, function(key, value){
        toastr["error"](value,"Error");
      });
    });
  }
  $("#editarConfgDocs").on("submit", function(e){
    e.preventDefault();
    // loading();
    var f = $(this);
    var formData2 = new FormData(document.getElementById("editarConfgDocs"));
    var route = "{{asset('paramteros/config_docs/editar')}}";
    var token = $("#token").val();
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN':token},
        type: "POST",
        dataType: "json",
        data: formData2,
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(res){
      if(res.codigo == 0){
        // loading();
        toastr["error"](res.mensaje, "Error");
        $("#myModalEditar1").modal('show');
      }else{
        // loading();
        toastr["success"](res.mensaje,"Registrado");
        $("#myModalEditar1").modal('hide');
        $("#listado").DataTable().ajax.reload();
      }
    })
    .fail(function(msg){
      // loading();
      $.each(msg.responseJSON.errors, function(key, value){
        toastr["error"](value,"Error");
        $("#myModalEditar1").modal('show');
      });
    });
  });
  function limpiarCampos1_1(){
    document.getElementById("editarConfgDocs").reset();
  }
</script>
{{-- Habilitar o inhabilitar Campos--}}
<script>
  function habilitar(value){
    if(value=="0")
    {
      // Habilitamos
      document.getElementById("autorizacionSRI").value='';
      document.getElementById("ultimoNum").value='';
      document.getElementById("fechaCaducidad").value='';
      document.getElementById("autorizacionSRI").disabled=true;
      document.getElementById("ultimoNum").disabled=true;
      document.getElementById("fechaCaducidad").disabled=true;
      // Habilitamos2
      document.getElementById("autorizacionSRI2").value='';
      document.getElementById("ultimoNum2").value='';
      document.getElementById("fechaCaducidad2").value='';
      document.getElementById("autorizacionSRI2").disabled=true;
      document.getElementById("ultimoNum2").disabled=true;
      document.getElementById("fechaCaducidad2").disabled=true;
    }else if(value=="1"){
      // Deshabilitamos
      document.getElementById("autorizacionSRI").disabled=false;
      document.getElementById("ultimoNum").disabled=false;
      document.getElementById("fechaCaducidad").disabled=false;
      // Deshabilitamos2
      document.getElementById("autorizacionSRI2").disabled=false;
      document.getElementById("ultimoNum2").disabled=false;
      document.getElementById("fechaCaducidad2").disabled=false;
    }
  }
</script>
{{-- FIN CONFIGURACION DE DOCUMENTOS --}}


{{-- CONFIGURACION DE IMPRESIONES --}}
<script>
  // Listado
  $(document).ready(function () {
    $('#listadoImpresiones').DataTable({
      "language":{url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
      "processing":true,
      "serverSide":true,
      "ajax":{
        url:"{{route('GetImpresiones')}}",
      },
      "columns":[
        {data:'tipocbte'},
        {data:'serie'},
        {data:'diseñoUsar'},
        {data:'impresoraUsar'},
        {data:'margen_sup'},
        {data:'margen_izq'},
        {data:'n_copias'},
        {data:'copiasEn1'},
        {data:'FeRide'},
        {data:'rideCompleto'},
        {data:'acciones'},
      ]
    });
  });
</script>
<script>
  // Acciones para crear
  $(document).on('click', '.crearConfg_impresora', function(event){
    $("#myModalCrearImpresiones").modal('show');
    // Cancelar creacion
    $("#myModalCrearImpresiones .modalCLose2").click(function(){
      limpiarCampos2();
    });
  });
  $("#crearImpresiones").on("submit", function(e){
    e.preventDefault();
    // loading();
    var f = $(this);
    var formData = new FormData(document.getElementById("crearImpresiones"));
    var route = "{{asset('comercio/parametros/impresiones/crear')}}";
    var token = $("#token").val();

    $.ajax({
      url: route,
      headers: {'X-CSRF-TOKEN':token},
      type: "POST",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      // loading();
      if(res.codigo == 0){
        toastr["error"](res.mensaje, "Error");
        $("#myModalCrearImpresiones").modal('show');
      }else{
        limpiarCampos2();
        $("#myModalCrearImpresiones").modal('hide');
        toastr["success"](res.mensaje,"Registro exitoso");
        $("#listadoImpresiones").DataTable().ajax.reload();
      }
    })
    .fail(function(msg){
      // loading();
      $.each(msg.responseJSON.errors, function(key, value){
        toastr["error"](value,"Error");
        $("#myModalCrearImpresiones").modal('show');
      });
    });
  });
  function limpiarCampos2(){
    document.getElementById("crearImpresiones").reset();
  }

  // Acciones para editar
  function add2(dato) {
    // ENVIO AJAX
    var id = $("#impresionesId").val();
    var routeEnvio = "{{asset('comercio/paramteros/impresiones/editar')}}"+'/'+dato.id;
    var token = $("#token").val();
    limpiarCampos2_2();
    $.ajax({
      url: routeEnvio,
      type: 'GET',
      dataType: 'json',
    }).done(function(res){
      if(res.respuesta == 0){
        toastr["error"](res.mensaje, "Fallo al cargar edición de impresiones", "¡Error!");
      }else{
        // Llenar selects
        $("#comprobanteImpresion2").empty();
        $("#series2").empty();
        $("#diseño2").empty();
        $("#impresora2").empty();

        $.each(res.TiposComprobantes, function(key, value){
          $("#comprobanteImpresion2").append('<option value='+value.id+'>'+value.nombre+'</option>');
        });

        $.each(res.seriesCbte, function(key, value){
          $("#series2").append('<option value='+value.id+'>'+value.num_serie1+' - '+value.num_serie2+'</option>');
        });

        // Selects
        $("#comprobanteImpresion2").val(res.comprobante).trigger("change");
        $("#series2").val(res.series).trigger("change");
        $("#diseño2").append('<option selected value="">Seleccione</option>');
        $("#impresora2").append('<option selected value="">Seleccione</option>');

        // Checks
        $("#margen_sup2").val(res.margen_sup);
        $("#margen_izq2").val(res.margen_izq);
        $("#n_copias2").val(res.n_copias);

        // Inputs
        if (res.copias_hoja == 1) {
          document.getElementById("copias_hoja2").checked = true;
        }else{
          document.getElementById("copias_hoja2").checked = false;
        }
        if (res.fe_ride == 1) {
          document.getElementById("fe_ride2").checked = true;
        }else{
          document.getElementById("fe_ride2").checked = false;
        }
        if (res.nombre_completo == 1) {
          document.getElementById("nombre_completo2").checked = true;
        }else{
          document.getElementById("nombre_completo2").checked = false;
        }

        $("#impresionesId").val(res.id);
        $("#myModalEditarImpresiones").modal('show');
      }

    }).fail(function(msg){
      $.each(msg.responseJSON.errors, function(key, value){
        toastr["error"](value,"Error");
      });
    });
  }
  $("#editarImpresiones").on("submit", function(e){
    e.preventDefault();
    // loading();
    var f = $(this);
    var formData = new FormData(document.getElementById("editarImpresiones"));
    var route = "{{asset('paramteros/impresiones/editar')}}";
    var token = $("#token").val();
    $.ajax({
      url: route,
      headers: {'X-CSRF-TOKEN':token},
      type: "POST",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
        // loading();
      if(res.codigo == 0){
        toastr["error"](res.mensaje, "Error");
        $("#myModalEditarImpresiones").modal('show');
      }else{
        toastr["success"](res.mensaje,"Registrado");
        $("#myModalEditarImpresiones").modal('hide');
        $("#listadoImpresiones").DataTable().ajax.reload();
      }
    })
    .fail(function(msg){
      // loading();
      $.each(msg.responseJSON.errors, function(key, value){
        toastr["error"](value,"Error");
        $("#myModalEditarImpresiones").modal('show');
      });
    });
  });
  function limpiarCampos2_2(){
    document.getElementById("editarImpresiones").reset();
  }
</script>
@endsection
