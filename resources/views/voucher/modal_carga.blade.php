<div class="modal fade" id="archivoModal" tabindex="-1" role="dialog" aria-labelledby="archivoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- HEADER -->
            <div class="modal-header fondo1">
                <h5 class="modal-title" id="archivoModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form method="POST" action="{{route('voucherEstudio.archivo')}}" enctype="multipart/form-data">
            @csrf
            <!-- BODY -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Archivo:</label>
                    <input class="form-control-file" name="anexo[]" type="file" multiple required>
                </div>
                <div class="form-group">
                    <input type="text" name="voucher_estudio_id" class="form-control" id="voucher_estudio" hidden>
                    <input type="text" name="estudio" class="form-control" id="estudio" hidden>
                </div>
            </div>
            <!-- FOOTER -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="cargarPdf" class="btn fondo1" >Guardar</button>
            </div>
        </form>
        </div>
    </div>
</div>