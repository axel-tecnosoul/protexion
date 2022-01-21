<?php

namespace App\Http\Controllers;

use App\Models\Aptitud;
use App\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class AptitudController extends Controller
{
    public function create($id)
    {   
        $aptitud = new Aptitud(); 
        $voucher  = Voucher::find($id);

        //Carga de riesgos
        $riesgos = $aptitud->riesgos();

        //Carga de estudios de sistema
        $declaracion_jurada = $voucher->declaracionJurada;
        $historia_clinica = $voucher->historiaClinica;
        $posiciones_forzada = $voucher->posicionesForzadas;
        $iluminacion_direccionado = $voucher->iluminacionDireccionado;

        //Carga de diagnosticos
        $voucher->declaracionJurada ? ($diagnosticoD = $declaracion_jurada->generarDiagnostico()) : ($diagnosticoD = " ");
        $voucher->historiaClinica ? ($diagnosticoH = $historia_clinica->generarDiagnostico()) : ($diagnosticoH = " ");
        $voucher->posicionesForzadas ? ($diagnosticoP = $posiciones_forzada->generarDiagnostico()) : ($diagnosticoP = " ");
        $voucher->iluminacionDireccionado ? ($diagnosticoI = $iluminacion_direccionado->generarDiagnostico()) : ($diagnosticoI = " ");

        //Carga de estudios clasificados por tipo
        $estudios = $voucher->getEstudiosClasificados();

        //Carga de datos adicionales
        if ($voucher->historiaClinica) {
            $datosAdicionales = "IMC: ".$historia_clinica->examenClinico->imc.". ";
            if ($historia_clinica->examenClinico->sobrepeso) {
                $datosAdicionales = $datosAdicionales." Sobrepeso. ";
            }
            if ($historia_clinica->examenClinico->medicacion_actual) {
                $datosAdicionales = $datosAdicionales." Medicación actual: ".$historia_clinica->examenClinico->medicacion_actual.". ";
            }else {
                $datosAdicionales = $datosAdicionales." Medicación actual: No. ";
            }
        } else {
            $datosAdicionales = "";
        }

        //Tabla pf
        $articulaciones = ['Hombro','Codo','Muñeca','Mano y dedos','Cadera','Rodilla','Tobillo'];
        $cuadro = 0;
        
        return view('aptitud.create', compact('voucher','riesgos','estudios', 'datosAdicionales','articulaciones','cuadro',
                                              'declaracion_jurada','historia_clinica','posiciones_forzada','iluminacion_direccionado',
                                              'diagnosticoD','diagnosticoH','diagnosticoP','diagnosticoI' ));
    }

    public function store(Request $request)
    {   
        $aptitudModel = new Aptitud(); 
        //Obtener voucher
        $voucher = Voucher::find($request->voucher_id);
        //Crear objeto aptitud
        $aptitud = ["riesgos" => implode($request->riesgos),
                    "comentarios" => $request->comentarios,
                    "aptitud_laboral" => $request->aptitud_laboral,
                    "fecha" => new Carbon(),
                    "preexistencias" => $request->preexistencias,
                    "observaciones" => $request->observaciones
        ];

        //Cargar Aptitud
        $aptitudDB = Aptitud::create($request->all());

        //Generar PDF
        $ruta = public_path().'/archivo/'."APTITUD".$aptitudDB->id.".pdf";

        $pdf = PDF::loadView('aptitud.pdf',["voucher" => $voucher, 
                                            "riesgos" => $aptitudModel->riesgos(), 
                                            "aptitud" => $aptitud]);
        $pdf->setPaper('a4','letter');
        $pdf->save($ruta);

        //Almacenar ruta de archivo en db
        $aptitudDB->pdf = $ruta;
        $aptitudDB->save();

        return redirect()->route('voucher.show',$voucher->id);

    }

    //Descarga archivos pasando el Id del archivo a descargar (Se usa para estudios cargados)
    public function descargar($id)
    {   
        $aptitud = Aptitud::find($id); 
        return response()->file($aptitud->pdf);
    }

    /*
    public function crearPDF($id)
    {   
        $aptitudModel = new Aptitud(); 
        $voucher = Voucher::find($id);

        //Carga de riesgos
        $riesgos = $aptitudModel->riesgos();

        $pdf = PDF::loadView('aptitud.pdf',["voucher" => $voucher, "riesgos" => $riesgos]);
        $pdf->setPaper('a4','letter');

        return $pdf->stream('aptitud.pdf');
    }*/
}
