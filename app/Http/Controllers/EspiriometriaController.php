<?php

namespace App\Http\Controllers;

use App\DeclaracionJurada;
use App\Models\Espiriometria;
use App\Voucher;
use Illuminate\Http\Request;

use PDF;

/**
 * Class EspiriometriaController
 * @package App\Http\Controllers
 */
class EspiriometriaController extends Controller
{

    public function index()
    {
        $espiriometrias = Espiriometria::all();

        return view('espiriometria.index', compact('espiriometrias'));
    }


    public function create()
    {   
        $vouchers = Voucher::all();
        $espiriometria = new Espiriometria();
        return view('espiriometria.create', compact('espiriometria', 'vouchers'));
    }

    public function crearPDF($id)
    {
        $voucher= Voucher::find($id);
        $declaracionJurada=null;
        if($voucher->declaracionJurada){
          $declaracionJurada=DeclaracionJurada::find($voucher->declaracionJurada->id);
        }
        $pdf = PDF::loadView('espiriometria.PDF',[
            "voucher"   =>  $voucher,
            "declaracion_jurada"   =>  $declaracionJurada
            ]);
        $pdf->setPaper('a4','letter');
        return $pdf->stream('espiriometria.pdf');
    }

    public function store(Request $request)
    {
        request()->validate(Espiriometria::$rules);

        $espiriometria = Espiriometria::create($request->all());

        return redirect()->route('espiriometrias.index');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, Espiriometria $espiriometria)
    {

    }

    public function destroy($id)
    {

    }
}
