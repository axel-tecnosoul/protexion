<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ciudad;
//use App\Sexo;
use App\Provincia;
//use App\Especialidad;
//use App\Estado;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use DB;

class CiudadController extends Controller
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
            $sql = Ciudad::select('ciudades.*'); //inicio la consulta sobre una determinada tabla

            if($request->puesto_id) //si el request proviene de la categoria del ticket
            {
                $sql = $sql->wherePuesto_id($request->puesto_id); //creo la consulta y almaceno en "sql"
            }
            /*if($request->estado_id){
                $sql = $sql->whereEstado_id($request->estado_id); //creo la consulta y almaceno en "sql"
            }*/
            $ciudades=$sql->orderBy('created_at','desc')->get(); //ejecuto la consulta
            $puesto_id=$request->puesto_id; //mantengo el id de la categoria del tiquet
            //$estado_id=$request->estado_id; //mantengo el id de la categoria del tiquet
        }else //si nunca filtre, (si no existió request)
        {
            //$puesto_id=null; //en el select2 que me aparesca " -- Todas las Categorias --"
            //$estado_id=null; //en el select2 que me aparesca " -- Todas las Categorias --"
            //$personals=Ciudad::whereEstado_id(1)->orderBy('created_at','desc')->get(); //que me obtenga directamente todos los grupos
            $ciudades=Ciudad::orderBy('created_at','desc')->get(); //que me obtenga directamente todos los grupos
        }

        return view('ciudad.index',[
            "ciudades"         =>  $ciudades,         //los grupos de trabajo
            //"puesto_id"         =>  $puesto_id, //si los id son identicos que me mantenga el valor
            //"puestos"           =>  $puestos,  //las categorias asociadas al grupo de trabajo
            //"estado_id"         =>  $estado_id, //si los id son identicos que me mantenga el valor
            //"estados"           =>  $estados, //si los id son identicos que me mantenga el valor

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
        $provincias=Provincia::all();
        return view("ciudad.create", [
            //"sexos"             =>  $sexos,
            "provincias"           =>  $provincias
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
            'nombre'           => 'required',
            //'codigp_'         => 'required',
            //'fecha_nacimiento'  => 'required',
            //'sexo_id'           => 'required',
            'provincias_id'         => 'required'
        ]);

        //Creo los datos de la persona
        $ciudad = new Ciudad;
        $ciudad->nombre=$request->get('nombre');
        $ciudad->codigo_postal=$request->get('codigo_postal');
        /*$ciudad->documento=$request->get('documento');
        $ciudad->fecha_nacimiento=$request->get('fecha_nacimiento');
        $ciudad->nro_matricula=$request->get('nro_matricula');
        $ciudad->sexo_id=$request->get('sexo_id');*/
        $ciudad->provincia_id=$request->get('provincias_id');
        /*$ciudad->especialidad_id=$request->get('especialidad_id');
        $ciudad->cuenta=false;
        $ciudad->estado_id=1; //Habilitado*/

        $ciudad->save();

        return redirect()->route('ciudad.index');

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
        $ciudad=Ciudad::findOrFail($id);
        $provincias=Provincia::all();


        return view("ciudad.edit",["ciudad"=>$ciudad,"provincias"           =>  $provincias]);
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

        $personal=Ciudad::findOrFail($id);
        $personal->nombre=$request->get('nombre');
        $personal->codigo_postal=$request->get('codigo_postal');
        $personal->provincia_id=$request->get('provincias_id');

        $personal->update();

        return redirect()->route('ciudad.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $personal=Ciudad::find($id);
        $nombre=$personal->nombreCompleto();
        $personal->update(['estado_id'=>2]);
        return redirect()->route('personal.index')->withMessage("El personal $nombre ha sido dado de baja correctamente");

    }

    /*public function eliminados()
    {
        $personalEliminados=Ciudad::where('habilitado',false)->get();
        return view("personal.eliminados",compact('personalEliminados'));

    }*/


    public function restaurar($id)
    {
        $personalRestaurar = Ciudad::find($id);
        $personalRestaurar->update(['estado_id'=>1]);
        return redirect()->route('personal.index');

    }
}
