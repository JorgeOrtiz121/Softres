<div class="modal" id="modalEliminar" tabindex="-1" zIndex="1040" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$titulo}}</h4>
                <button type="button" class="close modalCLose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="col-xs-2"></div>
            <form id="frmConfirmarEliminar">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="" >{{$descripcion}}</label>
                    </div>
                </div>
                <input type="hidden" name="id_clasificador" id="id_clasificador" value="">

                {{-- Opciones del Modal --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" class="btn btn-primary">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
