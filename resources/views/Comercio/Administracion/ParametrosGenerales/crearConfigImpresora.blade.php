<!-- Modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="myModalCrearImpresiones">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">Crear nuevo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="crearImpresiones" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">Tipo de comprobante</label>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <select class="form-control comprobante" id="comprobanteImpresion" name="comprobanteImpresion">
                                            <option value="">Seleccione...</option>
                                            @foreach ($TiposComprobantes as $comprobante)
                                                <option value="{{$comprobante->id}}">{{$comprobante->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">Con serie</label>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <select class="form-control" id="series" name="series">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">Diseño a utilizar</label>
                                </div>
                                </div>
                                <div class="col-lg-7">
                                <div class="form-group">
                                    <select class="form-control" id="diseño" name="diseño">
                                    <option value="">Seleccione...</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">Impresora a utilizar</label>
                                </div>
                                </div>
                                <div class="col-lg-7">
                                <div class="form-group">
                                    <select class="form-control" id="impresora" name="impresora">
                                    <option value="">Seleccione...</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Ajuste margen superior</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <input type="number" id="margen_sup" name="margen_sup" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">mm</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Ajuste margen izquierdo</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <input type="number" id="margen_izq" name="margen_izq" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">mm</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Número de copias</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <input type="number" id="n_copias" name="n_copias" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Imprimir las copias en 1 sola hoja</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="copias_hoja" name="copias_hoja" class="flat">&nbsp;
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Imprimir las facturas electrónicas usando el RIDE</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="fe_ride" name="fe_ride" class="flat">&nbsp;
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Imprimir RIDE usando nombre completo del producto</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="nombre_completo" name="nombre_completo" class="flat">&nbsp;
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger modalCLose2" data-dismiss="modal">CANCELAR</button>
                <input type="submit" value="CREAR" id="crearConfg2" class="btn btn-success">
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /Modal -->