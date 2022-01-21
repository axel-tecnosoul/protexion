<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use App\Estado;
use App\Origen;
use App\EstadoCivil;
use App\Sexo;
use App\ObraSocial;
use App\Domicilio;
use App\Ciudad;
use App\Pais;
use App\Provincia;
use App\Voucher;
use App\Http\Requests\PacienteRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PacientesImport;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*function __construct()
    {
         $this->middleware('permission:listar pacientes|crear paciente|editar paciente|eliminar paciente', ['only' => ['index','store']]);
         $this->middleware('permission:crear paciente', ['only' => ['create','store']]);
         $this->middleware('permission:editar paciente', ['only' => ['edit','update']]);
         $this->middleware('permission:eliminar paciente', ['only' => ['destroy']]);
    }*/


    public function encontrarProvincia(Request $request)
	{
	    $provincias=Provincia::select('nombre','id')
			->where('pais_id',$request->id)
            ->get();
        return response()->json($provincias);
    }

    public function encontrarCiudad(Request $request)
	{
	    $ciudades=Ciudad::select('nombre','id')
			->where('provincia_id',$request->id)
            ->get();
        return response()->json($ciudades);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $origenes=Origen::all(); //obteneme todas las categorias
        $obras_sociales=ObraSocial::all(); //obteneme todas las categorias
        $estados=Estado::all(); //obteneme todas las categorias

        if(count($request->all())>=1) //si existe algun request(es decir, si uso el "Filtrar")
        {
            //dd($request->all());
            $sql = Paciente::select('pacientes.*'); //inicio la consulta sobre una determinada tabla

            if($request->origen_id) //si el request proviene de la categoria del ticket
            {

                $sql = $sql->whereOrigen_id($request->origen_id); //creo la consulta y almaceno en "sql"
            }
            if($request->obra_social_id)
            {
                $sql = $sql->whereObra_social_id($request->obra_social_id); //creo la consulta y almaceno en "sql"
            }
            if($request->estado_id)
            {
                $sql = $sql->whereEstado_id($request->estado_id); //creo la consulta y almaceno en "sql"
            }


            $pacientes=$sql->orderBy('created_at','desc')->get(); //ejecuto la consulta
            $origen_id=$request->origen_id; //mantengo el id de la categoria del tiquet
            $obra_social_id=$request->obra_social_id; //mantengo el id de la categoria del tiquet
            $estado_id=$request->estado_id; //mantengo el id de la categoria del tiquet


        }
        else //si nunca filtre, (si no existió request)
        {

            $origen_id=null; //en el select2 que me aparesca " -- Todas las Categorias --"
            $obra_social_id=null; //en el select2 que me aparesca " -- Todas las Categorias --"
            $estado_id=null; //en el select2 que me aparesca " -- Todas las Categorias --"
            $pacientes=Paciente::whereEstado_id(1)->orderBy('created_at','desc')->get(); //que me obtenga directamente todos los grupos


        }

        return view('paciente.index',[
            "pacientes"         =>  $pacientes,         //los grupos de trabajo
            "origen_id"         =>  $origen_id, //si los id son identicos que me mantenga el valor
            "origenes"          =>  $origenes,  //las categorias asociadas al grupo de trabajo
            "obras_sociales"    =>  $obras_sociales,  //las categorias asociadas al grupo de trabajo
            "obra_social_id"    =>  $obra_social_id, //si los id son identicos que me mantenga el valor
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
        $origenes=Origen::all();
        $estado_civiles=EstadoCivil::all();
        $sexos=Sexo::all();
        $obra_sociales=ObraSocial::all();
        $paises=Pais::all();
        $lugar_nacimiento=Ciudad::all();

        return view("paciente.create", [
            "origenes"          =>  $origenes,
            "estado_civiles"    =>  $estado_civiles,
            "sexos"             =>  $sexos,
            "obra_sociales"     =>  $obra_sociales,
            "paises"            =>  $paises,
            "lugar_nacimiento"  =>  $lugar_nacimiento,

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
            'documento' => 'unique:pacientes,documento,except,id',
            'nombres'   => 'required',
            'apellidos' => 'required'
        ]);


        if($request->get('direccion')!=null) {
            $domicilio = new Domicilio;
            $domicilio->direccion = $request->get('direccion');
            $domicilio->ciudad_id = $request->get('ciudad_id');
            $domicilio->save();
        }
        

        //Creo los datos del personal de la clinica
        $paciente = new Paciente;
        $paciente->nombres=$request->get('nombres');
        $paciente->apellidos=$request->get('apellidos');
        if($request->get('documento')!=null){
            $paciente->documento=$request->get('documento');
        }
        if($request->get('fecha_nacimiento')!=null){
            $paciente->fecha_nacimiento=$request->get('fecha_nacimiento');
        }
        if($request->get('sexo_id')!=null){
            $paciente->sexo_id=$request->get('sexo_id');
        }
        if($request->get('obra_social_id')!=null){
            $paciente->obra_social_id=$request->get('obra_social_id');
        }
        if($request->get('peso')!=null){
            $paciente->peso=$request->get('peso');
        }
        if($request->get('cuil')!=null){
            $paciente->cuil=$request->get('cuil');
        }
        if($request->get('estatura')!=null){
            $paciente->estatura=$request->get('estatura');
        }
        if($request->get('telefono')!=null){
            $paciente->telefono=$request->get('telefono');
        }
        if($request->get('origen_id')!=null){
            $paciente->origen_id=$request->get('origen_id');
        }
        if($request->get('estado_civil_id')!=null){
            $paciente->estado_civil_id=$request->get('estado_civil_id');
        }
        $paciente->estado_id=1; //habilitado
        if($request->get('ciudad_id')!=null){
            $paciente->ciudad_id=$request->get('ciudad_id');
        }
        if($request->get('direccion')!=null) {
            $paciente->domicilio_id = $domicilio->id;
        }
        $paciente->estado_id=1; //Habilitado
        if($request->file('imagen')){

            $image = $request->imagen;
            $image->move(public_path() . '/imagenes/paciente/', $image->getClientOriginalName());
            $paciente->imagen = $image->getClientOriginalName();

        }
        $paciente->save();
        return redirect()->route('paciente.index');
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


        $paciente=Paciente::findOrFail($id);
        $sexos=Sexo::all();
        $origenes=Origen::all();
        $estado_civiles=EstadoCivil::all();
        $obra_sociales=ObraSocial::all();
        $paises=Pais::all();
        $provincias=Provincia::all();
        $ciudades=Ciudad::all();



        return view("paciente.edit",compact('paises','provincias','ciudades','paciente','sexos','origenes','estado_civiles','obra_sociales'));
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

        $paciente=Paciente::findOrFail($id);
        $paciente->nombres=$request->get('nombres');
        $paciente->apellidos=$request->get('apellidos');
        $paciente->documento=$request->get('documento');
        $paciente->fecha_nacimiento=$request->get('fecha_nacimiento');
        $paciente->sexo_id=$request->get('sexo_id');
        $paciente->cuil=$request->get('cuil');
        $paciente->telefono=$request->get('telefono');
        $paciente->obra_social_id=$request->get('obra_social_id');
        $paciente->estado_civil_id=$request->get('estado_civil_id');
        $paciente->origen_id=$request->get('origen_id');
        

        if ($paciente->domicilio_id) {
            $domicilio=Domicilio::find($paciente->domicilio_id);
            $domicilio->direccion=$request->get('direccion');
            $domicilio->ciudad_id=$request->get('ciudad_id');
            $domicilio->update();
        }else{
            if($request->get('direccion')!=null) {
                $domicilio = new Domicilio;
                $domicilio->direccion = $request->get('direccion');
                $domicilio->ciudad_id = $request->get('ciudad_id');
                $domicilio->save();
            }
        }

        
        if($request->get('direccion')!=null) {
            $paciente->domicilio_id = $domicilio->id;
        }
        
        $paciente->update();

        return redirect()->route('paciente.index')->withMessage("El paciente " .  $paciente->nombreCompleto() .  " ha sido actualizado con éxito");



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //El metodo delete() cambia el estado del paciente cuando se da al boton de dar de baja
    public function delete($id)
    {
        $paciente=Paciente::find($id);
        $nombre=$paciente->nombreCompleto();
        $paciente->update(['estado_id'=>2]);
        return redirect()->route('paciente.index')->withMessage("El paciente $nombre ha sido dado de baja correctamente");

    }



    /*public function eliminados()
    {
        $pacientesEliminados=Paciente::where('habilitado',false)->get();
        return view("paciente.eliminados",compact('pacientesEliminados'));

    }*/



    public function restaurar($id)
    {
        $pacienteRestaurar = Paciente::find($id);
        $pacienteRestaurar->update(['estado_id'=>1]);
        return redirect()->route('paciente.index');

    }

    public function voucher($id)
    {
        $paciente = Paciente::find($id);
        $vouchers = Voucher::wherePaciente_id($id)->orderBy('turno','desc')->get();;
        return view("paciente.vouchers", compact('vouchers','paciente'));
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new PacientesImport, $file);

        return back()->with('message','Pacientes importados');
    }

}
