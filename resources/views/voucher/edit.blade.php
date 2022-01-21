@extends('layouts.admin')

@section('titulo')
<div class="box-header" style="text-align:center">
    <a href="{{ asset('user') }}">
        <button title="atras" class="btn btn-default btn-responsive pull-left">
            <i class="fa fa-arrow-left"></i> Atras
        </button>
    </a>
</div>
@endsection

@section('content')

    {!!Form::model($user, [
        'method'=>'PATCH',
        'route'=>['user.update',$user->id]
    ])!!}


    {{Form::token()}}
    <div class="box-body">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:#D2D6DE">
            @include('errors.request')
            @include('user.mensaje')
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title" >
                        <i class="fa fa-id-card" aria-hidden="true"></i> Editar una persona
                    </h4>
                </div>
                <div class="box-body">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="apellido">
                                    Apellido
                            </label>
                            <input
                                type="string"
                                name="apellido"
                                value="{{ $user->apellido }}"
                                class="form-control"
                                title="apellido de la persona"
                                >
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="name">
                                    Nombres
                            </label>
                            <input
                                type="string"
                                name="name"
                                value="{{ $user->name }}"
                                class="form-control"
                                title="nombre de la persona"
                                >
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="dni">
                                Documento
                            </label>
                            <input
                                type="integer"
                                name="dni"
                                value="{{ $user->dni }}"
                                class="form-control"
                                title="documento de la persona"
                                >
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="domicilio">
                                    Domicilio
                            </label>
                            <input
                                type="string"
                                name="domicilio"
                                value="{{ $user->domicilio }}"
                                class="form-control"
                                title="domicilio de la persona"
                                >
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="sexo_id">
                                Sexo
                            </label>
                            <select
                                id="sexo_id"
                                name="sexo_id"
                                class="form-control">
                                    @foreach ($sexo as $s)
                                        @if ($s->id==$user->sexo_id)
                                            <option value="{{$s->id}}" selected>{{$s->descripcion}}</option>
                                        @else
                                             <option value="{{$s->id}}">{{$s->descripcion}}</option>
                                        @endif
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="telefono">
                                Teléfono
                            </label>
                            <input
                                type="string"
                                name="telefono"
                                value="{{ $user->telefono }}"
                                class="form-control"
                                title="número de telefono de la persona"
                                >
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="fecha_nac">
                                    Fecha de nacimiento
                            </label>
                            <input
                                type="date"
                                name="fecha_nac"
                                value="{{ $user->fecha_nac }}"
                                class="form-control"
                                title="fecha de nacimiento de la persona"
                                >
                        </div>
                    </div>



                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="cuit">
                                    Cuit
                            </label>
                            <input
                                type="text"
                                name="cuit"
                                value="{{ $user->cuit }}"
                                class="form-control"
                                title="cuit de la persona"
                                >
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="email">
                                Correo electónico
                            </label>
                            <input
                                type="string"
                                name="email"
                                value="{{ $user->email }}"
                                class="form-control"
                                title="correo de la persona"
                                >
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="password">
                                Contraseña
                            </label>
                            <input
                                type="password"
                                name="password"
                                value="{{ $user->password }}"
                                class="form-control"
                                title="contraseña de la persona"
                                >
                        </div>
                    </div>



                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label>

                            </label>
                            <br>
                            <button title="Guardar" class="btn btn-danger btn-responsive" type="submit"> <i class="fa fa-check"></i> Guardar</button>
                            <button title="Limpiar" class="btn btn-secondary btn-responsive" type="reset"><i class="fa fa-remove"></i> Cancelar</button>
                        </div>
                    </div>

                 </div>
                </div>
            </div>
        </div>
        {!!Form::close()!!}




    @endsection
