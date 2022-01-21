<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sexo;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\SexoFormRequest;


class SexoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sexos = Sexo::all();
        return view('sexo.index',["sexos"=> $sexos]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view("sexo.create");


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SexoFormRequest $request)
    {
        $sexo = new Sexo;
        $sexo->descripcion=$request->get('descripcion');
        $sexo->save();

        Session::flash('store_sexo','El sexo '.$sexo->descripcion. ' se creó con éxito');
        return Redirect::to('sexo');    

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
        $sexo=Sexo::findOrFail($id);
        return view("sexo.edit",["sexo"=>$sexo]);
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
        $sexo=Sexo::findOrFail($id);
        $sexo->descripcion=$request->get('descripcion');
        $sexo->update();
        Session::flash('update_sexo','El sexo '.$sexo->descripcion. ' ha sido actualizado con éxito');
        return Redirect::to('sexo'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sexo=Sexo::findOrFail($id);
        try{
            Sexo::destroy($id);
            $sexo->update();
            Session::flash('delete_sexo','El sexo '.$sexo->descripcion. ' ha sido eliminado correctamente');
            return Redirect::to('sexo');
        }
        catch(\Illuminate\Database\QueryException $e){
            Session::flash('delete_sexo_error','El sexo '.$sexo->descripcion. ' no puede ser eliminado');
            return Redirect::to('sexo');

        }
    }

}
