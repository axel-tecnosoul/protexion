$(document).ready(function() {
    $('#tablaDetalle').DataTable({
        "pageLength" : 25,
        //"lengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]]
        //"lengthMenu": [5, 10, 25, 50, 100],
        "lengthMenu": [ 10, 25, 50, 75, 100 ],
        "aaSorting":[],
        "language":{
            "info":"_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next":"Siguiente",
                "previous":"Anterior"
            },
            /*"lengthMenu":'Mostrar <select>'+
                '<option value="5">5</option>'+
                '<option value="10">10</option>'+
                '<select> registros',*/
            "loadingRecords":"Cargando...",
            "processing":"Procesando...",
            "emptyTable":"No hay datos",
            "zeroRecords":"No hay coincidencias",
            "infoEmpty":"",
            "infoFiltered":""

        }
    });
    cambiar_color_over(celda);
} );

function cambiar_color_over(celda){
  celda.style.backgroundColor="#A7A7A7"
}
function cambiar_color_out(celda){
  celda.style.backgroundColor="#FFFFFF"
}
