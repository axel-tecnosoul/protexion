<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use App\DeclaracionJurada;
use App\AntecedenteFamiliar;
use App\AntecedenteMedicoInfancia;
use App\AntecedentePersonal;
use App\AntecedenteQuirurjico;
use App\AntecedenteReciente;
use App\ArchivoAdjunto;
use App\Voucher;
use App\PersonalClinica;

use PDF;
use Carbon\Carbon;

class DeclaracionJuradaController extends Controller
{
    /*function __construct()
    {
         $this->middleware('permission:listar declaraciones_juradas|crear declaracion_jurada|editar declaracion_jurada|eliminar declaracion_jurada', ['only' => ['index','store']]);
         $this->middleware('permission:crear declaracion_jurada', ['only' => ['create','store']]);
         $this->middleware('permission:editar declaracion_jurada', ['only' => ['edit','update']]);
         $this->middleware('permission:eliminar declaracion_jurada', ['only' => ['destroy']]);
    }*/

    public function traerDatosPaciente(Request $request)
    {
        $voucher=Voucher::find($request->id);
        $retorno = [
            'documento'         =>  number_format( (intval($voucher->paciente->documento)/1000), 3, '.', '.'),
            'nombres'           =>  $voucher->paciente->nombreCompleto(),
            'fecha_nacimiento'  =>  Carbon::parse($voucher->paciente->fecha_nacimiento)->format('d/m/Y'),
            'foto'              =>  asset('imagenes/paciente/'.$voucher->paciente->foto),
            'cuil'              =>  $voucher->paciente->cuil,
            'sexo'              =>  $voucher->paciente->sexo->definicion,
        ];
        return response()->json($retorno);

    }

    public function index()
    {
        $declaraciones_juradas = DeclaracionJurada::all();
        return view('declaracion_jurada.index',compact('declaraciones_juradas'));
    }
    
    public function crearPDF($id)
    {
    $declaracion_jurada=DeclaracionJurada::find($id);
        $pdf = PDF::loadView('declaracion_jurada.pdf',[
            "declaracion_jurada"   =>  $declaracion_jurada
            ]);

        $pdf->setPaper('a4','letter');
        return $pdf->stream();
    }

    public function create($id)
    {
        $voucher  = Voucher::find($id);
        //trae a los puestos que no sean amdinistradores ni secretarias
        $personal_clinicas = PersonalClinica::whereNotIn('puesto_id', [1,2])->get();
        return view('declaracion_jurada.create', compact('voucher','personal_clinicas'));
    }

    public function store(Request $request)
    {       
            //Crear y buscar los models
            $declaracion_jurada=new DeclaracionJurada();
            $voucher=Voucher::find($request->voucher_id);
            $paciente=Paciente::find($voucher->paciente_id);

            //Actualizar paciente
            $paciente->peso=$request->peso;
            $paciente->estatura=$request->estatura;
            $paciente->update();

            //Almacenar Declaracion jurada
            $n=DeclaracionJurada::count() + 1;
            $declaracion_jurada->firma=$request->firma;
            $declaracion_jurada->codigo=str_pad($n, 10, '0', STR_PAD_LEFT);
            $declaracion_jurada->personal_clinica_id=$request->personal_clinica_id;
            $declaracion_jurada->voucher_id=$request->voucher_id;
            $declaracion_jurada->ciudad_id=18; //Todos a Puerto Rico
            $declaracion_jurada->fecha_realizacion=$request->fecha_realizacion;
            $declaracion_jurada->save();

            //Tablas secundarias
                $antecedente_familiar=new AntecedenteFamiliar();
                $antecedente_familiar->su_padre_vive=$request->su_padre_vive;
                $antecedente_familiar->su_madre_vive=$request->su_madre_vive;
                $antecedente_familiar->cancer=$request->cancer;
                $antecedente_familiar->diabetes=$request->diabetes;
                $antecedente_familiar->infarto=$request->infarto;
                $antecedente_familiar->hipertension_Arterial=$request->hipertension_Arterial;
                $antecedente_familiar->detalle=$request->detalle;
                $antecedente_familiar->declaracion_jurada_id=$declaracion_jurada->id;
                $antecedente_familiar->save();

                $antecedente_personal=new AntecedentePersonal();
                $antecedente_personal->fuma=$request->fuma;
                $antecedente_personal->bebe=$request->bebe;
                $antecedente_personal->actividad_fisica=$request->actividad_fisica;
                $antecedente_personal->declaracion_jurada_id=$declaracion_jurada->id;
                $antecedente_personal->save();

                $antecedente_medico_infancia=new AntecedenteMedicoInfancia();
                $antecedente_medico_infancia->sarampion=$request->sarampion;
                $antecedente_medico_infancia->rebeola=$request->rebeola;
                $antecedente_medico_infancia->epilepsia=$request->epilepsia;
                $antecedente_medico_infancia->varicela=$request->varicela;
                $antecedente_medico_infancia->parotiditis=$request->parotiditis;
                $antecedente_medico_infancia->cefalea_prolongada=$request->cefalea_prolongada;
                $antecedente_medico_infancia->hepatitis=$request->hepatitis;
                $antecedente_medico_infancia->gastritis=$request->gastritis;
                $antecedente_medico_infancia->ulcera_gastrica=$request->ulcera_gastrica;
                $antecedente_medico_infancia->hemorroide=$request->hemorroide;
                $antecedente_medico_infancia->hemorragias=$request->hemorragias;
                $antecedente_medico_infancia->neumonia=$request->neumonia;
                $antecedente_medico_infancia->asma=$request->asma;
                $antecedente_medico_infancia->tuberculosis=$request->tuberculosis;
                $antecedente_medico_infancia->tos_cronica=$request->tos_cronica;
                $antecedente_medico_infancia->catarro=$request->catarro;
                $antecedente_medico_infancia->detalle1_m=$request->detalle1_m;
                $antecedente_medico_infancia->declaracion_jurada_id=$declaracion_jurada->id;
                $antecedente_medico_infancia->save();

                $antecedente_reciente=new AntecedenteReciente();            
                $antecedente_reciente->detalle1_reciente=$request->detalle1_reciente;
                $antecedente_reciente->detalle2_reciente=$request->detalle2_reciente;
                $antecedente_reciente->detalle3_reciente=$request->detalle3_reciente;
                $antecedente_reciente->detalle4_reciente=$request->detalle4_reciente;
                $antecedente_reciente->detalle5_reciente=$request->detalle5_reciente;
                $antecedente_reciente->detalle6_reciente=$request->detalle6_reciente;
                $antecedente_reciente->detalle7_reciente=$request->detalle7_reciente;
                $antecedente_reciente->detalle8_reciente=$request->detalle8_reciente;
                $antecedente_reciente->detalle9_reciente=$request->detalle9_reciente;
                $antecedente_reciente->detalle10_reciente=$request->detalle10_reciente;
                $antecedente_reciente->detalle11_reciente=$request->detalle11_reciente;
                $antecedente_reciente->detalle12_reciente=$request->detalle12_reciente;
                $antecedente_reciente->detalle13_reciente=$request->detalle13_reciente;
                $antecedente_reciente->detalle14_reciente=$request->detalle14_reciente;
                $antecedente_reciente->declaracion_jurada_id=$declaracion_jurada->id;
                $antecedente_reciente->save();

                $antecedente_quirurjico=new AntecedenteQuirurjico();
                $antecedente_quirurjico->detalle1_q=$request->detalle1_q;
                $antecedente_quirurjico->detalle2_q=$request->detalle2_q;
                $antecedente_quirurjico->detalle3_q=$request->detalle3_q;
                $antecedente_quirurjico->declaracion_jurada_id=$declaracion_jurada->id;
                $antecedente_quirurjico->save();
            //

            //Generar PDF y enlazarlo
                //Obtener voucher-estudio
                $estudio = $voucher->getVoucherEstudio("DECLARACION JURADA");

                //Ruta de PDF
                $ruta = public_path().'/archivo/'."DECLARACION JURADA".$estudio->id.".pdf";
                //Generar PDF
                $pdf = PDF::loadView('declaracion_jurada.pdf',[
                    "declaracion_jurada"   =>  $declaracion_jurada
                    ]);
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
