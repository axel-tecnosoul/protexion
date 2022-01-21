

<div class="modal fade bs-example-modal-lg"
     aria-labelledby="classInfo"
     aria-hidden="true"
     role="dialog"
     tabindex="-1"
     enctype="multipart/form-data"
     id="modal-show-{{$declaracion_jurada->id}}">


    <div class="modal-dialog modal-lg">
        <!--contenido del modal-->
        <div class="modal-content">
            <!-- cabecera del modal -->
            <div class="modal-header" style="background-color:#222D32">
                <h4 class="modal-title" style="color:#FFFFFF">Detalle de la Declaración Jurada <b>Nro {{ $declaracion_jurada->codigo }}</b></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" ><i class="fa fa-close" style="color:#FFFFFF"></i></span>
                </button>
            </div>
            <!--cuerpo del modal-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <p style="font-size:100%">
                            <b>Fecha de declaración jurada:</b> {{Carbon\Carbon::parse($declaracion_jurada->fecha)->format('d/m/Y') . " - "}}
                            <b>Paciente:</b> {{ $declaracion_jurada->paciente->apellidos . " " . $declaracion_jurada->paciente->nombres . " " . $declaracion_jurada->paciente->documento}}
                        </p>
                        <table id="total_records{{$declaracion_jurada->id}}" class="table table-condensed table-striped table-hover responsive table-responsive">
                            <thead>
                                <tr>
                                    <th>Pregunta</th>
                                    <th>Respuesta</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($declaracion_jurada->detalleDeclaraciones as $detalle)
                                    <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                                        <td>{{ $detalle->respuesta->pregunta->pregunta }}</td>
                                        <td>{{ $detalle->respuesta->antecedente }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('imagenes/paciente/'.$declaracion_jurada->paciente->foto)}}" class="img-fluid" alt="sin imagen de perfil">
                    </div>
                </div>
            </div>
           <!--pie del modal-->
            <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-responsive" data-dismiss="modal">
                        <i class="fa fa-close"> </i>Cerrar
                    </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#total_records{{$declaracion_jurada->id}}").DataTable({

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
            "bDestroy": true,
            "pageLength" : 5,
            "lengthMenu": "[[5, 10], [5, 10]]"
        });

    } );
</script>
