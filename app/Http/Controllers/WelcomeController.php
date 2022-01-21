<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    public function index()
    {


        $users = User::all();
        $cantUser = $users->count();



        return view('welcome',[
            "cantUser"          => $cantUser,

        ]);
    }

}
