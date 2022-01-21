<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PersonalClinica;
use App\Sexo;
use App\Puesto;
use App\Especialidad;
use App\Estado;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use DB;

class PersonalClinicaController extends Controller
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


    public function encontrarEspecialidad(Request $request)
	{
	    $especialidades =Especialidad::select('nombre','id')
			->where('puesto_id',$request->id)
            ->get();
        return response()->json($especialidades);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $puestos=PUesto::all(); //obteneme todas las categorias
        $estados=Estado::all(); //obteneme todas las categorias

        if(count($request->all())>=1) //si existe algun request(es decir, si uso el "Filtrar")
        {
            //dd($request->all());
            $sql = PersonalClinica::select('personal_clinicas.*'); //inicio la consulta sobre una determinada tabla

            if($request->puesto_id) //si el request proviene de la categoria del ticket
            {

                $sql = $sql->wherePuesto_id($request->puesto_id); //creo la consulta y almaceno en "sql"
            }

            if($request->estado_id)
            {
                $sql = $sql->whereEstado_id($request->estado_id); //creo la consulta y almaceno en "sql"
            }


            $personals=$sql->orderBy('created_at','desc')->get(); //ejecuto la consulta
            $puesto_id=$request->puesto_id; //mantengo el id de la categoria del tiquet
            $estado_id=$request->estado_id; //mantengo el id de la categoria del tiquet


        }
        else //si nunca filtre, (si no existió request)
        {
            $puesto_id=null; //en el select2 que me aparesca " -- Todas las Categorias --"
            $estado_id=null; //en el select2 que me aparesca " -- Todas las Categorias --"
            $personals=PersonalClinica::whereEstado_id(1)->orderBy('created_at','desc')->get(); //que me obtenga directamente todos los grupos


        }

        return view('personal.index',[
            "personals"         =>  $personals,         //los grupos de trabajo
            "puesto_id"         =>  $puesto_id, //si los id son identicos que me mantenga el valor
            "puestos"           =>  $puestos,  //las categorias asociadas al grupo de trabajo
            "estado_id"         =>  $estado_id, //si los id son identicos que me mantenga el valor
            "estados"           =>  $estados, //si los id son identicos que me mantenga el valor

            ]);


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $sexos=Sexo::all();
        $puestos=Puesto::all();


        return view("personal.create", [
            "sexos"             =>  $sexos,
            "puestos"           =>  $puestos
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
            'documento'         => 'required|unique:personal_clinicas,documento,except,id',
            'nombres'           => 'required',
            'apellidos'         => 'required',
            'fecha_nacimiento'  => 'required',
            'sexo_id'           => 'required',
            'puesto_id'         => 'required'
        ]);

        //Creo los datos de la persona
        $personal = new PersonalClinica;
        $personal->nombres=$request->get('nombres');
        $personal->apellidos=$request->get('apellidos');
        $personal->documento=$request->get('documento');
        $personal->fecha_nacimiento=$request->get('fecha_nacimiento');
        $personal->nro_matricula=$request->get('nro_matricula');
        if($request->file('foto')){

            $image = $request->foto;
            $image->move(public_path() . '/imagenes/firmas/', $personal->documento.$image->getClientOriginalName());
            $personal->foto = $personal->documento.$image->getClientOriginalName();

        }
        $personal->sexo_id=$request->get('sexo_id');
        $personal->puesto_id=$request->get('puesto_id');
        $personal->especialidad_id=$request->get('especialidad_id');
        $personal->cuenta=false;
        $personal->estado_id=1; //Habilitado

        $personal->save();

        return redirect()->route('personal.index');

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
        $personal=PersonalClinica::findOrFail($id);
        $sexos=Sexo::all();
        return view("personal.edit",["personal"=>$personal,"sexos"=>$sexos]);
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

        $personal=PersonalClinica::findOrFail($id);
        $personal->nombres=$request->get('nombres');
        $personal->apellidos=$request->get('apellidos');
        $personal->documento=$request->get('documento');
        $personal->fecha_nacimiento=$request->get('fecha_nacimiento');
        $personal->sexo_id=$request->get('sexo_id');

        $personal->update();

        return redirect()->route('personal.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $personal=PersonalClinica::find($id);
        $nombre=$personal->nombreCompleto();
        $personal->update(['estado_id'=>2]);
        return redirect()->route('personal.index')->withMessage("El personal $nombre ha sido dado de baja correctamente");

    }

    /*public function eliminados()
    {
        $personalEliminados=PersonalClinica::where('habilitado',false)->get();
        return view("personal.eliminados",compact('personalEliminados'));

    }*/


    public function restaurar($id)
    {
        $personalRestaurar = PersonalClinica::find($id);
        $personalRestaurar->update(['estado_id'=>1]);
        return redirect()->route('personal.index');

    }
}
