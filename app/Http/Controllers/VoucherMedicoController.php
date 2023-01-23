<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Estudio;
use App\Models\TipoEstudio;
//use App\Models\Aptitud;
use App\Riesgos;
use DB;

use Illuminate\Http\Request;
use App\Voucher;
use App\VoucherMedico;
use App\User;
use App\Paciente;
use App\Models\VoucherEstudio;
use App\Models\VoucherRiesgos;
use Carbon\Carbon;
use PDF;

class VoucherMedicoController extends Controller
{

    /*function __construct()
    {
         $this->middleware('permission:listar vouchers|crear voucher|editar voucher|eliminar voucher', ['only' => ['index','store']]);
         $this->middleware('permission:crear voucher', ['only' => ['create','store']]);
         $this->middleware('permission:editar voucher', ['only' => ['edit','update']]);
         $this->middleware('permission:eliminar voucher', ['only' => ['destroy']]);
    }*/
    
    public function traerDatosPaciente($fecha,$tipo_estudio_id)
    {
      $query = DB::table('vouchers')
        ->join('vouchers_estudios', 'vouchers_estudios.voucher_id', '=', 'vouchers.id')
        ->join('estudios', 'vouchers_estudios.estudio_id', '=', 'estudios.id')
        //->where('carga', '=', 0);
        ->whereNotIn('estudios.id', [1,60,66,73]);
        //->join('pacientes', 'vouchers.paciente_id', '=', 'pacientes.id');
        //->where('followers.follower_id', '=', 3)
        //->get();

      if($fecha){
          $query = $query->where('turno','=',$fecha);
      }
      if($tipo_estudio_id){
          $query = $query->where('tipo_estudio_id','=',$tipo_estudio_id);
      }
      //dd($query);
      
      $vouchers_medico=$query->get(); //ejecuto la consulta
      $aVoucherMedico=[];
      foreach($vouchers_medico as $voucher){
        $paciente=Paciente::find($voucher->paciente_id);
        $paciente=$paciente->nombreCompleto();
        $aVoucherMedico[]=[
          "paciente" => $paciente,
          "estudio" => $voucher->nombre,
        ];
        /*if($voucher->tipo_estudio_id==$tipo_estudio_id){
          var_dump($voucher);
        }*/
      }
      //var_dump($aVoucherMedico);

      $aPacientes=[];
      foreach ($aVoucherMedico as $k => &$paciente) {
          $aPacientes[$paciente['paciente']][$k] = $paciente['estudio'];
      }
      //var_dump($aPacientes);

      return $aPacientes;
    }

    public function index(Request $request)
    {
        //$vouchers = Voucher::all(); //obteneme todas los vouchers
        $tipo_estudios=TipoEstudio::all();

        $fecha=date("Y-m-d");
        $tipo_estudio_id=0;

        $aPacientes=[];
        if(isset($request->fecha)){
          $fecha=$request->fecha;
          $tipo_estudio_id=$request->tipo_estudio_id;
          //if(is_null($fecha)) $fecha=date("Y-m-d");

          $aPacientes=$this->traerDatosPaciente($fecha,$tipo_estudio_id);
        }

        //$vouchers = Voucher::orderBy('id', 'desc')->get();
        return view('voucher_medico.index',[
            //"vouchers"          => $vouchers,
            "aPacientes"        => $aPacientes,
            "fecha"             => $fecha,
            "tipo_estudio_id"   => $tipo_estudio_id,
            "tipo_estudios"     => $tipo_estudios
        ]);
    }

    public function pdf_medico(Request $request)
    {

      $fecha=$request->fecha;
      $tipo_estudio_id=$request->tipo_estudio_id;
      //if(is_null($fecha)) $fecha=date("Y-m-d");

      $tipo_estudio=TipoEstudio::find($tipo_estudio_id);

      $aPacientes=$this->traerDatosPaciente($fecha,$tipo_estudio_id);

      //return view('voucher_medico.pdf_medico', compact('aPacientes', 'tipo_estudio', 'fecha','tipo_estudio_id'));
      $pdf = PDF::loadView('voucher_medico.pdf_medico',[
        "aPacientes"       => $aPacientes,
        "tipo_estudio"     => $tipo_estudio,
        //"estudios"       => $estudios,
        "fecha"            => $fecha,
        "tipo_estudio_id"  => $tipo_estudio_id
      ]);
      $pdf->setPaper('a4','letter');
      return $pdf->stream('voucher_medico.pdf');
    }


}
