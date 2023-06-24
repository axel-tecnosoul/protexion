<?php
require_once('administrar_empresas.php');
$conexion = new Conexion();
$empresa = new Empresas();
$query = "SELECT id,id_usuario,archivo FROM archivos_usuario WHERE fecha_hora_subida <= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
$get = $conexion->consultaRetorno($query);
while($row = $get->fetch_array()){
  $id_archivo=$row["id"];
  $nombre_adjunto=$row["archivo"];
  $id_empresa=$row["id_usuario"];
  var_dump($row);
  $empresa->eliminarArchivo($id_archivo, $nombre_adjunto, $id_empresa);
}

//include_once("./test_envio_mail.php");
?>