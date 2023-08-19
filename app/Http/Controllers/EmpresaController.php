<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Empresa;
use App\Pais;
use App\Domicilio;
//use App\Sexo;
use App\Provincia;
use App\Ciudad;
use App\Paciente;
//use App\Especialidad;
//use App\Estado;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use App\Models\Aptitud;
use DB;
use PDF;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;

class EmpresaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*function __construct()
    {
        $this->middleware('permission:listar personal|crear personal|editar personal|eliminar personal', ['only' => ['index','store']]);
        $this->middleware('permission:crear personal', ['only' => ['create','store']]);
        $this->middleware('permission:editar personal', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar personal', ['only' => ['destroy']]);
    }*/

    //const URL_SERVIDOR_WEB = 'https://protexionpr.com.ar/client_access/models/';
    //const URL_SERVIDOR_WEB = 'http://localhost/protexion/client_access/models/';
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$puestos=Puesto::all(); //obteneme todas las categorias
        //$estados=Estado::all(); //obteneme todas las categorias

        if(count($request->all())>=1) //si existe algun request(es decir, si uso el "Filtrar")
        {
            //dd($request->all());
            $sql = Empresa::select('empresas.*'); //inicio la consulta sobre una determinada tabla

            if($request->puesto_id) //si el request proviene de la categoria del ticket
            {
                $sql = $sql->wherePuesto_id($request->puesto_id); //creo la consulta y almaceno en "sql"
            }
            /*if($request->estado_id){
                $sql = $sql->whereEstado_id($request->estado_id); //creo la consulta y almaceno en "sql"
            }*/
            $empresas=$sql->orderBy('created_at','desc')->get(); //ejecuto la consulta
            $puesto_id=$request->puesto_id; //mantengo el id de la categoria del tiquet
            //$estado_id=$request->estado_id; //mantengo el id de la categoria del tiquet
        }else //si nunca filtre, (si no existió request)
        {
            
            //$personals=Empresa::whereEstado_id(1)->orderBy('created_at','desc')->get(); //que me obtenga directamente todos los grupos
            $empresas=Empresa::orderBy('created_at','desc')->get(); //que me obtenga directamente todos los grupos
        }

        return view('empresa.index',[
          "empresas"         =>  $empresas,         //los grupos de trabajo
        ]);


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //$sexos=Sexo::all();
        //$provincias=Provincia::all();
        $paises=Pais::all();
        return view("empresa.create", [
          "paises"             =>  $paises,
            //"sexos"             =>  $sexos,
            //"provincias"           =>  $provincias
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
        $this->validate($request, [
            //'documento'         => 'required|unique:personal_clinicas,documento,except,id',
            'definicion'      => 'required',
            'cuit'            => 'required',
            'direccionOrigen' => 'required',
            'ciudad_idOrigen' => 'required',
            //'provincias_id' => 'required'
        ]);

        $direccion = new Domicilio;
        $direccion->direccion = $request->get('direccionOrigen');
        $direccion->ciudad_id = $request->get('ciudad_idOrigen');
        $direccion->save();

        //Creo los datos de la persona

        $nombreEmpresa=$request->get('definicion');

        $empresa = new Empresa;
        $empresa->definicion=$nombreEmpresa;
        $empresa->cuit=$request->get('cuit');
        //$empresa->domicilio_id=$request->get('domicilio_id');
        $empresa->domicilio_id=$direccion->id;

        //dd($empresa);
        $empresa->save();
        $idEmpresa=$empresa->id;
        //$idEmpresa=99;

        $resultado=$this->subirEmpresaWeb($idEmpresa,$nombreEmpresa);

        $accion="";
        $msj="";
        if($idEmpresa>0){
          if($resultado==""){
            $accion="success";
            $msj="La empresa fue creada y subida al servidor web correctamente";
          }else{
            $accion="warning";
            $msj="La empresa fue creada pero no subida al servidor web por algun error inesperado. ".$resultado;
          }
        }

        //dd($resultado);
        //return redirect()->route('empresa.index')->with($accion,$msj);
        return redirect()->route('empresa.index')->with('store', [
          'alert' => $accion,
          'message' => $msj,
        ]);
    }

    public function subirEmpresaWeb($idEmpresa,$nombreEmpresa){
      // URL del sistema en el servidor web (Sistema B) que recibirá los archivos
      
      $url = env('URL_SERVIDOR_WEB')."administrar_empresas.php?accion=subirEmpresa";

      // Agregar el nombre de la empresa al arreglo de archivos
      $datos = [
        [
          'name' => 'idEmpresa',
          'contents' => $idEmpresa,
        ],[
          'name' => 'nombreEmpresa',
          'contents' => $nombreEmpresa,
        ]
      ];

      //var_dump($datos);

      // Enviar la solicitud POST con los archivos y el nombre de la empresa
      try {
        // Crear una instancia del cliente GuzzleHTTP
        $client = new Client([ 'verify' => false ]);

        // Realizar la solicitud a la URL
        $response = $client->post($url, [
          RequestOptions::MULTIPART => $datos,
        ]);

        // Obtener la respuesta de la solicitud
        $body = $response->getBody();
        //var_dump($body);
        $resultado = $body->getContents();
        //var_dump($resultado);

      }  catch (ConnectException $e) {
        // Manejar el error de conexión
        $resultado='No se pudo establecer conexión con el servidor web. Verifica tu conexión a internet o la URL proporcionada.';
      } catch (RequestException $e) {
        if ($e->hasResponse()) {
          // Si se recibió una respuesta, obtener el código de estado HTTP
          $statusCode = $e->getResponse()->getStatusCode();
          
          // Manejar el código de estado y mostrar un mensaje de error apropiado
          if ($statusCode === 404) {
            // Manejar el error 404
            $resultado='Página no encontrada.';
          } else {
            // Manejar otros códigos de estado
            $resultado='Ocurrió un error con el código de estado: ' . $statusCode;
          }
        } else {
          // Manejar errores de conexión o resolución DNS
          $resultado='No se pudo resolver el host. Verifica tu conexión a internet.';
        }
      }
      //var_dump($resultado);
      
      //die();
      return $resultado;
    }

    public function sincronizarEmpresas(){

      $empresas = Empresa::select('origenes.*')->get(); //ejecuto la consulta

      // URL del sistema en el servidor web (Sistema B) que recibirá los archivos
      $url = env('URL_SERVIDOR_WEB')."administrar_empresas.php?accion=sincronizarEmpresa";

      $ok=$ok2=0;
      $aErrores=[];
      foreach ($empresas as $key => $empresa) {
        $ok++;
        // Agregar el nombre de la empresa al arreglo de archivos
        $datos = [
          [
            'name' => 'idEmpresa',
            'contents' => $empresa->id,
          ],[
            'name' => 'nombreEmpresa',
            'contents' => $empresa->definicion,
          ]
        ];

        //var_dump($datos);

        // Enviar la solicitud POST con los archivos y el nombre de la empresa
        try {
          // Crear una instancia del cliente GuzzleHTTP
          $client = new Client([ 'verify' => false ]);

          // Realizar la solicitud a la URL
          $response = $client->post($url, [
            RequestOptions::MULTIPART => $datos,
          ]);

          // Obtener la respuesta de la solicitud
          $body = $response->getBody();
          //var_dump($body);
          $resultado = $body->getContents();
          //var_dump($resultado);

        }  catch (ConnectException $e) {
          // Manejar el error de conexión
          $resultado='No se pudo establecer conexión con el servidor web. Verifica tu conexión a internet o la URL proporcionada.';
        } catch (RequestException $e) {
          if ($e->hasResponse()) {
            // Si se recibió una respuesta, obtener el código de estado HTTP
            $statusCode = $e->getResponse()->getStatusCode();
            
            // Manejar el código de estado y mostrar un mensaje de error apropiado
            if ($statusCode === 404) {
              // Manejar el error 404
              $resultado='Página no encontrada.';
            } else {
              // Manejar otros códigos de estado
              $resultado='Ocurrió un error con el código de estado: ' . $statusCode;
            }
          } else {
            // Manejar errores de conexión o resolución DNS
            $resultado='No se pudo resolver el host. Verifica tu conexión a internet.';
          }
        }
        //var_dump($resultado);
        if($resultado==""){
          $ok2++;
        }else{
          $aErrores[]=$resultado;
        }
      }
      
      //die();
      //return $resultado;
      $accion="success";
      $msj="Las empresas ha sido sincronizadas con la web correctamente";
      if(count($aErrores)>0){
        $accion="warning";
        $msj="La sincronizacion con el servidor web ha devuelto los siguientes errores: ".implode("/n",$aErrores);
      }

      //dd($resultado);
      //return redirect()->route('empresa.index')->with($accion,$msj);
      return redirect()->route('empresa.index')->with('store', [
        'alert' => $accion,
        'message' => $msj,
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id){
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id){
        $empresa=Empresa::findOrFail($id);
        $paises=Pais::all();
        $provincias=Provincia::all();
        $ciudades=Ciudad::all();

        //dd($empresa->domicilio);

        return view("empresa.edit",[
          "empresa"=>$empresa,
          "paises"=>$paises,
          "provincias"=>$provincias,
          "ciudades"=>$ciudades,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $this->validate($request, [
            //'documento'         => 'required|unique:personal_clinicas,documento,except,id',
            'definicion'           => 'required',
            'cuit'         => 'required',
            'direccionOrigen'  => 'required',
            'ciudad_idOrigen'           => 'required',
            //'provincias_id'         => 'required'
        ]);

        $direccion=Domicilio::findOrFail($id);
        $direccion->direccion = $request->get('direccionOrigen');
        $direccion->ciudad_id = $request->get('ciudad_idOrigen');
        $direccion->update();


        $empresa=Empresa::findOrFail($id);
        $empresa->definicion=$nombreEmpresa=$request->get('definicion');
        $empresa->cuit=$request->get('cuit');
        $empresa->domicilio_id=$direccion->id;
        //$empresa->provincia_id=$request->get('provincias_id');

        $resultado=$this->updateEmpresaWeb($id,$nombreEmpresa);
        //echo $resultado;
        $msj="La empresa no ha sido modificada porque ha ocurrido un error en el servidor web: ".$resultado;
        $accion="warning";
        if($resultado=="true"){
          $empresa->update();

          $msj='Empresa modificada correctamente de ambos servidores';
          $accion="success";
        }
        //die();
        return redirect()->route('empresa.index')->with('update', [
          'alert' => $accion,
          'message' => $msj,
        ]);

    }

    public function updateEmpresaWeb($idEmpresa,$nombreEmpresa){
      // URL del sistema en el servidor web (Sistema B) que recibirá los archivos
      
      $url = env('URL_SERVIDOR_WEB')."administrar_empresas.php?accion=updateEmpresa";

      // Agregar el nombre de la empresa al arreglo de archivos
      $datos = [
        [
          'name' => 'idEmpresa',
          'contents' => $idEmpresa,
        ],[
          'name' => 'nombreEmpresa',
          'contents' => $nombreEmpresa,
        ]
      ];

      //var_dump($datos);

      // Enviar la solicitud POST con los archivos y el nombre de la empresa
      try {
        // Crear una instancia del cliente GuzzleHTTP
        $client = new Client([ 'verify' => false ]);

        // Realizar la solicitud a la URL
        $response = $client->post($url, [
          RequestOptions::MULTIPART => $datos,
        ]);

        // Obtener la respuesta de la solicitud
        $body = $response->getBody();
        //var_dump($body);
        $resultado = $body->getContents();
        //var_dump($resultado);

      }  catch (ConnectException $e) {
        // Manejar el error de conexión
        $resultado='No se pudo establecer conexión con el servidor web. Verifica tu conexión a internet o la URL proporcionada.';
      } catch (RequestException $e) {
        if ($e->hasResponse()) {
          // Si se recibió una respuesta, obtener el código de estado HTTP
          $statusCode = $e->getResponse()->getStatusCode();
          
          // Manejar el código de estado y mostrar un mensaje de error apropiado
          if ($statusCode === 404) {
            // Manejar el error 404
            $resultado='Página no encontrada.';
          } else {
            // Manejar otros códigos de estado
            $resultado='Ocurrió un error con el código de estado: ' . $statusCode;
          }
        } else {
          // Manejar errores de conexión o resolución DNS
          $resultado='No se pudo resolver el host. Verifica tu conexión a internet.';
        }
      }
      //var_dump($resultado);
      
      //die();
      return $resultado;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        try { 
            $resultado=$this->eliminarEmpresaWeb($id);
            //echo $resultado;
            
            $msj="La empresa no ha sido eliminada porque ha ocurrido un error en el servidor web: ".$resultado;
            $accion="warning";
            if($resultado=="true"){
              Empresa::find($id)->delete();
              $msj='Empresa eliminada correctamente de ambos servidores';
              $accion="success";
            }
            //return redirect()->route('empresa.index')->with('delete', $msj);
        } catch(\Illuminate\Database\QueryException $ex){
          $accion="danger";
          $msj='La empresa no fue eliminado porque está siendo utilizado en otras tablas';
        }

        //die();
        return redirect()->route('empresa.index')->with('delete', [
          'alert' => $accion,
          'message' => $msj,
        ]);
    }

    public function eliminarEmpresaWeb($idEmpresa){
      // URL del sistema en el servidor web (Sistema B) que recibirá los archivos
      
      $url = env('URL_SERVIDOR_WEB')."administrar_empresas.php?accion=eliminarEmpresa";

      // Agregar el nombre de la empresa al arreglo de archivos
      $datos = [
        [
          'name' => 'idEmpresa',
          'contents' => $idEmpresa,
        ]
      ];

      //var_dump($datos);

      // Enviar la solicitud POST con los archivos y el nombre de la empresa
      try {
        // Crear una instancia del cliente GuzzleHTTP
        $client = new Client([ 'verify' => false ]);

        // Realizar la solicitud a la URL
        $response = $client->post($url, [
          RequestOptions::MULTIPART => $datos,
        ]);

        // Obtener la respuesta de la solicitud
        $body = $response->getBody();
        //var_dump($body);
        $resultado = $body->getContents();
        //var_dump($resultado);

      }  catch (ConnectException $e) {
        // Manejar el error de conexión
        $resultado='No se pudo establecer conexión con el servidor web. Verifica tu conexión a internet o la URL proporcionada.';
      } catch (RequestException $e) {
        if ($e->hasResponse()) {
          // Si se recibió una respuesta, obtener el código de estado HTTP
          $statusCode = $e->getResponse()->getStatusCode();
          
          // Manejar el código de estado y mostrar un mensaje de error apropiado
          if ($statusCode === 404) {
            // Manejar el error 404
            $resultado='Página no encontrada.';
          } else {
            // Manejar otros códigos de estado
            $resultado='Ocurrió un error con el código de estado: ' . $statusCode;
          }
        } else {
          // Manejar errores de conexión o resolución DNS
          $resultado='No se pudo resolver el host. Verifica tu conexión a internet.';
        }
      }
      //var_dump($resultado);
      
      //die();
      return $resultado;
    }

    /*public function eliminados()
    {
        $personalEliminados=Empresa::where('habilitado',false)->get();
        return view("personal.eliminados",compact('personalEliminados'));

    }*/

    public function reporte(Request $request){
      //$vouchers = Voucher::all(); //obteneme todas los vouchers

        //obtenemos todos los tipos de estudios
        //$empresas=Empresa::all();
        $empresas=Empresa::orderBy('definicion','asc')->get(); //que me obtenga directamente todos los grupos
        
        //dd($aEstudios);

        $desde=date("Y-m-d");
        if(isset($request->desde)){
          $desde=$request->desde;
        }
        $hasta=date("Y-m-d");
        if(isset($request->hasta)){
          $hasta=$request->hasta;
        }
        $empresa_id=0;

        $resultados=["Apto sin preexistencias","Apto con preexistencias","Inconveniente si ingreso en el momento actual"];
        $aResultados=[];
        foreach ($resultados as $resultado) {
          $aResultados[]=[
            "nombre"=>$resultado,
            "selected"=>"",
          ];
        }

        $datos=[];
        if(isset($request->empresa_id)){
          $empresa_id=$request->empresa_id;

          // Obtener el registro más reciente de la tabla aptituds para cada voucher
          $subquery = DB::table('aptituds')
          ->select('voucher_id', DB::raw('MAX(updated_at) AS max_updated_at'))
          ->groupBy('voucher_id');

          // Unir la subconsulta con las tablas aptituds, vouchers y pacientes
          $query = DB::table('aptituds')
          ->join('vouchers', 'aptituds.voucher_id', '=', 'vouchers.id')
          ->join('pacientes', 'vouchers.paciente_id', '=', 'pacientes.id')
          ->joinSub($subquery, 'latest_aptituds', function ($join) {
              $join->on('aptituds.voucher_id', '=', 'latest_aptituds.voucher_id')
                  ->on('aptituds.updated_at', '=', 'latest_aptituds.max_updated_at');
          })
          ->where('vouchers.turno', '>=', $desde)
          ->where('vouchers.turno', '<=', $hasta)
          ->where('vouchers.origen_id', $empresa_id)
          ->orderBy('latest_aptituds.max_updated_at', 'desc')
          ->select('aptituds.id', 'vouchers.turno', 'pacientes.apellidos', 'pacientes.nombres', 'aptituds.aptitud_laboral', 'pacientes.documento', 'pacientes.cuil', 'aptituds.preexistencias', 'aptituds.observaciones');

          $datos = $query->get();

        }

        //dd($aResultados);
        //dd($datos);
        //dd($aInformes);

        //$vouchers = Voucher::orderBy('id', 'desc')->get();
        return view('empresa.reporte',[
            //"vouchers"          => $vouchers,
            "desde"             => $desde,
            "hasta"             => $hasta,
            "empresa_id"        => $empresa_id,
            "empresas"          => $empresas,
            "aResultados"       => $aResultados,
            "datos"             => $datos
        ]);
    }
    
    public function pdf_reporte($empresa_id,$visitas){

        $empresa=Empresa::findOrFail($empresa_id);
        //dd($empresa_id);

        $query = DB::table('aptituds')
          ->join('vouchers', 'aptituds.voucher_id', '=', 'vouchers.id')
          ->join('pacientes', 'vouchers.paciente_id', '=', 'pacientes.id');
          //->where('carga', '=', 0);
        
        $query->whereIn('aptituds.id', explode(",",$visitas));
        $datos=$query->get();
        //dd($datos);

        $pdf = PDF::loadView('empresa.pdf_reporte',[
            "empresa"          => $empresa,
            "datos"             => $datos
        ]);
        //$pdf->setPaper('a4','letter');
        $pdf->setPaper('a4','landscape');
        return $pdf->stream('voucher_medico.pdf');
    }


    public function restaurar($id)
    {
        $personalRestaurar = Empresa::find($id);
        $personalRestaurar->update(['estado_id'=>1]);
        return redirect()->route('personal.index');

    }
}
