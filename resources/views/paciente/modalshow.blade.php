{{--ventanita modal cuando se haga clic en eliminar--}}


<div class="modal fade modal-slide-in-right"
    aria-hidden="true"
    role="dialog"
    tabindex="-1"
    id="modal-show-{{$paciente->id}}">



    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-user" aria-hidden="true"></i> Paciente <br> {{ $paciente->nombreCompleto() }}
                <hr><i class="fa fa-industry" aria-hidden="true"></i>
                        <?php if($paciente->origen == null)
                            echo(" ");
                        else echo($paciente->origen->definicion)?>
                 <hr>
                 @if($paciente->imagen == null)
                    <img src="{{ asset('imagenes/paciente/default.png')}}" width="150px" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('imagenes/paciente/'.$paciente->imagen)}}" width="150px" class="img-circle elevation-2" alt="User Image">
                @endif</h3>
                <div class="modal-body">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Apellido y Nombre</th>
                                <td>{{ $paciente->nombreCompleto() }}</td>
                            </tr>
                            <tr>
                                <th>Documento</th>
                                <td><?php if($paciente->documento == null)
                                        echo(" ");
                                    else echo($paciente->documentoIdentidad())?></td>
                            </tr>
                            <tr>
                                <th>Sexo</th>
                                <td><?php if($paciente->sexo == null)
                                        echo(" ");
                                    else echo($paciente->sexo->definicion)?></td>
                            </tr>
                            <tr>
                                <th>Domicilio</th>
                                <td><?php if($paciente->domicilio == null)
                                        echo(" ");
                                    else echo($paciente->direccion())?></td>

                            </tr>
                            <tr>
                                <th>Fecha de nacimiento</th>
                                <td>{{Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }} ({{Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años)</td>

                            </tr>
                            <tr>
                                <th>Cuit</th>
                                <td>{{ $paciente->cuil }}</td>
                            </tr>
                            <tr>
                                <th>Obra Social</th>
                                <td><?php if($paciente->obraSocial == null)
                                        echo(" ");
                                    else echo($paciente->obraSocial->obraSocialCompleta())?></td>
                            </tr>
                            <tr>
                                <th>Peso</th>
                                <td>{{ $paciente->peso }} Kgrs</td>
                            </tr>
                            <tr>
                                <th>Estatura</th>
                                <td>{{ $paciente->estatura }} Mts</td>
                            </tr>
                            <tr>
                                <th>Estado civil</th>
                                <td><?php if($paciente->estadoCivil == null)
                                            echo(" ");
                                        else echo($paciente->estadoCivil->definicion)?></td>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>

    </div>


</div>

