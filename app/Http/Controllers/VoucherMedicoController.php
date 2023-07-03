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
use PHPExcel;
use PHPExcel_IOFactory;

class VoucherMedicoController extends Controller
{

    /*function __construct()
    {
         $this->middleware('permission:listar vouchers|crear voucher|editar voucher|eliminar voucher', ['only' => ['index','store']]);
         $this->middleware('permission:crear voucher', ['only' => ['create','store']]);
         $this->middleware('permission:editar voucher', ['only' => ['edit','update']]);
         $this->middleware('permission:eliminar voucher', ['only' => ['destroy']]);
    }*/
    
    public function traerDatosPaciente($desde,$hasta,$tipo_estudio_id)
    {

      $tipo_estudio_id=explode(".",$tipo_estudio_id);

      $query = DB::table('vouchers')
        ->join('vouchers_estudios', 'vouchers_estudios.voucher_id', '=', 'vouchers.id')
        ->join('estudios', 'vouchers_estudios.estudio_id', '=', 'estudios.id')
        ->join('origenes', 'vouchers.origen_id', '=', 'origenes.id')
        //->where('carga', '=', 0);
        ->where('vouchers.anulado','=',0)
        ->whereNotIn('estudios.id', [1,60,66,73]);
        //->join('pacientes', 'vouchers.paciente_id', '=', 'pacientes.id');
        //->where('followers.follower_id', '=', 3)
        //->get();

      if($desde){
          $query = $query->where('turno','>=',$desde);
      }
      if($hasta){
        $query = $query->where('turno','<=',$hasta);
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
      //TRAEMOS TODOS LOS ESTUDIOS DE LOS VOUCHERS DE LOS PACIENTES
      foreach($vouchers_medico as $voucher){
        $paciente=Paciente::find($voucher->paciente_id);

        if($paciente->estado_id==1){
          //$dniCuil=$paciente->cuil ?? number_format($paciente->documento,0,",",".");
          $dni="";
          if($paciente->documento){
            $dni=$paciente->documento;
            $dni=str_replace(".","",$dni);
            $dni=number_format($dni,0,",",".");
          }

          //$pacienteNombre="(".$dni.") ".$paciente->nombreCompleto();
          $pacienteNombre=$paciente->nombreCompleto();
          $edadPaciente=$paciente->edad();
          $turno=new Carbon($voucher->turno);
          $aVoucherMedico[]=[
            "turno" => $turno->format('d/m/Y'),
            "paciente" => $pacienteNombre,
            "dni" => $dni,
            "edad" => $edadPaciente,
            "empresa" => $voucher->definicion,
            "estudio" => $voucher->nombre,
          ];
        }
        /*if($voucher->tipo_estudio_id==$tipo_estudio_id){
          var_dump($voucher);
        }*/
      }
      //var_dump($aVoucherMedico);

      //AGRUPAMOS TODOS LOS ESTUDIOS CON EL PACIENTE QUE CORRESPONDE
      $aPacientes=[];
      foreach ($aVoucherMedico as $k => &$paciente) {
          $aPacientes[$paciente['paciente']]["estudios"][$k] = $paciente['estudio'];
          $aPacientes[$paciente['paciente']]["turno"] = $paciente['turno'];
          $aPacientes[$paciente['paciente']]["empresa"] = $paciente['empresa'];
          $aPacientes[$paciente['paciente']]["dni"] = $paciente['dni'];
          $aPacientes[$paciente['paciente']]["edad"] = $paciente['edad'];
      }
      /*var_dump($aPacientes);
      die();*/

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

        $desde=date("Y-m-d");
        $hasta=date("Y-m-d");
        $tipo_estudio_id=0;

        $aPacientes=[];
        if(isset($request->desde)){
          $desde=$request->desde;
        }
        if(isset($request->hasta)){
          $hasta=$request->hasta;
        }
        $tipo_estudio_id=$request->tipo_estudio_id;
        if(is_null($tipo_estudio_id)) $tipo_estudio_id=0;
         //if(is_null($desde)) $desde=date("Y-m-d");

        $aPacientes=$this->traerDatosPaciente($desde,$hasta,$tipo_estudio_id);

        //$vouchers = Voucher::orderBy('id', 'desc')->get();
        return view('voucher_medico.index',[
            //"vouchers"          => $vouchers,
            "aPacientes"        => $aPacientes,
            "desde"             => $desde,
            "hasta"             => $hasta,
            "tipo_estudio_id"   => $tipo_estudio_id,
            "aEstudios"         => $aEstudios
        ]);
    }

    public function pdf_medico(Request $request)
    {

      $desde=$request->desde;
      $hasta=$request->hasta;
      $tipo_estudio_id=$request->tipo_estudio_id;
      //if(is_null($fecha)) $fecha=date("Y-m-d");

      //dd($request->fecha);

      $aPacientes=$this->traerDatosPaciente($desde,$hasta,$tipo_estudio_id);

      $tipo_estudio_id=explode(".",$tipo_estudio_id);
      
      if($tipo_estudio_id[0]=="te"){
          $tipo_estudio=TipoEstudio::find($tipo_estudio_id[1]);
      }elseif($tipo_estudio_id[0]=="e"){
          $tipo_estudio=Estudio::find($tipo_estudio_id[1]);
      }

      //dd($tipo_estudio);

      //return view('voucher_medico.pdf_medico', compact('aPacientes', 'tipo_estudio', 'fecha','tipo_estudio_id'));
      $pdf = PDF::loadView('voucher_medico.pdf_medico',[
        "aPacientes"       => $aPacientes,
        "tipo_estudio"     => $tipo_estudio,
        //"estudios"       => $estudios,
        "desde"            => $desde,
        "hasta"            => $hasta,
        "tipo_estudio_id"  => $tipo_estudio_id
      ]);
      $pdf->setPaper('a4','letter');
      return $pdf->stream('voucher_medico.pdf');
    }

    public function excel_medico(Request $request)
    {

      $desde=$request->desde;
      $hasta=$request->hasta;
      $tipo_estudio_id=$request->tipo_estudio_id;
      //if(is_null($fecha)) $fecha=date("Y-m-d");

      //dd($request->fecha);

      $aPacientes=$this->traerDatosPaciente($desde,$hasta,$tipo_estudio_id);

      $tipo_estudio_id=explode(".",$tipo_estudio_id);
      
      if($tipo_estudio_id[0]=="te"){
          $tipo_estudio=TipoEstudio::find($tipo_estudio_id[1]);
      }elseif($tipo_estudio_id[0]=="e"){
          $tipo_estudio=Estudio::find($tipo_estudio_id[1]);
      }

      //$ori=DB::select('SELECT definicion FROM origenes');
      //var_dump($ori);

      require_once './../vendor/PHPExcel.php';
      $objPHPExcel = new PHPExcel();
      //$objPHPExcel = new PHPExcel();
      //Informacion del excel
      /*$objPHPExcel->
      getProperties()
        ->setCreator("ingenieroweb.com.co")
        ->setLastModifiedBy("ingenieroweb.com.co")
        ->setTitle("Exportar excel desde mysql")
        ->setSubject("Ejemplo 1")
        ->setDescription("Documento generado con PHPExcel")
        ->setKeywords("ingenieroweb.com.co  con  phpexcel")
        ->setCategory("ciudades"); */   

      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',"Desde:");
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1',date("d-m-Y",strtotime($desde)));
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1',"Hasta:");
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1',date("d-m-Y",strtotime($hasta)));
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1',"Tipo de estudio:");
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1',$tipo_estudio->nombre);
      
      $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);
      $objPHPExcel->setActiveSheetIndex(0)->getStyle('C1')->getFont()->setBold(true);
      $objPHPExcel->setActiveSheetIndex(0)->getStyle('E1')->getFont()->setBold(true);
        
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3',"Turno");
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3',"Paciente");
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3',"DNI");
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3',"Edad");
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3',"Empresa");
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3',"Detalle");

      $objPHPExcel->setActiveSheetIndex(0)->getStyle('A3')->getFont()->setBold(true);
      $objPHPExcel->setActiveSheetIndex(0)->getStyle('B3')->getFont()->setBold(true);
      $objPHPExcel->setActiveSheetIndex(0)->getStyle('C3')->getFont()->setBold(true);
      $objPHPExcel->setActiveSheetIndex(0)->getStyle('D3')->getFont()->setBold(true);
      $objPHPExcel->setActiveSheetIndex(0)->getStyle('E3')->getFont()->setBold(true);
      $objPHPExcel->setActiveSheetIndex(0)->getStyle('F3')->getFont()->setBold(true);

      $row=4;
      foreach($aPacientes as $paciente =>$estudios){

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,strval($estudios["turno"]));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,strval($paciente));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,strval($estudios["dni"]));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row,strval($estudios["edad"]));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row,strval($estudios["empresa"]));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row,strval(implode(", ",$estudios["estudios"])));
        
        $row++;
      }

      $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setAutoSize(true);
      $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setAutoSize(true);
      $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setAutoSize(true);
      $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setAutoSize(true);
      $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('E')->setAutoSize(true);
      $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('F')->setAutoSize(true);

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 

      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
      header('Content-Disposition: attachment;filename="Visitas por medico.xlsx"'); //tell browser what's the file name
      header('Cache-Control: max-age=0'); //no cache 
      ob_end_clean();
      $objWriter->save('php://output');
      exit();

    }


}
