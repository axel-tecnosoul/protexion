<?php

namespace App\Http\Controllers;

use App\DeclaracionJurada;
use App\Models\Aptitud;
use App\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\VoucherRiesgos;
use App\Models\VoucherEstudio;
use App\Riesgos;
use App\HistoriaClinica;
use App\PosicionesForzada;
use App\Models\IluminacionDireccionado;
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
        $datosAdicionales = "";
        /*$datosAdicionales = "IMC: ".$historia_clinica->examenClinico->imc.". ";
        if ($historia_clinica->examenClinico->sobrepeso) {
            $datosAdicionales.=" Sobrepeso. ";
        }*/
        /*if ($voucher->historiaClinica) {
            $estatura=$historia_clinica->examenClinico->estatura;
            if($estatura>100){
              $estatura/=100;
            }
            $peso=$historia_clinica->examenClinico->peso;
            $imc=number_format($peso/($estatura*$estatura),2);

            $datosAdicionales = "IMC: ".$imc;
            //Calculo de IMC
            if ($imc >= "30") {
              $descripcionIMC='Sobrepeso';
            } elseif ($imc <= "18") {
              $descripcionIMC='Muy bajo';
            } else {
              $descripcionIMC='Normal';
            }
            $datosAdicionales.=" (".$descripcionIMC.").";

            if ($historia_clinica->examenClinico->medicacion_actual) {
                $datosAdicionales.=" Medicación actual: ".$historia_clinica->examenClinico->medicacion_actual.". ";
            }else {
                $datosAdicionales.=" Medicación actual: No posee. ";
            }
        }*/

        $voucher_riesgos=[];
        foreach($voucher->vouchersRiesgos as $riesgo){
          $voucher_riesgos[]=$riesgo->riesgo_id;
        }

        //Tabla pf
        $articulaciones = ['Hombro','Codo','Muñeca','Mano y dedos','Cadera','Rodilla','Tobillo'];
        $cuadro = 0;
        
        return view('aptitud.create', compact('voucher','riesgos','estudios', 'datosAdicionales','articulaciones','cuadro',
                                              'declaracion_jurada','historia_clinica','posiciones_forzada','iluminacion_direccionado',
                                              'diagnosticoD','diagnosticoH','diagnosticoP','diagnosticoI','voucher_riesgos', 'aptitud'));
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

        if(isset($request->pre_historia_clinica) and isset($request->obs_historia_clinica)){
          $historiaClinica=HistoriaClinica::findOrFail($voucher->historiaClinica->id);
          $historiaClinica->informe_final_observaciones=$request->obs_historia_clinica;
          $historiaClinica->informe_final_preexistencias=$request->pre_historia_clinica;
          $historiaClinica->update();
        }
        if(isset($request->pre_posiciones_forzadas) and isset($request->obs_posiciones_forzadas)){
          $posicionesForzada=PosicionesForzada::findOrFail($voucher->posicionesForzadas->id);
          $posicionesForzada->informe_final_observaciones=$request->obs_posiciones_forzadas;
          $posicionesForzada->informe_final_preexistencias=$request->pre_posiciones_forzadas;
          $posicionesForzada->update();
        }
        if(isset($request->pre_iluminacion_insuficiente) and isset($request->obs_iluminacion_insuficiente)){
          $iluminacionDireccionado=IluminacionDireccionado::findOrFail($voucher->iluminacionDireccionado->id);
          $iluminacionDireccionado->informe_final_observaciones=$request->obs_iluminacion_insuficiente;
          $iluminacionDireccionado->informe_final_preexistencias=$request->pre_iluminacion_insuficiente;
          $iluminacionDireccionado->update();
        }

        /*var_dump($historiaClinica->id);
        var_dump($posicionesForzada->id);
        var_dump($iluminacionDireccionado->id);*/

        //dd($request);
        //dd($request->all());
        //dd($aptitudModel);
        //Cargar Aptitud
        $id=$request->voucher_id;

        $aptitudModel->voucher_id=$request->voucher_id;
        $aptitudModel->preexistencias=$request->preexistencias;
        $aptitudModel->observaciones=$request->observaciones;
        $aptitudModel->aptitud_laboral=$request->aptitud_laboral;
        $aptitudModel->comentarios=$request->comentarios;
        $aptitudModel->save();

        $input_name="POinput";
        foreach($request->all() as $key => $input){
          $ex=explode("_",$key);
          if($ex[0]==$input_name){
            //$id_tipo_estudio=$ex[1];
            $id_estudio=$ex[2];
            $voucher_estudio=VoucherEstudio::whereVoucher_id($id)->whereEstudio_id($id_estudio)->first();
            //dd($voucher_estudio);
            if(isset($ex[3]) and $ex[3]=="radio"){
              //es un radio
              $voucher_estudio->pre_obs=$input;
              $voucher_estudio->update();
            }else{
              $voucher_estudio->valor=$input;
              $voucher_estudio->update();
            }
          }
        }
        //dd($request->all());
        $riesgos=$request->riesgos;

        $voucher_riesgo=VoucherRiesgos::whereVoucher_id($id)->delete();
        //var_dump($voucher_riesgo);
        
        foreach ($riesgos as $key => $value) {
          if($value==1){
            //$voucher_riesgo = new VoucherRiesgos;
            $voucher_riesgo = new VoucherRiesgos;
            $voucher_riesgo->voucher_id = $id;
            $voucher_riesgo->riesgo_id = $key;
            $voucher_riesgo->save();
          }
        }
        //$aptitudDB = Aptitud::create($request->all());
        //dd($aptitudDB);

        //Generar PDF
        //$ruta = public_path().'/archivo/'."APTITUD".$aptitudDB->id.".pdf";
        //$ruta = public_path().'/archivo/'."APTITUD".$voucher->id.".pdf";

        /*$pdf = PDF::loadView('aptitud.pdf',["voucher" => $voucher, 
                                            "riesgos" => $aptitudModel->riesgos(), 
                                            "aptitud" => $aptitud]);
        $pdf->setPaper('a4','letter');
        //$pdf->save($ruta);

        //Almacenar ruta de archivo en db
        $aptitudDB->pdf = $ruta;
        $aptitudDB->save();*/

        return redirect()->route('voucher.show',$id);

    }

    //Descarga archivos pasando el Id del archivo a descargar (Se usa para estudios cargados)
    public function descargar($id)
    {   

        $aptitud = Aptitud::find($id);
        $riesgos = Riesgos::all();

        $voucher = Voucher::find($aptitud->voucher_id);
        $declaracionJurada=DeclaracionJurada::find($voucher->declaracionJurada->id);
        //dd($voucher);

        $voucher_riesgos=[];
        foreach($voucher->vouchersRiesgos as $riesgo){
          $voucher_riesgos[]=$riesgo->riesgo_id;
        }
        
        //return view('aptitud.pdf',["voucher" => $voucher, "riesgos" => $riesgos,"voucher_riesgos" => $voucher_riesgos,"aptitud" => $aptitud,"declaracion_jurada" => $declaracionJurada]);
        $pdf = PDF::loadView('aptitud.pdf',["voucher" => $voucher, 
                                            "riesgos" => $riesgos,
                                            "voucher_riesgos" => $voucher_riesgos,
                                            "aptitud" => $aptitud,
                                            "declaracion_jurada" => $declaracionJurada,
        ]);
        $pdf->setPaper('a4','letter');
        return $pdf->stream('aptitud.pdf');

        $aptitud = Aptitud::find($id); 
        //dd($aptitud);
        //return redirect()->route('aptitudes.pdf',$aptitud->id);
        //return view('aptitudes.pdf', compact('aptitud'));
        return response()->file($aptitud->pdf);

    }

    /* SE USA?? */
    public function crearPDF($id)
    {   
        $aptitudModel = new Aptitud(); 
        $voucher=Voucher::find($id);
        $declaracionJurada=DeclaracionJurada::find($voucher->declaracionJurada->id);
        /*$aptitud = Aptitud::find($voucher->aptitud->id);
        var_dump($aptitud);*/
        
        //$declaracion_jurada=DeclaracionJurada::find($voucher->declaracionJurada->id);

        //Carga de riesgos
        $riesgos = $aptitudModel->riesgos();

        dd($declaracionJurada);
        $pdf = PDF::loadView('aptitud.pdf',[
          "voucher" => $voucher,
          "riesgos" => $riesgos,
          "declaracion_jurada" => $declaracionJurada,
          //"aptitud" => $aptitud,
        ]);
        $pdf->setPaper('a4','letter');

        return $pdf->stream('aptitud.pdf');
    }

    public function edit($id)
    {   
        $voucher  = Voucher::find($id);
        //$declaracion_jurada=DeclaracionJurada::find($voucher->declaracionJurada->id);
        //$aptitud = new Aptitud();
        $aptitud = Aptitud::findOrFail($voucher->aptitud->id);
        //dd($aptitud);
        //dd($aptitud->observaciones,nl2br($aptitud->observaciones),explode("\r\n",$aptitud->observaciones));
        //Carga de riesgos
        $riesgos = $aptitud->riesgos();

        $voucher  = Voucher::find($id);
        //Carga de estudios de sistema
        $declaracion_jurada = $voucher->declaracionJurada;
        $historia_clinica = $voucher->historiaClinica;
        $posiciones_forzada = $voucher->posicionesForzadas;
        $iluminacion_direccionado = $voucher->iluminacionDireccionado;

        //dd($iluminacion_direccionado);

        //Carga de diagnosticos
        $voucher->declaracionJurada ? ($diagnosticoD = $declaracion_jurada->generarDiagnostico()) : ($diagnosticoD = " ");
        $voucher->historiaClinica ? ($diagnosticoH = $historia_clinica->generarDiagnostico()) : ($diagnosticoH = " ");
        $voucher->posicionesForzadas ? ($diagnosticoP = $posiciones_forzada->generarDiagnostico()) : ($diagnosticoP = " ");
        $voucher->iluminacionDireccionado ? ($diagnosticoI = $iluminacion_direccionado->generarDiagnostico()) : ($diagnosticoI = " ");

        //dd($diagnosticoH);

        //Carga de estudios clasificados por tipo
        $estudios = $voucher->getEstudiosClasificados();
        //dd($estudios);

        //Carga de datos adicionales
        $datosAdicionales = "";
        /*if ($historia_clinica->examenClinico->sobrepeso) {
            $datosAdicionales.=" Sobrepeso. ";
        }*/
        /*if ($voucher->historiaClinica) {
            $estatura=$historia_clinica->examenClinico->estatura;
            if($estatura>100){
              $estatura/=100;
            }
            $peso=$historia_clinica->examenClinico->peso;
            $imc=number_format($peso/($estatura*$estatura),2);

            $datosAdicionales = "IMC: ".$imc;
            //Calculo de IMC
            if ($imc >= "30") {
              $descripcionIMC='Sobrepeso';
            } elseif ($imc <= "18") {
              $descripcionIMC='Muy bajo';
            } else {
              $descripcionIMC='Normal';
            }
            $datosAdicionales.=" (".$descripcionIMC.").";
            
            if ($historia_clinica->examenClinico->medicacion_actual) {
                $datosAdicionales.=" Medicación actual: ".$historia_clinica->examenClinico->medicacion_actual.". ";
            }else {
                $datosAdicionales.=" Medicación actual: No posee. ";
            }
        }*/

        $voucher_riesgos=[];
        foreach($voucher->vouchersRiesgos as $riesgo){
          $voucher_riesgos[]=$riesgo->riesgo_id;
        }

        //Tabla pf
        $articulaciones = ['Hombro','Codo','Muñeca','Mano y dedos','Cadera','Rodilla','Tobillo'];
        $cuadro = 0;
        
        return view('aptitud.edit', compact('voucher','riesgos','estudios', 'datosAdicionales','articulaciones','cuadro',
                                              'declaracion_jurada','historia_clinica','posiciones_forzada','iluminacion_direccionado',
                                              'diagnosticoD','diagnosticoH','diagnosticoP','diagnosticoI','voucher_riesgos','aptitud' ));
    }

    public function update(Request $request, $id)
    {   
        $aptitud = Aptitud::findOrFail($id);
        //$aptitudModel = new Aptitud(); 
        //Obtener voucher
      
        //dd($request->all());
        $voucher = Voucher::find($request->voucher_id);
        //Crear objeto aptitud
        /*$aptitud = ["riesgos" => implode($request->riesgos),
                    "comentarios" => $request->comentarios,
                    "aptitud_laboral" => $request->aptitud_laboral,
                    "fecha" => new Carbon(),
                    "preexistencias" => $request->preexistencias,
                    "observaciones" => $request->observaciones
        ];*/

        if(isset($request->pre_historia_clinica) and isset($request->obs_historia_clinica)){
          $historiaClinica=HistoriaClinica::findOrFail($voucher->historiaClinica->id);
          $historiaClinica->informe_final_observaciones=$request->obs_historia_clinica;
          $historiaClinica->informe_final_preexistencias=$request->pre_historia_clinica;
          $historiaClinica->update();
        }
        if(isset($request->pre_posiciones_forzadas) and isset($request->obs_posiciones_forzadas)){
          $posicionesForzada=PosicionesForzada::findOrFail($voucher->posicionesForzadas->id);
          $posicionesForzada->informe_final_observaciones=$request->obs_posiciones_forzadas;
          $posicionesForzada->informe_final_preexistencias=$request->pre_posiciones_forzadas;
          $posicionesForzada->update();
        }
        if(isset($request->pre_iluminacion_insuficiente) and isset($request->obs_iluminacion_insuficiente)){
          $iluminacionDireccionado=IluminacionDireccionado::findOrFail($voucher->iluminacionDireccionado->id);
          $iluminacionDireccionado->informe_final_observaciones=$request->obs_iluminacion_insuficiente;
          $iluminacionDireccionado->informe_final_preexistencias=$request->pre_iluminacion_insuficiente;
          $iluminacionDireccionado->update();
        }

        /*var_dump($historiaClinica->id);
        var_dump($posicionesForzada->id);
        var_dump($iluminacionDireccionado->id);*/

        //dd($request);
        //dd($request->all());
        //dd($aptitudModel);
        //Cargar Aptitud

        //$aptitud->voucher_id=$request->voucher_id;
        $aptitud->preexistencias=$request->preexistencias;
        $aptitud->observaciones=$request->observaciones;
        $aptitud->aptitud_laboral=$request->aptitud_laboral;
        $aptitud->comentarios=$request->comentarios;
        $aptitud->update();

        $input_name="POinput";
        foreach($request->all() as $key => $input){
          $ex=explode("_",$key);
          if($ex[0]==$input_name){
            //$id_tipo_estudio=$ex[1];
            $id_estudio=$ex[2];
            $voucher_estudio=VoucherEstudio::whereVoucher_id($request->voucher_id)->whereEstudio_id($id_estudio)->first();
            //dd($voucher_estudio);
            if(isset($ex[3]) and $ex[3]=="radio"){
              //es un radio
              $voucher_estudio->pre_obs=$input;
              $voucher_estudio->update();
            }else{
              $voucher_estudio->valor=$input;
              $voucher_estudio->update();
            }
          }
        }
        //dd($request->all());
        $riesgos=$request->riesgos;

        $voucher_riesgo=VoucherRiesgos::whereVoucher_id($request->voucher_id)->delete();
        //var_dump($voucher_riesgo);
        
        foreach ($riesgos as $key => $value) {
          if($value==1){
            //$voucher_riesgo = new VoucherRiesgos;
            $voucher_riesgo = new VoucherRiesgos;
            $voucher_riesgo->voucher_id = $request->voucher_id;
            $voucher_riesgo->riesgo_id = $key;
            $voucher_riesgo->save();
          }
        }

        return redirect()->route('voucher.show',$request->voucher_id);

    }
}
