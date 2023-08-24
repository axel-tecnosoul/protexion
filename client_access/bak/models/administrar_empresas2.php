<?php
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
            $clave=$this->generarPasswordRandom();
						$queryInsert = "INSERT INTO usuarios (usuario,clave,tipo) VALUES ('$usuario','$clave',2)";
						$insertNewAdjunto = $this->conexion->consultaSimple($queryInsert);
            //var_dump($insertNewAdjunto);
            
            $mensajeError=$this->conexion->conectar->error;
            echo $mensajeError;
            if($mensajeError!=""){
              echo "<br><br>".$queryInsert;
            }
					}

        }
        $i++;
        $contador++;
      }
      unlink($archivo);
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

    echo json_encode($arrayArchivos);

  }

  public function subirArchivos($id_empresa,$adjuntos,$cantAdjuntos){

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

  public function marcarArchivoDescargado($id_archivo){

    $queryDelAdjuntos = "UPDATE archivos_usuario SET fecha_hora_bajada = NOW() WHERE id = $id_archivo";
    $this->conexion->consultaSimple($queryDelAdjuntos);

  }

}

$empresas = new Empresas();
if (isset($_POST['accion'])) {
		switch ($_POST['accion']) {
			/*case 'empresas':
				$items->traerTodosClientes();
			break;
			case 'traerDatosIniciales':
				$empresas->traerDatosIniciales();
			break;*/
      case "importarEmpresas":
        $empresas->importarEmpresas($_FILES);
      break;
      case "trerArchivosEmpresa":
        $empresas->trerArchivosEmpresa($id_empresa);
      break;
      case "subirArchivos":
        if(isset($_FILES['file0'])) {
          $adjuntos = 1;
        }else{
          $adjuntos = 0;
        }

        if(isset($_POST['cantAdjuntos'])){
          $cantAdjuntos = $_POST['cantAdjuntos'];
        }else{
          $cantAdjuntos = 0;
        }
        echo $empresas->subirArchivos($id_empresa,$adjuntos,$cantAdjuntos);
      break;
      case "eliminarArchivo":
        $empresas->eliminarArchivo($id_archivo, $nombreArchivo, $id_empresa);
      break;
      case "marcarArchivoDescargado":
        $empresas->marcarArchivoDescargado($id_archivo);
      break;
		}
	}else{
		if (isset($_GET['accion'])) {
			echo json_encode($empresas->traerEmpresas());
		}
	}

?>