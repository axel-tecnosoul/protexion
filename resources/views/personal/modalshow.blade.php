
{{--ventanita modal cuando se haga clic en eliminar--}}


<div class="modal fade modal-slide-in-right"
    aria-hidden="true"
    role="dialog"
    tabindex="-1"
    id="modal-show-{{$personal->id}}">



    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-user" aria-hidden="true"></i> {{ $personal->puesto->nombre }} <br> {{ $personal->nombreCompleto() }}</h3>
                
                <div class="modal-body">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Apellido y Nombre</th>
                                <td>{{ $personal->nombreCompleto() }}</td>
                            </tr>
                            <tr>
                                <th>Documento</th>
                                <td><p >{{  number_format( (intval($personal->documento)/1000), 3, '.', '.') }}</p></td>
                            </tr>
                            <tr>
                                <th>Sexo</th>
                                <td>{{ $personal->sexo->definicion }}</td>
                            </tr>

                            <tr>
                                <th>Fecha de nacimiento</th>
                                <td>{{Carbon\Carbon::parse($personal->fecha_nacimiento)->format('d/m/Y') }} ({{Carbon\Carbon::parse($personal->fecha_nacimiento)->age }} años)</td>

                            </tr>

                        </thead>

                    </table>
                </div>
            </div>
        </div>

    </div>


</div>

