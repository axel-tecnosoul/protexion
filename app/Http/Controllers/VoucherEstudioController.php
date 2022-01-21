<?php

namespace App\Http\Controllers;

use App\ArchivoAdjunto;
use App\Models\VoucherEstudio;
use Illuminate\Http\Request;

class VoucherEstudioController extends Controller
{
    public function archivo(Request $request)
    {   
        $archivos = $request->file('anexo');
        //Controla si hay un archivo en el request
        if ($archivos) {
            foreach ($archivos as $item) {
                if ($item) {
                        $nombre = $request->estudio
                                ."_"
                                .$request->voucher_estudio_id
                                .$item->getClientOriginalName();
                        
                        $item->move(public_path().'/archivo/',$nombre);
                        $ruta = public_path().'/archivo/'.$nombre;
                        $archivo_adjunto = new ArchivoAdjunto();
                        $archivo_adjunto->anexo = $ruta;
                        $archivo_adjunto->voucher_estudio_id = $request->voucher_estudio_id;
                        $archivo_adjunto->save();
                }
            }
        }
        return back();
    }

    //Descarga archivos pasando el Id de voucherEstudios (Se usa para estudios de sistema)
    public function show($id)
    {   
        $voucher_estudio = VoucherEstudio::find($id);
        $archivo_adjunto = $voucher_estudio->archivo_adjunto[0];

        $img = $archivo_adjunto->anexo;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($img));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($img));
        ob_clean();
        flush();
        readfile($img);
    }

    //Descarga archivos pasando el Id del archivo a descargar (Se usa para estudios cargados)
    public function descargar($id)
    {   
        $archivo_adjunto = ArchivoAdjunto::find($id);

        $img = $archivo_adjunto->anexo;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($img));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($img));
        ob_clean();
        flush();
        readfile($img);
    }
}
