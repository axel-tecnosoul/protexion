@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/paciente">Indice de Pacientes</a></li>
    <li class="breadcrumb-item active">Editar Paciente</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        @include('errors.request')
        @include('paciente.mensaje')
        
        {!!Form::model($paciente, [
            'method'=>'PATCH',
            'route'=>['paciente.update',$paciente->id]
        ])!!}        

        {{Form::token()}}

        <div class="card card-dark">
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-user" aria-hidden="true"></i> Editar Paciente</p>
                </div>
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="nombres">
                                        Nombres
                                </label>
                                <input
                                    type="string"
                                    name="nombres"
                                    value="{{ $paciente->nombres }}"
                                    class="form-control"
                                    title="nombre del paciente"
                                    onkeypress="return soloLetras(event)"
                                    required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="apellidos">
                                        Apellido
                                </label>
                                <input
                                    type="string"
                                    name="apellidos"
                                    value="{{ $paciente->apellidos }}"
                                    class="form-control"
                                    title="apellidos del paciente"
                                    onkeypress="return soloLetras(event)"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="documento">
                                    Documento
                                </label>
                                <input
                                    type="integer"
                                    name="documento"
                                    id="documento"
                                    value="{{ $paciente->documento }}"
                                    class="form-control"
                                    title="documento del paciente"
                                    onkeypress="return soloNumeros(event)"
                                    required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="fecha_nacimiento">
                                        Fecha de nacimiento
                                </label>
                                <input
                                    type="date"
                                    name="fecha_nacimiento"
                                    value="{{ $paciente->fecha_nacimiento }}"
                                    class="form-control"
                                    title="fecha de nacimiento de la persona"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="cuil">
                                    Cuil
                                </label>
                                <input
                                    type="text"
                                    name="cuil"
                                    value="{{ $paciente->cuil }}"
                                    class="form-control"
                                    title="fcuil del paciente"
                                    >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="telefono">
                                    Teléfono
                                </label>
                                <input
                                    type="string"
                                    name="telefono"
                                    value="{{ $paciente->telefono }}"
                                    class="form-control"
                                    title="número de telefono de la persona"
                                    onkeypress="return soloNumeros(event)"
                                    >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>
                                    Género
                                </label>
                                <select
                                    id="sexo_id"
                                    name="sexo_id"
                                    class="form-control">
                                    <option
                                        value="0"
                                        disabled="true"
                                        selected="true"
                                        title="Seleccione un género"
                                        >
                                        -Seleccione un género-
                                    </option>
                                        @foreach ($sexos as $sexo)
                                            @if ($paciente->sexo != null)
                                                @if ($sexo->id==$paciente->sexo_id)
                                                        <option value="{{$sexo->id}}" selected>{{$sexo->definicion}}</option> 
                                                @else
                                                        <option value="{{$sexo->id}}">{{$sexo->definicion}}</option>                                                
                                                @endif
                                            @else
                                                <option value="{{$sexo->id}}">{{$sexo->definicion}}</option> 
                                            @endif
                                                
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="estado_civil_id">
                                    Estado Civil
                                </label>
                                <select
                                    id="estado_civil_id"
                                    name="estado_civil_id"
                                    class="form-control">
                                    <option
                                        value="0"
                                        disabled="true"
                                        selected="true"
                                        title="Seleccione un estado civil"
                                        >
                                        -Seleccione un estado civil-
                                    </option>
                                        @foreach ($estado_civiles as $estado_civil)
                                            @if ($paciente->estadoCivil != null)
                                                @if ($estado_civil->id==$paciente->estado_civil)
                                                    <option value="{{$estado_civil->id}}" selected>{{$estado_civil->definicion}}</option>
                                                @else
                                                    <option value="{{$estado_civil->id}}">{{$estado_civil->definicion}}</option>
                                                @endif
                                            @else
                                                <option value="{{$estado_civil->id}}">{{$estado_civil->definicion}}</option>
                                            @endif
                                            
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="foto de perfil">
                            Foto de Perfil
                        </label>
                        <input
                            type="file"
                            name="imagen"
                            value="{{old('imagen')}}"
                            class="form-control"
                            >
                    </div>
                </div>               
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="card card-dark">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card-body">
                    
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="origen_id">
                            Procedencia
                        </label>
                        <select
                            id="origen_id"
                            name="origen_id"
                            class="form-control">
                            <option
                                value="0"
                                disabled="true"
                                selected="true"
                                title="Seleccione una procedencia"
                                >
                                -Seleccione una procedencia-
                            </option>
                                @foreach ($origenes as $origen)
                                    @if ($origen->id==$paciente->origen_id)
                                        <option value="{{$origen->id}}" selected>{{$origen->definicion}}</option>
                                    @else
                                        <option value="{{$origen->id}}">{{$origen->definicion}}</option>
                                    @endif
                                @endforeach
                        </select>
                        <a data-keyboard="false" data-target="#modal-agregarOrigen" data-toggle="modal">
                            <button title="agregar obra social" class="btn btn-dark btn-md">
                                <i class="fa fa-plus"></i>
                            </button>
                        </a>
                        @include('origen.modalAgregarOrigen')
                    </div>
                </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>
                                Obra social
                            </label>
                            <select
                                id="obra_social_id"
                                name="obra_social_id"
                                class="form-control">
                                <option
                                value="0"
                                disabled="true"
                                selected="true"
                                title="Seleccione una obra social"
                                >
                                -Seleccione una obra social-
                            </option>
                                    @foreach ($obra_sociales as $obra_social)
                                    @if ($paciente->obra_social != null)
                                        @if ($obra_social->id==$paciente->obra_social_id)
                                            <option value="{{$obra_social->id}}" selected>{{$obra_social->definicion}}</option> 
                                        @else
                                            <option value="{{$obra_social->id}}">{{$obra_social->definicion}}</option>                                                
                                        @endif
                                    @else
                                        <option value="{{$obra_social->id}}">{{$obra_social->definicion}}</option>
                                    @endif
                                        
                                    @endforeach
                            </select>
                            <a data-keyboard="false" data-target="#modal-agregarObraSocial" data-toggle="modal">
                                <button title="agregar obra social" class="btn btn-dark btn-md">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </a>
                            @include('obra_social.modalAgregarObraSocial')
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label>País</label>
                        <select
                            name="pais_id"
                            id="pais_id"
                            class="pais_id custom-select"
                            style="width:50%"
                            >
                            <option
                                value="0"
                                disabled="true"
                                selected="true"
                                title="Seleccione un pais"
                                >
                                -Seleccione un pais-
                            </option>
                            @foreach($paises as $pais)
                                @if ($paciente->domicilio != null)
                                        @if (old('paises', $paciente->domicilio->ciudad->provincia->pais_id)== $pais->id)
                                            <option value="{{$pais->id}}" selected>
                                                {{$pais->nombre}}
                                            </option>
                                        @else
                                            <option value="{{$pais->id}}">
                                                {{$pais->nombre}}
                                            </option>
                                        @endif
                                    @elseif ($paciente->domicilio == null)
                                        <option value="{{$pais->id}}">
                                            {{$pais->nombre}}
                                        </option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        <label>Provincia</label>
                        <select
                            name="provincia_id"
                            id="provincia_id"
                            class="provincia_id custom-select"
                            style="width:50%"

                            >
                            <option
                                value="0"
                                disabled="true"
                                selected="true"
                                title="Seleccione una provincia"
                                >
                                -Seleccione una provincia-
                            </option>
                            @foreach($provincias as $provincia) 
                                @if ($paciente->domicilio != null)
                                    @if (old('provincias', $paciente->domicilio->ciudad->provincia_id)== $provincia->id)
                                        <option value="{{$provincia->id}}" selected>
                                            {{$provincia->nombre}}
                                        </option>
                                    @else
                                        <option value="{{$provincia->id}}">
                                            {{$provincia->nombre}}
                                        </option>
                                    @endif
                                @elseif ($paciente->domicilio == null)
                                    <option value="{{$provincia->id}}">
                                        {{$provincia->nombre}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        <label>Ciudad</label>
                        <select
                            name="ciudad_id"
                            id="ciudad_id"
                            class="ciudad_id custom-select"
                            style="width:50%"

                            >
                            <option
                                value="0"
                                disabled="true"
                                selected="true"
                                title="Seleccione una ciudad"
                                >
                                -Seleccione una ciudad-
                            </option>
                            @foreach($ciudades as $ciudad)
                                @if ($paciente->domicilio != null)
                                        @if (old('ciudades', $paciente->domicilio->ciudad_id)== $ciudad->id)
                                            <option value="{{$ciudad->id}}" selected>
                                                {{$ciudad->nombre}}
                                            </option>
                                        @else
                                            <option value="{{$ciudad->id}}">
                                                {{$ciudad->nombre}}
                                            </option>
                                        @endif
                                    @elseif ($paciente->domicilio == null)
                                        <option value="{{$ciudad->id}}">
                                            {{$ciudad->nombre}}
                                        </option>
                                @endif
                                
                            @endforeach
                        </select>
                        <br>
                        <br>
                    </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="direccion">
                                            Direccion
                                        </label>
                                        <input
                                            type="string"
                                            name="direccion"
                                            @if ($paciente->domicilio)
                                                value="{{ $paciente->domicilio->direccion }}"
                                            @endif
                                            class="form-control"
                                            placeholder="Introduzca la direccion"
                                            title="Introduzca la direccion">
                                    </div>
                                </div>
                                
                        </div>
                    </div>



                   

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
            <a href="/paciente">
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

            var select2 = $("#obra_social_id").select2({width:'90%'});
            select2.data('select2').$selection.css('height', '100%');

            var select3 = $("#origen_id").select2({width:'90%'});
            select3.data('select2').$selection.css('height', '100%');

            var select5 = $("#estado_civil_id").select2({width:'100%'});
            select5.data('select2').$selection.css('height', '100%');

            var select7 = $("#pais_id").select2({width:'100%'});
            select7.data('select2').$selection.css('height', '100%');

            var select8 = $("#provincia_id").select2({width:'100%'});
            select8.data('select2').$selection.css('height', '100%');

            var select9 = $("#ciudad_id").select2({width:'100%'});
            select9.data('select2').$selection.css('height', '100%');

            $(document).on('change','.pais_id',function(){
                var pais_id=$(this).val();
                var div=$(this).parent();
                var op=" ";

                $.ajax({
                    type:'get',
                    url:'{!!URL::to('paciente/create/encontrarProvincia')!!}',
                    data:{'id':pais_id},
                    success:function(data){
                        op+='<option value="0" selected disabled>-Seleccione una provincia-</option>';
                        for(var i=0;i<data.length;i++){
                            op+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                        }
                        div.find('.provincia_id').html(" ");
                        div.find('.provincia_id').append(op);
                    },
                    error:function(){
                    }
                });
            });


            $(document).on('change','.provincia_id',function(){
                var provincia_id=$(this).val();
                var div=$(this).parent();
                var op=" ";



                $.ajax({
                    type:'get',
                    url:'{!!URL::to('paciente/create/encontrarCiudad')!!}',
                    data:{'id':provincia_id},
                    success:function(data){
                        op+='<option value="0" selected disabled>-Seleccione una ciudad-</option>';
                        for(var i=0;i<data.length;i++){
                            op+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                        }
                        div.find('.ciudad_id').html(" ");
                        div.find('.ciudad_id').append(op);
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

