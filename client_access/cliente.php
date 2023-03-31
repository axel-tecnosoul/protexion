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
            <div class="card-body">
              <div class="table-responsive"><?php
                include_once("views/tabla_archivos.php")?>
              </div>
            </div>
          </div>
        </div>
        <!-- Container-fluid Ends-->
      </div>
      
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

    </script>
  </body>
</html>