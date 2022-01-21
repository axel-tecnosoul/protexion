<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

class AuditController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {



        $desde=$request->desde;
        $hasta=$request->hasta;
        $auditable_type=$request->auditable_type;
        $auditable_id=$request->auditable_id;



        $path = app_path();
        $types = [];
        $results = scandir($path);
        foreach ($results as $result)
        {
            if ($result === '.' or $result === '..') continue;
                    $filename = $path . '/' . $result;
            if (!is_dir($filename))
                {

                    $types[] = substr($result,0,-4);
                }
        }

        //$types = DB::table('audits')->distinct()->pluck("auditable_type");


        if(count($request->all())>1)
        {
            $sql = \OwenIt\Auditing\Models\Audit::select('audits.*');

            if($desde)
            {
                $sql = $sql->whereDate('created_at','>=',$desde);
            }
            if($hasta)
            {
                $sql = $sql->whereDate('created_at','<=',$hasta);
            }
            if($auditable_type)
            {
                $sql = $sql->whereAuditable_type('App\\' . $auditable_type);
            }
            if($auditable_id)
            {
                $sql = $sql->whereAuditable_id($auditable_id);
            }

            $audits=$sql->orderBy('created_at','desc')->get();
        }
        else
        {
            //            $audits =  \OwenIt\Auditing\Models\Audit::with('user')

            $audits =  \OwenIt\Auditing\Models\Audit::select('audits.*')
            ->orderBy('created_at','desc')
            ->get();
        }


        return view('audits.index',[
            "audits"        =>  $audits,
            "desde"         =>  $desde,
            "hasta"         =>  $hasta,
            "auditable_type"=>  $auditable_type,
            "types"         =>  $types,
            "auditable_id"  =>  $auditable_id,

            ]);

    }



}
