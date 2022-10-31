<table id="adjuntos" class="table">
  <thead class="text-center">
    <th class="d-none">ID</th>
    <th>Archivo</th>
    <th>Fecha y hora carga</th>
    <th>Fecha y hora descarga</th><?php
    if($_SESSION["rowUsers"]["tipo"]==1){?>
      <th>Acciones</th><?php
    }?>
  </thead>
  <tbody></tbody>
</table>

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
        let divAdjuntos=tableAdjuntos.find("tbody");

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
        divAdjuntos.html(divImagen);
      }
    });
  }
</script>