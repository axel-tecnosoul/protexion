{{--ventanita modal cuando se haga clic en eliminar--}}

<div class="modal fade modal-slide-in-right"
    aria-hidden="true"
    role="dialog"
    tabindex="-1"
    id="modal-dni-encontrado">

    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h3 class="modal-title">Atencion, el documento ya existe!</h3>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Apellido y Nombre</th>
                            <td id="modal_apellido_nombre"></td>
                        </tr>
                        <tr>
                            <th>Documento</th>
                            <td id="modal_documento"></td>
                        </tr>
                        <tr>
                            <th>Sexo</th>
                            <td id="modal_sexo"></td>
                        </tr>
                        <tr>
                            <th>Domicilio</th>
                            <td id="modal_domicilio"></td>
                        </tr>
                        <tr>
                            <th>Fecha de nacimiento</th>
                            <td id="modal_fecha_nacimiento"></td>
                        </tr>
                        <tr>
                            <th>Cuit</th>
                            <td id="modal_cuit"></td>
                        </tr>
                        <tr>
                            <th>Estado civil</th>
                            <td id="modal_estado_civil"></td>
                        </tr>
                        <tr>
                            <th>Anulado</th>
                            <td id="modal_anulado"></td>
                        </tr>
                    </thead>

                </table>
            </div>

            <div class="modal-footer">
                <a id="modal_button" href="{{URL::action('PacienteController@edit',1)}}" class="btn fondo2">Continuar con este Paciente -></a>
            </div>
        </div>
    </div>
</div>

