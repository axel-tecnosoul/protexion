<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use App\Models\TipoEstudio;
use Illuminate\Http\Request;

/**
 * Class EstudioController
 * @package App\Http\Controllers
 */
class EstudioController extends Controller
{

    public function index()
    {
        $estudios = Estudio::All();

        return view('estudio.index', compact('estudios'));
    }

    public function create()
    {
        $estudio = new Estudio();
        $tipo_estudios = TipoEstudio::all();
        return view('estudio.create', compact('estudio', 'tipo_estudios'));
    }

    public function store(Request $request)
    {
        request()->validate(Estudio::$rules);

        $estudio = Estudio::create($request->all());

        return redirect()->route('estudios.index')
            ->with('success', 'Estudio created successfully.');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

        $estudio=Estudio::findOrFail($id);
        $tipo_estudios = TipoEstudio::all();
        //$provincias=Provincia::all();

        //return view("estudio.edit",["estudio"=>$estudio, 'tipo_estudios']);
        return view("estudio.edit",compact("estudio", 'tipo_estudios'));

    }

    public function update(Request $request, $id)
    {
 
        $estudio=Estudio::findOrFail($id);
        $estudio->nombre=$request->get('nombre');
        $estudio->tipo_estudio_id=$request->get('tipo_estudio_id');
        //$estudio->provincia_id=$request->get('provincias_id');

        $estudio->update();

        return redirect()->route('estudios.index');
    }

    public function destroy($id)
    {
        try { 
            Estudio::find($id)->delete();
        } catch(\Illuminate\Database\QueryException $ex){ 
            return redirect()->route('estudios.index')->with('delete_user_error', 'El estudio no fue eliminado porque está siendo utilizado en otras tablas');
        }
        return redirect()->route('estudios.index')->with('delete_user', 'Estudio eliminado correctamente');
    }

    public function delete($id)
    {
        try { 
          Estudio::find($id)->delete();
        } catch(\Illuminate\Database\QueryException $ex){ 
            return redirect()->route('estudios.index')->with('delete_user_error', 'El estudio no fue eliminado porque está siendo utilizado en otras tablas');
        }
        return redirect()->route('estudios.index')->with('delete_user', 'Estudio eliminado correctamente');
    }
}
