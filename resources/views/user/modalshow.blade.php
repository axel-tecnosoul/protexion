{{--ventanita modal cuando se haga clic en eliminar--}}


<div class="modal fade modal-slide-in-right"
    aria-hidden="true"
    role="dialog"
    tabindex="-1"
    id="modal-show-{{$user->id}}">



    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title"><i class="fa fa-user" aria-hidden="true"></i> Detalle del Usuario <br> {{ $user->name }}
                 <hr>
                 @if($user->foto == null)
                    <img src="{{ asset('imagenes/perfil/default.png')}}" width="150px" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('imagenes/perfil/'.$user->foto)}}" width="150px" class="img-circle elevation-2" alt="User Image">
                @endif</h3>
                <div class="modal-body">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Apellido</th>
                                <td>{{ $user->personal_clinica->apellidos }}</td>
                            </tr>
                            <tr>
                                <th>Nombres</th>
                                <td>{{ $user->personal_clinica->nombres }}</td>
                            </tr>
                            <tr>
                                <th>Documento</th>
                                <td>{{  number_format( (intval($user->personal_clinica->documento)/1000), 3, '.', '.') }}</td>
                            </tr>
                            <tr>
                                <th>E-mail</th>
                                <td>{{ $user->email }}</td>

                            </tr>
                            <tr>
                                <th>Fecha de nacimiento</th>
                                <td>{{Carbon\Carbon::parse($user->personal_clinica->fecha_nacimiento)->format('d/m/Y') }}</td>

                            </tr>                           

                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>

    </div>


</div>

