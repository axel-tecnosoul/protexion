<!-- Modal -->
<div class="modal fade" id="modelAchivos{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- HEADER -->
            <div class="modal-header fondo1">
                <h5 class="modal-title">Archivos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        @for ($i = 0; $i < sizeof($item->archivo_adjunto); $i++)
                        <tr>
                            <td style="text-align: left">
                                <a href={{ route('voucherEstudio.descargar',$item->archivo_adjunto[$i]->id)}}>{{strtoupper($item->estudio->nombre)    }} {{ $i + 1 }}</a> 
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>