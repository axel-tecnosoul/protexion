<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//@set_magic_quotes_runtime(false);
ini_set('magic_quotes_runtime', 0);
ini_set('max_execution_time', 0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
extract($_REQUEST);
require_once('conexion.php');
class Empresas{

  public function __construct(){
    $this->conexion = new Conexion();
      date_default_timezone_set("America/Buenos_Aires");
  }

  public function traerDatosIniciales(){

        
    /*TIPO DE ITEM*/
    $queryProvincias = "SELECT id as id_provincia, provincia 
                FROM provincias";
    $getProvincias = $this->conexion->consultaRetorno($queryProvincias);


    $datosIniciales = array();
    
    $arrayProvincias = array();


    /*CARGO ARRAY ALMACENES*/
    while ($rowsProv= $getProvincias->fetch_array()) {
      $id_provincia = $rowsProv['id_provincia'];
      $provincia = $rowsProv['provincia'];
      $arrayProvincias[] = array('id_provincia' => $id_provincia, 'provincia' =>$provincia);
    }

    $datosIniciales["provincias"] = $arrayProvincias;
    echo json_encode($datosIniciales);
  }

  public function traerEmpresas(){

    //$queryTraerEmpresas = "SELECT u.id, u.usuario, u.clave, u.activo, u.tipo FROM usuarios u WHERE id != 1";
    $queryTraerEmpresas = "SELECT u.id, u.usuario, u.clave, u.activo, u.tipo, COUNT(au.id) AS cant_archivos FROM usuarios u LEFT JOIN archivos_usuario au ON au.id_usuario=u.id WHERE u.id != 1 GROUP BY u.id";
    $getEmpresas = $this->conexion->consultaRetorno($queryTraerEmpresas);

    $arrayEmpresas = array();
    while ($rowEmpresas = $getEmpresas->fetch_array()) {
      $arrayEmpresas[] = array(
        'id_usuario'=>$rowEmpresas['id'],
        'usuario'=>$rowEmpresas['usuario'],
        'clave'=>$rowEmpresas['clave'],
        'activo'=>$rowEmpresas['activo'],
        'tipo'=>$rowEmpresas['tipo'],
        'cant_archivos'=>$rowEmpresas['cant_archivos'],
      );
    }

    //echo json_encode($arrayEmpresas);
    return $arrayEmpresas;

  }

  public function generarPasswordRandom(){
    $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); 
    $combLen = strlen($comb) - 1; 
    for ($i = 0; $i < 12; $i++) {
        $n = rand(0, $combLen);
        $pass[] = $comb[$n];
    }
    return (implode($pass));
  }

  public function importarEmpresas($file){

    //var_dump($file);
    $archivo=$file["file"]['name'];
    //var_dump($archivo);

    $destino=$archivo;
    copy($file['file']['tmp_name'],$destino);
    
    $dirPHPExcel="../assets/";
    include_once($dirPHPExcel."PHPExcel/IOFactory.php");
    $objPHPExcel = PHPExcel_IOFactory::load($archivo);
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    
    $ar=explode('.',$archivo);
    $file=$ar[0].".xlsx";
    $objWriter->save($file);
    
    //if (file_exists ("bak_".$file)){
    if (file_exists ($file)){//validacion para saber si el archivo ya existe previamente
      /*INVOCACION DE CLASES Y CONEXION A BASE DE DATOS*/
      /** Invocacion de Clases necesarias */
      require_once($dirPHPExcel.'PHPExcel.php');
      require_once($dirPHPExcel.'PHPExcel/Reader/Excel2007.php');
      //DATOS DE CONEXION A LA BASE DE DATOS
      //include 'conexion.php';
      //$pdo = Database::connect();
          
      // Cargando la hoja de calculo
      $objReader=new PHPExcel_Reader_Excel2007();//instancio un objeto como PHPExcelReader(objeto de captura de datos de excel)
      //$objPHPExcel=$objReader->load("bak_".$file);//carga en objphpExcel por medio de objReader,el nombre del archivo
      $objPHPExcel=$objReader->load($file);//carga en objphpExcel por medio de objReader,el nombre del archivo
      $objFecha=new PHPExcel_Shared_Date();// Asignar hoja de excel activa
      $objPHPExcel->setActiveSheetIndex(0);//objPHPExcel tomara la posicion de hoja (en esta caso 0 o 1) con el setActiveSheetIndex(numeroHoja)
      // Llenamos un arreglo con los datos del archivo xlsx
      $i=3; //celda inicial en la cual empezara a realizar el barrido de la grilla de excel
      $param=0;
      $contador=0;
      $filas=$objPHPExcel->getActiveSheet()->getHighestRow()-1;
      while($param==0){//mientras el parametro siga en 0, no ha encontrado un NULL, entonces sige metiendo datos
        if($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()==NULL){//pregunta si ha encontrado un valor null en la columna
          $param=1;//Si ha encontrado un valor en NULL pone $param en 1 y finaliza eh while
        }else{
          //$id_usuario=$objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
          $usuario=$objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();

          //$id_usuario=str_replace("'"," ",$id_usuario);
          $usuario=str_replace("'"," ",$usuario);

          $query = "SELECT id FROM usuarios WHERE usuario = '$usuario'";
					$result = $this->conexion->consultaRetorno($query);

					if($result->num_rows == 0){
            
            $insert=$this->insertarEmpresa($usuario);
            
					}

        }
        $i++;
        $contador++;
      }
      unlink($archivo);
    }
  }

  public function insertarEmpresa($usuario,$idEmpresa=NULL){
    $clave=$this->generarPasswordRandom();
    if($idEmpresa){
      $queryInsert = "INSERT INTO usuarios (usuario,id_empresa,clave,tipo) VALUES ('$usuario',$idEmpresa,'$clave',2)";
    }else{
      $queryInsert = "INSERT INTO usuarios (usuario,clave,tipo) VALUES ('$usuario','$clave',2)";
    }
    $insertNewAdjunto = $this->conexion->consultaSimple($queryInsert);
    //var_dump($insertNewAdjunto);
    
    $mensajeError=$this->conexion->conectar->error;
    echo $mensajeError;
    if($mensajeError!=""){
      echo "<br><br>".$queryInsert;
    }
  }

  public function eliminarEmpresa($idEmpresa){

    //$idEmpresa=68;
    //var_dump($idEmpresa);
    
    $queryTraerEmpresa = "SELECT id FROM usuarios WHERE id_empresa = $idEmpresa";
    $getEmpresa = $this->conexion->consultaRetorno($queryTraerEmpresa);
    $rowEmpresa = $getEmpresa->fetch_array();
    //var_dump($rowEmpresa);
    $mensaje="true";
    if($rowEmpresa){
      $idEmpresa=$rowEmpresa["id"];
      //var_dump($idEmpresa);

      $archivos=$this->trerArchivosEmpresa($idEmpresa);
      $archivos=json_decode($archivos,true);

      $email=$this->trerEmailEmpresa($idEmpresa);
      $email=json_decode($email,true);

      
      if(count($archivos)==0 and count($email)==0){
        $queryDelAdjuntos = "DELETE FROM usuarios WHERE id = $idEmpresa";
        $delAdjuntos = $this->conexion->consultaSimple($queryDelAdjuntos);
        
        $mensajeError=$this->conexion->conectar->error;
        //echo $mensajeError;
        if($mensajeError!=""){
          $mensaje=$mensajeError."<br><br>".$queryInsert;
        }
      }else{
        $mensaje="La empresa no se puede eliminar porque tiene archivos o emails cargados";
      }
    }
    
    //var_dump($mensaje);
    
    return $mensaje;
  }

  public function updateEmpresa($idEmpresa,$nombreEmpresa){
    
    $queryInsert = "UPDATE usuarios SET usuario = '$nombreEmpresa' WHERE id_empresa = $idEmpresa";
    $insertNewAdjunto = $this->conexion->consultaSimple($queryInsert);
    //var_dump($insertNewAdjunto);
    $mensaje="true";

    $mensajeError=$this->conexion->conectar->error;
    if($mensajeError!=""){
      $mensaje=$mensajeError."<br><br>".$queryInsert;
    }
    return $mensaje;
  }

  public function sincronizarEmpresa($idEmpresa,$nombreEmpresa){
    $queryTraerEmpresa = "SELECT * FROM usuarios WHERE usuario='$nombreEmpresa' and id_empresa='$idEmpresa'";
    $getEmpresas = $this->conexion->consultaRetorno($queryTraerEmpresa);
    $row = $getEmpresas->fetch_array();
    $afe = $getEmpresas->num_rows;
    if($afe==0){
      /*echo "<hr>".$queryTraerEmpresa."<br>";
      var_dump($row);*/

      $queryTraerEmpresa = "SELECT id FROM usuarios WHERE usuario='$nombreEmpresa'";
      $getEmpresas = $this->conexion->consultaRetorno($queryTraerEmpresa);
      $row = $getEmpresas->fetch_array();
      $afe = $getEmpresas->num_rows;
      if($afe==1){
        $queryInsert = "UPDATE usuarios SET id_empresa = $idEmpresa WHERE usuario='$nombreEmpresa'";
      }else{
        $clave=$this->generarPasswordRandom();
        $queryInsert = "INSERT INTO usuarios (id_empresa,usuario,clave,tipo) VALUES ($idEmpresa,'$nombreEmpresa','$clave',2)";
      }

      //echo "<hr>".$queryInsert."<br>";
      $insertNewAdjunto = $this->conexion->consultaSimple($queryInsert);
      //var_dump($insertNewAdjunto);
      
      $mensajeError=$this->conexion->conectar->error;
      echo $mensajeError;
      if($mensajeError!=""){
        echo "<br><br>".$queryInsert;
      }
    }
  }

  public function trerArchivosEmpresa($id_empresa){

    $queryTraerEmpresas = "SELECT id,archivo,fecha_hora_subida,fecha_hora_bajada FROM archivos_usuario WHERE id_usuario = $id_empresa";
    $getEmpresas = $this->conexion->consultaRetorno($queryTraerEmpresas);

    $arrayArchivos = array();
    while ($row = $getEmpresas->fetch_array()) {
      $arrayArchivos[] = array(
        'id_archivo_usuario'=>$row['id'],
        'archivo'=>$row['archivo'],
        /*'fecha_hora_subida'=>date("d M Y H:i:s",strtotime($row['fecha_hora_subida'])),
        'fecha_hora_bajada'=>($row['fecha_hora_bajada']) ? date("d M Y H:i:s",strtotime($row['fecha_hora_bajada'])) : "",*/
        'fecha_hora_subida'=>$row['fecha_hora_subida'],
        'fecha_hora_bajada'=>($row['fecha_hora_bajada']) ? $row['fecha_hora_bajada'] : "",
      );
    }

    return json_encode($arrayArchivos);

  }

  public function subirMultiplesArchivos($id_empresa,$adjuntos,$cantAdjuntos){

    /*var_dump($adjuntos);
    var_dump($cantAdjuntos);*/
    //SI VIENEN ADJUNTOS LOS GUARDO.
    if ($adjuntos > 0) {
      $totalSubidas=0;
      for ($i=0; $i < $cantAdjuntos; $i++) { 
        $indice = "file".$i;
        $nombreADJ = $_FILES[$indice]['name'];
        
        $subidaOK=false;
        if (is_uploaded_file($_FILES[$indice]['tmp_name'])) {
          //INGRESO ARCHIVOS EN EL DIRECTORIO
          $directorio = "../views/archivos_empresas/$id_empresa/";
          //$path = "sample/path/newfolder";
          if (!file_exists($directorio)) {
              mkdir($directorio, 0777, true);
          }
          /*var_dump($_FILES);
          echo "<hr>";
          var_dump($_FILES[$indice]['tmp_name']);
          echo "<hr>";
          var_dump($directorio.$nombreADJ);
          echo "<hr>";*/

          $subidaOK=move_uploaded_file($_FILES[$indice]['tmp_name'], $directorio.$nombreADJ);
          //$ruta_completa_imagen = $directorio.$nombreFinalArchivo;

          //var_dump($subidaOK);
          
          if($subidaOK){
            //INSERTO DATOS EN LA TABLA ADJUNTOS ORDEN_COMPRA
            $queryInsertAdjuntos = "INSERT INTO archivos_usuario (id_usuario, archivo)VALUES($id_empresa, '$nombreADJ')";
            $insertAdjuntos = $this->conexion->consultaSimple($queryInsertAdjuntos);

            $mensajeError=$this->conexion->conectar->error;
            echo $mensajeError;
            if($mensajeError!=""){
              echo "<br><br>".$queryInsertAdjuntos;
            }else{
              $totalSubidas++;
            }
          }else{
            if($_FILES[$indice]['error']){
              return "Ha ocurrido un error: Cod. ".$_FILES[$indice]['error'];
            }
          }
        }
      }
      if($totalSubidas==$cantAdjuntos){
        return 1;
      }else{
        return 0;
      }
    }

  }

  public function subirArchivo($id_empresa,$adjuntos,$cantAdjuntos){
    $ok=$ok2=0;
    //SI VIENEN ADJUNTOS LOS GUARDO.
    if ($adjuntos > 0) {
      //$indice = "file".$i;
      
      foreach ($_FILES["file"]['name'] as $key => $value) {
        $ok2++;
      
        $nombreADJ = $_FILES["file"]['name'][$key];
        if(isset($_POST["nuevo_nombre"][$key]) and $_POST["nuevo_nombre"][$key]!=""){
          $nombreADJ = $_POST["nuevo_nombre"][$key];
        }
        
        $subidaOK=false;
        if (is_uploaded_file($_FILES["file"]['tmp_name'][$key])) {
          //INGRESO ARCHIVOS EN EL DIRECTORIO
          $directorio = "../views/archivos_empresas/$id_empresa/";
          //$path = "sample/path/newfolder";
          if (!file_exists($directorio)) {
              mkdir($directorio, 0777, true);
          }

          $subidaOK=move_uploaded_file($_FILES["file"]['tmp_name'][$key], $directorio.$nombreADJ);
          //$ruta_completa_imagen = $directorio.$nombreFinalArchivo;
          //var_dump($subidaOK);
          
          if($subidaOK){

            $campoOpcional="";
            $valorOpcional="";
            if(isset($_POST["id_archivo"][$key])){
              //var_dump($_POST["id_archivo"][$key]);
              $campoOpcional=", id_archivo_local";
              $valorOpcional=", ".$_POST["id_archivo"][$key];
            }

            //INSERTO DATOS EN LA TABLA ADJUNTOS ORDEN_COMPRA
            $queryInsertAdjuntos = "INSERT INTO archivos_usuario (id_usuario, archivo $campoOpcional) VALUES ($id_empresa, '$nombreADJ' $valorOpcional)";
            $insertAdjuntos = $this->conexion->consultaSimple($queryInsertAdjuntos);

            //var_dump($queryInsertAdjuntos);

            $mensajeError=$this->conexion->conectar->error;
            echo $mensajeError;
            if($mensajeError!=""){
              echo "<br><br>".$queryInsertAdjuntos;
            }else{
              //$totalSubidas++;
              $ok++;
            }
          }else{
            if($_FILES["file"]['error'][$key]){
              return "Ha ocurrido un error: Cod. ".$_FILES["file"]['error'][$key];
            }
          }
        }
      }

      if($ok==$ok2){
        return 1;
      }else{
        return 0;
      }
    }

  }

  public function eliminarArchivo($id_archivo, $nombre_adjunto, $id_empresa){

    $directorio = "../views/archivos_empresas/$id_empresa/";
    $archivo=$directorio.$nombre_adjunto;

    if(file_exists($archivo)){
      $deletedOK=unlink($archivo);
      if($deletedOK){
        $queryDelAdjuntos = "DELETE FROM archivos_usuario WHERE id = $id_archivo";
        $delAdjuntos = $this->conexion->consultaSimple($queryDelAdjuntos);
      }
      return $deletedOK;
    }else{
      $queryDelAdjuntos = "DELETE FROM archivos_usuario WHERE id = $id_archivo";
      $delAdjuntos = $this->conexion->consultaSimple($queryDelAdjuntos);
    }

  }

  public function eliminarArchivosSeleccionados($archivos){

    $queryTraerEmpresas = "SELECT id,archivo,id_usuario FROM archivos_usuario WHERE id IN ($archivos)";
    $getEmpresas = $this->conexion->consultaRetorno($queryTraerEmpresas);

    while ($row = $getEmpresas->fetch_array()) {
      //var_dump($row);
      $id_archivo=$row["id"];
      $nombre_adjunto=$row["archivo"];
      $id_empresa=$row["id_usuario"];
      $delAdjuntos = $this->eliminarArchivo($id_archivo, $nombre_adjunto, $id_empresa);
    }

  }

  public function eliminarArchivoLocal($idArchivo){

    $query = "SELECT id,id_usuario,archivo FROM archivos_usuario WHERE id_archivo_local = $idArchivo";
    $get = $this->conexion->consultaRetorno($query);
    $row = $get->fetch_array();
    if($row){
      $id_archivo=$row["id"];
      $nombre_adjunto=$row["id_usuario"];
      $id_empresa=$row["archivo"];
      //var_dump($row);
      $this->eliminarArchivo($id_archivo, $nombre_adjunto, $id_empresa);
    }

  }

  public function marcarArchivoDescargado($id_archivo){

    //$queryDelAdjuntos = "UPDATE archivos_usuario SET fecha_hora_bajada = NOW() WHERE id = $id_archivo";
    $queryDelAdjuntos = "UPDATE archivos_usuario SET fecha_hora_bajada = NOW() WHERE id IN ($id_archivo)";
    $this->conexion->consultaSimple($queryDelAdjuntos);

  }

  public function recibir_archivos($datosExtra){
    $datos=json_decode($datosExtra,true);
    $id_empresa=$datos["id_empresa"];
    $paciente=$datos["paciente"];
    $turno=$datos["turno"];

    //$empresa="Particular";
    $query = "SELECT id,usuario FROM usuarios WHERE id_empresa = $id_empresa";
    $get = $this->conexion->consultaRetorno($query);
    $afe = $get->num_rows;
    if($afe==1){
      $row = $get->fetch_array();
      $id_empresa=$row["id"];
      //$email=$row["email"];
      $usuario=$row["usuario"];
      $cantAdjuntos=count($_FILES);

      $subidaOk=$this->subirArchivo($id_empresa,$adjuntos=1,$cantAdjuntos);

      if($subidaOk==1){
        /*$destinatario=[
          $email=> $usuario,
        ];*/

        $query = "SELECT ue.email,u.usuario FROM usuarios_email ue INNER JOIN usuarios u ON ue.id_usuario=u.id WHERE anulado=0 AND ue.validado=1 AND ue.id_usuario = '$id_empresa'";
        //echo $query;
        $get = $this->conexion->consultaRetorno($query);
        $destinatarios=[];
        while($row = $get->fetch_array()){
          /*$destinatarios[]=[
            $row["email"]=> $row["usuario"],
          ];*/
          $destinatarios[$row["email"]]=$row["usuario"];
        }
        if(count($destinatarios)>0){

          //$asunto="Notificación de nuevo archivo";
          $asunto="Resultados Exámenes Médicos del Paciente ".$paciente.", fecha ".date("d/m/Y",strtotime($turno));
          $cuerpo='<b>*Por favor no responda este mail*</b><br><br>Hola '.$usuario.', desde ProteXion queremos informarte que un nuevo archivo ha sido subido a nuestro sistema online para clientes.<br><br>Para dascarglo puede hacer un click <a href="https://protexionpr.com.ar/client_access/login.php" target="_blank">Aqui</a><br><br><br>Te recodamos que TODOS los ESTUDIOS los realizamos en UNA sola mañana, RESULTADOS en 24/48 hs.<br>Para cualquier duda o consulta al mail info@protexionpr.com.ar / gerencia@protexionpr.com.ar<br>Turnos al WhatsApp 3743 400804';

          $archivosAdjuntos[]=[
            "ruta"=>"../views/docs/INSTRUCTIVO PARA BAJAR ARCHIVOS SISTEMA PROTEXION.pdf",
            "fileName"=>"INSTRUCTIVO PARA BAJAR ARCHIVOS SISTEMA PROTEXION"
          ];

          $envioMail=$this->enviarMail($destinatarios,$asunto,$cuerpo,$archivosAdjuntos);
          if($envioMail!=true){
            $envioMail="El archivo se ha subido correctamente pero ocurrió un error con el envío del mail: ".$envioMail;
          }
          $subidaOk=$envioMail;
        }else{
          $subidaOk="El archivo se ha subido correctamente pero no se han encontrado destinatarios validados para el envío del mail";
        }
      }
    }else{
      $subidaOk="Empresa no encontrada";
    }

    return $subidaOk;

  }

  public function guardar_email($id_empresa,$email){

    $query = "SELECT id,anulado,validado FROM usuarios_email WHERE email = '$email' AND id_usuario = $id_empresa";
    //echo $query;
    $get = $this->conexion->consultaRetorno($query);
    $row = $get->fetch_array();
    if($row){
      //echo " - ".$row["anulado"]." - ";
      
      $id_email=$row["id"];
      $ok=0;
      if($row["anulado"]==1 or $row["validado"]==0){
        $queryDelAdjuntos = "UPDATE usuarios_email SET anulado = 0, validado = 0, fecha_hora_alta = NOW() WHERE id = ".$id_email;
        $delAdjuntos = $this->conexion->consultaSimple($queryDelAdjuntos);
        $ok=1;
      }
    }else{
      $query = "INSERT INTO usuarios_email (id_usuario,email,anulado) VALUES ($id_empresa,'$email',0)";
      $insert = $this->conexion->consultaSimple($query);
      $mensajeError=$this->conexion->conectar->error;
      $id_email=$this->conexion->conectar->insert_id;
      echo $mensajeError;
      $ok=0;
      if($mensajeError!=""){
        echo "<br><br>".$query;
      }else{
        //$totalSubidas++;
        $ok=1;
      }
    }
    //var_dump($ok);
    //$_SESSION["rowUsers"]["email"]=$email;
    if($ok==1){
      //$_SESSION['rowUsers']["cant_direcciones"]++;
      $ok=$this->enviar_mail_verificacion($id_email);
      $this->updateUsrMails();
    }
    return $ok;

  }

  public function enviar_mail_verificacion($id_email){
    $query = "SELECT u.usuario,ue.email FROM usuarios u INNER JOIN usuarios_email ue ON ue.id_usuario=u.id WHERE ue.id = $id_email";
    //echo $query;
    $get = $this->conexion->consultaRetorno($query);
    $row = $get->fetch_array();

    $url = $this->conexion->url_servidor_web();

    $destinatarios[$row["email"]]=$row["usuario"];
    $asunto="Verificacion de Email";
    $cuerpo='<b>*Por favor no responda este mail*</b><br><br>Hola '.$row["usuario"].'<br><br>Para verificar tu correo hacé click en el siguiente boton: <br><a href="'.$url.'administrar_empresas.php?accion=verificar_email&id='.$id_email.'" style="display:inline-block;text-decoration:none;background:#DA0037;border-radius:3px;color:white;font-family:Helvetica,sans-serif;font-size:16px;line-height:24px;font-weight:400;padding:12px 20px 11px;margin:0px;margin-top:25px" target="_blank" ><span class="il">Verificar</span> mi correo electrónico</a><br><br><br>Te recodamos que TODOS los ESTUDIOS los realizamos en UNA sola mañana, RESULTADOS en 24/48 hs.<br>Para cualquier duda o consulta al mail info@protexionpr.com.ar / gerencia@protexionpr.com.ar<br>Turnos al WhatsApp 3743 400804';

    $adjuntos[]=[
      "ruta"=>"../views/docs/INSTRUCTIVO PARA BAJAR ARCHIVOS SISTEMA PROTEXION.pdf",
      "fileName"=>"INSTRUCTIVO PARA BAJAR ARCHIVOS SISTEMA PROTEXION"
    ];

    $envioMail=$this->enviarMail($destinatarios,$asunto,$cuerpo,$adjuntos);
    if($envioMail!=true){
      $envioMail="Ocurrió un error con el envío del mail: ".$envioMail;
    }
    return $envioMail;
  }

  public function enviar_mail_verificacion_todos($id_empresa){
    $aEmail=$this->trerEmailEmpresa($id_empresa);
    $aEmail=json_decode($aEmail,true);
    $aRespuesta=[];
    foreach ($aEmail as $key => $email) {
      $envio_ok=$this->enviar_mail_verificacion($email["id_email_usuario"]);
      $aRespuesta[$email["email"]]=$envio_ok;
    }
    return json_encode($aRespuesta);
  }

  public function verificar_email($id_email){

    $query = "SELECT IF(DATEDIFF(NOW(), fecha_hora_alta) >= 7,1,0) AS expirado FROM usuarios_email WHERE anulado = 0 AND id = $id_email";
    $get = $this->conexion->consultaRetorno($query);
    $row = $get->fetch_array();
    /*echo $query;
    var_dump($row);
    if($row and $row["expirado"]==0){
      echo "expirado";
    }
    die();*/
    $ok=2;
    if($row and $row["expirado"]==0){
      $query = "UPDATE usuarios_email SET validado = 1 WHERE id = $id_email";
      $insert = $this->conexion->consultaSimple($query);
      $mensajeError=$this->conexion->conectar->error;
      echo $mensajeError;
      $ok=0;
      if($mensajeError!=""){
        echo "<br><br>".$query;
      }else{
        //$totalSubidas++;
        $ok=1;
        //$_SESSION['rowUsers']["cant_validados"]++;
        $this->updateUsrMails();
      }
    }
    return $ok;
  }

  public function enviarMail($destinatarios,$asunto,$cuerpo,$adjuntos=[]){
    require_once './../assets/PHPMailer/src/Exception.php';
    require_once './../assets/PHPMailer/src/PHPMailer.php';
    require_once './../assets/PHPMailer/src/SMTP.php';
    
    /*$destinatarios=[
      'recipient1@domain.com'=> 'First Name',
      'recipient2@domain.com'=> 'Second Name'
    ];

    $adjuntos[]=[
        "ruta"      =>$directorio."/".$nombreArchivo,
        "fileName"  =>$nombreArchivo,
    ];*/

    $smtpHost = "mail.protexionpr.com.ar";  //agregar servidor
    $smtpUsuario = "resultados@protexionpr.com.ar";  //agregar usuario
    $smtpClave = '-vg#+J$I9_oH';  //agregar contraseña
    $remitente = $smtpUsuario;
    $nombre_remitente = "ProteXion - Centro Medico Laboral";

    //var_dump($smtpUsuario);
    //var_dump($smtpClave);
    
    $mail = new PHPMailer(true);
    //$mail->SMTPDebug = 3;//Habilitamos solo para debugguear
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Port = 465;
    //$mail->Port = 587;
    //$mail->Port = 25;
    $mail->SMTPSecure = 'ssl';
    $mail->IsHTML(true);
    $mail->CharSet = "utf-8";
    $mail->Host = $smtpHost;
    $mail->Username = $smtpUsuario;
    $mail->Password = $smtpClave;
    $mail->From = $remitente;//"mailorigen@gmail.com"; //mail remitente
    $mail->FromName = $nombre_remitente;//"de donde sale el mail"; //remitente
    
    foreach ($destinatarios as $key => $value) {
        /*var_dump($key);
        var_dump($value);*/
        $email=$key;
        $name=$value;
        if(is_numeric($key)){
          $email=$value;
          $name="";
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // La dirección de correo electrónico es válida
            $mail->AddAddress($email, $name); //destinatario
        } else {
            // La dirección de correo electrónico no es válida
            //echo "La dirección de correo electrónico no es válida.";
        }
    }

    $numDestinatarios = count($mail->getToAddresses());
    if($numDestinatarios>0){
    
      foreach ($adjuntos as $key => $value) {
          $mail->addAttachment($value["ruta"], $value["fileName"]);
      }

      $mail->Subject = $asunto; //titulo
      $mensajeHtml = nl2br($cuerpo); //mensaje
      $mail->Body = "{$mensajeHtml} <br /><br />";
      $mail->AltBody = "{$cuerpo} \n\n";
      //var_dump($mail);
      try {
        $envio = $mail->Send();
      } catch (\Throwable $th) {
        //throw $th;
        //var_dump($th);
        //$envio="El archivo se ha subido correctamente pero ocurrió un error con el envío del mail: ".$th->getMessage();
        $envio=$th->getMessage();
      }
      //var_dump($envio);
    }else{
      $envio="No se han encontrado destinatarios validos";
    }

    return $envio;

  }

  public function trerEmailEmpresa($id_empresa){

    $queryTraerEmpresas = "SELECT id,email,validado FROM usuarios_email WHERE anulado = 0 AND id_usuario = $id_empresa";
    $getEmpresas = $this->conexion->consultaRetorno($queryTraerEmpresas);

    $arrayArchivos = array();
    //$_SESSION["rowUsers"]["email"]="";
    while ($row = $getEmpresas->fetch_array()) {
      //$_SESSION["rowUsers"]["email"]=$row['email'];
      $arrayArchivos[] = array(
        'id_email_usuario'=>$row['id'],
        'email'=>$row['email'],
        'validado'=>$row['validado'],
      );
    }

    return json_encode($arrayArchivos);

  }

  public function modificar_email($id_empresa,$id_email_usuario,$email){

    foreach($id_email_usuario as $key => $id){
      $queryTraerEmpresas = "SELECT id,validado FROM usuarios_email WHERE validado = 1 AND email = '".$email[$key]."' AND id_usuario = $id_empresa";
      $getEmpresas = $this->conexion->consultaRetorno($queryTraerEmpresas);
      $row = $getEmpresas->fetch_array();
      /*$validado=0;
      if($row and $row["validado"]==1){
        $validado=1;
      }*/

      if(is_null($row["id"])){
        $query = "UPDATE usuarios_email SET email = '".$email[$key]."', validado = 0 WHERE id = $id";
        $insert = $this->conexion->consultaSimple($query);
        $mensajeError=$this->conexion->conectar->error;
        echo $mensajeError;
        $ok=0;
        if($mensajeError!=""){
          echo "<br><br>".$query;
        }else{
          //if($validado==0){
            $this->updateUsrMails();
            $envio_ok=$this->enviar_mail_verificacion($id);
          //}
          //$totalSubidas++;
          $ok=1;
        }
      }
    }

  }

  public function updateUsrMails(){

    if(isset($_SESSION['rowUsers'])){
      $queryGetUser = "SELECT SUM(if(ue.anulado=0,1,0)) AS cant_direcciones, SUM(ue.validado) as cant_validados FROM usuarios u LEFT JOIN usuarios_email ue ON ue.id_usuario=u.id WHERE u.id = ".$_SESSION['rowUsers']["id_usuario"];
      $getUser = $this->conexion->consultaRetorno($queryGetUser);

      if($getUser->num_rows == 0){
        echo "El usuario no existe";
      }else{
        $userRows = $getUser->fetch_assoc();
        $_SESSION['rowUsers']["cant_direcciones"] = $userRows["cant_direcciones"];
        $_SESSION['rowUsers']["cant_validados"] = $userRows["cant_validados"];
      }
    }else{

    }
  }

  public function eliminarEmail($id_email_usuario){

    $queryDelAdjuntos = "UPDATE usuarios_email SET anulado = 1, validado = 0 WHERE id = $id_email_usuario";
    $delAdjuntos = $this->conexion->consultaSimple($queryDelAdjuntos);
    $this->updateUsrMails();

  }

}
extract($_REQUEST);
$empresas = new Empresas();
if (isset($accion)) {
		switch ($accion) {
			/*case 'empresas':
				$items->traerTodosClientes();
			break;
			case 'traerDatosIniciales':
				$empresas->traerDatosIniciales();
			break;*/
      case "traerEmpresas":
        echo json_encode($empresas->traerEmpresas());
      break;
      case "importarEmpresas":
        $empresas->importarEmpresas($_FILES);
      break;
      case "trerArchivosEmpresa":
        echo $empresas->trerArchivosEmpresa($id_empresa);
      break;
      case "subirArchivos":
        //var_dump($_FILES);
        
        if(isset($_FILES['file'])) {
          $adjuntos = 1;
        }else{
          $adjuntos = 0;
        }
        //var_dump($adjuntos);
        
        if(isset($cantAdjuntos)){
          $cantAdjuntos = $cantAdjuntos;
        }else{
          $cantAdjuntos = 0;
        }
        echo $empresas->subirArchivo($id_empresa,$adjuntos,$cantAdjuntos);
      break;
      case "eliminarArchivo":
        $empresas->eliminarArchivo($id_archivo, $nombreArchivo, $id_empresa);
      break;
      case "eliminarArchivosSeleccionados":
        $empresas->eliminarArchivosSeleccionados($archivos);
      break;
      case "marcarArchivoDescargado":
        $empresas->marcarArchivoDescargado($id_archivo);
      break;
      case "recibirArchivo":
        //var_dump($_POST);
        if(isset($_POST["datosExtra"])){
          $datosExtra=$_POST["datosExtra"];
          //var_dump($_FILES);
          //$empresas->recibir_archivos($archivos,$empresa);
          echo $empresas->recibir_archivos($datosExtra);
        }else{
          echo "Faltan datos para subir el archivo".json_encode($_POST);
        }
      break;
      case "eliminarArchivoDesdeLocal":
        $idArchivo=$_POST["idArchivo"];
        
        echo $empresas->eliminarArchivoLocal($idArchivo);
      break;
      case "guardar_email":
        //var_dump($_POST);
        $id_empresa=$_POST["id_empresa"];
        $email=$_POST["email"];
        echo $empresas->guardar_email($id_empresa,$email);
        //header("location: ../cliente.php");
      break;
      case "enviar_mail_verificacion_todos":
        $id_empresa=$_POST["id_empresa"];
        echo $empresas->enviar_mail_verificacion_todos($id_empresa);
      break;
      case "verificar_email":
        //var_dump($_POST);
        $id_email=$_GET["id"];
        $ok=$empresas->verificar_email($id_email);
        if($ok==1){
          header("location: ../email_verified.php");
        }elseif($ok==2){
          header("location: ../link_expired.php");
        }else{
          header("location: ../email_error.php");
        }
      break;
      case "trerEmailEmpresa":
        echo $empresas->trerEmailEmpresa($id_empresa);
      break;
      case "modificar_email":
        $empresas->modificar_email($id_empresa,$id_email_usuario,$email);
        header("location: ../cliente.php");
      break;
      case "eliminarEmail":
        $empresas->eliminarEmail($id_email_usuario);
      break;
      case "subirEmpresa":
        $idEmpresa=$_POST["idEmpresa"];
        $nombreEmpresa=$_POST["nombreEmpresa"];
        //echo $nombreEmpresa;
        
        $empresas->insertarEmpresa($nombreEmpresa,$idEmpresa);
      break;
      case "eliminarEmpresa":
        $idEmpresa=$_POST["idEmpresa"];
        //echo $nombreEmpresa;
        
        echo $empresas->eliminarEmpresa($idEmpresa);
      break;
      case "sincronizarEmpresa":
        $idEmpresa=$_POST["idEmpresa"];
        $nombreEmpresa=$_POST["nombreEmpresa"];
        //echo $nombreEmpresa;
        
        $empresas->sincronizarEmpresa($idEmpresa,$nombreEmpresa);
      break;
      case "updateEmpresa":
        $idEmpresa=$_POST["idEmpresa"];
        $nombreEmpresa=$_POST["nombreEmpresa"];
        //echo $nombreEmpresa;
        
        echo $empresas->updateEmpresa($idEmpresa,$nombreEmpresa);
      break;
      case "verificarEmail":
        $empresas->updateUsrMails();
      default:
        echo "ruta no especificada";
		}
	}else{
		if (isset($_GET['accion'])) {
			echo json_encode($empresas->traerEmpresas());
		}
	}

?>