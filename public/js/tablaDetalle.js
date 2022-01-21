$(document).ready(function() {
    $('#tablaDetalle').DataTable({
        "aaSorting":[],
        "language":{
            "info":"_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next":"Siguiente",
                "previous":"Anterior"
            },
            "lengthMenu":'Mostrar <select>'+
                '<option value="5">5</option>'+
                '<option value="10">10</option>'+
                '<select> registros',
            "loadingRecords":"Cargando...",
            "processing":"Procesando...",
            "emptyTable":"No hay datos",
            "zeroRecords":"No hay coincidencias",
            "infoEmpty":"",
            "infoFiltered":""

        },
        "pageLength" : 5,
        "lengthMenu": "[[5, 10], [5, 10]]"
    });
    cambiar_color_over(celda);
} );

function cambiar_color_over(celda){
celda.style.backgroundColor="#A7A7A7"
}
function cambiar_color_out(celda){
celda.style.backgroundColor="#FFFFFF"


}
