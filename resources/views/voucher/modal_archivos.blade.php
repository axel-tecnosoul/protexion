<!-- Modal -->
<div class="modal fade" id="modelArchivos{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- HEADER -->
      <div class="modal-header fondo1">
        <h5 class="modal-title">Archivos</h5>
        <button type="button" class="close" onclick="$('#modelArchivos{{$item->id}}').modal('hide');" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tbody>
            @for ($i = 0; $i < sizeof($item->archivo_adjunto); $i++)<?php
              $ruta=$item->archivo_adjunto[$i]->anexo;
              //var_dump($ruta);
              $ex=explode("/",$ruta);
              $nombre_archivo=$ex[count($ex)-1];?>
              <tr>
                <td style="text-align: left">
                  <!-- <a href={{ route('voucherEstudio.descargar',$item->archivo_adjunto[$i]->id)}}>{{strtoupper($item->estudio->nombre)    }} {{ $i + 1 }}</a> -->
                  <a href={{ route('voucherEstudio.descargar',$item->archivo_adjunto[$i]->id)}}>{{strtoupper($nombre_archivo)}}</a>
                </td>
                <td style="text-align: center">
                  <a data-keyboard="false" data-target="#modal-delete-{{ $item->archivo_adjunto[$i]->id }}" data-toggle="modal">
                    <button type="submit" class="btn fondo1 btn-responsive"><i class="fa fa-fw fa-trash"></i></button>
                  </a>
                  @include('voucher.modaldelete_file')
                </td>
              </tr>
            @endfor
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="$('#modelArchivos{{$item->id}}').modal('hide');">Cerrar</button>
      </div>
    </div>
  </div>
</div>