@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/voucher">Indice de Visitas</a></li>
    <li class="breadcrumb-item active">Generar Visita</li>
@endsection

@section('content')
    <div class="container">
        @include('errors.request')
        @include('voucher.mensaje')
        {!!Form::open(array('url'=>'voucher','method'=>'POST','autocomplete'=>'off','files' => true,))!!}
        {{Form::token()}}

        <div class="card card-outline">
            <div class="card-header header-bg">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-voucher" aria-hidden="true"></i> Datos de la Visita</p>
                </div>
            </div>
            <div class="card-body fondo0">
                <!-- Fecha -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label> <p style="font-size:130%">Fecha: </p></label>
                                <input class="form-control" type="date" name="turno"  required
                                value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="origen_id"> <p style="font-size:130%">Empresa</p></label>
                            <div class="form-group inline">
                                <select
                                    name="origen_id"
                                    id="origen_id"
                                    class="origen_id custom-select"
                                    style="width:90%"
                                    required>
                                    <option
                                        value=""
                                        disabled="true"
                                        selected="true"
                                        title="-Seleccione la empresa-">
                                        -Seleccione la empresa-
                                    </option><?php
                                    foreach ($origenes as $origen){
                                        if (isset($paciente->origen_id) and $origen->id==$paciente->origen_id){?>
                                            <option value="{{$origen->id}}" selected>{{$origen->definicion}}</option><?php
                                        }else{?>
                                            <option value="{{$origen->id}}">{{$origen->definicion}}</option><?php
                                        }
                                        //<option value="{{$origen->id}}">{{$origen->definicion}}</option>
                                      }?>
                                </select>
                                <a data-target="#modal-agregarOrigen" data-toggle="modal" style="width:10%">
                                    <button title="agregar empresa" class="btn btn-dark btn-md">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </a>
                                @include('origen.modalAgregarOrigen')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Fecha -->

                <!-- HIDDEN --><?php
                if(isset($paciente->id)){
                  $pacientes_id=$paciente->id;?>
                  <!-- Paciente -->
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card flex-fill" >
                            <div class="card-header header-bg">
                                <h3 class="card-title">Datos del paciente</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-7">
                                        <div> 
                                            <p style="font-size:100%" class="text-left"> <strong> Nombre completo:    </strong> {{$paciente->nombreCompleto()             }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> CUIL:               </strong> {{$paciente->cuil                         }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Fecha de nacimiento:</strong> {{$paciente->fecha_nacimiento()           }} </p> 
                                            <p style="font-size:100%" class="text-left"> <strong> Edad:               </strong> {{$paciente->edad()                       }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Domicilio:          </strong> {{$paciente->domicilio ? $paciente->domicilio->direccion : " "        }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Sexo:               </strong> {{$paciente->sexo ? $paciente->sexo->definicion : " "                 }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Origen:             </strong> {{$paciente->origen ? $paciente->origen->definicion : " "             }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Cuit de origen:     </strong> {{$paciente->origen ? $paciente->origen->cuit : " "                   }} </p>      
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="added"> 
                                            @if($paciente->imagen==null)
                                                <img class="img-thumbnail" height="200px" width="200px" src="{{ asset('imagenes/paciente/default.png')}}">
                                            @else
                                                <!-- <img class="img-thumbnail" height="200px" width="200px" src="{{$paciente->imagen}}"> -->
                                                <img class="img-thumbnail" height="200px" width="200px" src="{{ asset('imagenes/paciente/'.$paciente->imagen)}}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Paciente --><?php
                }else{
                  $pacientes_id=$paciente;
                  echo "<h4>".$cant_pacientes." pacientes seleccionados</h4>";
                }?>
                <input type="text" name="paciente_id" value="{{$pacientes_id }}" hidden>
                <!-- Estudios -->
                    @foreach ($tipo_estudios as $tipo)<?php
                        //var_dump($tipo->nombre)?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card "> <!--collapsed-card -->
                                <div class="card-header header-bg">
                                    <div class="row">
                                        <div class="col">
                                            <h3 class="card-title">{{$tipo->nombre}}</h3> 
                                        </div>
                                        <div style="text-align: right" class="col">
                                            <div class="icheck-danger d-inline"><?php
                                                $checked="";
                                                if($tipo->id==2){
                                                  $checked="checked";
                                                }?>
                                                <input id="a{{$tipo->id}}" type="checkbox" onClick="ActivarCasilla(this,{{$tipo->id}});" <?=$checked?>/>
                                                <Label for="a{{$tipo->id}}">{{strtoupper("Seleccionar todo")}} </Label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" > <!--style="display: none;" -->
                                    <div class="row"><?php
                                        $idChecked = ["45","46","47","48","49","50","56","57"]; 
                                        //dd($estudios)?>
                                        @foreach ($estudios as $item)
                                            @if ($item->tipo_estudio_id == $tipo->id)
                                                <div class="col-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <div class="icheck-danger d-inline">
                                                            <?php $readonly=$checked="" ?>
                                                            @if($item->id==73)
                                                              <input class="{{$tipo->id}}" type="hidden" name="{{$item->id}}" value = 1 id="{{$item->id}}">
                                                            @else
                                                              @if(in_array($item->id, $idChecked))
                                                                  <?php $checked=" checked"?>
                                                              @endif
                                                              @if($item->id==56)
                                                                  <!-- 56 = Declaracion Jurada -> Va si o si -->
                                                                  <?php $readonly=" onclick='return false;' required";?>
                                                              @endif
                                                              <input class="{{$tipo->id}}" type="checkbox" name="{{$item->id}}" value = 1 id="{{$item->id}}" <?=$checked.$readonly?>>
                                                              <label for="{{$item->id}}"> {{strtoupper($item->nombre)}} </label>
                                                            @endif
                                                        </div>
                                                    </div>  
                                                </div>         
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                <!-- / Estudios-->
            </div>
        </div>
        <div class="card  "> 
          <div class="card-header header-bg">
              <h3 class="card-title">Riesgos</h3>
              <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
              </div>
          </div>
          <div class="card-body" > 
            <div class="row">
            
              @foreach ($riesgos as $riesgo)<?php
              //dd($riesgo->id)?>
                <div class="form-group col-12">
                    <input type="text" value=0  name="riesgos[{{$riesgo->id}}]" hidden>
                    <div class="icheck-danger d-inline">
                        <input type="checkbox" value=1 id="riesgo{{$riesgo->id}}" name="riesgos[{{$riesgo->id}}]">
                        <label for="riesgo{{$riesgo->id}}">{{$riesgo->riesgo}}</label>
                    </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group" style="text-align:center">
                <a href="/protexion/public/voucher">
                    <button title="Cancelar" class="btn btn-secondary btn-lg" type="button"><i class="fas fa-arrow-left"></i> Cancelar</button>
                </a>
                <button title="Guardar" id="confirmar" class="btn btn-danger btn-lg" type="submit"> <i class="fa fa-check"></i> Guardar</button>
            </div>
        </div>
    </div> 
{!!Form::close()!!}

@push('scripts')
    <script>
        $(document).ready(function(){
            var select67 = $("#paciente_id").select2({width:'100%'});
            select67.data('select2').$selection.css('height', '34px');
        });
    </script>
    <script>
        $(document).ready(function(){
            //Visita
            var select1 = $("#paciente_id").select2({width:'100%'});
            select1.data('select2').$selection.css('height', '34px');


            $("#paciente_id").change(function(){
                mostrarDatos();
            });

            function mostrarDatos(){
                paciente_id=$("#paciente_id").val();
                /*   Aca iría el Ajax para obtener la cantidad por Paquete*/
                $.ajax({
                    type:'get',
                    //url:'{!!URL::to('voucher/create/traerDatosPaciente')!!}',
                    url:"{!!URL::to('voucher/create/traerDatosPaciente')!!}",
                    data:{'id':paciente_id},
                    success:function(data){

                        let documento=data['documento'];
                        let nombres=data['nombres'];
                        let apellidos=data['apellidos'];
                        let fecha_nacimiento=data['fecha_nacimiento'];
                        let foto=data['foto'];
                        let cuil=data['cuil'];
                        let sexo=data['sexo'];

                        datosPaciente=`
                          <div class="added">
                            <input type="hidden" value="${nombres}">
                            <p style="font-size:140%" class="text-left">Nombre y Apellido del paciente: ${nombres}</p>
                            <input type="hidden" value="${documento}">
                            <p style="font-size:140%" class="text-left">Documento del paciente: ${documento}</p>
                            <input type="hidden" value="${fecha_nacimiento}">
                            <p style="font-size:140%" class="text-left">Fecha de nacimiento del paciente: ${fecha_nacimiento}</p>
                            <input type="hidden" value="${cuil}">
                            <p style="font-size:140%" class="text-left">CUIL: ${cuil}</p>
                            <input type="hidden" value="${sexo}">
                            <p style="font-size:140%" class="text-left">Sexo: ${sexo}</p>
                            <input type="hidden" name="paciente_id" value="${paciente_id}">
                          </div>`;
                        fotoPaciente=`
                          <div class="added">
                            @if(`+foto+`==null)
                              <img class="img-thumbnail" height="85px" width="85px" src="${foto}">
                            @else
                              <img class="img-thumbnail" height="350px" width="350px" src="{{ asset('imagenes/paciente/default.png')}}">
                            @endif
                          </div>`;

                        //Limpiar datos agregadoss
                        $('.added').remove();
                        
                        $("#datos_paciente").append(datosPaciente).hide().show('slow');
                        $("#foto_paciente").append(fotoPaciente).hide().show('slow');
                    },
                    error:function(){
                        console.log('no anda AJAX');
                    }
                });

            }
            function eliminarDelSelect2 (){
              $("#paciente_id option:selected").remove();
            }
        });
    </script>

    <script type="text/javascript">
        function ActivarCasilla(casilla, id) 
        {
            miscasillas=document.getElementsByClassName(id); //Rescatamos controles tipo Input
            for(i=0;i<miscasillas.length;i++) //Ejecutamos y recorremos los controles
            {
                if(miscasillas[i].type == "checkbox") // Ejecutamos si es una casilla de verificacion
                {
                    if(miscasillas[i].id!=56){//56 = Declaracion Jurada -> Va si o si
                        miscasillas[i].checked=casilla.checked; // Si el input es CheckBox se aplica la funcion ActivarCasilla
                    }
                }
            }
        }
    </script>
@endpush
@endsection

