<?php

namespace App\Http\Controllers;
use App\ObraSocial;
use Illuminate\Http\Request;

class ObraSocialController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('obra_social.create');
    }

    public function ajaxGuardar(Request $request)
    {
       
            $data = new ObraSocial();
            $data->definicion = $request->definicion;
            $data->abreviatura = $request->abreviatura;
            $data->save();
            return response()->json($data);
        
        

        
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $obra_social=new ObraSocial;
        $obra_social->definicion=$request->get('definicion');
        $obra_social->abreviatura=$request->get('abreviatura');
        $obra_social->save();

        return redirect()->route('obra_social.index');
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
