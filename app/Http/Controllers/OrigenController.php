<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Origen;
use App\Pais;
use App\Provincia;
use App\Ciudad;
use App\Barrio;
use App\Calle;
use App\Domicilio;
use App\Exports\OrigensExport;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel;
use PHPExcel_IOFactory;

class OrigenController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function ajaxGuardar(Request $request)
    {
        $direccion = new Domicilio;
        $direccion->direccion = $request->get('direccionOrigen');
        $direccion->ciudad_id = $request->get('ciudad_idOrigen');
        $direccion->save();

        $data = new Origen();
        $data->definicion = $request->definicion;
        $data->cuit = $request->cuit;
        $data->domicilio_id = $direccion->id;
        $data->save();

        return response()->json($data);

    }

    public function exportar()
    {

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
        
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',"ID");
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1',"Empresa");

      $ori=DB::select('SELECT id,definicion FROM origenes');
      $row=2;
      foreach($ori as $fila){

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,strval($fila->id));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,strval($fila->definicion));
        
        $row++;
      }

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 

      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
      header('Content-Disposition: attachment;filename="empresas.xlsx"'); //tell browser what's the file name
      header('Cache-Control: max-age=0'); //no cache 
      ob_end_clean();
      $objWriter->save('php://output');
      exit();

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises=Pais::all();

        return view('paciente.create', compact('paises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {




        $origen=new Origen;
        $origen->razon_social=$request->get('razon_social');
        $origen->cuit=$request->get('cuit');
        $origen->domicilio_id=$request->get('domicilio_id');
        $origen->save();

        return redirect()->route('empresa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
