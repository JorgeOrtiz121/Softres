<!-- Modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="myModalEditar1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">Editar registro</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editarConfgDocs" method="POST">
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
                                    <select class="form-control" id="comprobante2" name="comprobante2">
                                        <option>Seleccione...</option>
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
                                    <input type="text" class="form-control" id="numSerie12" name="numSerie12">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="numSerie22" name="numSerie22">
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
                                    <select class="form-control" id="tipo_comprobante2" name="tipo_comprobante2" onchange="habilitar(this.value);">
                                        <option>Seleccione...</option>
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
                                        <input type="text" class="form-control" id="autorizacionSRI2" name="autorizacionSRI2">
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
                                        <input type="text" class="form-control" id="ultimoNum2" name="ultimoNum2">
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
                                        <input type="date" class="form-control" id="fechaCaducidad2" name="fechaCaducidad2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id2" id="id2">
                        <div class="col-xs-2"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger modalCLose1" data-dismiss="modal">CANCELAR</button>
                <input type="submit" value="EDITAR" id="editarConfg" class="btn btn-success">
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /Modal -->