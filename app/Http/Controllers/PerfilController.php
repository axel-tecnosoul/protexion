<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth as Auth;
use Spatie\Permission\Models\Role;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::User()->id);
        return view('perfil.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::find(Auth::User()->id);
       if(empty($user)){
          //Flash::error('mensaje error');
          return redirect()->back();
       }
       return view('perfil.edit')->with('user', $user);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    $usuario = User::find(Auth::User()->id);
    $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$usuario->id,
            'password' => 'same:confirm-password',
        ]);
    if (!empty($request['password'])) {
        $request['password'] = FacadesHash::make($request['password']);
    }

    if (!empty($request['roles'])) {
        //DB::table('model_has_roles')->where('model_id',$id)->delete();
        $usuario->assignRole($request->input('roles'));
    }

    $usuario->update(array_filter($request->all())); 


    return redirect()->route('perfil.index')
                    ->with('success','User updated successfully');
    
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
