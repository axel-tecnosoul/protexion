<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Estado;
use App\PersonalClinica;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserUpdateFormRequest;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*function __construct()
    {
         $this->middleware('permission:listar usuarios|crear usuario|editar usuario|eliminar usuario', ['only' => ['index','store']]);
         $this->middleware('permission:crear usuario', ['only' => ['create','store']]);
         $this->middleware('permission:editar usuario', ['only' => ['edit','update']]);
         $this->middleware('permission:eliminar usuario', ['only' => ['destroy']]);
    }*/


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users=User::whereEstad(1); 
        //d($users);
        return view('user.index',[
            "users"         =>  $users,         //los grupos de trabajo
            ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$pacientes=Paciente::where('historia_clinica',false)->get();
        //$personas=Persona::all();
        $personals=PersonalClinica::where('cuenta',false)->get();
        //$roles=DB::table('roles')->get();
        return view("user.create", [
            "personals"   =>  $personals
            //"roles"      =>  $roles
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

        //Asociar los datos del personal a la cuenta del usuario
        $user = new User;
        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->password=bcrypt($request->password);
        $user->personal_clinica_id=$request->personal_clinica_id;
        //Persona::find($user->persona_id)->update(['cuenta'=>true]);

        if($request->file('foto')){

            $image = $request->foto;
            $image->move(public_path() . '/imagenes/perfil/', $image->getClientOriginalName());
            $user->foto = $image->getClientOriginalName();

        }
        $user->estado_id=1; //Habilitado
        $user->save();
        $personal_clinica=PersonalClinica::find($user->personal_clinica_id);
        $personal_clinica->cuenta=true;
        $personal_clinica->update();


        //Paciente::find($historia_clinica->paciente_id)->update(['historia_clinica'=>true]);
        //PersonalClinica::find($user->personal_clinica_id)->update(['cuenta'=>true]);

        //Sincronizar al usuario creado con el rol y guardarlo
        //$user->roles()->sync($request->get('roles'));

        Session::flash('store_user','El usuario '.$user->name. ' ha sido registrdo con éxito');
        return Redirect::to('user');

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
        $user=User::findOrFail($id);
        //$roles=DB::table('roles')->get();
        $personals=PersonalClinica::get();

        return view("user.edit", [
            "user"      =>  $user,
            //"roles"     =>  $roles,
            "personals" =>  $personals
            ]);
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
        $user=User::findOrFail($id);
        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->password=bcrypt($request->password);
        $user->personal_clinica_id=$request->personal_clinica_id;

        $user->update();

        $personal_clinica=PersonalClinica::find($user->personal_clinica_id);
        $personal_clinica->cuenta=true;
        $personal_clinica->update();

        Session::flash('update_user','La persona '.$user->name. ' ha sido actualizada con éxito');
        return Redirect::to('user');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user=User::find($id);
        //$nombre=$user->personal->nombreCompleto();
        $user->update(['estado_id'=>2]);
        $personal=PersonalClinica::find($user->personal_clinica_id);
        $personal->cuenta=false;
        $personal->update();
        return redirect()->route('user.index')/*->withMessage("El user $nombre ha sido dado de baja correctamente")*/;

    }

    /*public function eliminados()
    {
        $userEliminados=userClinica::where('habilitado',false)->get();
        return view("user.eliminados",compact('userEliminados'));

    }*/


    public function restaurar($id)
    {
        $userRestaurar = User::find($id);
        $userRestaurar->update(['estado_id'=>1]);
        $personal=PersonalClinica::find($userRestaurar->personal_clinica_id);
        $personal->cuenta=true;
        $personal->update();
        return redirect()->route('user.index');

    }
}
