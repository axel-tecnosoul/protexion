<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use DB;
use App\Estado;
use App\Origen;
use App\Http\Controllers\EmpresaController;
use App\EstadoCivil;
use App\Sexo;
use App\ObraSocial;
use App\Domicilio;
use App\Ciudad;
use App\Pais;
use App\Provincia;
use App\Voucher;
use App\Http\Requests\PacienteRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PacientesImport;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*function __construct(){
         $this->middleware('permission:listar pacientes|crear paciente|editar paciente|eliminar paciente', ['only' => ['index','store']]);
         $this->middleware('permission:crear paciente', ['only' => ['create','store']]);
         $this->middleware('permission:editar paciente', ['only' => ['edit','update']]);
         $this->middleware('permission:eliminar paciente', ['only' => ['destroy']]);
    }*/

    public function encontrarDni(Request $request){
	      //$provincias=Provincia::select('nombre','id')->where('pais_id',$request->id)->get();
        $dniActual="";
        if(isset($request->dniActual)) $dniActual=$request->dniActual;

        $pacientes=Paciente::whereDocumento($request->dni)->whereEstado_id(1)->get(); //que me obtenga directamente todos los grupos
        $pacienteEncontrado=[];
        if(isset($pacientes[0])){
          $pacientes=$pacientes[0];
          $dni=($pacientes->documento == null) ? " " : $pacientes->documentoIdentidad();
          if($dni!=$dniActual){
            $pacienteEncontrado=[
              "id"=>$pacientes->id,
              "apellidoNombre"=>$pacientes->nombreCompleto(),
              //"apellidoNombre"=>$pacientes->apellidos." ".$pacientes.nombres,
              "documento"=>$dni,
              "sexo"=>($pacientes->sexo == null) ? " " : $pacientes->sexo->definicion,
              "domicilio"=>($pacientes->domicilio == null) ? " " : $pacientes->direccion(),
              "fecha_nacimiento"=>Carbon::parse($pacientes->fecha_nacimiento)->format('d/m/Y')." (".Carbon::parse($pacientes->fecha_nacimiento)->age." años)",
              "cuit"=>$pacientes->cuil,
              "estado_civil"=>($pacientes->estadoCivil == null) ? " " : $pacientes->estadoCivil->definicion,
              "estado"=>$pacientes->estado_id,
            ];
          }
        }
        return response()->json($pacienteEncontrado);
    }

    public function encontrarProvincia(Request $request){
	    $provincias=Provincia::select('nombre','id')
			->where('pais_id',$request->id)
            ->get();
        return response()->json($provincias);
    }

    public function encontrarCiudad(Request $request){
	    $ciudades=Ciudad::select('nombre','id')
			->where('provincia_id',$request->id)
            ->get();
        return response()->json($ciudades);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        $origenes=Origen::all(); //obteneme todas las categorias
        $obras_sociales=ObraSocial::all(); //obteneme todas las categorias
        $estados=Estado::all(); //obteneme todas las categorias

        if(count($request->all())>=1){ //si existe algun request(es decir, si uso el "Filtrar")
            //dd($request->all());
            $sql = Paciente::select('pacientes.*') //inicio la consulta sobre una determinada tabla
              ->leftjoin('vouchers', 'vouchers.paciente_id', '=', 'pacientes.id');

            if($request->origen_id){ //si el request proviene de la categoria del ticket
                $sql = $sql->whereOrigen_id($request->origen_id); //creo la consulta y almaceno en "sql"
            }
            if($request->obra_social_id){
                $sql = $sql->whereObra_social_id($request->obra_social_id); //creo la consulta y almaceno en "sql"
            }
            if($request->estado_id){
                $sql = $sql->whereEstado_id($request->estado_id); //creo la consulta y almaceno en "sql"
            }

            $pacientes=$sql->orderBy('created_at','desc')->get(); //ejecuto la consulta
            $origen_id=$request->origen_id; //mantengo el id de la categoria del tiquet
            $obra_social_id=$request->obra_social_id; //mantengo el id de la categoria del tiquet
            $estado_id=$request->estado_id; //mantengo el id de la categoria del tiquet


        }else{ //si nunca filtre, (si no existió request)
            $origen_id=null; //en el select2 que me aparesca " -- Todas las Categorias --"
            $obra_social_id=null; //en el select2 que me aparesca " -- Todas las Categorias --"
            $estado_id=null; //en el select2 que me aparesca " -- Todas las Categorias --"
            
            //$pacientes=Paciente::select("pacientes.*")->leftjoin('vouchers', 'vouchers.paciente_id', '=', 'pacientes.id')->whereEstado_id(1)->orderBy('created_at','desc')->get(); //que me obtenga directamente todos los grupos

            $pacientes = Paciente::with(['vouchers' => function ($query) {
                $query->latest('turno');
            }])->whereEstado_id(1)->orderBy('pacientes.created_at','desc')->get();
          
            $pacientes->map(function ($paciente) {
                //$ultima_visita = $paciente->vouchers->isEmpty() ? null : $paciente->vouchers->first()->turno;
                $ultima_visita = $paciente->vouchers->isEmpty() ? '01/01/1900' : $paciente->vouchers->first()->turno;
                if($ultima_visita){
                    $ultima_visita = new Carbon($ultima_visita);
                    //$ultima_visita = $ultima_visita->format('d-m-Y');
                }
                $paciente->ultima_visita = $ultima_visita;
                return $paciente;
            });

            //var_dump($pacientes);
        }

        /*var_dump($pacientes);
        die();*/

        return view('paciente.index',[
            "pacientes"         =>  $pacientes,         //los grupos de trabajo
            "origen_id"         =>  $origen_id, //si los id son identicos que me mantenga el valor
            "origenes"          =>  $origenes,  //las categorias asociadas al grupo de trabajo
            "obras_sociales"    =>  $obras_sociales,  //las categorias asociadas al grupo de trabajo
            "obra_social_id"    =>  $obra_social_id, //si los id son identicos que me mantenga el valor
            "estado_id"         =>  $estado_id, //si los id son identicos que me mantenga el valor
            "estados"           =>  $estados, //si los id son identicos que me mantenga el valor

            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //$origenes = Origen::all();
        $origenes = Origen::orderBy('definicion')->get();
        $estado_civiles=EstadoCivil::all();
        $sexos=Sexo::all();
        $obra_sociales=ObraSocial::all();
        $paises=Pais::all();
        $lugar_nacimiento=Ciudad::all();

        return view("paciente.create", [
            "origenes"          =>  $origenes,
            "estado_civiles"    =>  $estado_civiles,
            "sexos"             =>  $sexos,
            "obra_sociales"     =>  $obra_sociales,
            "paises"            =>  $paises,
            "lugar_nacimiento"  =>  $lugar_nacimiento,

            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $this->validate($request, [
            //'documento' => 'unique:pacientes,documento,except,id',
            'nombres'   => 'required',
            'apellidos' => 'required'
        ]);

        if($request->get('direccion')!=null) {
            $domicilio = new Domicilio;
            $domicilio->direccion = $request->get('direccion');
            $domicilio->ciudad_id = $request->get('ciudad_id');
            $domicilio->save();
        }

        //Creo los datos del personal de la clinica
        $paciente = new Paciente;
        $paciente->nombres=$request->get('nombres');
        $paciente->apellidos=$request->get('apellidos');
        if($request->get('documento')!=null){
            $paciente->documento=$request->get('documento');
        }
        if($request->get('fecha_nacimiento')!=null){
            $paciente->fecha_nacimiento=$request->get('fecha_nacimiento');
        }
        if($request->get('sexo_id')!=null){
            $paciente->sexo_id=$request->get('sexo_id');
        }
        if($request->get('obra_social_id')!=null){
            $paciente->obra_social_id=$request->get('obra_social_id');
        }
        if($request->get('peso')!=null){
            $paciente->peso=$request->get('peso');
        }
        if($request->get('cuil')!=null){
            $paciente->cuil=$request->get('cuil');
        }
        if($request->get('estatura')!=null){
            $paciente->estatura=$request->get('estatura');
        }
        if($request->get('telefono')!=null){
            $paciente->telefono=$request->get('telefono');
        }
        if($request->get('origen_id')!=null){
            $paciente->origen_id=$request->get('origen_id');
        }
        if($request->get('oficio')!=null){
            $paciente->oficio=$request->get('oficio');
        }
        if($request->get('estado_civil_id')!=null){
            $paciente->estado_civil_id=$request->get('estado_civil_id');
        }
        if($request->get('ciudad_id')!=null){
            $paciente->ciudad_id=$request->get('ciudad_id');
        }
        if($request->get('direccion')!=null) {
            $paciente->domicilio_id = $domicilio->id;
        }
        $paciente->estado_id=1; //Habilitado
        if($request->file('imagen')){

          $imagen = $request->file('imagen');
          $nombre_imagen = $imagen->getClientOriginalName();
          //$ruta_imagen = public_path('imagenes/paciente/' . $nombre_imagen);

          // Redimensionar la imagen
          $imagen_temp = Image::make($imagen->getRealPath())->resize(300, null, function ($constraint) {
              $constraint->aspectRatio();
          });

          $exif = exif_read_data($imagen->getPathname());

          //var_dump($exif);
          // Corregir la orientación de la imagen si es necesario
          if (!empty($exif['Orientation'])) {
            switch ($exif['Orientation']) {
              case 3:
                $imagen_temp->rotate(180);
                break;
              case 6:
                $imagen_temp->rotate(-90);
                break;
              case 8:
                $imagen_temp->rotate(90);
                break;
            }
          }
          //dd($image_resize);
          $path_foto_paciente='imagenes/paciente/';

          $imagen_temp->save(public_path($path_foto_paciente . $nombre_imagen));
          $paciente->imagen = $nombre_imagen;

          $thumbnailPath = public_path($path_foto_paciente.'thumbnails/'); // Ruta donde guardarás los thumbnails
          //$thumbnail = \Image::make($image)->fit(100, 100, function ($constraint) {
          $thumbnail = Image::make($imagen_temp)->fit(50, 50, function ($constraint) {
              $constraint->aspectRatio();
              $constraint->upsize();
          });
          $thumbnail->save($thumbnailPath . $imagen->getClientOriginalName());

        }
        $paciente->save();
        return redirect()->route('paciente.voucher', ['paciente' => $paciente->id]);
        //return redirect()->route('paciente.index');
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

    public function edit($id){

        $paciente=Paciente::findOrFail($id);
        $sexos=Sexo::all();
        //$origenes=Origen::all();
        $origenes = Origen::orderBy('definicion')->get();
        $estado_civiles=EstadoCivil::all();
        $obra_sociales=ObraSocial::all();
        $paises=Pais::all();
        $provincias=Provincia::all();
        $ciudades=Ciudad::all();

        return view("paciente.edit",compact('paises','provincias','ciudades','paciente','sexos','origenes','estado_civiles','obra_sociales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        /*$this->validate($request, [
            'documento' => 'unique:pacientes,documento,except,id',
            'nombres'   => 'required',
            'apellidos' => 'required'
        ]);*/

        $paciente=Paciente::findOrFail($id);
        $paciente->nombres=$request->get('nombres');
        $paciente->apellidos=$request->get('apellidos');
        $paciente->documento=$request->get('documento');
        $paciente->fecha_nacimiento=$request->get('fecha_nacimiento');
        $paciente->sexo_id=$request->get('sexo_id');
        $paciente->cuil=$request->get('cuil');
        $paciente->telefono=$request->get('telefono');
        $paciente->oficio=$request->get('oficio');
        $paciente->obra_social_id=$request->get('obra_social_id');
        $paciente->estado_civil_id=$request->get('estado_civil_id');
        $paciente->origen_id=$request->get('origen_id');
        $paciente->estado_id=1; //Habilitado

        if ($paciente->domicilio_id) {
            $domicilio=Domicilio::find($paciente->domicilio_id);
            $domicilio->direccion=$request->get('direccion');
            $domicilio->ciudad_id=$request->get('ciudad_id');
            $domicilio->update();
        }else{
            if($request->get('direccion')!=null) {
                $domicilio = new Domicilio;
                $domicilio->direccion = $request->get('direccion');
                $domicilio->ciudad_id = $request->get('ciudad_id');
                $domicilio->save();
            }
        }

        
        if($request->get('direccion')!=null) {
            $paciente->domicilio_id = $domicilio->id;
        }

        if($request->file('imagen')){

          $imagen = $request->file('imagen');
          $nombre_imagen = $imagen->getClientOriginalName();
          //$ruta_imagen = public_path('imagenes/paciente/' . $nombre_imagen);

          // Redimensionar la imagen
          $imagen_temp = Image::make($imagen->getRealPath())->resize(300, null, function ($constraint) {
              $constraint->aspectRatio();
          });

          $exif = exif_read_data($imagen->getPathname());
          //var_dump($exif);
          // Corregir la orientación de la imagen si es necesario
          if (!empty($exif['Orientation'])) {
            switch ($exif['Orientation']) {
              case 3:
                $imagen_temp->rotate(180);
                break;
              case 6:
                $imagen_temp->rotate(-90);
                break;
              case 8:
                $imagen_temp->rotate(90);
                break;
            }
          }
          //dd($image_resize);

          $path_foto_paciente='imagenes/paciente/';

          $imagen_temp->save(public_path($path_foto_paciente . $nombre_imagen));
          $paciente->imagen = $nombre_imagen;

          $thumbnailPath = public_path($path_foto_paciente.'thumbnails/'); // Ruta donde guardarás los thumbnails
          //$thumbnail = \Image::make($image)->fit(100, 100, function ($constraint) {
          $thumbnail = Image::make($imagen_temp)->fit(50, 50, function ($constraint) {
              $constraint->aspectRatio();
              $constraint->upsize();
          });
          $thumbnail->save($thumbnailPath . $imagen->getClientOriginalName());

        }
        
        $paciente->update();

        return redirect()->route('paciente.voucher', ['paciente' => $paciente->id]);
        //return redirect()->route('paciente.index')->withMessage("El paciente " .  $paciente->nombreCompleto() .  " ha sido actualizado con éxito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //El metodo delete() cambia el estado del paciente cuando se da al boton de dar de baja
    public function delete($id){
        $paciente=Paciente::find($id);
        $nombre=$paciente->nombreCompleto();
        $paciente->update(['estado_id'=>2]);
        return redirect()->route('paciente.index')->withMessage("El paciente $nombre ha sido dado de baja correctamente");

    }

    /*public function eliminados(){
        $pacientesEliminados=Paciente::where('habilitado',false)->get();
        return view("paciente.eliminados",compact('pacientesEliminados'));

    }*/

    public function restaurar($id){
        $pacienteRestaurar = Paciente::find($id);
        $pacienteRestaurar->update(['estado_id'=>1]);
        return redirect()->route('paciente.index');

    }

    public function voucher($id){
        $paciente = Paciente::find($id);
        $vouchers = Voucher::whereAnulado(0)->wherePaciente_id($id)->orderBy('turno','desc')->get();;
        $sql = Paciente::select('pacientes.*') //inicio la consulta sobre una determinada tabla
          ->whereEstado_id(1); //creo la consulta y almaceno en "sql"
        $pacientes=$sql->get();
        return view("paciente.vouchers", compact('vouchers','paciente','pacientes'));
    }

    public function destroy_voucher($id,$paciente)
    {
        $voucher=Voucher::findOrFail($id);
        $voucher->anulado=1;
        //$voucher->paciente_id = $request->paciente_id;
        $voucher->update();

        return redirect()->route('paciente.voucher',[$paciente]);
    }

    public function importExcelOriginal(Request $request){
        $file = $request->file('file');
        Excel::import(new PacientesImport, $file);

        return back()->with('message','Pacientes importados');
    }

    public function importExcel(Request $request){
      $file = $request->file('file');
      $array = Excel::toArray(new PacientesImport, $file);
      //$array = Excel::toArray($file);
      $filas=$array[0];
      //var_dump($filas);
      $filaEmpresa=$filas[3];
      $cuit=$filaEmpresa[1];
      
      $origen = new Origen;
      $origen->definicion = $filaEmpresa[0];
      $origen->cuit = $cuit;
      //$origen->domicilio_id = $request->get('domicilio_id');

      $cuit=str_replace("-","",$cuit);
      $ori=DB::select('SELECT id FROM origenes WHERE REPLACE(cuit,"-","")="'.$cuit.'"');
      if(!$ori){
        $origen->save();
        $id_origen=$origen->id;

        $empresa = new EmpresaController();

        $idEmpresa=$id_origen;
        $nombreEmpresa=$filaEmpresa[0];
        $resultado=$empresa->subirEmpresaWeb($idEmpresa,$nombreEmpresa);

      }else{
        $id_origen=$ori[0]->id;
      }

      $cant_filas=count($filas);

      $aIdPacientes=[];
      for($i=8;$i<$cant_filas;$i++){
          $fila=$filas[$i];
          //var_dump($fila);

          /*$domicilio_actual=$fila[9];
          $localidad=$fila[10];
          $ciudad_id=NULL;

          if($localidad){
            //si viene una localidad la buscamos
            //$resultados = Ciudad::where('nombre', 'like', '%' . $localidad . '%')->get();
            $resultados = Ciudad::where('nombre', 'like', '%' . $localidad . '%')->first();
            if($resultados and $resultados->id){
              //si existe tomamos su id
              $ciudad_id=$resultados->id;
            }else{
              //si no existe la creamos
              $ciudad = new Ciudad;
              $ciudad->nombre = $localidad;
              $ciudad->save();

              $ciudad_id=$ciudad->id;
            }
          }

          $domicilio_id=NULL;
          if($domicilio_actual) {
            //si viene un domicilio lo buscamos relacionado a la ciudad
            $resultados = Domicilio::where('ciudad_id', $ciudad_id)
                                    ->where('direccion', 'like', '%' . $domicilio_actual . '%')
                                    ->first();

            if($resultados and $resultados->id){
              //si existe tomamos su id
              $domicilio_id=$resultados->id;
            }else{
              //si no existe la creamos
              $domicilio = new Domicilio;
              $domicilio->direccion = $domicilio_actual;
              $domicilio->ciudad_id = $ciudad_id;
              $domicilio->save();

              $domicilio_id=$domicilio->id;
            }
          }*/

          //dd($domicilio_actual,$localidad,$ciudad_id,$domicilio);

          //Creo los datos del personal de la clinica
          $paciente = new Paciente;
          $paciente->apellidos=$fila[0];
          $paciente->nombres=$fila[1];
          $documento=$fila[7];

          /*if($domicilio_id){
            $paciente->domicilio_id=$domicilio_id;
          }*/

          if(!is_null($documento)){
            $paciente->documento=$documento;
          }
          $paciente->origen_id=$id_origen;
          $paciente->estado_id=1; //Habilitado

          if($documento==""){
            $paciente->save();
            $aIdPacientes[]=$paciente->id;
          }else{
            $documento=str_replace(".","",$documento);
            $pac=DB::select('SELECT id FROM pacientes WHERE estado_id=1 AND REPLACE(documento,".","")="'.$documento.'"');
            //var_dump($pac);
            if(!$pac){
              $paciente->save();
              $aIdPacientes[]=$paciente->id;
            }else{
              $aIdPacientes[]=$pac[0]->id;
            }
          }
          //dd($paciente);
          //
      }

      //dd($aIdPacientes);
      //window.location.href="voucher/create/"+encodeURIComponent(aIdPacientes.join(","))
      return redirect()->route('voucher.create',implode(",",$aIdPacientes));
      //return back()->with('message','Pacientes importados');//opcion vieja
    }

    public function generarThumbnail(){

      $path_foto_paciente='imagenes/paciente/';

      $rutaImagenes = public_path($path_foto_paciente); // Ruta de la carpeta que contiene las imágenes originales
      $rutaThumbnails = public_path($path_foto_paciente.'thumbnails/'); // Ruta donde guardarás los thumbnails
      
      $imagenes = File::allFiles($rutaImagenes); // Obtiene todas las imágenes de la carpeta
      
      foreach ($imagenes as $imagen) {
          $nombreImagen = $imagen->getFilename();
          $rutaImagen = $rutaImagenes . $nombreImagen;
          
          $thumbnail = Image::make($rutaImagen)->fit(50, 50, function ($constraint) {
              $constraint->aspectRatio();
              $constraint->upsize();
          });
          
          $thumbnail->save($rutaThumbnails . $nombreImagen);
      }

      //$imagen_temp->save(public_path($path_foto_paciente . $nombre_imagen));
      //$paciente->imagen = $nombre_imagen;

      //$thumbnailPath = public_path($path_foto_paciente.'thumbnails/'); // Ruta donde guardarás los thumbnails
      //$thumbnail = \Image::make($image)->fit(100, 100, function ($constraint) {
      /*$thumbnail = Image::make($imagen_temp)->fit(50, 50, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();
      });
      $thumbnail->save($thumbnailPath . $imagen->getClientOriginalName());*/

    }

}
