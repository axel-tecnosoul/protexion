<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Riesgo;
//use App\Sexo;
use App\Provincia;
use App\Riesgos;
//use App\Especialidad;
//use App\Estado;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use DB;

class RiesgoController extends Controller
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
        $riesgos=Riesgos::all(); //que me obtenga directamente todos los grupos

        return view('riesgo.index',[
          "riesgos"         =>  $riesgos,         //los grupos de trabajo
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincias=Provincia::all();
        return view("riesgo.create", [
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
          'riesgo'           => 'required',
        ]);

        //Creo los datos de la persona
        $riesgo = new Riesgos;
        $riesgo->riesgo=$request->get('riesgo');
        $riesgo->save();

        return redirect()->route('riesgo.index');
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
        $riesgo=Riesgos::findOrFail($id);
        return view("riesgo.edit",compact("riesgo"));
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
        $riesgo=Riesgos::findOrFail($id);
        $riesgo->riesgo=$request->get('riesgo');
        $riesgo->update();

        return redirect()->route('riesgo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try { 
          Riesgos::find($id)->delete();
        } catch(\Illuminate\Database\QueryException $ex){ 
            return redirect()->route('riesgo.index')->with('delete_user_error', 'El riesgo no fue eliminado porque está siendo utilizado en otras tablas');
        }
        return redirect()->route('riesgo.index')->with('delete_user', 'Riesgo eliminado correctamente');
    }

    /*public function eliminados()
    {
        $personalEliminados=Riesgo::where('habilitado',false)->get();
        return view("personal.eliminados",compact('personalEliminados'));

    }*/

    public function restaurar($id)
    {
        $personalRestaurar = Riesgos::find($id);
        $personalRestaurar->update(['estado_id'=>1]);
        return redirect()->route('personal.index');

    }
}
