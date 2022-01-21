<?php

namespace App\Http\Controllers;

use App\Models\TipoEstudio;
use Illuminate\Http\Request;

/**
 * Class TipoEstudioController
 * @package App\Http\Controllers
 */
class TipoEstudioController extends Controller
{

    public function index()
    {
        $tipoEstudios = TipoEstudio::All();

        return view('tipo_estudio.index', compact('tipoEstudios'));
    }

    public function create()
    {
        $tipoEstudio = new TipoEstudio();
        return view('tipo_estudio.create', compact('tipoEstudio'));
    }

    public function store(Request $request)
    {
        request()->validate(TipoEstudio::$rules);

        $tipoEstudio = TipoEstudio::create($request->all());

        return redirect()->route('tipo_estudios.index')
            ->with('success', 'TipoEstudio created successfully.');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, TipoEstudio $tipoEstudio)
    {
 
    }

    public function destroy($id)
    {
        $tipoEstudio = TipoEstudio::find($id)->delete();

        return redirect()->route('tipo_estudios.index');
    }
}
