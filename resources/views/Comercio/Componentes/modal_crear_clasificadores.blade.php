<div class="modal" id="modalCrear" tabindex="-1" zIndex="1040" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$titulo}}</h4>
                <button type="button" class="close modalCLose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="col-xs-2"></div>
            <form id="frmConfirmar">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-sm{{$columna}}">
                            <label for="nombreClasificador" class="" >{{$descripcion}}</label>
                            <input type="text" class="form-control" name="nombreClasificador" id="nombreClasificador" required>
                        </div>
                        <div class="col-sm-4">
                            {{$abreviatura}}
                        </div>
                    </div>
                </div>
                {{-- Opciones del Modal --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

