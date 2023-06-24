<?php
include_once("administrar_empresas.php");
$empresas=new Empresas();
$id_empresa=4;
$datosExtra=[
  "paciente"=>"Axel",
  "turno"=>"2023-06-22"
];
$empresas->enviarMail($id_empresa,json_encode($datosExtra));

?>