@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/user">Indice de Usuarios</a></li>
    <li class="breadcrumb-item active">Crear Usuarios</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        @include('errors.request')
        {!!Form::open(array('url'=>'user','method'=>'POST','autocomplete'=>'off','files' => true,))!!}
        {{Form::token()}}

        <div class="card card-dark">
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-user" aria-hidden="true"></i> Datos personales</p>
                </div>
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <select name="personal_clinica_id"id="personal_clinica_id"class="personal_clinica_id custom-select">
                            <option value="0"disabled="true"selected="true"title="-Seleccione una persona-">
                                -Seleccione una Persona-
                            </option>
                            @foreach ($personals as $personal)
                                <option value="{{$personal->id }}">{{$personal->documento . " " . $personal->nombreCompleto() }}</option>
                            @endforeach
                        </select>
                </div>
                <br><br>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card card-dark">
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-key" aria-hidden="true"></i> Perfil de Cuenta</p>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="name">
                                Nombre de Usuario
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                    <input
                                        type="string"
                                        name="name"
                                        maxlength="30"
                                        value="{{old('name')}}"
                                        class="form-control"
                                        placeholder="Ingrese el nombre de la cuenta..."
                                        title="Ingrese el nombre de la cuenta">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label for="email">
                            E-mail
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input
                                type="email"
                                name="email"
                                value="{{old('email')}}"
                                class="input-group form-control"
                                placeholder="uncorreo@mail.com..."
                                title="Introduzca un correo electrónico">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="password">
                                Contraseña
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input
                                    type="password"
                                    name="password"
                                    min="8"
                                    maxlength="13"
                                    value="{{old('password')}}"
                                    class="form-control"
                                    placeholder="********..."
                                    title="Introduzca una contraseña">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Confirmar Constraseña</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input
                                    id="password-confirm"
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    placeholder="********..."
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="foto">Foto de Perfil</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-file-image" aria-hidden="true"></i></span>
                            </div>
                            <input
                                id="file"
                                type="file"
                                name="foto"
                                class="form-control img-responsive">
                        </div>
                        <hr>
                        <div id="preview"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group" style="text-align:center">
            <label>

            </label>
            <br>
            <a href="/user">
                <button title="Cancelar" class="btn btn-secondary btn-lg" type="button"><i class="fas fa-arrow-left"></i> Cancelar</button>
            </a>
            <button title="Guardar" id="confirmar" class="btn btn-danger btn-lg" type="submit"> <i class="fa fa-check"></i> Guardar</button>
        </div>
    </div>
</div>

{!!Form::close()!!}

    @push('scripts')
    <script type="text/javascript">
        document.getElementById("file").onchange = function(e) {
            let reader = new FileReader();

            reader.onload = function(){
                let preview = document.getElementById('preview'),
                image = document.createElement('img');

                image.src = reader.result;

                preview.innerHTML = '';
                preview.append(image);
            };

            reader.readAsDataURL(e.target.files[0]);
        }

        $(document).ready(function(){
            var select1 = $("#personal_clinica_id").select2({width:'100%'});
            select1.data('select2').$selection.css('height', '34px');

           /* $("#persona_id").change(function(){
                mostrarDatos();
            });

            function mostrarDatos()
            {
                persona_id=$("#persona_id").val();
                personas=$("#persona_id option:selected").text();


                /*   Aca iría el Ajax para obtener la cantidad por Paquete*/
           /*     $.ajax({
                    type:'get',
                    url:'{!!URL::to('historia_clinica/create/traerDatospersona')!!}',
                    data:{'id':persona_id},
                    success:function(data){
                        documento=data['documento'];
                        nombres=data['nombres'];
                        apellidos=data['apellidos'];
                        fecha_nacimiento=data['fecha_nacimiento'];
                        sexo=data['sexo'];


                        var datospersona='<img class="img-thumbnail" height="85px" alt="sin imagen" width="85px" src='+foto+'><input type="hidden" name="stock" value="'+nombres+'"><p style="font-size:140%" class="text-left">'+nombres+'</p><input type="hidden" name="stock" value="'+apellidos+'"><p style="font-size:140%" class="text-left">'+apellidos+'</p><input type="hidden" name="stock" value="'+documento+'"><p style="font-size:140%" class="text-left">'+documento+'</p><input type="hidden" name="stock" value="'+fecha_nacimiento+'"><p style="font-size:140%" class="text-left">'+fecha_nacimiento+'</p><input type="hidden" name="stock" value="'+cuil+'"><p style="font-size:140%" class="text-left">'+cuil+'</p><input type="hidden" name="stock" value="'+peso+'"><p style="font-size:140%" class="text-left">'+peso+'</p><input type="hidden" name="stock" value="'+estatura+'"><p style="font-size:140%" class="text-left">'+estatura+'</p><input type="hidden" name="stock" value="'+empresa+'"><p style="font-size:140%" class="text-left">'+empresa+'</p><input type="hidden" name="stock" value="'+sexo+'"><p style="font-size:140%" class="text-left">'+sexo+'</p><input type="hidden" name="persona_id" value="'+persona_id+'">';
                        $("#datos_persona").append(datospersona);
                        eliminarDelSelect2 ();


                    },
                    error:function(){
                        console.log('no anda AJAX');
                    }
                });
                /*   Aca iría el Ajax para obtener el stock maximo y realizar el multiplicador*/

            /*}
                function eliminarDelSelect2 ()
                {
                    $("#persona_id option:selected").remove();

                }*/

        });

</script>
@endpush

@endsection

