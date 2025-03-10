<?php

namespace App\Http\Controllers;

use App\DeclaracionJurada;
use App\HistoriaClinica;
use App\Paciente;
use App\ExamenClinico;
use App\Cardiovascular;
use App\Piel;
use App\Osteoarticular;
use App\Columna;
use App\CabezaCuello;
use App\Oftalmologico;
use App\Neurologico;
use App\Odontologico;
use App\Respiratorio;
use App\Abdomen;
use App\ArchivoAdjunto;
use App\RegionInguinal;
use App\Genital;
use App\RegionAnal;
use App\Voucher;
use App\ObraSocial;
use App\Origen;
use App\Pais;
use PDF;
use Illuminate\Http\Request;
class HistoriaClinicaController extends Controller
{
    public function index()
    {
        $historias_clinicas = HistoriaClinica::all();
        return view('historia_clinica.index',compact('historias_clinicas'));
    }

    public function crearPDF($id)
    {
        $voucher=Voucher::find($id);
        $historia_clinica=HistoriaClinica::find($voucher->historiaClinica->id);
        $declaracionJurada=DeclaracionJurada::find($voucher->declaracionJurada->id);

        $pdf = PDF::loadView('historia_clinica.pdf',[
            "hc_formulario"   =>  $historia_clinica,
            "declaracion_jurada"   =>  $declaracionJurada,
        ]);

        $pdf->setPaper('a4','letter');
        return $pdf->stream('historia-clinica.pdf');
    }

    public function create($id)
    {
        $pacientes=Paciente::where('historia_clinica',false)->get();
        //esta variable $voucher deberia traer el voucher + nombre del paciente y dni + fecha...en el modelo y quedarte eunuco
        $voucher  = Voucher::find($id);
        $origenes = Origen::all();
        $obra_sociales = ObraSocial::all();
        $paises=Pais::all();

        $peso_decla_jurada="";
        $altura_decla_jurada="";
        if($voucher->declaracionJurada){
          $declaJurada  = DeclaracionJurada::find($voucher->declaracionJurada->id);
          $peso_decla_jurada=$declaJurada->voucher->paciente->peso;
          $altura_decla_jurada=$declaJurada->voucher->paciente->estatura;
        }

        $voucher_historial = Voucher::wherePaciente_id($voucher->paciente_id)->orderBy("created_at","desc")->get();
        $id_historia_clinica_anterior = 0;
        foreach ($voucher_historial as $voucher_anterior) {
          if($voucher_anterior->anulado==0 and $voucher_anterior->historiaClinica){
            $id_historia_clinica_anterior = $voucher_anterior->historiaClinica->id;
            break;
          }
        }
        $historia_clinica_anterior = HistoriaClinica::find($id_historia_clinica_anterior);

        return view('historia_clinica.create', compact('voucher','pacientes','origenes','obra_sociales','paises','historia_clinica_anterior','peso_decla_jurada','altura_decla_jurada'));
    }

    public function store(Request $request)
    {
        //Crear y buscar Models
        $n=HistoriaClinica::count() + 1;
        $voucher=Voucher::find($request->voucher_id);
        $historia_clinica=new HistoriaClinica();

        //Historia clínica
        $historia_clinica->firma=$request->firma;
        $historia_clinica->codigo=str_pad($n, 10, '0', STR_PAD_LEFT);
        $historia_clinica->voucher_id=$request->voucher_id;
        $historia_clinica->user_id=auth()->user()->id;
        $historia_clinica->save();
        
        //Carga de tablas
            //Examen Clinico
                $examen_clinico=new ExamenClinico();
                $examen_clinico->peso=                  $request->peso                  ;
                $examen_clinico->estatura=              $request->estatura              ;
                $examen_clinico->sobrepeso=             $request->sobrepeso             ;
                $examen_clinico->imc=                   $request->imc                   ;
                $examen_clinico->medicacion_actual=     $request->medicacion_actual     ;
                $examen_clinico->historia_clinica_id=   $historia_clinica->id           ;
                $examen_clinico->save();
            //
            //Cardiovascular
                $cardiovascular=new Cardiovascular();
                $cardiovascular->frecuencia_cardiaca=         $request->frecuencia_cardiaca;
                $cardiovascular->tension_arterial=            $request->tension_arterial;
                $cardiovascular->sistolica=                   $request->sistolica;
                $cardiovascular->diastolica=                  $request->diastolica;
                $cardiovascular->pulso=                       $request->pulso;
                $cardiovascular->observacion_varices=         $request->observacion_varices;
                $cardiovascular->historia_clinica_id=         $historia_clinica->id;
                $cardiovascular->save();
            //
            //PIEL
                $piel=new Piel();
                $piel->observacion1_piel=     $request->observacion1_piel;
                $piel->obs_vesicula=          $request->obs_vesicula;
                $piel->obs_ulceras=           $request->obs_ulceras;
                $piel->obs_fisuras=           $request->obs_fisuras;
                $piel->obs_prurito=           $request->obs_prurito;
                $piel->obs_eczemas=           $request->obs_eczemas;
                $piel->obs_dertmatitis=       $request->obs_dertmatitis;
                $piel->obs_eritemas=          $request->obs_eritemas;
                $piel->obs_petequias=         $request->obs_petequias;
                $piel->tejido=                $request->tejido;
                $piel->historia_clinica_id=   $historia_clinica->id;
                $piel->save();
            //
            //OSTEOARTICULAR
                $osteoarticular=new Osteoarticular();
                $osteoarticular->observacion1_os=       $request->observacion1_os;
                $osteoarticular->observacion2_os=       $request->observacion2_os;
                $osteoarticular->observacion3_os=       $request->observacion3_os;
                $osteoarticular->observacion4_os=       $request->observacion4_os;
                $osteoarticular->observacion_os=        $request->observacion_os;
                $osteoarticular->historia_clinica_id=   $historia_clinica->id;
                $osteoarticular->save();
            //
            //COLUMNA VERTEBRAL
                $columna=new Columna();
                $columna->observacion1_col=$request->observacion1_col;
                $columna->observacion2_col=$request->observacion2_col;
                $columna->observacion3_col=$request->observacion3_col;
                $columna->observacion4_col=$request->observacion4_col;
                $columna->observacion_col=$request->observacion_col;
                $columna->historia_clinica_id=$historia_clinica->id;
                $columna->save();
            //
            //CABEZA Y CUELLO
                $cabezacuello=new CabezaCuello();
                $cabezacuello->observacion1_cc=$request->observacion1_cc;
                $cabezacuello->observacion2_cc=$request->observacion2_cc;
                $cabezacuello->observacion3_cc=$request->observacion3_cc;
                $cabezacuello->observacion4_cc=$request->observacion4_cc;
                $cabezacuello->observacion5_cc=$request->observacion5_cc;
                $cabezacuello->observacion6_cc=$request->observacion6_cc;
                $cabezacuello->historia_clinica_id=$historia_clinica->id;
                $cabezacuello->save();
            //
            //OFTALMOLÓGICO
                $oftalmologico=new Oftalmologico();
                $oftalmologico->observacion1_of=$request->observacion1_of;
                $oftalmologico->observacion2_of=$request->observacion2_of;
                $oftalmologico->observacion3_of=$request->observacion3_of;
                $oftalmologico->observacion4_of=$request->observacion4_of;
                $oftalmologico->observacion5_of=$request->observacion5_of;
                $oftalmologico->observacion6_of=$request->observacion6_of;
                $oftalmologico->pregunta7_of=$request->pregunta7_of;
                $oftalmologico->observacion_of=$request->observacion_of;
                $oftalmologico->historia_clinica_id=$historia_clinica->id;
                $oftalmologico->save();
            //
            //NEUROLOGICO
                $neutologico=new Neurologico();
                $neutologico->observacion1_neu=$request->observacion1_neu;
                $neutologico->observacion2_neu=$request->observacion2_neu;
                $neutologico->observacion3_neu=$request->observacion3_neu;
                $neutologico->observacion4_neu=$request->observacion4_neu;
                $neutologico->observacion5_neu=$request->observacion5_neu;
                $neutologico->observacion6_neu=$request->observacion6_neu;
                $neutologico->observacion7_neu=$request->observacion7_neu;
                $neutologico->observacion_neu=$request->observacion_neu;
                $neutologico->historia_clinica_id=$historia_clinica->id;
                $neutologico->save();
            //
            //ODONTOLOGICO
                $odontologico=new Odontologico();
                $odontologico->observacion1_od=$request->observacion1_od;
                $odontologico->observacion2_od=$request->observacion2_od;
                $odontologico->pregunta4_od=$request->pregunta4_od;
                $odontologico->pregunta5_od=$request->pregunta5_od;
                $odontologico->superior=$request->superior;
                $odontologico->inferior=$request->inferior;
                $odontologico->observacion_od=$request->observacion_od;
                $odontologico->historia_clinica_id=$historia_clinica->id;
                $odontologico->save();
            //
            //TORAX Y APARTO RESPIRATORIO
                $respiratorio=new Respiratorio();
                $respiratorio->observacion1_re=$request->observacion1_re;
                $respiratorio->observacion2_re=$request->observacion2_re;
                $respiratorio->covid19=$request->covid19;
                $respiratorio->vacunado=$request->vacunado;
                $respiratorio->historia_clinica_id=$historia_clinica->id;
                $respiratorio->save();
            //
            //ABDOMEN
                $abdomen=new Abdomen();
                $abdomen->observacion1_ab=$request->observacion1_ab;
                $abdomen->observacion2_ab=$request->observacion2_ab;
                $abdomen->observacion3_ab=$request->observacion3_ab;
                $abdomen->observacion4_ab=$request->observacion4_ab;
                $abdomen->observacion5_ab=$request->observacion5_ab;
                $abdomen->observacion6_ab=$request->observacion6_ab;
                $abdomen->observacion_ab=$request->observacion_ab;
                $abdomen->historia_clinica_id=$historia_clinica->id;
                $abdomen->save();
            //
            //REGIONES INGUINALES
                $inguinal=new RegionInguinal();
                $inguinal->observacion1_in=$request->observacion1_in;
                $inguinal->observacion2_in=$request->observacion2_in;
                $inguinal->observacion3_in=$request->observacion3_in;
                $inguinal->observacion_in=$request->observacion_in;
                $inguinal->historia_clinica_id=$historia_clinica->id;
                $inguinal->save();
            //
            //GENITALES
                $genital=new Genital();
                $genital->observacion1_ge=$request->observacion1_ge;
                $genital->observacion_ge=$request->observacion_ge;
                $genital->historia_clinica_id=$historia_clinica->id;
                $genital->save();
            //
            //REGIÓN ANAL
                $reganal=new RegionAnal();
                $reganal->observacion1_an=$request->observacion1_an;
                $reganal->observacion_an=$request->observacion_an;
                $reganal->historia_clinica_id=$historia_clinica->id;
                $reganal->save();
            //
        //

        //Generar PDF y enlazarlo
            //Obtener voucher-estudio
            foreach ($voucher->vouchersEstudios as $item) {
                if ($item->estudio->nombre == "HISTORIA CLINICA") {
                    $estudio = $item;
                }
            }
            /*//Ruta de PDF
            $ruta = public_path().'/archivo/'."HISTORIA CLINICA".$estudio->id.".pdf";
            //Generar PDF
            $pdf = PDF::loadView('historia_clinica.pdf',[
                "hc_formulario"   =>  $historia_clinica
                ]);
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

    public function edit($id){
        $pacientes=Paciente::where('historia_clinica',false)->get();
        //esta variable $voucher deberia traer el voucher + nombre del paciente y dni + fecha...en el modelo y quedarte eunuco
        $voucher  = Voucher::find($id);
        $origenes = Origen::all();
        $obra_sociales = ObraSocial::all();
        $paises=Pais::all();

        $peso_decla_jurada="";
        $altura_decla_jurada="";
        if($voucher->declaracionJurada){
          $declaJurada  = DeclaracionJurada::find($voucher->declaracionJurada->id);
          $peso_decla_jurada=$declaJurada->voucher->paciente->peso;
          $altura_decla_jurada=$declaJurada->voucher->paciente->estatura;
        }

        $historia_clinica=HistoriaClinica::find($voucher->historiaClinica->id);

        return view('historia_clinica.edit', compact('voucher','pacientes','origenes','obra_sociales','paises','historia_clinica','peso_decla_jurada','altura_decla_jurada'));
    }

    public function update(Request $request, $id)
    {
        //Crear y buscar Models
        //$n=HistoriaClinica::count() + 1;
        $voucher=Voucher::find($request->voucher_id);
        //$historia_clinica=new HistoriaClinica();

        //dd($request);

        $historia_clinica=HistoriaClinica::findOrFail($id);

        //Historia clínica
        $historia_clinica->firma=$request->firma;
        //$historia_clinica->codigo=str_pad($n, 10, '0', STR_PAD_LEFT);
        //$historia_clinica->voucher_id=$request->voucher_id;
        $historia_clinica->user_id=auth()->user()->id;
        $historia_clinica->save();
        
        //Carga de tablas
            //Examen Clinico
                $examen_clinico=ExamenClinico::FindOrFail($historia_clinica->examenClinico->id);
                $examen_clinico->peso=                  $request->peso                  ;
                $examen_clinico->estatura=              $request->estatura              ;
                $examen_clinico->sobrepeso=             $request->sobrepeso             ;
                $examen_clinico->imc=                   $request->imc                   ;
                $examen_clinico->medicacion_actual=     $request->medicacion_actual     ;
                $examen_clinico->historia_clinica_id=   $historia_clinica->id           ;
                $examen_clinico->update();
            //
            //Cardiovascular
                $cardiovascular=Cardiovascular::FindOrFail($historia_clinica->cardiovascular->id);
                $cardiovascular->frecuencia_cardiaca=         $request->frecuencia_cardiaca;
                $cardiovascular->tension_arterial=            $request->tension_arterial;
                $cardiovascular->sistolica=                   $request->sistolica;
                $cardiovascular->diastolica=                  $request->diastolica;
                $cardiovascular->pulso=                       $request->pulso;
                $cardiovascular->observacion_varices=         $request->observacion_varices;
                $cardiovascular->historia_clinica_id=         $historia_clinica->id;
                $cardiovascular->update();
            //
            //PIEL
                $piel=Piel::FindOrFail($historia_clinica->piel->id);
                $piel->observacion1_piel=     $request->observacion1_piel;
                $piel->obs_vesicula=          $request->obs_vesicula;
                $piel->obs_ulceras=           $request->obs_ulceras;
                $piel->obs_fisuras=           $request->obs_fisuras;
                $piel->obs_prurito=           $request->obs_prurito;
                $piel->obs_eczemas=           $request->obs_eczemas;
                $piel->obs_dertmatitis=       $request->obs_dertmatitis;
                $piel->obs_eritemas=          $request->obs_eritemas;
                $piel->obs_petequias=         $request->obs_petequias;
                $piel->tejido=                $request->tejido;
                $piel->historia_clinica_id=   $historia_clinica->id;
                $piel->update();
            //
            //OSTEOARTICULAR
                $osteoarticular=Osteoarticular::FindOrFail($historia_clinica->osteoarticular->id);
                $osteoarticular->observacion1_os=       $request->observacion1_os;
                $osteoarticular->observacion2_os=       $request->observacion2_os;
                $osteoarticular->observacion3_os=       $request->observacion3_os;
                $osteoarticular->observacion4_os=       $request->observacion4_os;
                $osteoarticular->observacion_os=        $request->observacion_os;
                $osteoarticular->historia_clinica_id=   $historia_clinica->id;
                $osteoarticular->update();
            //
            //COLUMNA VERTEBRAL
                $columna=Columna::FindOrFail($historia_clinica->columna->id);
                $columna->observacion1_col=$request->observacion1_col;
                $columna->observacion2_col=$request->observacion2_col;
                $columna->observacion3_col=$request->observacion3_col;
                $columna->observacion4_col=$request->observacion4_col;
                $columna->observacion_col=$request->observacion_col;
                $columna->historia_clinica_id=$historia_clinica->id;
                $columna->update();
            //
            //CABEZA Y CUELLO
                $cabezacuello=CabezaCuello::FindOrFail($historia_clinica->cabezaCuello->id);
                $cabezacuello->observacion1_cc=$request->observacion1_cc;
                $cabezacuello->observacion2_cc=$request->observacion2_cc;
                $cabezacuello->observacion3_cc=$request->observacion3_cc;
                $cabezacuello->observacion4_cc=$request->observacion4_cc;
                $cabezacuello->observacion5_cc=$request->observacion5_cc;
                $cabezacuello->observacion6_cc=$request->observacion6_cc;
                $cabezacuello->historia_clinica_id=$historia_clinica->id;
                $cabezacuello->update();
            //
            //OFTALMOLÓGICO
                $oftalmologico=Oftalmologico::FindOrFail($historia_clinica->oftalmologico->id);
                $oftalmologico->observacion1_of=$request->observacion1_of;
                $oftalmologico->observacion2_of=$request->observacion2_of;
                $oftalmologico->observacion3_of=$request->observacion3_of;
                $oftalmologico->observacion4_of=$request->observacion4_of;
                $oftalmologico->observacion5_of=$request->observacion5_of;
                $oftalmologico->observacion6_of=$request->observacion6_of;
                $oftalmologico->pregunta7_of=$request->pregunta7_of;
                $oftalmologico->observacion_of=$request->observacion_of;
                $oftalmologico->historia_clinica_id=$historia_clinica->id;
                $oftalmologico->update();
            //
            //NEUROLOGICO
                $neutologico=Neurologico::FindOrFail($historia_clinica->neurologico->id);
                $neutologico->observacion1_neu=$request->observacion1_neu;
                $neutologico->observacion2_neu=$request->observacion2_neu;
                $neutologico->observacion3_neu=$request->observacion3_neu;
                $neutologico->observacion4_neu=$request->observacion4_neu;
                $neutologico->observacion5_neu=$request->observacion5_neu;
                $neutologico->observacion6_neu=$request->observacion6_neu;
                $neutologico->observacion7_neu=$request->observacion7_neu;
                $neutologico->observacion_neu=$request->observacion_neu;
                $neutologico->historia_clinica_id=$historia_clinica->id;
                $neutologico->update();
            //
            //ODONTOLOGICO
                $odontologico=Odontologico::FindOrFail($historia_clinica->odontologico->id);
                $odontologico->observacion1_od=$request->observacion1_od;
                $odontologico->observacion2_od=$request->observacion2_od;
                $odontologico->pregunta4_od=$request->pregunta4_od;
                $odontologico->pregunta5_od=$request->pregunta5_od;
                $odontologico->superior=$request->superior;
                $odontologico->inferior=$request->inferior;
                $odontologico->observacion_od=$request->observacion_od;
                $odontologico->historia_clinica_id=$historia_clinica->id;
                $odontologico->update();
            //
            //TORAX Y APARTO RESPIRATORIO
                $respiratorio=Respiratorio::FindOrFail($historia_clinica->respiratorio->id);
                $respiratorio->observacion1_re=$request->observacion1_re;
                $respiratorio->observacion2_re=$request->observacion2_re;
                /*$respiratorio->covid19=$request->covid19;
                $respiratorio->vacunado=$request->vacunado;*/
                $respiratorio->historia_clinica_id=$historia_clinica->id;
                $respiratorio->update();
            //
            //ABDOMEN
                $abdomen=Abdomen::FindOrFail($historia_clinica->abdomen->id);
                $abdomen->observacion1_ab=$request->observacion1_ab;
                $abdomen->observacion2_ab=$request->observacion2_ab;
                $abdomen->observacion3_ab=$request->observacion3_ab;
                $abdomen->observacion4_ab=$request->observacion4_ab;
                $abdomen->observacion5_ab=$request->observacion5_ab;
                $abdomen->observacion6_ab=$request->observacion6_ab;
                $abdomen->observacion_ab=$request->observacion_ab;
                $abdomen->historia_clinica_id=$historia_clinica->id;
                $abdomen->update();
            //
            //REGIONES INGUINALES
                $inguinal=RegionInguinal::FindOrFail($historia_clinica->regionInguinal->id);
                $inguinal->observacion1_in=$request->observacion1_in;
                $inguinal->observacion2_in=$request->observacion2_in;
                $inguinal->observacion3_in=$request->observacion3_in;
                $inguinal->observacion_in=$request->observacion_in;
                $inguinal->historia_clinica_id=$historia_clinica->id;
                $inguinal->update();
            //
            //GENITALES
                $genital=Genital::FindOrFail($historia_clinica->genital->id);
                $genital->observacion1_ge=$request->observacion1_ge;
                $genital->observacion_ge=$request->observacion_ge;
                $genital->historia_clinica_id=$historia_clinica->id;
                $genital->update();
            //
            //REGIÓN ANAL
                $reganal=RegionAnal::FindOrFail($historia_clinica->regionAnal->id);
                $reganal->observacion1_an=$request->observacion1_an;
                $reganal->observacion_an=$request->observacion_an;
                $reganal->historia_clinica_id=$historia_clinica->id;
                $reganal->update();
            //
        //

        //Generar PDF y enlazarlo
            //Obtener voucher-estudio
            /*foreach ($voucher->vouchersEstudios as $item) {
                if ($item->estudio->nombre == "HISTORIA CLINICA") {
                    $estudio = $item;
                }
            }*/
            /*//Ruta de PDF
            $ruta = public_path().'/archivo/'."HISTORIA CLINICA".$estudio->id.".pdf";
            //Generar PDF
            $pdf = PDF::loadView('historia_clinica.pdf',[
                "hc_formulario"   =>  $historia_clinica
                ]);
            $pdf->setPaper('a4','letter');
            $pdf->save($ruta);*/
            //Almacenar archivo adjunto
            /*$archivo_adjunto = new ArchivoAdjunto();
            $archivo_adjunto->anexo = "ruta";
            $archivo_adjunto->voucher_estudio_id = $estudio->id;
            $archivo_adjunto->save();*/
        //
        return redirect()->route('voucher.show',$voucher->id);
    }
}
