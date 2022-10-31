<?php
namespace App\Http\Controllers;

use App\DeclaracionJurada;
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
        $voucher=Voucher::find($id);
        //dd($voucher);
        $iluminacion=IluminacionDireccionado::find($voucher->iluminacionDireccionado->id);
        $declaracionJurada=DeclaracionJurada::find($voucher->declaracionJurada->id);

        $pdf = PDF::loadView('direccionado_iluminacion.PDF',[
            "iluminacion"   =>  $iluminacion,
            "declaracion_jurada"   =>  $declaracionJurada,
        ]);
        $pdf->setPaper('a4','letter');
        return $pdf->stream('iluminacion.pdf');
    }

    public function create($id)
    {
        $voucher  = Voucher::find($id);

        $voucher_historial = Voucher::wherePaciente_id($voucher->paciente_id)->orderBy("created_at","desc")->get();
        $id_iluminacion_direccionado_anterior = 0;
        foreach ($voucher_historial as $voucher_anterior) {
          if($voucher_anterior->iluminacionDireccionado){
            $id_iluminacion_direccionado_anterior = $voucher_anterior->iluminacionDireccionado->id;
            break;
          }
        }
        $iluminacion_direccionado_anterior = IluminacionDireccionado::find($id_iluminacion_direccionado_anterior);

        return view('direccionado_iluminacion.create', compact('voucher','iluminacion_direccionado_anterior'));
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
            /*$ruta = public_path().'/archivo/'."ILUMINACION".$estudio->id.".pdf";
            //Generar PDF
            $pdf = PDF::loadView('direccionado_iluminacion.PDF',["iluminacion"   =>  $iluminacion]);
            $pdf->setPaper('a4','letter');
            $pdf->save($ruta);*/
            //Almacenar archivo adjunto
            $archivo_adjunto = new ArchivoAdjunto();
            $archivo_adjunto->anexo = "ruta";
            $archivo_adjunto->voucher_estudio_id = $estudio->id;
            $archivo_adjunto->save();
        //
        return redirect()->route('voucher.show',$voucher->id);
    }
}
