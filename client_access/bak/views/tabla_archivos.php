<style>
  .w-40{
    width:40%;
    word-break: break-all;
  }
  .w-25{
    width: 25%;
  }
  .w-10{
    width: 25%;
  }
</style>
<table id="adjuntos" class="table">
  <thead class="text-center">
    <th class="d-none">ID</th>
    <th>Archivo</th>
    <th>Fecha y hora carga</th>
    <th>Fecha y hora descarga</th><?php
    if($_SESSION["rowUsers"]["tipo"]==1){?>
      <th style="width: 10%;">Acciones</th><?php
    }?>
  </thead>
  <tbody></tbody>
</table>

<!-- latest jquery-->
<script src="assets/js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap js-->
<script src="assets/js/bootstrap/popper.min.js"></script>
<script src="assets/js/bootstrap/bootstrap.js"></script>
<script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="assets\js\calendar\moment.min.js"></script>

<script>
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
        console.log(respuestaJson);

        let tableAdjuntos = $('#adjuntos');

        /*let divAdjuntos=tableAdjuntos.find("tbody");

        let divImagen="";
        respuestaJson.forEach((archivos)=>{
          divImagen+= `
            <tr>
              <td class="d-none">${archivos.id_archivo_usuario}</td>
              <td style="width:40%;word-break: break-all;"><a class="archivo_empresa" download="${archivos.archivo}" href="${urlDirectorio+archivos.archivo}"><i class="fa fa-download" aria-hidden="true"></i> ${archivos.archivo}</a></td>
              <td style="width:25%">${archivos.fecha_hora_subida}</td>
              <td style="width:25%">${archivos.fecha_hora_bajada}</td>`
            if(tipo_usuario==1){
              divImagen+= `
                <td style="width:10%"><a class='btn btn-outline-danger btnBorrarFoto text-danger' data-id="${archivos.id_archivo_usuario}" data-name="${archivos.archivo}"><i class='fa fa-trash-o'></i></a></td>`
            }
          divImagen+=`</tr>`;
        })
        if(respuestaJson.length==0){
          divImagen+= `
            <tr class="text-center">
              <td colspan="4">No hay registros</td>
            </tr>`;
        }
        divAdjuntos.html(divImagen);*/

        tableAdjuntos.DataTable().destroy();
        tableAdjuntos.DataTable({
          "language":  idiomaEsp,
          "data": respuestaJson,
          "columns":[
            {"data": "id_archivo_usuario","class":"d-none"},
            //{"data": "archivo"},
            {render: function(data, type, full, meta) {
              return `
              <a class="archivo_empresa" download="${full.archivo}" href="${urlDirectorio+full.archivo}">
                <i class="fa fa-download" aria-hidden="true"></i> ${full.archivo}
              </a>`;
            }},
            //{"data": "fecha_hora_subida","class":"w-25"},
            {render: function(data, type, full, meta) {
              return ()=>{
                if(type=="display"){
                  return moment(full.fecha_hora_subida).format('DD MMM YYYY HH:mm');;
                }else{
                  return full.fecha_hora_subida;
                }
              }
            },"class":"w-25"},
            //{"data": "fecha_hora_bajada","class":"w-25"},
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
            },"class":"w-25"},<?php
            
            if($_SESSION["rowUsers"]["tipo"]==1){?>
              {render: function(data, type, full, meta) {
                return `
                <a class='btn btn-outline-danger btnBorrarFoto text-danger' data-id="${full.id_archivo_usuario}" data-name="${full.archivo}"><i class='fa fa-trash-o'></i></a>`;
              }},<?php
            }?>

          ],
          columnDefs: [
            //{ targets: [0], visible: false},
            { targets: [1], className: "w-40"},
            { targets: [2], type: 'datetime'},
            { targets: [3], type: 'datetime'},<?php
            
            if($_SESSION["rowUsers"]["tipo"]==1){?>
            
              { targets: [4], className: "w-10"}<?php
            
            }?>
          ]
        });
      }
    });
  }

</script>