<?php

namespace App\Http\Controllers;

use App\ArchivoAdjunto;
use App\Http\Controllers\Controller;
use App\DeclaracionJurada;
use App\HistoriaClinica;
use App\Models\Audiometria;
use App\Models\Espiriometria;
use App\Models\Estudio;
use App\Models\TipoEstudio;
//use App\Models\Aptitud;
use App\Riesgos;

use Illuminate\Http\Request;
use App\Voucher;
use App\User;
use App\Paciente;
use App\Origen;
use App\Pais;
use App\Provincia;
use App\Models\VoucherEstudio;
use App\Models\VoucherRiesgos;
use Carbon\Carbon;
use PDF;
use DB;

class VoucherController extends Controller
{

    /*function __construct()
    {
         $this->middleware('permission:listar vouchers|crear voucher|editar voucher|eliminar voucher', ['only' => ['index','store']]);
         $this->middleware('permission:crear voucher', ['only' => ['create','store']]);
         $this->middleware('permission:editar voucher', ['only' => ['edit','update']]);
         $this->middleware('permission:eliminar voucher', ['only' => ['destroy']]);
    }*/
    
    public function traerDatosPaciente(Request $request)
    {
        $paciente=Paciente::find($request->id);

        $retorno = [
            'documento'         =>  number_format( (intval($paciente->documento)/1000), 3, '.', '.'),
            'nombres'           =>  $paciente->nombreCompleto(),
            'fecha_nacimiento'  =>  Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y'),
            'foto'              =>  asset('imagenes/paciente/'.$paciente->foto),
            'cuil'              =>  $paciente->cuil,
            'sexo'              =>  $paciente->sexo->definicion,
        ];
        return response()->json($retorno);
    }

    public function index(Request $request)
    {
        $vouchers = Voucher::all(); //obteneme todas los vouchers
        $sql = Paciente::select('pacientes.*') //inicio la consulta sobre una determinada tabla
          ->whereEstado_id(1); //creo la consulta y almaceno en "sql"
        $pacientes=$sql->get();

        $desde=$request->desde;
        $hasta=$request->hasta;
        if(is_null($desde)) $desde=date("Y-m-d");
        if(is_null($hasta)) $hasta=date("Y-m-d");

        $today = Carbon::now()->format('Y-m-d');

        if(count($request->all())>=1) //si existe algun request(es decir, si uso el "Filtrar")
        {
            //dd($request->all());
            $sql = Voucher::select('vouchers.*'); //inicio la consulta sobre una determinada tabla
            $sql = $sql->where('anulado','=',0);
            if($request->desde){
                $sql = $sql->where('turno','>=',$request->desde);
            }            
            if($request->hasta){
                $sql = $sql->where('turno','<=',$request->hasta);
            }
            $vouchers=$sql->orderBy('turno','desc')->get(); //ejecuto la consulta
        }
        else //si nunca filtre, (si no existió request)
        {
            $vouchers=Voucher::whereAnulado(0)->whereTurno($today)->orderBy('codigo','desc')->get(); //que me obtenga directamente todos los grupos
        }

        //$vouchers = Voucher::orderBy('id', 'desc')->get();
        return view('voucher.index',[
            "vouchers"         => $vouchers,
            "pacientes"         => $pacientes,
            "desde"             => $desde,
            "hasta"             => $hasta
        ]);
    }

    public function create($id)
    {

      //dd($id);
      $ex=explode(",",$id);
      $cant_pacientes=count($ex);
      if($cant_pacientes==1){
        $paciente =         Paciente::find($id);
      }else{
        $paciente=$id;
      }

      $tipo_estudios = TipoEstudio::all();
      $estudios = Estudio::all();
      $riesgos = Riesgos::all();
      //$origenes = Origen::all();
      $origenes = Origen::orderBy('definicion')->get();

      $paises = Pais::all();

      //Eliminar estudios con el mismo nombre que el tipo de estudio
      for ($i=0; $i < sizeof($estudios); $i++) { 
          if (strtoupper($estudios[$i]->nombre)  == strtoupper($estudios[$i]->tipoEstudio->nombre))  {
              unset($estudios[$i]);
          }
      }
      /*$pacientes =        Paciente::where('estado_id','=',1)
                                  ->where('documento','!=',"")->get();*/
      return view("voucher.create", compact(/*'pacientes', */'estudios', 'tipo_estudios', 'paciente','riesgos','cant_pacientes',"origenes","paises"));
    }

    public function store(Request $request)
    {

      $paciente_id=$request->paciente_id;
      $aPacientes=explode(",",$paciente_id);

      $origen_id=$request->origen_id;
      //$cant_pacientes=count($aPacientes);
      //dd($request->all());
      //$paciente=$paciente_id;
      foreach ($aPacientes as $key => $paciente_id) {

          $n=Voucher::count() + 1;
          $voucher=new Voucher();
          $voucher->codigo=str_pad($n, 10, '0', STR_PAD_LEFT);
          $voucher->turno=$request->turno;
          $voucher->user_id=auth()->user()->id;
          //$voucher->paciente_id = $request->paciente_id;
          $voucher->paciente_id = $paciente_id;
          $voucher->origen_id = $origen_id;
          $voucher->save();

          $paciente=Paciente::findOrFail($paciente_id);
          $paciente->origen_id=$origen_id;
          $paciente->update();

          //dd($request->riesgos);
          $riesgos=$request->riesgos;

          foreach ($riesgos as $key => $value) {
            if($value==1){
              $voucher_riesgo = new VoucherRiesgos;
              $voucher_riesgo->voucher_id = $voucher->id;
              $voucher_riesgo->riesgo_id = $key;
              $voucher_riesgo->save();
            }
          }

          //HARDCODEADISIMO
          //     | | | 
          //     V V V
          //
          $analisisB = false;
          $psicotecnico = false;
          $radiologia = false;

          $estudios = Estudio::all();
          foreach ($estudios as $estudio) {
              //La variable aux toma el valor del id del Estudio
              $aux = $estudio->id;
              //Compara el aux con el campo de la request, que en la vista se establece que cada uno es el id de un Estudio distinto.
              if ($request->$aux == 1) {
                  $voucher_estudio = new VoucherEstudio;
                  $voucher_estudio->voucher_id = $voucher->id;
                  $voucher_estudio->estudio_id = $estudio->id;
                  $voucher_estudio->save();

                  //Comprobar si se cargar estudios base
                  if ($estudio->id == $voucher_estudio->estudio_id) {
                      if ((strtoupper($estudio->tipoEstudio->nombre) == "ANALISIS BIOQUIMICO") or
                          (strtoupper($estudio->tipoEstudio->nombre) == "ANALISIS BIOQUIMICO ANEXO 01") ) {
                          $analisisB = true;
                      }
                      if (strtoupper($estudio->tipoEstudio->nombre) == "PSICOTECNICO") {
                          $psicotecnico = true;
                      }
                      if (strtoupper($estudio->tipoEstudio->nombre) == "RADIOLOGIA") {
                          $radiologia = true;
                      }
                  }
              }
          }
          //Cargar estudios base
          if ($analisisB) {
              $voucher_estudio = new VoucherEstudio;
              $voucher_estudio->voucher_id = $voucher->id;
              $voucher_estudio->estudio_id = 1;
              $voucher_estudio->save();
          }
          if ($psicotecnico) {
              $voucher_estudio = new VoucherEstudio;
              $voucher_estudio->voucher_id = $voucher->id;
              $voucher_estudio->estudio_id = 60;
              $voucher_estudio->save();
          }
          if ($radiologia) {
              $voucher_estudio = new VoucherEstudio;
              $voucher_estudio->voucher_id = $voucher->id;
              $voucher_estudio->estudio_id = 66;
              $voucher_estudio->save();
          }
      }
      
        //"riesgos" => implode($request->riesgos),

        if(count($aPacientes)==1){
          return redirect()->route('voucher.show',$voucher->id);
        }else{
          return redirect()->route('voucher.index');
        }
    }

    public function show($id)
    {
        //Obtener Voucher
        $voucher = Voucher::find($id);

        $puede_imprimir=0;
        if($voucher->declaracionJurada){
          $puede_imprimir=1;
        }

        //Tipos de estudio en Voucher
        $tipo_estudios = $voucher->tiposEstudios();

        //Estudios a cargar
        $estudios_cargar = $voucher->estudiosCargar();

        //Todos los estudios del voucher
        //$estudios_voucher = $voucher->getEstudiosClasificados();
        $estudios_voucher=[];
        foreach($voucher->getEstudiosClasificados() as $tipos_estudio){
          $tipo_estudio=$tipos_estudio[0]->nombre;
          //var_dump($tipo_estudio);
          foreach($tipos_estudio[1] as $estudios){
            $estudio=$estudios["estudio"]->nombre;
            $id_estudio=$estudios["estudio"]->id;
            //var_dump($estudio);
            $estudios_voucher[$tipo_estudio][$id_estudio]=$estudio;
          }
          //echo "<hr>";
        }
        //dd($estudios_voucher);
        //die();

        //Estudios generados por el sistema
        $estudios_sistema = [];
        $estudios = [];
        $indice = [];
        $rutasCreate = [];
        $rutasEdit = [];
        $forms = [];
        $forms[] = array(   'DECLARACION JURADA',
                            'HISTORIA CLINICA',
                            'POSICIONES FORZADAS',
                            'AUDIOMETRIA',
                            'ESPIROMETRIA',
                            'ILUMINACION'); 

        $forms[] = array(   'declaracion_jurada.create',
                            'historia_clinica.create',
                            'posiciones_forzadas.create',
                            'audiometrias.create',
                            'espiriometrias.create',
                            'iluminacion_direccionados.create');

        $forms[] = array(   'declaracionJurada',
                            'historiaClinica',
                            'posicionesForzadas',
                            '',
                            '',
                            'iluminacionDireccionado');

        $forms[] = array(   'declaracion_jurada.edit',
                            'historia_clinica.edit',
                            'posiciones_forzadas.edit',
                            'audiometrias.edit',
                            'espiriometrias.edit',
                            'iluminacion_direccionados.edit');
        $a = 0;
        //dd($voucher->vouchersEstudios);
        $id_estudios=[];
        foreach ($voucher->vouchersEstudios as $item) {
            for ($i=0; $i < sizeof($forms[0]); $i++) {
                if ( $item->estudio->nombre == $forms[0][$i]) {
                    $estudios[] = $item;
                    $rutasCreate[] = $forms[1][$i];
                    $rutasEdit[] = $forms[3][$i];
                    $indice[] = $a;

                    $id_estudio=0;
                    if($voucher->{$forms[2][$i]}){
                      $id_estudio=$voucher->{$forms[2][$i]}->id;
                    }

                    $id_estudios[] = $id_estudio;
                    $a++;
                }

            }
        }
        //var_dump($id_estudios);
        //dd($id_estudios);
        
        $estudios_sistema[] = $estudios;
        $estudios_sistema[] = $rutasCreate;
        $estudios_sistema[] = $indice;
        $estudios_sistema[] = $id_estudios;
        $estudios_sistema[] = $rutasEdit;
        return view('voucher.show', compact('voucher', 'estudios_sistema','estudios_cargar', 'tipo_estudios', 'puede_imprimir','estudios_voucher'));
    }

    public function edit($id)
    {
      $voucher=Voucher::findOrFail($id);

      $tipo_estudios =    TipoEstudio::all();
      $estudios =         Estudio::all();
      $paciente =         Paciente::find($voucher->paciente->id);
      $origenes = Origen::orderBy('definicion')->get();
      $paises = Pais::all();

      $voucher_estudio=[];
      //dd($voucher->vouchersEstudios);
      
      foreach($voucher->vouchersEstudios as $estudio){
        //var_dump($estudio->estudio_id);
        //echo $estudio->estudio_id."<br>";
        
        $archivoAdjunto=ArchivoAdjunto::where('voucher_estudio_id', $estudio->id)->get();
        //var_dump($archivoAdjunto);
        //var_dump(count($archivoAdjunto));
        $completo="no";
        if(count($archivoAdjunto)>0){
          //echo "TIENE ALGOOOOOOOOOOOOOOOOOOOOOOOOOOOO<br>";
          //echo $estudio->estudio_id."<br>";
          $completo="si";
        }
        
        $voucher_estudio[$estudio->estudio_id]=$completo;
      }

      //dd($voucher_estudio);

      $voucher_riesgos=[];
      foreach($voucher->vouchersRiesgos as $riesgo){
        $voucher_riesgos[]=$riesgo->riesgo_id;
      }

      $riesgos =         Riesgos::all();

      //Eliminar estudios con el mismo nombre que el tipo de estudio
      /*for ($i=0; $i < sizeof($estudios); $i++) { 
        if (strtoupper($estudios[$i]->nombre)  == strtoupper($estudios[$i]->tipoEstudio->nombre))  {
          //if($estudios[$i]->id!=66){
            //echo "eliminamos";
            unset($estudios[$i]);
          //}
        }
      }*/
      //die();

      return view("voucher.edit", compact(/*'pacientes', */'estudios', 'tipo_estudios', 'paciente','riesgos','voucher','voucher_estudio','voucher_riesgos','origenes','paises'));
      //return view("ciudad.edit",["ciudad"=>$ciudad,"provincias"           =>  $provincias]);
    }

    public function update(Request $request, $id)
    {

      //dd($request);
      $voucher=Voucher::findOrFail($id);
      $voucher->turno=$request->turno;
      $voucher->user_id=auth()->user()->id;
      $voucher->origen_id = $request->origen_id;
      $voucher->update();

      $paciente=Paciente::findOrFail($request->paciente_id);
      $paciente->origen_id=$request->origen_id;
      $paciente->update();

      //dd($request->riesgos);
      $riesgos=$request->riesgos;

      $voucher_riesgo=VoucherRiesgos::whereVoucher_id($id)->delete();
      //var_dump($voucher_riesgo);
      
      foreach ($riesgos as $key => $value) {
        if($value==1){
          //$voucher_riesgo = new VoucherRiesgos;
          $voucher_riesgo = new VoucherRiesgos;
          $voucher_riesgo->voucher_id = $id;
          $voucher_riesgo->riesgo_id = $key;
          $voucher_riesgo->save();
        }
      }


      //$voucher_estudio=VoucherEstudio::whereVoucher_id($id)->delete();
      //dd($voucher_estudio);

      //HARDCODEADISIMO
      //     | | | 
      //     V V V
      //
          $analisisB = false;
          $psicotecnico = false;
          $radiologia = false;

          $estudios = Estudio::all();

          //dd($request->all());
          foreach ($estudios as $estudio) {
              //La variable aux toma el valor del id del Estudio
              $aux = $estudio->id;

              if($aux==60 or $aux==66){
                //var_dump($aux);
                //var_dump($request->$aux);
              }
              
              //Compara el aux con el campo de la request, que en la vista se establece que cada uno es el id de un Estudio distinto.
              if ($request->$aux == 1) {
                  /* VINO EN EL REQUEST */
                  $get_voucher_estudio=VoucherEstudio::whereVoucher_id($id)->whereEstudio_id($aux)->get();
                  //echo "encontrado: ".count($voucher_estudio)."<br><br>";
                  if($aux==60){
                    //echo "count: ".count($get_voucher_estudio);
                    //dd($get_voucher_estudio);
                  }
                  //die();
                  if(count($get_voucher_estudio)==0){
                      /* ES NUEVO Y LO INSERTAMOS */
                      $voucher_estudio = new VoucherEstudio;
                      $voucher_estudio->voucher_id = $id;
                      $voucher_estudio->estudio_id = $estudio->id;
                      $voucher_estudio->save();

                      //Comprobar si se cargar estudios base
                      //var_dump($voucher_estudio->estudio_id);
                      //var_dump($estudio->id);
                      if ($estudio->id == $voucher_estudio->estudio_id) {
                          //var_dump($estudio->tipoEstudio->nombre);
                          if ((strtoupper($estudio->tipoEstudio->nombre) == "ANALISIS BIOQUIMICO") or
                              (strtoupper($estudio->tipoEstudio->nombre) == "ANALISIS BIOQUIMICO ANEXO 01") ) {
                              $analisisB = true;
                          }
                          if (strtoupper($estudio->tipoEstudio->nombre) == "PSICOTECNICO") {
                              $psicotecnico = true;
                          }
                          if (strtoupper($estudio->tipoEstudio->nombre) == "RADIOLOGIA") {
                              $radiologia = true;
                          }
                      }
                  }else{
                      /* YA ESTÁ INSERTADO, O SEA QUE NO SE MODIFICA NADA */
                      //echo "YA ESTÁ INSERTADO, O SEA QUE NO SE MODIFICA NADA<br><br>";
                  }
              }else{
                  /* NO VINO EN EL REQUEST POR LO QUE LO ELIMINAMOS */
                  //echo "ELIMINAR";
                  $voucher_estudio=VoucherEstudio::whereVoucher_id($id)->whereEstudio_id($aux)->delete();
              }
          }
          //var_dump($psicotecnico);
          //var_dump($radiologia);
          //Cargar estudios base
          if ($analisisB) {
              /*$voucher_estudio = new VoucherEstudio;
              $voucher_estudio->voucher_id = $id;
              $voucher_estudio->estudio_id = 1;*/
              //$voucher_estudio->save();
          }else{
              //echo "VER CUANTOS HAY DE analisisB Y ELIMINAR el 1 SI NO SE ENCUENTRA<br><br>";
              $query = DB::table('vouchers_estudios')
                ->join('estudios', 'vouchers_estudios.estudio_id', '=', 'estudios.id')
                ->select('vouchers_estudios.id AS vouchers_estudio_id','vouchers_estudios.estudio_id')
                ->where('voucher_id', '=', $id)
                ->where('tipo_estudio_id', '=', 1);
              $voucher_estudio=$query->get(); //ejecuto la consulta
              //var_dump($voucher_estudio);

              if(count($voucher_estudio)==1 and $voucher_estudio[0]->estudio_id==1){
                //echo "ELIMINAMOS";
                $voucher_estudio=VoucherEstudio::whereId($voucher_estudio[0]->vouchers_estudio_id)->delete();
              }
          }

          if ($psicotecnico) {
              /*$voucher_estudio = new VoucherEstudio;
              $voucher_estudio->voucher_id = $id;
              $voucher_estudio->estudio_id = 60;*/
              //$voucher_estudio->save();
          }else{
              //echo "VER CUANTOS HAY DE psicotecnico Y ELIMINAR el 60 SI NO SE ENCUENTRA<br><br>";
              //$voucher_estudio=VoucherEstudio::whereVoucher_id($id)->whereTipo_estudio_id(5)->get();
              $query = DB::table('vouchers_estudios')
                ->join('estudios', 'vouchers_estudios.estudio_id', '=', 'estudios.id')
                ->select('vouchers_estudios.id AS vouchers_estudio_id','vouchers_estudios.estudio_id')
                ->where('voucher_id', '=', $id)
                ->where('tipo_estudio_id', '=', 5);
              $voucher_estudio=$query->get(); //ejecuto la consulta
              //var_dump($voucher_estudio);
              //echo "Cant psicotencios: ".count($voucher_estudio)."<br>";

              if(count($voucher_estudio)==1 and $voucher_estudio[0]->estudio_id==60){
                //echo "ELIMINAMOS psicotecnico";
                //$voucher_estudio=VoucherEstudio::whereId($voucher_estudio[0]->vouchers_estudio_id)->delete();
                //var_dump($voucher_estudio);
              }
          }
          //var_dump($radiologia);
          if ($radiologia) {
              /*$voucher_estudio = new VoucherEstudio;
              $voucher_estudio->voucher_id = $id;
              $voucher_estudio->estudio_id = 66;*/
              //$voucher_estudio->save();
          }else{
              //echo "VER CUANTOS HAY DE radiología Y ELIMINAR el 66 SI NO SE ENCUENTRA<br><br>";
              //$voucher_estudio=VoucherEstudio::whereVoucher_id($id)->whereTipo_estudio_id(6)->get();
              $query = DB::table('vouchers_estudios')
                ->join('estudios', 'vouchers_estudios.estudio_id', '=', 'estudios.id')
                ->join('archivo_adjuntos', 'archivo_adjuntos.voucher_estudio_id', '=', 'vouchers_estudios.id')
                ->select('vouchers_estudios.id AS vouchers_estudio_id','vouchers_estudios.estudio_id','archivo_adjuntos.anexo')
                ->where('voucher_id', '=', $id)
                ->where('tipo_estudio_id', '=', 6);
              $voucher_estudio=$query->get(); //ejecuto la consulta
              //var_dump($voucher_estudio);
              //echo "Cant radiologia: ".count($voucher_estudio)."<br>";

              if(count($voucher_estudio)==1 and $voucher_estudio[0]->estudio_id==66 and $voucher_estudio[0]->anexo=="ruta"){
                //echo "ELIMINAMOS radiologia";
                $voucher_estudio=VoucherEstudio::whereId($voucher_estudio[0]->vouchers_estudio_id)->delete();
                //var_dump($voucher_estudio);
              }
          }
          //die();

      //return false;

      return redirect()->route('paciente.voucher',$request->paciente_id);
    }

    public function destroy(Request $request, $id)
    {
        $volver=$request->volver;
        //dd($request);
        $voucher=Voucher::findOrFail($id);
        $voucher->anulado=1;
        $paciente_id=$voucher->paciente_id;

        //dd($id,$request->all(),$voucher->paciente_id);
        //$voucher->paciente_id = $request->paciente_id;
        $voucher->update();

        if($volver=="todas"){
          return redirect()->route('voucher.index');
        }else{
          return redirect()->route('paciente.voucher', ['paciente' => $paciente_id]);
        }
    }

    public function pdf_paciente($id)
    {
        $voucher=Voucher::find($id);
        $tipo_estudios =    TipoEstudio::all();
        $estudios = [];
        $tipos = [];
        $i = -1;
        $cont = 0;

        $aVoucherPaciente=[];
        //foreach ($tipo_estudios as $tipo_estudio) {
            /*$aux = 0;
            foreach ($voucher->vouchersEstudios as $item) {
                if  ($item->estudio->tipo_estudio_id == $tipo->id){
                  //dd($item->estudio);
                    $estudios[] = $item->estudio;
                    if ($aux == 0) {
                        $aux = 1;
                    }
                }
            }
            if ($aux == 1) {
                $tipos[] = $tipo_estudio;
            }*/

            //entramos solamente si NO es ANALISIS BIOQUIMICO ANEXO 01
            foreach ($voucher->vouchersEstudios as $item) {
              $itemVoucher=$item->estudio;
              $tipo_estudio=$itemVoucher->tipoEstudio;
              if ($tipo_estudio->id != 2){
                //if (($tipo_estudio->id == 3) || ($tipo_estudio->id == 4) ){
                if(in_array($tipo_estudio->id,[3,4,6])){//3->COMPLEMENTARIO, 4->EXAMEN CLINICO, 6->RADIOLOGIA
                  //si es uno de estos tipos de estudio debemos realizar otras acciones
                  /*echo "itemVoucher->tipo_estudio_id: ";
                  echo $itemVoucher->tipo_estudio_id;
                  echo "<br>tipo_estudio->id: ";
                  echo $tipo_estudio->id;
                  echo "<br>itemVoucher->id: ";
                  echo $itemVoucher->id;*/

                  //if ($itemVoucher->tipo_estudio_id == $tipo_estudio->id and !in_array($itemVoucher->id,[73,66])){//73->GENERAL, 66->RADIOLOGIA
                  if (!in_array($itemVoucher->id,[73,66])){//73->GENERAL, 66->RADIOLOGIA
                    //echo "ENTRAMOS";
                    /*if($tipo_estudio->id==3){
                      dd($item,$itemVoucher->tipoEstudio,$tipo_estudio,$item,$itemVoucher);
                    }*/
                    if(in_array($itemVoucher->id,[56,57])){//56->DECLARACION JURADA, 57->HISTORIA CLINICA
                      //para estos estudios deben aparecen el nombre del tipo de estudio (EXAMEN CLINICO)
                      $aVoucherPaciente[]=$tipo_estudio->nombre;
                    }else{
                      //para los demas casos, va el nombre del estudio propiamente dicho
                      $aVoucherPaciente[]=strtoupper($itemVoucher->nombre);
                    }
                  }
                }else{
                  //si el estudio es PSICOTECNICO no lo mostramos
                  //var_dump($itemVoucher->id);
                  
                  if($itemVoucher->id!=60){
                    //var_dump($tipo_estudio->nombre);
                    //var_dump(strtoupper($itemVoucher->nombre));
                    //si es ANALISIS BIOQUIMICO o PSICOTECNICO va el nombre del tipo de estudio directamente
                    if ($tipo_estudio->nombre == strtoupper($itemVoucher->nombre) or $tipo_estudio->id == 5){
                      //var_dump($tipo_estudio->nombre);
                      //echo "2 - ".$tipo_estudio->nombre."<br>";
                      $aVoucherPaciente[]=$tipo_estudio->nombre;
                    }
                  }
                }
                //echo "<hr>";
              }else{
                //echo "ANALISIS BIOQUIMICO"."<br>";
                $aVoucherPaciente[]="ANALISIS BIOQUIMICO";
              }
            }
        //}
        $aVoucherPaciente=array_unique($aVoucherPaciente);
        //var_dump($aVoucherPaciente);
        //die();

        //dd($tipos,$tipo_estudios,$estudios,$voucher);
        $pdf = PDF::loadView('voucher.pdf_paciente',[
            "voucher"           =>  $voucher,
            "tipo_estudios"     =>  $tipos,
            "estudios"          =>  $estudios,
            "aVoucherPaciente"  =>  $aVoucherPaciente,
            "i"                 =>  $i,
            "cont"              =>  $cont
        ]);
        $pdf->setPaper('a4','letter');
        return $pdf->stream('voucher_paciente.pdf');
        //return view('voucher.pdf_paciente', compact('voucher', 'tipo_estudios', 'estudios','i','cont'));
    }

    public function pdf_medico($id)
    {

        $voucher=Voucher::find($id);
        $tipo_estudios =    TipoEstudio::all();
        $estudios = [];
        $tipos = [];
        $i = -1;
        $cont = 0;
        foreach ($tipo_estudios as $tipo) {
            $aux = 0;
            foreach ($voucher->vouchersEstudios as $item) {
                if  ($item->estudio->tipo_estudio_id == $tipo->id){
                    $estudios[] = $item->esudio;
                    if ($aux == 0) {
                        $aux = 1;
                    }
                }
            }
            if ($aux == 1) {
                $tipos[] = $tipo;
            }
        }

        $pdf = PDF::loadView('voucher.pdf_medico',[
            "voucher"           =>  $voucher,
            "tipo_estudios"     =>  $tipos,
            "estudios"          =>  $estudios,
            "i"                 =>  $i,
            "cont"              =>  $cont
            ]);
        $pdf->setPaper('a4','letter');
        return $pdf->stream('voucher_medico.pdf');
    }

    public function clonar(Request $request, $voucher_id)
    {

      $paciente_id=$request->paciente_id;

      $paciente=Paciente::find($paciente_id);
      $voucher_clonar=Voucher::find($voucher_id);

      //$origen_id=$request->origen_id;
      $origen_id=$paciente->origen_id;
      $estudios_voucher_clonar=$voucher_clonar->vouchersEstudios()->get();
      $riesgos_voucher_clonar=$voucher_clonar->vouchersRiesgos()->get();
      
      //dd($voucher_id,$request->all(),$origen_id);
      //dd($request->all());
      //$paciente=$paciente_id;

        $n=Voucher::count() + 1;
        $voucher=new Voucher();
        $voucher->codigo=str_pad($n, 10, '0', STR_PAD_LEFT);
        $voucher->turno=$request->turno;
        $voucher->user_id=auth()->user()->id;
        //$voucher->paciente_id = $request->paciente_id;
        $voucher->paciente_id = $paciente_id;
        $voucher->origen_id = $origen_id;
        $voucher->save();

        $paciente=Paciente::findOrFail($paciente_id);
        $paciente->origen_id=$origen_id;
        $paciente->update();

        //dd($request->riesgos);
        //$riesgos=$request->riesgos;
        foreach ($riesgos_voucher_clonar as $key => $riesgo) {
          //var_dump($riesgo->riesgo_id);
          $voucher_riesgo = new VoucherRiesgos;
          $voucher_riesgo->voucher_id = $voucher->id;
          $voucher_riesgo->riesgo_id = $riesgo->riesgo_id;
          $voucher_riesgo->save();
        }

        //HARDCODEADISIMO
        //     | | | 
        //     V V V
        //
        $analisisB = false;
        $psicotecnico = false;
        $radiologia = false;


        foreach ($estudios_voucher_clonar as $key => $estudio) {
          //var_dump($estudio->estudio_id);
          $voucher_estudio = new VoucherEstudio;
          $voucher_estudio->voucher_id = $voucher->id;
          $voucher_estudio->estudio_id = $estudio->estudio_id;
          $voucher_estudio->save();

          //Comprobar si se cargar estudios base
          if ($estudio->id == $voucher_estudio->estudio_id) {
              if ((strtoupper($estudio->tipoEstudio->nombre) == "ANALISIS BIOQUIMICO") or
                  (strtoupper($estudio->tipoEstudio->nombre) == "ANALISIS BIOQUIMICO ANEXO 01") ) {
                  $analisisB = true;
              }
              if (strtoupper($estudio->tipoEstudio->nombre) == "PSICOTECNICO") {
                  $psicotecnico = true;
              }
              if (strtoupper($estudio->tipoEstudio->nombre) == "RADIOLOGIA") {
                  $radiologia = true;
              }
          }
        }
        
        //Cargar estudios base
        if ($analisisB) {
            $voucher_estudio = new VoucherEstudio;
            $voucher_estudio->voucher_id = $voucher->id;
            $voucher_estudio->estudio_id = 1;
            $voucher_estudio->save();
        }
        if ($psicotecnico) {
            $voucher_estudio = new VoucherEstudio;
            $voucher_estudio->voucher_id = $voucher->id;
            $voucher_estudio->estudio_id = 60;
            $voucher_estudio->save();
        }
        if ($radiologia) {
            $voucher_estudio = new VoucherEstudio;
            $voucher_estudio->voucher_id = $voucher->id;
            $voucher_estudio->estudio_id = 66;
            $voucher_estudio->save();
        }

        return redirect()->route('voucher.show',$voucher->id);
    }

}
