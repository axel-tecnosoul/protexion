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

    }

    public function update(Request $request, Estudio $estudio)
    {
 
    }

    public function destroy($id)
    {
        $estudio = Estudio::find($id)->delete();

        return redirect()->route('estudios.index')
            ->with('success', 'Estudio deleted successfully');
    }
}
