<?php 
session_start();
//include_once('../conexion.php');
date_default_timezone_set("America/Buenos_Aires");
$hora = date('Hi');
if ($_SESSION['rowUsers']['tipo']!=1) {
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
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!--<link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">-->
    <title>Empresas</title>
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
    <style>
      .modal-dialog{
        overflow-y: initial !important
      }
      .modal-body{
        max-height: 70vh;
        overflow-y: auto;
      }
    </style>
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
              <h5>
                Empresas
                <button id="btnImportarEmpresas" type="button" class="btn btn-outline-success ml-3" data-toggle="modal"><i class="fa fa-cloud-upload"></i> importar</button>
              </h5>
              <!-- <button id="btnNuevo" type="button" class="btn btn-primary mt-2" data-toggle="modalCRUD"><i class="fa fa-plus-square"></i> Importar</button>  -->
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover" id="tablaEmpresas">
                  <thead class="text-center">
                    <tr>
                      <th class="text-center">#ID</th>
                      <th>Empresa</th>
                      <th>Password</th>
                      <th>Cant. archivos</th>
                      <!-- <th>Tipo</th> -->
                      <!-- <th>Activo</th> -->
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
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

    <!--Modal para CRUD-->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <span id="id_empresa" class="d-none"></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form id="formEmpresas">
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-4 mb-2"><button id="btnAddAdjuntos" class="btn btn-secondary">Agregar</button></div>
                <div class="col-lg-12 d-none" id="masAdjuntos">
                  <div id="dropMasArchivos"></div>
                </div>
              </div>
              <div id="tablaArchivos" class="row m-1"><?php
                include_once("views/tabla_archivos.php")?>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <button type="submit" id="btnGuardar" class="btn btn-dark d-none">
                Guardar
                <div id="spinner_guardar" class="spinner-border spinner-border-sm d-none" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- FINAL MODAL CRUD-->

    <!-- MODAL SUBIR ARCHIVO CUENTAS DADAS DE BAJA -->
    <div class="modal fade mt-5" id="importarEmpresas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Seleccione un archivo de excel</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close" data-original-title="" title=""><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body p-4">
            <div class="row">
              <div class="col-12">
                <input class="form-control" type="file" id="xls_empresas">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
            <button type="submit" id="btnContinuarImportacion" class="btn btn-dark">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN MODAL SUBIR ARCHIVO CUENTAS DADAS DE BAJA-->

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
      $(document).ready(function(){

        tablaEmpresas= $('#tablaEmpresas').DataTable({
          "ajax": {
              "url" : "./models/administrar_empresas.php?accion=traerEmpresas",
              "dataSrc": "",
            },
          "columns":[
            {"data": "id_usuario"},
            {"data": "usuario"},
            {"data": "clave"},
            {"data": "cant_archivos","class":"text-center"},
            //{"data": "tipo"},
            //{"data": "activo"},
            {"defaultContent" : "<div class='text-center'><div class='btn-group'><button class='btn btn-success btnFolder'><i class='fa fa-folder'></i></button></div></div>"},
            //<button class='btn btn-warning btnVer'><i class='fa fa-eye'></i></button><button class='btn btn-danger btnBorrar'><i class='fa fa-trash-o'></i></button>
          ],
          stateSave:true,
          "language":  idiomaEsp
        });

        $('#modalCRUD').on('hidden.bs.modal', function (e) {
          document.getElementById('dropMasArchivos').innerHTML="";
          document.getElementById('masAdjuntos').classList.toggle("d-none");
          tablaEmpresas.ajax.reload(null, false);
        });

      });
      
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

      $(document).on("click", "#btnContinuarImportacion", function(e){
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página   
        
        let datosEnviar = new FormData();
        datosEnviar.append("accion", "importarEmpresas");
        img = document.getElementById("xls_empresas");
        if (img.files.length > 0) {
          datosEnviar.append("file", img.files[0]);
        }else{
          datosEnviar.append("file", "");
        }

        $.ajax({
          data: datosEnviar,
          url: "models/administrar_empresas.php",
          method: "post",
          cache: false,
          contentType: false,
          processData: false,
          success: function(data) {
            if(data==""){
              tablaEmpresas.ajax.reload(null, false);
              $('#importarEmpresas').modal('hide');
              swal({
                icon: 'success',
                title: 'Accion realizada correctamente'
              });
            }else{
              swal("Ha ocurrido un error!");
            }
          }
        });
      });

      /*SUBIR ARCHIVO ARTICULOS*/
      $(document).on('click', '#btnImportarEmpresas', function(){
        $('#importarEmpresas').modal('show');
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        //$(".modal-title").text("Importar Empresas");
      })

      $(document).on("click", ".btnFolder", function(){
        let fila = $(this);
        let id_empresa = parseInt($(this).closest('tr').find('td:eq(0)').text());
        let nombre_empresa = $(this).closest('tr').find('td:eq(1)').text();
        $("#id_empresa").html(id_empresa);

        $(".modal-header").css( "background-color", "#22af47");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Archivos de "+nombre_empresa);

        $("#modalCRUD").modal("show");

        $("#btnGuardar").html("Agregar")
        $("#masAdjuntos").addClass("d-none");
        $("#tablaArchivos").removeClass("d-none");

        get_archivos(id_empresa)
      });

      /*BOTTON AGREGAR ADJUNTOS*/
      $(document).on('click', '#btnAddAdjuntos', function(e){
        e.preventDefault();
        console.log(this);
        let btn=$(this);
        if(btn.html()=="Agregar"){
          btn.html("Cancelar agregar")
        }else{
          btn.html("Agregar")
        }
        $rowMasAdjuntos = document.getElementById("masAdjuntos");
        $rowMasAdjuntos.classList.toggle("d-none");
        $rowTablaArchivos = document.getElementById("tablaArchivos");
        $rowTablaArchivos.classList.toggle("d-none");

        $btnGuardar = document.getElementById("btnGuardar");
        $btnGuardar.classList.toggle("d-none");
        $.ajax({
          url: "dropMasAdjuntosEmpresas.html",
          type: "POST",
          datatype:"json",    
          data:  {},    
          success: function(response) {
            $('#dropMasArchivos').html(response);
          }
        });
      })

      $(document).on("click", "#btnGuardar", function(e){
        $(this).addClass("disabled")
        let id_empresa=$("#id_empresa").html();
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página   
        
        let datosEnviar = new FormData();
        datosEnviar.append("id_empresa", id_empresa);
        datosEnviar.append("accion", "subirArchivos");

        if(typeof arrayFiles !== 'undefined'){
          console.log(arrayFiles);
          console.log(arrayFiles.length);
          let cantArchivos = 0;
          for(let i = 0; i < arrayFiles.length; i++) {
            datosEnviar.append('file'+i, arrayFiles[i]);
            cantArchivos++;
          };
          datosEnviar.append('cantAdjuntos', cantArchivos);
        }else{
          let arrayFiles = "";
        }
        console.log(datosEnviar);

        $("#spinner_guardar").toggleClass("d-none");
        $.ajax({
          data: datosEnviar,
          url: "models/administrar_empresas.php",
          method: "post",
          cache: false,
          contentType: false,
          processData: false,
          success: function(data) {
            $("#btnGuardar").removeClass("disabled")
            console.log(data);
            $("#spinner_guardar").toggleClass("d-none");
            if(data=="1"){
              tablaEmpresas.ajax.reload(null, false);
              $('#modalCRUD').modal('hide');
              swal({
                icon: 'success',
                title: 'Accion realizada correctamente'
              });
            }else{
              swal("Ha ocurrido un error!");
            }
          }
        });

      })

      $(document).on("click", ".btnBorrarFoto", function(){
        //let id_item = parseInt($('#id_item').text());

        let id_empresa=$("#id_empresa").html();
        let id_archivo = this.getAttribute("data-id");
        //let id_archivo = parseInt($(this).closest('tr').find('td:eq(0)').text());
        let nombreArchivo = this.getAttribute("data-name");
        console.log($(this));
        console.log($(this).closest('tr'));
        console.log($(this).closest('tr').find('td:eq(0)'));
        console.log($(this).closest('tr').find('td:eq(0)').text());
        console.log(id_archivo);

        swal({
          title: "Estas seguro?",
          text: "Una vez eliminado este archivo, no volveras a verlo",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            accion = "eliminarArchivo";
            $.ajax({
              url: "models/administrar_empresas.php",
              type: "POST",
              datatype:"json",    
              data:  {accion:accion, id_archivo:id_archivo, nombreArchivo: nombreArchivo, id_empresa: id_empresa},    
              success: function() {
                get_archivos(id_empresa)
                /*$padre = this.parentElement.parentElement
                $padre.classList.add("d-none");*/
              }
            }); 
          } else {
            swal("El archivo no se eliminó!");
          }
        });
      })

    </script>
  </body>
</html>