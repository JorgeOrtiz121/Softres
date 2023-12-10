<!-- Modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="myModalCrear1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">Crear nuevo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="crearConfgDocumentos" method="POST">
                    <div class="row">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-8">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Comprobante</label>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                    <select class="form-control select2" id="comprobante" name="comprobante">
                                        <option>Seleccione...</option>
                                        @foreach ($TiposComprobantes as $comprobante)
                                            <option value="{{$comprobante->id}}">{{$comprobante->nombre}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Num Serie</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                    <input type="text" class="form-control" id="numSerie1" name="numSerie1">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="numSerie2" name="numSerie2">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Tipo Comprobante</label>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                    <select class="form-control" id="tipo_comprobante" name="tipo_comprobante" onchange="habilitar(this.value);">
                                        <option>Seleccione...</option>
                                        <option value="1">Comprobante Electrónico</option>
                                        <option value="0">Comprobante Físico</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Autorización SRI</label>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="autorizacionSRI" name="autorizacionSRI">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Ultimo número impreso</label>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="ultimoNum" name="ultimoNum">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Fecha de caducidad</label>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="fechaCaducidad" name="fechaCaducidad">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-2"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger modalCLose1" data-dismiss="modal">CANCELAR</button>
                <input type="button" value="CREAR" id="crearConfg" class="btn btn-success">
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /Modal -->
