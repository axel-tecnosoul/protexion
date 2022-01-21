<?php
namespace App\Http\Controllers;

use App\ArchivoAdjunto;
use App\Models\IluminacionDireccionado;
use App\Voucher;
use Illuminate\Http\Request;
use PDF;
class IluminacionDireccionadoController extends Controller
{
    public function index()
    {
        $iluminacionesDireccionados = IluminacionDireccionado::All();
        return view('direccionado_iluminacion.index', compact('iluminacionesDireccionados'));
    }

    public function crearPDF($id)
    {
        $iluminacion=IluminacionDireccionado::find($id);
        $pdf = PDF::loadView('direccionado_iluminacion.PDF',["iluminacion"   =>  $iluminacion]);
        $pdf->setPaper('a4','letter');
        return $pdf->stream('iluminacion.pdf');
    }

    public function create($id)
    {
        $voucher  = Voucher::find($id);
        return view('direccionado_iluminacion.create', compact('voucher'));
    }
    
    public function store(Request $request)
    {   
        //Almacenar y obtener Models
        $voucher=Voucher::find($request->voucher_id);
        $iluminacion = IluminacionDireccionado::create($request->all());

        //Generar PDF y enlazarlo
            //Obtener voucher-estudio
            foreach ($voucher->vouchersEstudios as $item) {
                if ($item->estudio->nombre == "ILUMINACION") {
                    $estudio = $item;
                }
            }
            //Ruta de PDF
            $ruta = public_path().'/archivo/'."ILUMINACION".$estudio->id.".pdf";
            //Generar PDF
            $pdf = PDF::loadView('direccionado_iluminacion.PDF',["iluminacion"   =>  $iluminacion]);
            $pdf->setPaper('a4','letter');
            $pdf->save($ruta);
            //Almacenar archivo adjunto
            $archivo_adjunto = new ArchivoAdjunto();
            $archivo_adjunto->anexo = $ruta;
            $archivo_adjunto->voucher_estudio_id = $estudio->id;
            $archivo_adjunto->save();
        //
        return redirect()->route('voucher.show',$voucher->id);
    }
}
