@extends('layouts.admin')
<!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/paciente">Indice de Pacientes</a></li>
    <li class="breadcrumb-item active">Crear Paciente</li>
    <style>
      .loader{
        /*width: 100px;
        height: 100px;*/
        border-radius: 100%;
        position: relative;
        /*margin: 0 auto;*/
        display: inline-block;
        margin-left: 10px;
      }

      /* LOADER 4 */
      #loader-4 span{
        display: inline-block;
        /*width: 20px;
        height: 20px;*/
        width: 8px;
        height: 8px;
        border-radius: 100%;
        background-color: #dc3545;
        /*margin: 35px 5px;*/
        opacity: 0;
      }

      #loader-4 span:nth-child(1){
        animation: opacitychange 1s ease-in-out infinite;
      }

      #loader-4 span:nth-child(2){
        animation: opacitychange 1s ease-in-out 0.33s infinite;
      }

      #loader-4 span:nth-child(3){
        animation: opacitychange 1s ease-in-out 0.66s infinite;
      }

      @keyframes opacitychange{
        0%, 100%{
          opacity: 0;
        }

        60%{
          opacity: 1;
        }
      }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        @include('errors.request')
        @include('paciente.mensaje')
        {!!Form::open(array('url'=>'paciente','method'=>'POST','autocomplete'=>'off','files' => true,))!!}
        {{Form::token()}}

        <div class="card card-dark">
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-user" aria-hidden="true"></i> Datos del Paciente</p>
                </div>
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="apellidos">
                                        Apellidos
                                </label>
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
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="nombres">
                                        Nombres
                                </label>
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
                       
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="documento">
                                  Documento
                                  <div class="loader d-none" id="loader-4">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                  </div>
                                </label>
                                <input type="number"name="documento"id="documento"value="{{old('documento')}}"class="form-control"
                                    placeholder="33.222.111"title="Introduzca el documento"onkeypress="return soloNumeros(event)">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input type="date"name="fecha_nacimiento"value="{{old('fecha_nacimiento')}}"
                                    class="form-control"placeholder="dia/mes/año"title="Introduzca la fecha de nacimiento">
                            </div>
                        </div>
                    </div>
                </div>                
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="cuil">CUIL</label>
                                <input type="string"name="cuil"value="{{old('cuil')}}"class="form-control"placeholder="22-12312412-11"
                                    title="Introduzca el cuil"
                                    onkeypress="return soloNumeros(event)">
                            </div>
                        </div>   
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text"name="telefono"value="{{old('telefono')}}"class="form-control"
                                    placeholder="3764-232266"title="Introduzca un teléfono"
                                    onkeypress="return soloNumeros(event)">
                            </div>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="ciudad_id">Lugar de Nacimiento</label>
                                <select name="ciudad_id"id="ciudad_id2"class="ciudad_id2 custom-select"required>
                                    <option value="0"disabled="true"selected="true" title="-Seleccione una ciudad-">
                                        -Seleccione una ciudad-
                                    </option>
                                    @foreach ($lugar_nacimiento as $lugar)
                                        <option
                                            value="{{$lugar->id }}">{{$lugar->nombre}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> -->
                        
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="sexo_id">Género</label>
                                <select name="sexo_id"id="sexo_id"class="sexo_id custom-select" required>
                                    <option value="0"disabled="true"selected="true"title="-Seleccione un tipo de sexo-">
                                        -Seleccione un genero-
                                    </option>
                                    @foreach ($sexos as $sexo)
                                        <option
                                            value="{{$sexo->id }}">{{$sexo->definicion}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="estado_civil_id">Estado Civil</label>
                                <select name="estado_civil_id"id="estado_civil_id"class="estado_civil_id custom-select"required>
                                    <option value="0"disabled="true"selected="true"title="-Seleccione el estado civil-">
                                        -Seleccione un estado civil-
                                    </option>
                                    @foreach ($estado_civiles as $estado_civil)
                                        <option
                                            value="{{$estado_civil->id }}">{{$estado_civil->definicion}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <div class="form-group">
                        <label for="foto de perfil">Foto de Perfil</label>
                        <input type="file"name="imagen"value="{{old('imagen')}}"class="form-control">
                    </div>  
                </div>
               
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="card card-dark">
            <!-- <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Domicilio del Paciente</p>
                    
                </div>
            </div> -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                
                <div class="card-body">
                    <!--div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="peso">
                                        Peso
                                    </label>
                                    <input
                                        type="string"
                                        name="peso"
                                        value="{{old('peso')}}"
                                        class="form-control"
                                        placeholder="65"
                                        title="Introduzca el peso">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="estatura">
                                        Estatura
                                    </label>
                                    <input
                                        type="string"
                                        name="estatura"
                                        value="{{old('estatura')}}"
                                        class="form-control"
                                        placeholder="1.66"
                                        title="Introduzca la estatura">
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="origen_id">Empresa</label>
                        <div class="form-group inline">
                            <select
                                name="origen_id"
                                id="origen_id"
                                class="origen_id custom-select"
                                required>
                                <option
                                    value="0"
                                    disabled="true"
                                    selected="true"
                                    title="-Seleccione la empresa-">
                                    -Seleccione la empresa-
                                </option>
                                @foreach ($origenes as $origen)
                                    <option
                                        value="{{$origen->id }}">{{$origen->definicion}}
                                    </option>
                                @endforeach
                            </select>
                            <a data-target="#modal-agregarOrigen" data-toggle="modal">
                                <button title="agregar empresa" class="btn btn-dark btn-md">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </a>
                            @include('origen.modalAgregarOrigen')
                        </div>
                    </div>
                    <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="obra_social_id">
                            Obra Social
                        </label>
                        <div class="form-group inline">
                            <select
                                name="obra_social_id"
                                id="obra_social_id"
                                class="obra_social_id custom-select"
                                required>
                                <option
                                    value="0"
                                    disabled="true"
                                    selected="true"
                                    title="-Seleccione la obra social-">
                                    -Seleccione una obra social-
                                </option>
                                @foreach ($obra_sociales as $obra_social)
                                    <option
                                        value="{{$obra_social->id }}">{{$obra_social->obraSocialCompleta()}}
                                    </option>
                                @endforeach
                            </select>
                            <a data-target="#modal-agregarObraSocial" data-toggle="modal">
                                <button title="agregar obra social" class="btn btn-dark btn-md">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </a>
                            @include('obra_social.modalAgregarObraSocial')
                        </div>
                    </div-->

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="oficio">
                                    Oficio
                            </label>
                            <input
                                type="string"
                                name="oficio"
                                maxlength="99"
                                value="{{old('oficio')}}"
                                class="form-control"
                                placeholder="Ingrese el oficio..."
                                title="Introduzca un oficio">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label> Pais</label>
                            <select name="pais_id"id="pais_id"class="pais_id form-control"required>
                                <option value="0"disabled="true"selected="true"title="Seleccione un pais">
                                    -Seleccione un pais-
                                </option>
                                @foreach ($paises as $pais)
                                    <option
                                        value="{{$pais->id }}">
                                            {{$pais->nombre}}
                                    </option>
                                @endforeach
                            </select>
                            <br><br>
                            <label>Provincia</label>
                            <select name="provincia_id"id="provincia_id"class="provincia_id form-control"required>
                                <option value="0"disabled="true"selected="true"title="Seleccione una provincia">
                                    -Seleccione una provincia-
                                </option>
                            </select>
                            <br><br>
                            <label>Ciudad</label>
                            <select name="ciudad_id"id="ciudad_id"class="ciudad_id form-control"required>
                                <option value="0"disabled="true"selected="true"title="Seleccione una ciudad">
                                    -Seleccione una ciudad-
                                </option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="direccion">Direccion</label>
                                        <input type="string"name="direccion"value="{{old('direccion')}}"class="form-control"
                                            placeholder="Introdusca la direccion"title="Introduzca la direccion">
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group" style="text-align:center">
                                        <a href="/protexion/public/paciente">
                                            <button title="Cancelar" class="btn btn-secondary btn-lg" type="button"><i class="fas fa-arrow-left"></i> Cancelar</button>
                                        </a>
                                        <button title="Guardar" id="confirmar" class="btn btn-danger btn-lg" type="submit"> <i class="fa fa-check"></i> Guardar</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('paciente.modaldniencontrado')

</div>

{!!Form::close()!!}

    @push('scripts')
    <script type="text/javascript">

        $(document).ready(function(){


            var select1 = $("#sexo_id").select2({width:'100%'});
            select1.data('select2').$selection.css('height', '100%');

            var select2 = $("#estado_civil_id").select2({width:'100%'});
            select2.data('select2').$selection.css('height', '100%');

            // var select4 = $("#ciudad_id2").select2({width:'100%'});
            // select4.data('select2').$selection.css('height', '100%');

            var select5 = $("#pais_id").select2({width:'100%'});
            select5.data('select2').$selection.css('height', '100%');

            var select6 = $("#provincia_id").select2({width:'100%'});
            select6.data('select2').$selection.css('height', '100%');
            
            var select7 = $("#ciudad_id").select2({width:'100%'});
            select7.data('select2').$selection.css('height', '100%');

            var select3 = $("#origen_id").select2({width:'90%'});
            select3.data('select2').$selection.css('height', '100%');

            $(document).on('input','#documento',function(){
                var dni=$(this).val();
                $("#loader-4").removeClass("d-none")
                console.log("buscando");
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('paciente/create/encontrarDni')!!}',
                    data:{'dni':dni},
                    success:function(data){
                        console.log("terminó");
                        $("#loader-4").addClass("d-none")
                        //console.log(data);
                        //console.log(Object.keys(data));
                        if(Object.keys(data).length>0){
                          console.log("encontró");
                          $("#confirmar").addClass("disabled")
                          $("#confirmar").attr("disabled",true)
                          $("#modal-dni-encontrado").modal("show")
                          $("#modal_apellido_nombre").html(data.apellidoNombre)
                          $("#modal_documento").html(data.documento)
                          $("#modal_sexo").html(data.sexo)
                          $("#modal_domicilio").html(data.domicilio)
                          $("#modal_fecha_nacimiento").html(data.fecha_nacimiento)
                          $("#modal_cuit").html(data.cuit)
                          $("#modal_estado_civil").html(data.estado_civil)
                          let estado="No"
                          if(data.estado==2){
                            estado="Si"
                          }
                          $("#modal_anulado").html(estado)
                          $("#modal_button").attr("href","/protexion/public/paciente/"+data.id+"/edit")
                        }else{
                          console.log("no encontró");
                          $("#confirmar").removeClass("disabled")
                          $("#confirmar").attr("disabled",false)
                        }
                    },
                    error:function(){
                    }
                });
            });

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
