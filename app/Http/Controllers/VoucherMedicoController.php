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
//use App\VoucherMedico;
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

      $tipo_estudio_id=explode(".",$tipo_estudio_id);

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
      if($tipo_estudio_id[0]=="te"){
          if($tipo_estudio_id[1]==1){
              //$query = $query->orWhere('tipo_estudio_id','=',2);
                $query = $query->where(function($query) {
                  $query->where('tipo_estudio_id', '=', 1)
                        ->orWhere('tipo_estudio_id', '=', 2);
              });
          }else{
              $query = $query->where('tipo_estudio_id','=',$tipo_estudio_id[1]);
          }
      }elseif($tipo_estudio_id[0]=="e"){
        $query = $query->where('estudio_id','=',$tipo_estudio_id[1]);
      }
      //dd($query);
      
      $vouchers_medico=$query->get(); //ejecuto la consulta
      //$vouchers_medico=$query->dd(); //ejecuto la consulta
      $aVoucherMedico=[];
      foreach($vouchers_medico as $voucher){
        $paciente=Paciente::find($voucher->paciente_id);

        //$dniCuil=$paciente->cuil ?? number_format($paciente->documento,0,",",".");
        $dni=number_format($paciente->documento,0,",",".");

        $paciente="(".$dni.") ".$paciente->nombreCompleto();
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

        //obtenemos todos los tipos de estudios
        $tipo_estudios=TipoEstudio::all();
        //eliminamos los tipos de estudios que no se deben mostrar
        $nuevo_tipo_estudios = $tipo_estudios->filter(function ($item) {
          if (!in_array($item->id,[2,3])) {//2 => ANEXO 1, 3 => COMPLEMENTARIO
              return $item;
          }
        });
        //obtenemos los estudios del tipo de estudio "COMPLEMENTARIO"
        $estudios_complementarios=Estudio::whereTipo_estudio_id(3)->get();
        //creamos un nuevo array para poder manejar los tipos de estudios y los estudios complementarios
        $aEstudios=[];
        foreach ($nuevo_tipo_estudios->toArray() as $tipo_estudio) {
          $aEstudios[]=[
            "id"=>"te.".$tipo_estudio["id"],
            "nombre"=>$tipo_estudio["nombre"]
          ];
        }
        foreach ($estudios_complementarios->toArray() as $estudio) {
          if($estudio["id"]!=73){
            $aEstudios[]=[
              "id"=>"e.".$estudio["id"],
              "nombre"=>$estudio["nombre"]
            ];
          }
        }
        //dd($aEstudios);

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
            "aEstudios"         => $aEstudios
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
