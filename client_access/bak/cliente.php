<?php 
session_start();
//include_once('../conexion.php');
date_default_timezone_set("America/Buenos_Aires");
$hora = date('Hi');
if ($_SESSION['rowUsers']['tipo']!=2) {
  header("location:login.php");
}
if (!isset($_SESSION['rowUsers']['id_usuario'])) {
  header("location:./models/redireccionar.php");
}?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="endless admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, endless admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <!--<link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">-->
    <title>ProteXion</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/flag-icon.css">
     <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="assets/css/datatables.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets/css/light-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="loader bg-white">
        <div class="whirly-loader"> </div>
      </div>
    </div>
    <!-- Loader ends--><?php
    include_once('./views/main_header.php');?>
    <!-- Page Header Ends-->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
      <!-- Page Sidebar Start-->
      <!-- <div class="page-sidebar open"><?php
        //include_once('./views/slideBar.php');?>
      </div> -->
      <!-- Page Sidebar Ends-->
      <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
          <span class="d-none" id="tipo_usuario"><?=$_SESSION["rowUsers"]["tipo"]?></span>
          <span class="d-none" id="id_usuario"><?=$_SESSION["rowUsers"]["id_usuario"]?></span>

          <div class="card">
            <div class="card-header">
              <h5>Bienvenido <?=$_SESSION["rowUsers"]["usuario"]?></h5>
            </div>
            <div class="card-body"><?php
require_once('models/conexion.php');
$conexion = new Conexion();
$id_empresa=$_SESSION["rowUsers"]["id_usuario"];
$query = "SELECT ue.email,u.usuario FROM usuarios_email ue INNER JOIN usuarios u ON ue.id_usuario=u.id WHERE anulado=0 AND ue.id_usuario = '$id_empresa'";
//echo $query;
$get = $conexion->consultaRetorno($query);
$destinatarios=[];
while($row = $get->fetch_array()){
  $destinatarios[$row["email"]]=$row["usuario"];
}
//var_dump($destinatarios);
              $msjMostrar="Por favor ingrese su direccion de E-Mail para recibir un aviso cuando haya archivos nuevos:";
              $accionBtn="Guardar";
              $mostrarArchivos=0;
              $mostrarBtnAdminEmail=0;
              //if($_SESSION["rowUsers"]["email"]){
              if(!empty($destinatarios)){
                $msjMostrar="Agregar direccion de E-Mail para notificar cuando haya archivos nuevos:";
                $accionBtn="Agregar";
                $mostrarArchivos=1;
                $mostrarBtnAdminEmail=1;
              }
              //var_dump($_SESSION["rowUsers"]);
              //if(!$_SESSION["rowUsers"]["email"]){?>
                <div class="row alert alert-danger" style="background-color: #DA0037;">
                  <div class="col-12">
                    <form method="post" action="models/administrar_empresas.php">
                      <label for="email" class="h5"><?=$msjMostrar?></label>
                      <input type="email" name="email" id="email" class="form-control" placeholder="empresa@dominio.com" required>
                      <input type="hidden" name="id_empresa" value="<?=$_SESSION["rowUsers"]["id_usuario"]?>">
                      <input type="hidden" name="accion" value="guardar_email">
                      <button class="btn btn-light mt-3" type="submit"><?=$accionBtn?></button><?php
                      if($mostrarBtnAdminEmail==1){?>
                        <button class="btn btn-light mt-3" type="button" data-toggle="modal" data-target="#direccionesEmail">Administrar E-Mails</button><?php
                      }?>
                    </form>
                  </div>
                </div><?php
              //}
              if($mostrarArchivos==1){?>
                <div class="table-responsive"><?php
                  include_once("views/tabla_archivos.php")?>
                </div><?php
              }?>
            </div>
          </div>
        </div>
        <!-- Container-fluid Ends-->
      </div>

      <!-- MODAL DIRECCIONES DE EMAIL -->
    <div class="modal fade mt-5" id="direccionesEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="post" action="models/administrar_empresas.php">
            <div class="modal-header">
              <h5 class="modal-title">Direcciones de E-Mail</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close" data-original-title="" title=""><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body p-4">
              <div class="row">
                <div class="col-12">
                  <input type="hidden" name="id_empresa" id="id_empresa" value="<?=$_SESSION["rowUsers"]["id_usuario"]?>">
                  <input type="hidden" name="accion" value="modificar_email">
                  <table id="emailEmpresas" style="width: 100%;">
                    <thead>
                      <tr>
                        <th style="text-align: center;">E-Mail</th>
                        <th style="text-align: center;">Eliminar</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
              <button type="submit" id="btnContinuarImportacion" class="btn btn-dark">Modificar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- FIN MODAL DIRECCIONES DE EMAIL-->
      
      <!-- footer start-->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 footer-copyright">
              <p class="mb-0"></p>
            </div>
            <div class="col-md-6">
              <p class="pull-right mb-0"></p>
            </div>
          </div>
        </div>
      </footer>

    </div>

    <!-- latest jquery-->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap/popper.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.js"></script>
    <!-- feather icon js-->
    <script src="assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <!--<script src="assets/js/datatable/datatables/datatable.custom.js"></script>-->
    <script src="assets/js/sweet-alert/sweetalert.min.js"></script>
    <script src="assets/js/chat-menu.js"></script>
    <script src="assets/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <!--<script src="assets/js/theme-customizer/customizer.js"></script>-->
    <!-- Plugin used-->
    <script type="text/javascript">

      idiomaEsp = {
          "autoFill": {
              "cancel": "Cancelar",
              "fill": "Llenar las celdas con <i>%d<i><\/i><\/i>",
              "fillHorizontal": "Llenar las celdas horizontalmente",
              "fillVertical": "Llenar las celdas verticalmente"
          },
          "decimal": ",",
          "emptyTable": "No hay datos disponibles en la Tabla",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
          "infoFiltered": "Filtrado de _MAX_ entradas totales",
          "infoThousands": ".",
          "lengthMenu": "Mostrar _MENU_ entradas",
          "loadingRecords": "Cargando...",
          "paginate": {
              "first": "Primera",
              "last": "Ultima",
              "next": "Siguiente",
              "previous": "Anterior"
          },
          "processing": "Procesando...",
          "search": "Busqueda:",
          "searchBuilder": {
              "add": "Agregar condición",
              "button": {
                  "0": "Constructor de búsqueda",
                  "_": "Constructor de búsqueda (%d)"
              },
              "clearAll": "Quitar todo",
              "condition": "Condición",
              "conditions": {
                  "date": {
                      "after": "Luego",
                      "before": "Luego",
                      "between": "Entre",
                      "empty": "Vacio",
                      "equals": "Igual"
                  }
              },
              "data": "Datos",
              "deleteTitle": "Borrar regla de filtrado",
              "leftTitle": "Criterio de alargado",
              "logicAnd": "Y",
              "logicOr": "O",
              "rightTitle": "Criterio de endentado",
              "title": {
                  "0": "Constructor de búsqueda",
                  "_": "Constructor de búsqueda (%d)"
              },
              "value": "Valor"
          },
          "searchPlaceholder": "Ingrese caracteres de busqueda",
          "thousands": ".",
          "zeroRecords": "No se encontraron registros que coincidan con la búsqueda",
          "datetime": {
              "previous": "Anterior",
              "next": "Siguiente",
              "hours": "Hora",
              "minutes": "Minuto",
              "seconds": "Segundo"
          },
          "editor": {
              "close": "Cerrar",
              "create": {
                  "button": "Nuevo",
                  "title": "Crear nueva entrada",
                  "submit": "Crear"
              },
              "edit": {
                  "button": "Editar",
                  "title": "Editar entrada",
                  "submit": "Actualizar"
              },
              "remove": {
                  "button": "Borrar",
                  "title": "Borrar",
                  "submit": "Borrar",
                  "confirm": {
                      "_": "Está seguro que desea borrar %d filas?",
                      "1": "Está seguro que desea borrar 1 fila?"
                  }
              },
              "multi": {
                  "title": "Múltiples valores",
                  "info": "La selección contiene diferentes valores para esta entrada. Para editarla y establecer todos los items al mismo valor, clickear o tocar aquí, de otra manera conservarán sus valores individuales.",
                  "restore": "Deshacer cambios",
                  "noMulti": "Esta entrada se puede editar individualmente, pero no como parte de un grupo."
              }
          }
      }

      var id_empresa=$("#id_usuario").html();
      $(document).ready(function(){
        get_archivos(id_empresa)
        get_email(id_empresa)
      });

      $(document).on("click", ".archivo_empresa", function(){

        let id_archivo = parseInt($(this).closest('tr').find('td:eq(0)').text());
        //let id_archivo = this.getAttribute("data-id");

        console.log("descargando");
        console.log(id_archivo);

        accion = "marcarArchivoDescargado";
        $.ajax({
          url: "models/administrar_empresas.php",
          type: "POST",
          datatype:"json",
          data:  {accion:accion, id_archivo:id_archivo},
          success: function() {
            get_archivos(id_empresa)
          }
        }); 
      })

      function get_email(id_empresa){
        let accion = "trerEmailEmpresa";
        $.ajax({
          url: "models/administrar_empresas.php",
          type: "POST",
          datatype:"json",
          data:  {accion:accion, id_empresa:id_empresa},
          success: function(response) {
            let respuestaJson = JSON.parse(response);
            console.log(respuestaJson);

            let tableEmailEmpresas = $('#emailEmpresas');
            let tbody=tableEmailEmpresas.find("tbody")
            tbody.empty();

            let filas="";
            respuestaJson.forEach((data)=>{
              filas+=`
                <tr>
                  <td>
                    <input type="hidden" name="id_email_usuario[]" value="${data.id_email_usuario}">
                    <input type="email" name="email[]" id="email" class="form-control" value="${data.email}" placeholder="empresa@dominio.com" required>
                  </td>
                  <td style="text-align: center;"><a class='btn btn-outline-danger text-danger btnBorrarEmail' data-id="${data.id_email_usuario}"><i class='fa fa-trash-o'></i></a></td>
                </tr>
              `;
            })
            if(filas==""){
              window.location.href="cliente.php"
            }
            tbody.html(filas)

          }
        });
      }

      $(document).on("click", ".btnBorrarEmail", function(){
        //let id_item = parseInt($('#id_item').text());

        let id_empresa=$("#id_empresa").val();
        console.log(id_empresa);
        let id_email_usuario = this.getAttribute("data-id");
        console.log(id_email_usuario);
        //let id_email_usuario = parseInt($(this).closest('tr').find('td:eq(0)').text());
        console.log($(this));
        console.log($(this).closest('tr').find('td:eq(0)'));
        console.log($(this).closest('tr').find('td:eq(0)').find('input'));
        let email=$(this).closest('tr').find('td:eq(0)').find('input[name="email[]"]').val()
        console.log(email);

        swal({
          title: "Eliminar el E-Mail "+email+"?",
          //text: "Una vez eliminado este archivo, no volveras a verlo",
          icon: "warning",
          //buttons: true,
          buttons: {
            cancel: "Cancelar",
            danger: {
              text: "Eliminar",
              closeModal: false,
            }
          },
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            accion = "eliminarEmail";
            $.ajax({
              url: "models/administrar_empresas.php",
              type: "POST",
              datatype:"json",
              data:  {accion:accion, id_email_usuario:id_email_usuario, id_empresa: id_empresa},    
              success: function() {
                swal({
                  icon: 'success',
                  title: 'E-Mail eliminado correctamente'
                });
                get_email(id_empresa)
                /*$padre = this.parentElement.parentElement
                $padre.classList.add("d-none");*/
              }
            }); 
          } else {
            swal("El E-Mail no se eliminó!");
          }
        });
      })

    </script>
  </body>
</html>