<?php

namespace App\Http\Controllers;

use App\ArchivoAdjunto;
use App\Models\VoucherEstudio;
use App\Voucher;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;

class VoucherEstudioController extends Controller
{

    //const URL_SERVIDOR_WEB = 'https://protexionpr.com.ar/client_access/models/';
    //const URL_SERVIDOR_WEB = 'http://localhost/protexion/client_access/models/';

    public function archivo(Request $request)
    {   
      $archivos = $request->file('anexo');
      //Controla si hay un archivo en el request
      $voucher_id=$request->voucher_id;

      $voucher=Voucher::findOrFail($voucher_id);
      //$empresa=$voucher->origen->definicion;
      $id_empresa=$voucher->origen_id;
      $paciente=$voucher->paciente->nombreCompleto();
      $turno=$voucher->turno;

      if ($archivos) {
        $aArchivosSubir=[];
        foreach ($archivos as $item) {
          if ($item) {
            /*$nombre = $request->estudio
              ."_"
              .$request->voucher_estudio_id
              .$item->getClientOriginalName();*/
              //dd($item);
            $nombre = $item->getClientOriginalName();
            $extension = $item->getClientOriginalExtension();
            
            $ruta = public_path().'/archivo/'.$voucher_id."/".$request->estudio."/";
            //dd($nombre,$ruta);
            $item->move($ruta,$nombre);
            $ruta.=$nombre;
            
            $archivo_adjunto = new ArchivoAdjunto();
            $archivo_adjunto->anexo = $ruta;
            $archivo_adjunto->voucher_estudio_id = $request->voucher_estudio_id;
            $archivo_adjunto->save();
            
            $id_archivo=$archivo_adjunto->id;

            "Juan Recalde 2023-07-22 RX.jpg";
            "Juan Recalde 2023-07-22 General.pdf";

            $nombre="RX";
            //if($request->estudio=="GENERAL" and count($aArchivosSubir)>=1){
            if($request->estudio=="GENERAL"){
              $nombre="RESULTADOS";
            }

            $nuevo_nombre=$paciente." ".$turno." ".$nombre.".".$extension;
            //var_dump($nuevo_nombre);

            $aArchivosSubir[]=[
              "ruta"=>$ruta,
              "nuevo_nombre"=>$nuevo_nombre,
              "id_archivo"=>$id_archivo,
            ];
          }
        }
      }
      $msj="El archivo se ha cargado correctamente pero no pudo ser envíado al acceso para clientes";
      $accion="upload-file-fail";

      //die();

      $datosExtra=[
        "id_empresa"=>$id_empresa,
        "paciente"=>$paciente,
        "turno"=>$turno
      ];

      //dd($datosExtra);

      $resultado=$this->sendFileLaravel($aArchivosSubir,json_encode($datosExtra));

      //echo $resultado;
      //die();
      if($resultado==1){
        $accion="upload-file-success";
        $msj="El archivo se ha cargado correctamente y fue envíado correctamente al servidor para clientes";
      }else{
        $msj.=". Error: ".$resultado;
      }

      //return back();
      //return redirect()->route('voucher.show',[$voucher_id])->withMessage($msj);
      return redirect()->route('voucher.show',[$voucher_id])->with($accion,$msj);
    }
    public function archivo2(Request $request)
    {   
        $archivos = $request->file('anexo');
        //Controla si hay un archivo en el request
        if ($archivos) {
            foreach ($archivos as $item) {
                if ($item) {
                        $nombre = $request->estudio
                                ."_"
                                .$request->voucher_estudio_id
                                .$item->getClientOriginalName();
                        
                        $item->move(public_path().'/archivo/',$nombre);
                        $ruta = public_path().'/archivo/'.$nombre;
                        $archivo_adjunto = new ArchivoAdjunto();
                        $archivo_adjunto->anexo = $ruta;
                        $archivo_adjunto->voucher_estudio_id = $request->voucher_estudio_id;
                        $archivo_adjunto->save();
                }
            }
        }
        return back();
    }

    private function sendFileLaravel($aArchivos,$datosExtra){

      //$url = self::URL_SERVIDOR_WEB."administrar_empresas.php?accion=recibirArchivo";
      $url = env('URL_SERVIDOR_WEB')."administrar_empresas.php?accion=recibirArchivo";

      $archivos = [];
      foreach ($aArchivos as $archivo) {
        $archivos[] = [
          'name' => 'file[]',
          'contents' => fopen($archivo["ruta"], 'r'),
        ];
        $archivos[] = [
          'name' => 'id_archivo[]',
          'contents' => $archivo["id_archivo"],
        ];
        $archivos[] = [
          'name' => 'nuevo_nombre[]',
          'contents' => $archivo["nuevo_nombre"],
        ];
      }

      // Agregar el nombre de la empresa al arreglo de archivos
      $archivos[] = [
        'name' => 'datosExtra',
        'contents' => $datosExtra,
      ];

      // Enviar la solicitud POST con los archivos y el nombre de la empresa
      try {
        // Crear una instancia del cliente GuzzleHTTP
        $client = new Client([ 'verify' => false ]);

        // Realizar la solicitud a la URL
        $response = $client->post($url, [
          RequestOptions::MULTIPART => $archivos,
        ]);

        // Obtener la respuesta de la solicitud
        $body = $response->getBody();

        $resultado = $body->getContents();
        //dd($url,$body,$resultado);

      }  catch (ConnectException $e) {
        // Manejar el error de conexión
        $resultado='No se pudo establecer conexión con el servidor web. Verifica tu conexión a internet o la URL proporcionada.';
      } catch (RequestException $e) {
        //dd($e);
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
      
      //die();
      return $resultado;

    }

    private function sendFilePHP($archivo,$empresa){
      // Ruta del archivo que deseas enviar
      //$archivo = '/ruta/al/archivo.pdf';

      // URL del sistema en el servidor web (Sistema B) que recibirá el archivo
      $url = 'http://servidor-web.com/sistema_b.php';

      // Crear un objeto de archivo
      $archivo_enviar = new CURLFile($archivo);

      // Datos adicionales que deseas enviar junto con el archivo (opcional)
      /*$datos = array(
          'campo1' => 'valor1',
          'campo2' => 'valor2',
      );*/

      // Campos de la solicitud POST que incluyen el archivo y los datos adicionales
      $campos = array(
          'archivo' => $archivo_enviar,
          //'datos' => $datos,
          'empresa' => $empresa,
      );

      // Inicializar la solicitud POST
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $campos);

      // Ejecutar la solicitud y obtener la respuesta
      $response = curl_exec($ch);

      // Verificar si hubo errores en la solicitud
      if ($response === false) {
          echo 'Error en la solicitud: ' . curl_error($ch);
      }

      // Cerrar la conexión
      curl_close($ch);

    }

    //Descarga archivos pasando el Id de voucherEstudios (Se usa para estudios de sistema)
    public function show($id)
    {   
        $voucher_estudio = VoucherEstudio::find($id);
        $archivo_adjunto = $voucher_estudio->archivo_adjunto[0];

        $img = $archivo_adjunto->anexo;
        //header('Content-Description: File Transfer');
        //header('Content-Type: application/octet-stream');
        header('Content-Type: application/pdf');
        //header('Content-Disposition: attachment; filename='.basename($img));
        header('Content-Disposition: inline; filename='.basename($img));
        //header('Content-Transfer-Encoding: binary');
        //header('Expires: 0');
        //header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        //header('Pragma: public');
        header('Content-Length: ' . filesize($img));
        ob_clean();
        flush();
        readfile($img);
    }

    //Descarga archivos pasando el Id del archivo a descargar (Se usa para estudios cargados)
    public function descargar($id)
    {   
        $archivo_adjunto = ArchivoAdjunto::find($id);

        $img = $archivo_adjunto->anexo;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($img));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($img));
        ob_clean();
        flush();
        readfile($img);
    }

    public function delete($id){

      $archivo=ArchivoAdjunto::findOrFail($id);
      $ruta=$archivo->anexo;
      $voucherEstudio=VoucherEstudio::findOrFail($archivo->voucher_estudio_id);
      $voucher_id=$voucherEstudio->voucher_id;

      try {

        $resultado=$this->eliminarArchivoWeb($id);
        /*echo $resultado;
        die();*/
        
        $msj="El archivo no ha sido eliminada porque ha ocurrido un error en el servidor web: ".$resultado;
        $accion="warning";
        if($resultado==""){

          //dd($archivo,$voucherEstudio,$voucher_id,$ruta);

          unset($ruta);

          $archivo->delete();

          $msj='Archivo eliminado correctamente de ambos servidores';
          $accion="success";
        }
        //return redirect()->route('empresa.index')->with('delete', $msj);
      } catch(\Illuminate\Database\QueryException $ex){
        $accion="danger";
        $msj='El archivo no fue eliminado porque está siendo utilizado en otras tablas';
      }

      //die();
      return redirect()->route('voucher.show',$voucher_id)->with('delete-archivo', [
        'alert' => $accion,
        'message' => $msj,
      ]);

      return redirect()->route('voucher.show',$voucher_id);
    }

    public function eliminarArchivoWeb($idArchivo){
      // URL del sistema en el servidor web (Sistema B) que recibirá los archivos
      
      //$url = self::URL_SERVIDOR_WEB."administrar_empresas.php?accion=eliminarArchivoDesdeLocal";
      $url = env('URL_SERVIDOR_WEB')."administrar_empresas.php?accion=eliminarArchivoDesdeLocal";

      // Agregar el nombre de la empresa al arreglo de archivos
      $datos = [
        [
          'name' => 'idArchivo',
          'contents' => $idArchivo,
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
}
