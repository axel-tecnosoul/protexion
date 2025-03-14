@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('content')
<style>
    .txt-center {
        text-align: -webkit-center;
    }
</style><?php

$puesto="";
$antiguedad="";
$direccion_completa="";
$enfermedades="";
$transtornos_congenitos="";
$enfermedades_profecionales="";
$exposicion_anterior="";
$exposicion_actual="";
$exp_actual_empresa="";
$exp_actual_actividad="";
$exp_actual_puesto="";
$exp_actual_antiguedad="";
$exp_actual_horario="";
$cefaleas="";
$vision_doble="";
$mareo_vertigo="";
$conjuntivitis="";
$vision_borrosa="";
$inseguridad_de_pie="";
$no_centrados="";
$pupilas_anormales="";
$conjuntivas_anormales="";
$corneas_anormales="";
$motilidad_anormal="";
$nistagmus_ausente="";
$informe_ocular="";
$av_correccion="";
$av_sin_correccion="";
$observaciones="";
if(isset($iluminacion_direccionado)){
  //dd($iluminacion_direccionado);
  $puesto=($iluminacion_direccionado->puesto) ?: "";
  $antiguedad=($iluminacion_direccionado->antiguedad) ?: "";
  $direccion_completa=($iluminacion_direccionado->direccion_completa) ?: "";
  $enfermedades=($iluminacion_direccionado->enfermedades) ?: "";
  $transtornos_congenitos=($iluminacion_direccionado->transtornos_congenitos) ?: "";
  $enfermedades_profecionales=($iluminacion_direccionado->enfermedades_profecionales) ?: "";
  $exposicion_anterior=($iluminacion_direccionado->exposicion_anterior) ?: "";
  $exposicion_actual=($iluminacion_direccionado->exposicion_actual) ?: "";
  $exp_actual_empresa=($iluminacion_direccionado->exp_actual_empresa) ?: "";
  $exp_actual_actividad=($iluminacion_direccionado->exp_actual_actividad) ?: "";
  $exp_actual_puesto=($iluminacion_direccionado->exp_actual_puesto) ?: "";
  $exp_actual_antiguedad=($iluminacion_direccionado->exp_actual_antiguedad) ?: "";
  $exp_actual_horario=($iluminacion_direccionado->exp_actual_horario) ?: "";
  $cefaleas=($iluminacion_direccionado->cefaleas) ?: "";
  $vision_doble=($iluminacion_direccionado->vision_doble) ?: "";
  $mareo_vertigo=($iluminacion_direccionado->mareo_vertigo) ?: "";
  $conjuntivitis=($iluminacion_direccionado->conjuntivitis) ?: "";
  $vision_borrosa=($iluminacion_direccionado->vision_borrosa) ?: "";
  $inseguridad_de_pie=($iluminacion_direccionado->inseguridad_de_pie) ?: "";
  $no_centrados=($iluminacion_direccionado->no_centrados==1) ? "checked" : "";
  $pupilas_anormales=($iluminacion_direccionado->pupilas_anormales==1) ? "checked" : "";
  $conjuntivas_anormales=($iluminacion_direccionado->conjuntivas_anormales==1) ? "checked" : "";
  $corneas_anormales=($iluminacion_direccionado->corneas_anormales==1) ? "checked" : "";
  $motilidad_anormal=($iluminacion_direccionado->motilidad_anormal==1) ? "checked" : "";
  $nistagmus_ausente=($iluminacion_direccionado->nistagmus_ausente==1) ? "checked" : "";
  $informe_ocular=($iluminacion_direccionado->informe_ocular) ?: "";
  $av_correccion=($iluminacion_direccionado->av_correccion) ?: "";
  $av_sin_correccion=($iluminacion_direccionado->av_sin_correccion) ?: "";
  $observaciones=($iluminacion_direccionado->observaciones) ?: "";
}
?>

{!!Form::open(array(
    'route'=>['iluminacion_direccionados.update',$iluminacion_direccionado->id],
    'method'=>'PATCH',
    'autocomplete'=>'off',
    'files' => true,
))!!}

{{Form::token()}}

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header fondo2 ">
                <div class="card-title">
                    <div class="row">
                        <div class="col-1">
                            <p style="font-size:130%"> <i class="fas fa-stethoscope"></i></p>
                        </div>
                        <div class="col-11">
                            <p style="font-size:130%">  Agente: Iluminación Insuficiente</p>
                            <p >Cuestionario Direccionado</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header header-bg -->
            <div class="card-body">
                <div class="col">
                    <!-- Voucher id HIDDEN -->
                    <div class="form-group">
                        <input type="number" name="voucher_id" value="{{$voucher->id }}" hidden>
                    </div>
                    <!-- Instrucciones -->
                    <div class="col-12">
                        <div class="card" >
                            <div class="card-header header-bg">
                                <h3 class="card-title">Instrucciones para el formulario</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <ul>
                                            <li><p>Completar los campos de los items que correspondan.</p></li>
                                            <li><p>Dejar vacíos los campos de los items que no correspondan.</p></li>
                                        </ul> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Criterios -->
                    <div class="col-12">
                        <div class="card" >
                            <div class="card-header header-bg">
                                <h3 class="card-title">Criterio de exposición al riesgo</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <ul>
                                            <li><p>Está orientado a trabajadores de minas o galerías subterráneas.</p></li>
                                        </ul> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Datos del paciente -->
                    <div class="col-12">
                        <div class="card" >
                            <div class="card-header header-bg">
                                <h3 class="card-title">Datos del paciente</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="added"> <input type="hidden" value="'+nombres+'">
                                            <p style="font-size:100%" class="text-left"> <strong> Nombre completo:    </strong> {{$voucher->paciente->nombreCompleto()             }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> CUIL:               </strong> {{$voucher->paciente->cuil                         }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Fecha de nacimiento:</strong> {{$voucher->paciente->fecha_nacimiento()           }} </p> 
                                            <p style="font-size:100%" class="text-left"> <strong> Edad:               </strong> {{$voucher->paciente->edad()                       }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Domicilio:          </strong> {{$voucher->paciente->domicilio ? $voucher->paciente->domicilio->direccion : " "        }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Sexo:               </strong> {{$voucher->paciente->sexo ? $voucher->paciente->sexo->definicion : " "                 }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Origen:             </strong> {{$voucher->origen ? $voucher->origen->definicion : " "             }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Cuit de origen:     </strong> {{$voucher->origen ? $voucher->origen->cuit : " "                   }} </p>        
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="added"> 
                                            @if($voucher->paciente->imagen==null)
                                                <img class="img-thumbnail" height="200px" width="200px" src="{{ asset('imagenes/paciente/default.png')}}">
                                            @else
                                                <img class="img-thumbnail" height="200px" width="200px" src="{{$voucher->paciente->imagen}}">
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Datos laborales -->
                    <div class="col-12">
                        <div class="card  "> <!--collapsed-card -->
                            <div class="card-header header-bg">
                                <h3 class="card-title">Datos laborales</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body" > <!--style="display: none;" -->
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="observacion1">Puesto de trabajo: </label>
                                        <input type="text" maxlength="255" class="form-control" name="puesto" value="<?=$puesto?>" placeholder="Ingrese el puesto de trabajo...">
                                    </div>
                                    <div class="form-group col">
                                        <label for="observacion1">Antigüedad (Años):</label>
                                        <input type="number" max="99" class="form-control" name="antiguedad" value="<?=$antiguedad?>" placeholder="Ingrese la antiguedad...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="observacion1">Dirección completa:   </label>
                                        <input type="text" maxlength="255" class="form-control" name="direccion_completa" value="<?=$direccion_completa?>" placeholder="Lugar donde se desempeña el trabajador...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Antecedentes -->
                    <div class="col-12">
                        <div class="card  "> <!--collapsed-card -->
                            <div class="card-header header-bg">
                                <h3 class="card-title">Antecedentes</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body" > <!--style="display: none;" -->
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="observacion1">Antecedentes de enfermedades:                                      </label>
                                        <input type="text" maxlength="255" class="form-control" name="enfermedades" value="<?=$enfermedades?>" placeholder="Antecedentes...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="observacion1">Antecedentes de trastornos congénitos:                             </label>
                                        <input type="text" maxlength="255" class="form-control" name="transtornos_congenitos" value="<?=$transtornos_congenitos?>" placeholder="Antecedentes...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="observacion1">Antecedentes de enfermedades profesionales o accidentes de trabajo:</label>
                                        <input type="text" maxlength="255" class="form-control" name="enfermedades_profecionales" value="<?=$enfermedades_profecionales?>" placeholder="Antecedentes...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Exposición al riesgo -->
                    <div class="col-12">
                        <div class="card  "> <!--collapsed-card -->
                            <div class="card-header header-bg">
                                <h3 class="card-title">Exposición al riesgo</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body" > <!--style="display: none;" -->
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="">Exposición anterior (Empresa, puesto y tiempo):                            </label>
                                        <input type="text" maxlength="255" class="form-control" name="exposicion_anterior" value="<?=$exposicion_anterior?>" placeholder="Empresa puesto tiempo 1, empresa puesto tiempo 2, etc">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="">Exposición Actual</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <input type="text" maxlength="255" class="form-control" id="exposicion_actual" name="exposicion_actual" value="<?=$exposicion_actual?>" hidden>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="">Empresa/Establecimiento:                     </label>
                                        <input type="text" maxlength="25" class="form-control exp_actual" id="exp_act_1" name="exp_actual_empresa" value="<?=$exp_actual_empresa?>" required placeholder="Empresa o establecimiento...">
                                    </div>
                                    <div class="form-group col">
                                        <label for="">Actividad:                                    </label>
                                        <input type="text" maxlength="60" class="form-control exp_actual" id="exp_act_2" name="exp_actual_actividad" value="<?=$exp_actual_actividad?>" required placeholder="Actividad que desempeña...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="">Puesto de Trabajo:                            </label>
                                        <input type="text" maxlength="25" class="form-control exp_actual" id="exp_act_3" name="exp_actual_puesto" value="<?=$exp_actual_puesto?>" required placeholder="Puesto de trabajo...">
                                    </div>
                                    <div class="form-group col">
                                        <label for="">Antigüedad en el puesto de trabajo (Años):    </label>
                                        <input type="number" max="99" class="form-control exp_actual" id="exp_act_4" name="exp_actual_antiguedad" value="<?=$exp_actual_antiguedad?>" required placeholder="Antigüedad...">
                                    </div>
                                    <div class="form-group col">
                                        <label for="">Horario de trabajo:                           </label>
                                        <input type="text" maxlength="75" class="form-control exp_actual" id="exp_act_5" name="exp_actual_horario" value="<?=$exp_actual_horario?>" required placeholder="Ej: de 7:30 a 11:30">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Examen clínico -->
                    <div class="col-12">
                        <div class="card  "> <!--collapsed-card -->
                            <div class="card-header header-bg">
                                <h3 class="card-title">Examen clínico</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body" > <!--style="display: none;" -->
                                <!-- Instrucciones -->
                                <div class="row">
                                    <div class="card text-white bg-light col" style="width: max-content">
                                      <div class="card-body">
                                        <h4 class="card-title"><b>Instrucciones:</b></h4><br>
                                        <p>                                        
                                            <ul>
                                                <li>Describir si corresponde.</li>
                                                <li>En caso de que corresponda y no se desee ingresar una descripción, escriba "Si".</li>
                                            </ul> 
                                        </p>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="checkbox_cefaleas">Cefaleas: </label>
                                        <input type="text" maxlength="255" class="form-control"  id="describir_cefaleas" name="cefaleas" value="<?=$cefaleas?>" placeholder="Descripción...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="checkbox_vision_doble">Visión doble: </label>
                                        <input type="text" maxlength="255" class="form-control"  id="describir_vision_doble" name="vision_doble" value="<?=$vision_doble?>" placeholder="Descripción...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="checkbox_mareo_vertigo">Mareos / Vértigo: </label>
                                        <input type="text" maxlength="255" class="form-control"  id="describir_mareo_vertigo" name="mareo_vertigo" value="<?=$mareo_vertigo?>" placeholder="Descripción...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="checkbox_conjuntivitis">Conjuntivitis: </label>
                                        <input type="text" maxlength="255" class="form-control"  id="describir_conjuntivitis" name="conjuntivitis" value="<?=$conjuntivitis?>" placeholder="Descripción...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="checkbox_vision_borrosa">Visión borrosa: </label>
                                        <input type="text" maxlength="255" class="form-control"  id="describir_vision_borrosa" name="vision_borrosa" value="<?=$vision_borrosa?>" placeholder="Descripción...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="checkbox_inseguridad_de_pie">Presencia de inseguridad en posición de pie: </label>
                                        <input type="text" maxlength="255" class="form-control"  id="describir_inseguridad_de_pie" name="inseguridad_de_pie" value="<?=$inseguridad_de_pie?>" placeholder="Descripción...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Examen ocular -->
                    <div class="col-12">
                        <div class="card  "> <!--collapsed-card -->
                            <div class="card-header header-bg">
                                <h3 class="card-title">Examen ocular</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body" > <!--style="display: none;" -->
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="observacion1"><u>Ojos:</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 icheck-danger d-inline">
                                        <input value=1 type="checkbox" name="no_centrados" <?=$no_centrados?> id="checkbox_no_centrados">
                                        <label for="checkbox_no_centrados">No centrados</label>
                                    </div>
                                    <div class="col-4 icheck-danger d-inline">
                                        <input value=1 type="checkbox" name="pupilas_anormales" <?=$pupilas_anormales?> id="checkbox_pupilas_anormales">
                                        <label for="checkbox_pupilas_anormales">Pupilas anormales</label>
                                    </div>
                                    <div class="col-4 icheck-danger d-inline">
                                        <input value=1 type="checkbox" name="conjuntivas_anormales" <?=$conjuntivas_anormales?> id="checkbox_conjuntivas_anormales">
                                        <label for="checkbox_conjuntivas_anormales">Conjuntivas anormales</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 icheck-danger d-inline">
                                        <input value=1 type="checkbox" name="corneas_anormales" <?=$corneas_anormales?> id="checkbox_corneas_anormales">
                                        <label for="checkbox_corneas_anormales">Córneas anormales</label>
                                    </div>
                                    <div class="col-4 icheck-danger d-inline">
                                        <input value=1 type="checkbox" name="motilidad_anormal" <?=$motilidad_anormal?> id="checkbox_motilidad_anormal">
                                        <label for="checkbox_motilidad_anormal">Motilidad ocular anormal</label>
                                    </div>
                                    <div class="col-4 icheck-danger d-inline">
                                        <input value=1 type="checkbox" name="nistagmus_ausente" <?=$nistagmus_ausente?> id="checkbox_nistagmus_ausente">
                                        <label for="checkbox_nistagmus_ausente">Nistagmus Ausente</label>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 2%">
                                    <div class="form-group col">
                                        <label>Informe:</label>
                                        <input type="text" maxlength="255" class="form-control" name="informe_ocular" value="<?=$informe_ocular?>" placeholder="Informe...">
                                    </div>
                                </div><hr>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="observacion1"> <u>Agudeza visual:</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label>Con corrección:                                      </label>
                                        <input type="text" maxlength="255" class="form-control" name="av_correccion" value="<?=$av_correccion?>" placeholder="Describa...">
                                    </div>
                                    <div class="form-group col">
                                        <label>Sin corrección:                                      </label>
                                        <input type="text" maxlength="255" class="form-control" name="av_sin_correccion" value="<?=$av_sin_correccion?>" placeholder="Describa...">
                                    </div>
                                </div>
                                <div class="row">

                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label>Observaciones:                                      </label>
                                        <input type="text" maxlength="255" class="form-control" name="observaciones" value="<?=$observaciones?>" placeholder="Observaciones...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Guardar -->
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
                    <div class="form-group">
                        <input id="guardar" name="_token" value="{{ csrf_token() }}" type="hidden">
                            <button class="btn btn-success btn-lg btn-block" id="confirmar"type="submit"><i class="fa fa-check"> </i>Modificar al formulario</button>
                    </div>
                </div>
            <!-- / Guardar -->
         </div>
    </div>
</div>

{!!Form::close()!!}

@push('scripts')
    <script>
    $(document).ready(function(){
        
        //Completar campo de exposicion actual
        $(".exp_actual").change(function()
        {
            var exp_act_1 = $("#exp_act_1").val();
            var exp_act_2 = $("#exp_act_2").val();
            var exp_act_3 = $("#exp_act_3").val();
            var exp_act_4 = $("#exp_act_4").val();
            var exp_act_5 = $("#exp_act_5").val();
            $("#exposicion_actual").val("Empresa: "+exp_act_1+", actividad: "+exp_act_2+ ", puesto: "+exp_act_3+
                                        ", antigüedad: "+exp_act_4+ " y Horario: " +exp_act_5);
        })
    });  
    </script>
@endpush
@endsection