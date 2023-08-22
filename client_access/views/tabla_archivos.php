<style>
  .w-40{
    width:40%;
    word-break: break-all;
  }
  .w-25{
    width: 25%;
  }
  .w-20{
    width: 20%;
  }
  .w-10{
    width: 25%;
  }
  .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
    background-color: #DA0037!important;
  }
  .custom-checkbox .custom-control-input:checked:focus ~ .custom-control-label::before {
    box-shadow: 0 0 0 1px #fff, 0 0 0 0.2rem rgb(218 0 55 / 50%)
  }
  .custom-checkbox .custom-control-input:focus ~ .custom-control-label::before {
    box-shadow: 0 0 0 1px #fff, 0 0 0 0.2rem rgb(218 0 55 / 50%)
  }
  .custom-checkbox .custom-control-input:active ~ .custom-control-label::before {
    background-color: rgb(218 0 55 / 50%);
  }
  /*.custom-checkbox .custom-control-input:checked:focus ~ .custom-control-label::before {
    box-shadow: 0 0 0 1px #fff, 0 0 0 0.2rem rgba(0, 255, 0, 0.25)
  }
  .custom-checkbox .custom-control-input:focus ~ .custom-control-label::before {
    box-shadow: 0 0 0 1px #fff, 0 0 0 0.2rem rgba(0, 0, 0, 0.25)
  }
  .custom-checkbox .custom-control-input:active ~ .custom-control-label::before {
    background-color: #C8FFC8; 
  }*/
</style>

<input type="hidden" name="id" id="idProductosFiltrados">
<!-- <button id="download_selected" class="btn btn-primary">Descargar seleccionados</button> -->

<table id="adjuntos" class="table">
  <thead class="text-center">
    <tr>
      <th class="d-none">ID</th>
      <th style="width: fit-content !important;">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="selectAll">
          <label class="custom-control-label" for="selectAll">Seleccionar todo</label>
        </div>
      </th>
      <th>Archivo</th>
      <th>Fecha y hora carga</th>
      <th>Fecha y hora descarga</th><?php
      $cantCols=3;
      if($_SESSION["rowUsers"]["tipo"]==1){
        $cantCols=4;?>
        <th style="width: 10%;">Acciones</th><?php
      }?>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="d-none"></td>
      <td colspan="<?=$cantCols?>" style="text-align:center">Cargando...</td>
    </tr>
  </tbody>
</table>

<!-- latest jquery-->
<script src="assets/js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap js-->
<script src="assets/js/bootstrap/popper.min.js"></script>
<script src="assets/js/bootstrap/bootstrap.js"></script>
<script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="assets\js\calendar\moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>


<script>

  var filasSeleccionadas = [];

  $(document).ready(function () {

    $('#selectAll').on('click', function () {
      var checkboxes = $('.check-row');
      //checkboxes.prop('checked', !checkboxes.prop('checked'));
      checkboxes.prop('checked', this.checked);
      if(this.checked==false){
        filasSeleccionadas=[];
      }
    });

    $(document).on('change', '.check-row', function() {
      let valor=this.value
      console.log(valor);
      if ($(this).is(':checked')) {
        filasSeleccionadas.push(valor);
      } else {
        var index = filasSeleccionadas.indexOf(valor);
        if (index > -1) {
          filasSeleccionadas.splice(index, 1);
        }
        let selectAll=$('#selectAll')
        if(selectAll.prop("checked",true)){
          selectAll.prop("checked",false)
        }
      }
    });

    // Función para manejar el evento de clic en el botón "Descargar seleccionados"
    $(document).on("click","#download_selected", function () {
      let selectedCheckboxes = $('#adjuntos').DataTable().column(1).nodes().to$().find(':checkbox:checked');
      let selectedFiles = [];

      /*
      // Obtener los nombres de archivo de los checkbox seleccionados
      selectedCheckboxes.each(function () {
        let fileName = $(this).closest('tr').find('.archivo_empresa').attr('download');
        selectedFiles.push(fileName);
      });

      // Verificar si se han seleccionado archivos
      if (selectedFiles.length === 0) {
        alert("No se han seleccionado archivos para descargar.");
        return;
      }

      // Crear un enlace oculto para descargar los archivos seleccionados
      let zip = new JSZip();
      let folder = zip.folder("archivos_seleccionados");

      // Agregar los archivos seleccionados al archivo ZIP
      selectedFiles.forEach(function (fileName) {
        let fileURL = "./views/archivos_empresas/" + id_empresa + "/" + fileName;
        console.log(fileURL);
        folder.file(fileName, fetch(fileURL).then(res => res.blob()));
      });*/

      // Verificar si se han seleccionado archivos
      if (selectedCheckboxes.length === 0) {
        alert("No se han seleccionado archivos para descargar.");
        return;
      }

      // Crear un enlace oculto para descargar los archivos seleccionados
      let zip = new JSZip();
      let folder = zip.folder("archivos_seleccionados");

      // Obtener los nombres de archivo de los checkbox seleccionados
      let aIdArchivos = []
      selectedCheckboxes.each(function () {
        //let fileName = $(this).closest('tr').find('.archivo_empresa').attr('download');
        let file = $(this).closest('tr').find('.archivo_empresa')
        let fileName = file.attr('download');
        let fileURL = file.attr('href');
        selectedFiles.push(fileName);
        folder.file(fileName, fetch(fileURL).then(res => res.blob()));

        let id_archivo = parseInt($(this).closest('tr').find('td:eq(0)').text());
        aIdArchivos.push(id_archivo)
      });

      // Agregar los archivos seleccionados al archivo ZIP
      /*selectedFiles.forEach(function (fileName) {
        let fileURL = "./views/archivos_empresas/" + id_empresa + "/" + fileName;
        console.log(fileURL);
        folder.file(fileName, fetch(fileURL).then(res => res.blob()));
      });*/
      //let id_archivo = this.getAttribute("data-id");
      let archivos=aIdArchivos.join(',')
      console.log("descargando");
      console.log(aIdArchivos);
      console.log(archivos);

      accion = "marcarArchivoDescargado";
      $.ajax({
        url: "models/administrar_empresas.php",
        type: "POST",
        datatype:"json",
        data:  {accion:accion, id_archivo:archivos},
        success: function() {
          //get_archivos(id_empresa)
        }
      });

      // Generar el archivo ZIP y descargar
      folder.generateAsync({ type: "blob" }).then(function (content) {
        let zipBlob = new Blob([content]);
        let zipURL = window.URL.createObjectURL(zipBlob);
        let a = document.createElement('a');
        a.href = zipURL;
        a.download = "archivos_seleccionados.zip";
        a.style.display = 'none';
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(zipURL);
      });
    });

    /*$('#adjuntos').on('page.dt', function() {
      //$('#selectAll').prop("checked",false)
      //$('.check-row').prop('checked', false);
      //filasSeleccionadas = [];
      console.log("page");
    });

    $('#adjuntos').on('draw.dt', function() {
      //$('#selectAll').prop("checked",false)
      //$('.check-row').prop('checked', false);
      //filasSeleccionadas = [];
      console.log("draw");
      var checkboxes = $('.check-row');
      var selectAll = $('#selectAll');
      checkboxes.each(function() {
        var valor = $(this).val();
        if (filasSeleccionadas.includes(valor) || selectAll.prop("checked")) {
          $(this).prop('checked', true);
        } else {
          $(this).prop('checked', false);
        }
      });
    });*/
  });

  function get_archivos(id_empresa){
    let urlDirectorio = "./views/archivos_empresas/"+id_empresa+"/";
    let accion = "trerArchivosEmpresa";
    let tipo_usuario=$("#tipo_usuario").html();
    $.ajax({
      url: "models/administrar_empresas.php",
      type: "POST",
      datatype:"json",
      data:  {accion:accion, id_empresa:id_empresa},
      success: function(response) {
        let respuestaJson = JSON.parse(response);
        //console.log(respuestaJson);

        let tableAdjuntos = $('#adjuntos');
        tableAdjuntos.find("tbody").empty();

        tableAdjuntos.DataTable().destroy();
        tableAdjuntos.DataTable({
          "language":  idiomaEsp,
          "data": respuestaJson,
          "paging":false,
          //"dom": '<"top"f>rt<"bottom"ip><"clear">',
          "dom": '<"top"f>rti<"clear">',
          "columns":[
            {"data": "id_archivo_usuario","class":"d-none"},{render: function(data, type, full, meta) {
              return `
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input check-row" id="check_${full.id_archivo_usuario}">
                <label class="custom-control-label" for="check_${full.id_archivo_usuario}"></label>
              </div>`;
            }},
            //{"data": "archivo"},
            {render: function(data, type, full, meta) {
              return `
              <a class="archivo_empresa" download="${full.archivo}" href="${urlDirectorio+full.archivo}">
                <i class="fa fa-download" aria-hidden="true"></i> ${full.archivo}
              </a>`;
            }},
            {render: function(data, type, full, meta) {
              return ()=>{
                if(type=="display"){
                  return moment(full.fecha_hora_subida).format('DD MMM YYYY HH:mm');;
                }else{
                  return full.fecha_hora_subida;
                }
              }
            },"class":"w-20"},
            {render: function(data, type, full, meta) {
              return ()=>{
                if(full.fecha_hora_bajada==""){
                  return full.fecha_hora_bajada;
                }else{
                  if(type=="display"){
                    return moment(full.fecha_hora_bajada).format('DD MMM YYYY HH:mm');;
                  }else{
                    return full.fecha_hora_bajada;
                  }
                }
              }
            },"class":"w-20"},<?php
            if($_SESSION["rowUsers"]["tipo"]==1){?>
              {render: function(data, type, full, meta) {
                return `
                <a class='btn btn-outline-danger btnBorrarFoto text-danger' data-id="${full.id_archivo_usuario}" data-name="${full.archivo}"><i class='fa fa-trash-o'></i></a>`;
              }},<?php
            }?>
          ],
          columnDefs: [
            //{ targets: [0], visible: false},
            { targets: [1], className: "text-center", searchable: false, orderable: false,},
            { targets: [2], className: "w-40"},
            { targets: [3], type: 'datetime'},
            { targets: [4], type: 'datetime'},<?php
            if($_SESSION["rowUsers"]["tipo"]==1){?>
              { targets: [5], className: "w-10"}<?php
            }?>
          ],
          initComplete: function(settings, json){
            //console.log(json.idProductosFiltered);
            $('#selectAll').prop("checked",false)
            //$("#idProductosFiltrados").val(json.idProductosFiltered)
            //$('.top').append($("#download_selected"));
            $('.top').append('<button id="download_selected" type="button" class="btn btn-primary">Descargar seleccionados</button>');
          }
        });
      }
    });
  }


</script>