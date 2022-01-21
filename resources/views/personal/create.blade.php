@extends('layouts.admin')
<!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/personal">Indice de Personal</a></li>
    <li class="breadcrumb-item active">Crear Personal</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        @include('errors.request')
        @include('personal.mensaje')
        {!!Form::open(array('url'=>'personal','method'=>'POST','autocomplete'=>'off','files' => true,))!!}
        {{Form::token()}}

        <div class="card card-dark">
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-user" aria-hidden="true"></i> Datos del Personal</p>
                </div>
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="nombres"> Nombres</label>
                        <input
                            type="string"
                            name="nombres"
                            maxlength="30"
                            value="{{old('nombres')}}"
                            class="form-control"
                            placeholder="Ingrese el nombre..."
                            title="Introduzca un nombre"
                            onkeypress="return soloLetras(event)"
                            required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input
                            type="string"
                            name="apellidos"
                            maxlength="30"
                            value="{{old('apellidos')}}"
                            class="form-control"
                            placeholder="Ingrese el apellido..."
                            title="Introduzca el apellido"
                            onkeypress="return soloLetras(event)"
                            required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="documento">Documento</label>
                        <input
                            type="number"
                            name="documento"
                            id="documento"
                            value="{{old('documento')}}"
                            class="form-control"
                            placeholder="33.222.111"
                            title="Introduzca el documento"
                            onkeypress="return soloNumeros(event)">
                    </div>
                </div>
                <br>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input 
                                    type="date"
                                    name="fecha_nacimiento"
                                    value="{{old('fecha_nacimiento')}}"
                                    class="form-control"
                                    placeholder="dia/mes/año"
                                    title="Introduzca la fecha de nacimiento">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="sexo_id">Género</label>
                                <select name="sexo_id"id="sexo_id"class="sexo_id custom-select"required>
                                    <option value="0"disabled="true" selected="true"title="-Seleccione un género-">
                                        -Seleccione un género-
                                    </option>
                                    @foreach ($sexos as $sexo)
                                        <option
                                            value="{{$sexo->id }}">{{$sexo->definicion}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="card card-dark">
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Datos Laborales</p>
                </div>
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label> Puesto</label>
                            <select
                                name="puesto_id"
                                id="puesto_id"
                                class="puesto_id form-control"
                                required
                                >
                                <option
                                    value="0"
                                    disabled="true"
                                    selected="true"
                                    title="Seleccione un puesto"
                                    >
                                    -Seleccione un puesto-
                                </option>
                                @foreach ($puestos as $puesto)
                                    <option
                                        value="{{$puesto->id }}">
                                            {{$puesto->nombre}}
                                    </option>
                                @endforeach
                            </select>
                            <label>
                                Especialidad
                            </label>
                            <select
                                name="especialidad_id"
                                id="especialidad_id"
                                class="especialidad_id form-control"
                                required
                                >
                                <option
                                    value="0"
                                    disabled="true"
                                    selected="true"
                                    title="Seleccione una especialidad"
                                    >
                                    -Seleccione una especialidad
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="nro_matricula"> Matricula</label>
                            <input
                                type="string"
                                name="nro_matricula"
                                maxlength="30"
                                value="{{old('nro_matricula')}}"
                                class="form-control"
                                placeholder="Ingrese la matricula..."
                                title="Introduzca la matricula">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="foto">Firma</label>
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
                                <div id="preview"></div>
                            </div>

                        </div>
                    </div>
                    <input type="hidden" name="firma" id="firma">
                    
       
                            
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group" style="text-align:center">
        <a href="/personal">
            <button title="Cancelar" class="btn btn-secondary btn-lg" type="button"><i class="fas fa-arrow-left"></i> Cancelar</button>
        </a>
        <button title="Guardar" id="confirmar" class="btn btn-danger btn-lg" type="submit"> <i class="fa fa-check"></i> Guardar</button>
    </div>
</div>
    
</div>

{!!Form::close()!!}

    @push('scripts')
    <script type="text/javascript">

        $(document).ready(function(){


            var select1 = $("#sexo_id").select2({width:'100%'});
            select1.data('select2').$selection.css('height', '100%');

            var select2 = $("#puesto_id").select2({width:'100%'});
            select2.data('select2').$selection.css('height', '100%');

            var select3 = $("#especialidad_id").select2({width:'100%'});
            select3.data('select2').$selection.css('height', '100%');

            $(document).on('change','.puesto_id',function(){
                var puesto_id=$(this).val();
                var div=$(this).parent();
                var op=" ";

                $.ajax({
                    type:'get',
                    url:'{!!URL::to('personal/create/encontrarEspecialidad')!!}',
                    data:{'id':puesto_id},
                    success:function(data){
                        op+='<option value="0" selected disabled>-Seleccione una especialidad-</option>';
                        for(var i=0;i<data.length;i++){
                            op+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                        }
                        div.find('.especialidad_id').html(" ");
                        div.find('.especialidad_id').append(op);
                    },
                    error:function(){
                    }
                });
            });

            $('#documento').mask('00.000.000');

        });
</script>

<script>
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = [8, 37, 39, 46];
    
        tecla_especial = false
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }
    
        if(letras.indexOf(tecla) == -1 && !tecla_especial)
            return false;
    }
</script>

<script>
    function soloNumeros(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key);
        letras = " 1234567890";
        especiales = [8, 37, 39, 46];
    
        tecla_especial = false
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }
    
        if(letras.indexOf(tecla) == -1 && !tecla_especial)
            return false;
    }
</script>

@endpush

@endsection

