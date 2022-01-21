<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Origen;
use App\Pais;
use App\Provincia;
use App\Ciudad;
use App\Barrio;
use App\Calle;
use App\Domicilio;

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
