<?php

namespace App\Http\Controllers;

use App\DeclaracionJurada;
use App\ArchivoAdjunto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Paciente;
use App\PosicionesForzada;
use App\Dolor;
use App\Tarea;
use App\Semiologica;
use App\Voucher;
use PDF;
use Carbon\Carbon;

class PosicionesForzadasController extends Controller
{
    public function traerDatosPaciente(Request $request)
    {
        $paciente=Paciente::find($request->id);
        $retorno = [
            'nombres'           =>  $paciente->nombreCompleto(),
            'cuil'              =>  $paciente->cuil,
            'empresa'           =>  $paciente->empresa->razon_social,
        ];
        return response()->json($retorno);
    }

    public function index()
    {
        $posiciones_forzadas = PosicionesForzada::all();
        return view('posiciones_forzadas.index',compact('posiciones_forzadas'));
    }

    public function crearPDF($id)
    {
        $voucher=Voucher::find($id);
        $posiciones_forzada=PosicionesForzada::find($voucher->posicionesForzadas->id);
        $declaracionJurada=DeclaracionJurada::find($voucher->declaracionJurada->id);

        $articulaciones = ['Hombro','Codo','Muñeca','Mano y dedos','Cadera','Rodilla','Tobillo'];
        $cuadro = 0;
        $pdf = PDF::loadView('posiciones_forzadas.pdf',[
            "posiciones_forzada"   =>  $posiciones_forzada,
            "articulaciones"       =>  $articulaciones,
            "cuadro"               =>  $cuadro,
            "declaracion_jurada"   =>  $declaracionJurada,
        ]);
        $pdf->setPaper('a4','letter');
        return $pdf->stream('posiciones-forzadas.pdf');
    }

    public function create($id)
    {
        $pacientes= Paciente::all();
        $voucher  = Voucher::find($id);
        $articulaciones = ['Hombro','Codo','Muñeca','Mano y dedos','Cadera','Rodilla','Tobillo'];
        $cuadro = 0;

        $voucher_historial = Voucher::wherePaciente_id($voucher->paciente_id)->orderBy("created_at","desc")->get();
        $id_posiciones_forzadas_anterior = 0;
        foreach ($voucher_historial as $voucher_anterior) {
          //var_dump($voucher_anterior->posicionesForzadas);
          if($voucher_anterior->posicionesForzadas){
            $id_posiciones_forzadas_anterior = $voucher_anterior->posicionesForzadas->id;
            break;
          }
        }
        $posiciones_forzadas_anterior = PosicionesForzada::find($id_posiciones_forzadas_anterior);

        return view('posiciones_forzadas.create', compact('pacientes','articulaciones','voucher','cuadro','posiciones_forzadas_anterior'));
    }

    public function store(Request $request)
    {          
            //Buscar y generar Models
            $voucher=Voucher::find($request->voucher_id);
            $posiciones_forzada=new PosicionesForzada();

            //Almacenar Posiciones forzadas
            $n=PosicionesForzada::count() + 1;
            $posiciones_forzada->firma=$request->firma;
            $posiciones_forzada->codigo=str_pad($n, 10, '0', STR_PAD_LEFT);
            $posiciones_forzada->puesto=$request->puesto;
            $posiciones_forzada->antiguedad=$request->antiguedad;
            $posiciones_forzada->nroTrabajo=$request->nroTrabajo;
            $posiciones_forzada->user_id=auth()->user()->id;
            $posiciones_forzada->voucher_id=$request->voucher_id;
            //Tabla articulaciones
                //Cada cuadro es representado por una posicion en el String
                $dolor_articular = "";
                for ($i=0; $i < 112; $i++) { 
                    $dolor_articular = $dolor_articular.$request->$i;
            }
            $posiciones_forzada->dolor_articular = $dolor_articular;
            $posiciones_forzada->save();
            
            //Tablas secundarias
                //Tarea
                $tarea=new Tarea();
                $tarea->tiempo=$request->tiempo;
                $tarea->ciclo=$request->ciclo;
                $tarea->cargas=$request->cargas;
                $tarea->pregunta1 = $request->pregunta1;     
                $tarea->pregunta2 = $request->pregunta2;     
                $tarea->pregunta3 = $request->pregunta3;     
                $tarea->pregunta4 = $request->pregunta4;     
                $tarea->pregunta5 = $request->pregunta5;     
                $tarea->pregunta6 = $request->pregunta6;     
                $tarea->pregunta7 = $request->pregunta7;     
                $tarea->pregunta8 = $request->pregunta8;        
                $tarea->observacion_tarea=$request->observacion_tarea;
                $tarea->posiciones_forzada_id=$posiciones_forzada->id;
                $tarea->save();
                //Dolor
                $dolor=new Dolor();
                $dolor->forma = $request->forma;
                $dolor->evolucion = $request->evolucion;
                $dolor->pregunta1_d = $request->pregunta1_d;    
                $dolor->pregunta2_d = $request->pregunta2_d;    
                $dolor->pregunta3_d = $request->pregunta3_d;    
                $dolor->pregunta4_d = $request->pregunta4_d;    
                $dolor->pregunta5_d = $request->pregunta5_d;    
                $dolor->observacion1_d= $request->observacion1_d;
                $dolor->observacion2_d= $request->observacion2_d;
                $dolor->posiciones_forzada_id=$posiciones_forzada->id;
                $dolor->save();
                //Semiologica
                $semiologica=new Semiologica();
                $semiologica->grado=$request->grado;
                $semiologica->observacion1_s=$request->observacion1_s;
                $semiologica->posiciones_forzada_id=$posiciones_forzada->id;
                $semiologica->save();
            //

            //Generar PDF y enlazarlo
                //Obtener voucher-estudio
                foreach ($voucher->vouchersEstudios as $item) {
                    if ($item->estudio->nombre == "POSICIONES FORZADAS") {
                        $estudio = $item;
                    }
                }
                //Ruta de PDF
                $ruta = public_path().'/archivo/'."POSICIONES FORZADAS".$estudio->id.".pdf";
                //Generar PDF
                $articulaciones = ['Hombro','Codo','Muñeca','Mano y dedos','Cadera','Rodilla','Tobillo'];
                $cuadro = 0;
                /*$pdf = PDF::loadView('posiciones_forzadas.pdf',[
                    "posiciones_forzada"   =>  $posiciones_forzada,
                    "articulaciones"       =>  $articulaciones,
                    "cuadro"               =>  $cuadro
                    ]);
                $pdf->setPaper('a4','letter');
                $pdf->stream($ruta);*/
                //Almacenar archivo adjunto
                $archivo_adjunto = new ArchivoAdjunto();
                $archivo_adjunto->anexo = "ruta";
                $archivo_adjunto->voucher_estudio_id = $estudio->id;
                $archivo_adjunto->save();
            //
            return redirect()->route('voucher.show',$voucher->id);
    }
}
