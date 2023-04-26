<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Empresa;
use App\Pais;
use App\Domicilio;
//use App\Sexo;
use App\Provincia;
use App\Ciudad;
use App\Paciente;
//use App\Especialidad;
//use App\Estado;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use App\Models\Aptitud;
use DB;
use PDF;

class EmpresaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*function __construct()
    {
        $this->middleware('permission:listar personal|crear personal|editar personal|eliminar personal', ['only' => ['index','store']]);
        $this->middleware('permission:crear personal', ['only' => ['create','store']]);
        $this->middleware('permission:editar personal', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar personal', ['only' => ['destroy']]);
    }*/


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$puestos=Puesto::all(); //obteneme todas las categorias
        //$estados=Estado::all(); //obteneme todas las categorias

        if(count($request->all())>=1) //si existe algun request(es decir, si uso el "Filtrar")
        {
            //dd($request->all());
            $sql = Empresa::select('empresas.*'); //inicio la consulta sobre una determinada tabla

            if($request->puesto_id) //si el request proviene de la categoria del ticket
            {
                $sql = $sql->wherePuesto_id($request->puesto_id); //creo la consulta y almaceno en "sql"
            }
            /*if($request->estado_id){
                $sql = $sql->whereEstado_id($request->estado_id); //creo la consulta y almaceno en "sql"
            }*/
            $empresas=$sql->orderBy('created_at','desc')->get(); //ejecuto la consulta
            $puesto_id=$request->puesto_id; //mantengo el id de la categoria del tiquet
            //$estado_id=$request->estado_id; //mantengo el id de la categoria del tiquet
        }else //si nunca filtre, (si no existió request)
        {
            
            //$personals=Empresa::whereEstado_id(1)->orderBy('created_at','desc')->get(); //que me obtenga directamente todos los grupos
            $empresas=Empresa::orderBy('created_at','desc')->get(); //que me obtenga directamente todos los grupos
        }

        return view('empresa.index',[
          "empresas"         =>  $empresas,         //los grupos de trabajo
        ]);


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //$sexos=Sexo::all();
        //$provincias=Provincia::all();
        $paises=Pais::all();
        return view("empresa.create", [
          "paises"             =>  $paises,
            //"sexos"             =>  $sexos,
            //"provincias"           =>  $provincias
        ]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            //'documento'         => 'required|unique:personal_clinicas,documento,except,id',
            'definicion'           => 'required',
            'cuit'         => 'required',
            'direccionOrigen'  => 'required',
            'ciudad_idOrigen'           => 'required',
            //'provincias_id'         => 'required'
        ]);

        $direccion = new Domicilio;
        $direccion->direccion = $request->get('direccionOrigen');
        $direccion->ciudad_id = $request->get('ciudad_idOrigen');
        $direccion->save();

        //Creo los datos de la persona
        $empresa = new Empresa;
        $empresa->definicion=$request->get('definicion');
        $empresa->cuit=$request->get('cuit');
        //$empresa->domicilio_id=$request->get('domicilio_id');
        $empresa->domicilio_id=$direccion->id;

        $empresa->save();

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

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $empresa=Empresa::findOrFail($id);
        $paises=Pais::all();
        $provincias=Provincia::all();
        $ciudades=Ciudad::all();

        //dd($empresa->domicilio);

        return view("empresa.edit",[
          "empresa"=>$empresa,
          "paises"=>$paises,
          "provincias"=>$provincias,
          "ciudades"=>$ciudades,
        ]);
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

        $this->validate($request, [
            //'documento'         => 'required|unique:personal_clinicas,documento,except,id',
            'definicion'           => 'required',
            'cuit'         => 'required',
            'direccionOrigen'  => 'required',
            'ciudad_idOrigen'           => 'required',
            //'provincias_id'         => 'required'
        ]);

        $direccion=Domicilio::findOrFail($id);
        $direccion->direccion = $request->get('direccionOrigen');
        $direccion->ciudad_id = $request->get('ciudad_idOrigen');
        $direccion->update();


        $empresa=Empresa::findOrFail($id);
        $empresa->definicion=$request->get('definicion');
        $empresa->cuit=$request->get('cuit');
        $empresa->domicilio_id=$direccion->id;
        //$empresa->provincia_id=$request->get('provincias_id');

        $empresa->update();

        return redirect()->route('empresa.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        /*$personal=Empresa::find($id);
        $nombre=$personal->nombreCompleto();
        $personal->update(['estado_id'=>2]);
        return redirect()->route('personal.index')->withMessage("El personal $nombre ha sido dado de baja correctamente");*/

        try { 
            Empresa::find($id)->delete();
        } catch(\Illuminate\Database\QueryException $ex){ 
            return redirect()->route('empresa.index')->with('delete_user_error', 'La empresa no fue eliminado porque está siendo utilizado en otras tablas');
        }
        return redirect()->route('empresa.index')->with('delete_user', 'Empresa eliminada correctamente');

    }

    /*public function eliminados()
    {
        $personalEliminados=Empresa::where('habilitado',false)->get();
        return view("personal.eliminados",compact('personalEliminados'));

    }*/

    public function reporte(Request $request){
      //$vouchers = Voucher::all(); //obteneme todas los vouchers

        //obtenemos todos los tipos de estudios
        //$empresas=Empresa::all();
        $empresas=Empresa::orderBy('definicion','asc')->get(); //que me obtenga directamente todos los grupos
        
        //dd($aEstudios);

        $desde=date("Y-m-d");
        if(isset($request->desde)){
          $desde=$request->desde;
        }
        $hasta=date("Y-m-d");
        if(isset($request->hasta)){
          $hasta=$request->hasta;
        }
        $empresa_id=0;

        $resultados=["Apto sin preexistencias","Apto con preexistencias","Inconveniente si ingreso en el momento actual"];
        $aResultados=[];
        foreach ($resultados as $resultado) {
          $aResultados[]=[
            "nombre"=>$resultado,
            "selected"=>"",
          ];
        }

        $datos=[];
        if(isset($request->empresa_id)){
          $empresa_id=$request->empresa_id;

          /*$query = DB::table('aptituds')
            ->join('vouchers', 'aptituds.voucher_id', '=', 'vouchers.id')
            ->join('pacientes', 'vouchers.paciente_id', '=', 'pacientes.id');
          
          $query->where('turno','>=', $desde);
          $query->where('turno','<=', $hasta);
          $query->where('pacientes.origen_id', $empresa_id);

          if(isset($request->resultado)){
            $query->where('aptitud_laboral', $request->resultado);
  
            $indice = array_search($request->resultado, array_column($aResultados, 'nombre'));
            $aResultados[$indice]["selected"]="selected";
  
          }
          $query->orderBy('aptituds.updated_at','desc');
          //$query->groupBy('vouchers.id');
          $query->select('aptituds.id', 'vouchers.turno', 'pacientes.apellidos', 'pacientes.nombres', 'aptituds.aptitud_laboral','pacientes.documento','pacientes.cuil', 'aptituds.preexistencias', 'aptituds.observaciones', DB::raw('MAX(aptituds.updated_at) AS updated_at'));
          $datos=$query->get();*/

          // Obtener el registro más reciente de la tabla aptituds para cada voucher
          $subquery = DB::table('aptituds')
          ->select('voucher_id', DB::raw('MAX(updated_at) AS max_updated_at'))
          ->groupBy('voucher_id');

          // Unir la subconsulta con las tablas aptituds, vouchers y pacientes
          $query = DB::table('aptituds')
          ->join('vouchers', 'aptituds.voucher_id', '=', 'vouchers.id')
          ->join('pacientes', 'vouchers.paciente_id', '=', 'pacientes.id')
          ->joinSub($subquery, 'latest_aptituds', function ($join) {
              $join->on('aptituds.voucher_id', '=', 'latest_aptituds.voucher_id')
                  ->on('aptituds.updated_at', '=', 'latest_aptituds.max_updated_at');
          })
          ->where('vouchers.turno', '>=', $desde)
          ->where('vouchers.turno', '<=', $hasta)
          ->where('pacientes.origen_id', $empresa_id)
          ->orderBy('latest_aptituds.max_updated_at', 'desc')
          ->select('aptituds.id', 'vouchers.turno', 'pacientes.apellidos', 'pacientes.nombres', 'aptituds.aptitud_laboral', 'pacientes.documento', 'pacientes.cuil', 'aptituds.preexistencias', 'aptituds.observaciones');

          $datos = $query->get();


        }

        //dd($aResultados);
        //dd($datos);
        //dd($aInformes);

        //$vouchers = Voucher::orderBy('id', 'desc')->get();
        return view('empresa.reporte',[
            //"vouchers"          => $vouchers,
            "desde"             => $desde,
            "hasta"             => $hasta,
            "empresa_id"        => $empresa_id,
            "empresas"          => $empresas,
            "aResultados"       => $aResultados,
            "datos"             => $datos
        ]);
    }
    
    public function pdf_reporte($empresa_id,$visitas){

        $empresa=Empresa::findOrFail($empresa_id);
        //dd($empresa_id);

        $query = DB::table('aptituds')
          ->join('vouchers', 'aptituds.voucher_id', '=', 'vouchers.id')
          ->join('pacientes', 'vouchers.paciente_id', '=', 'pacientes.id');
          //->where('carga', '=', 0);
        
        $query->whereIn('aptituds.id', explode(",",$visitas));
        $datos=$query->get();
        //dd($datos);

        $pdf = PDF::loadView('empresa.pdf_reporte',[
            "empresa"          => $empresa,
            "datos"             => $datos
        ]);
        //$pdf->setPaper('a4','letter');
        $pdf->setPaper('a4','landscape');
        return $pdf->stream('voucher_medico.pdf');
    }


    public function restaurar($id)
    {
        $personalRestaurar = Empresa::find($id);
        $personalRestaurar->update(['estado_id'=>1]);
        return redirect()->route('personal.index');

    }

    public function destroy($id)
    {
        //$id=152;
        $estudio=Estudio::find($id);
        if(is_null($estudio)){
            return redirect()->route('estudios.index')->with('delete_user_error', 'El estudio no fue eliminado porque está siendo utilizado en otras tablas');
        }else{
            $estudio = Estudio::find($id)->delete();

            return redirect()->route('estudios.index')->with('delete_user', 'Estudio eliminado correctamente');
        }
    }
}
