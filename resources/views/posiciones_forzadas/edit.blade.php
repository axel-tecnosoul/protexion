@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/posiciones_forzadas">Indice de Pacientes</a></li>
    <li class="breadcrumb-item active">Formulario de Posiciones Forzadas</li>
@endsection

@section('content')
{!!Form::open(array(
    'route'=>['posiciones_forzadas.update',$posiciones_forzadas->id],
    'method'=>'PATCH',
    'autocomplete'=>'off',
    'files' => true,
))!!}

{{Form::token()}}

<style>
    .txt-center {
        text-align: -webkit-center;
    }
</style><?php

$aTiemposDeTrabajo=["Esporádico","Continuo > 2hs y < 4hs","Continuo > 4hs"];
$aCiclosDeTrabajo=["hasta 30 segundos","30 segundos a 2 minutos","< 2 minutos"];
$aManipManualCargas=["Menor a 1 Kg","Entre 1 Kg y 3 Kgs","Mayor a 3 Kgs"];
$aFormaAparicionDolor=["Agudo","Insidioso","Ausente"];
$aEvolucionDolor=["Continuo","Brotes","Cíclico"];
$aGrados=["Grado 0: Ausencia de signos y síntomas.","Grado 1: Dolor en reposo y/o existencia de sintomatología sugestiva.","Grado 2: Grado 1 mas contractura y/o dolor a la movilización.","Grado 3: Grado 2 mas dolor a la palpación y/o percusión.","Grado 4: Grado 3 mas limitación funcional evidente clínicamente."];

$puesto="";
$antiguedad="";
$nroTrabajo="";
$tiempo="";
$ciclo="";
$cargas="";
$pregunta1="";
$pregunta2="";
$pregunta3="";
$pregunta4="";
$pregunta5="";
$pregunta6="";
$pregunta7="";
$pregunta8="";
$observacion_tarea="";
$forma="";
$evolucion="";
$observacion1_d="";
$observacion2_d="";
$pregunta1_d="";
$pregunta2_d="";
$pregunta3_d="";
$pregunta4_d="";
$pregunta5_d="";
$grado="";
$observacion1_s="";
if(isset($posiciones_forzadas)){
  $puesto=($posiciones_forzadas->puesto) ?: "";
  $antiguedad=($posiciones_forzadas->antiguedad) ?: "";
  $nroTrabajo=($posiciones_forzadas->nroTrabajo) ?: "";
  /* Tarea */
  $tiempo=($posiciones_forzadas->tarea->tiempo) ?: "";
  $ciclo=($posiciones_forzadas->tarea->ciclo) ?: "";
  $cargas=($posiciones_forzadas->tarea->cargas) ?: "";
  /* Tipos de tarea */
  $pregunta1=($posiciones_forzadas->tarea->pregunta1==1) ? "checked" : "";
  $pregunta2=($posiciones_forzadas->tarea->pregunta2==1) ? "checked" : "";
  $pregunta3=($posiciones_forzadas->tarea->pregunta3==1) ? "checked" : "";
  $pregunta4=($posiciones_forzadas->tarea->pregunta4==1) ? "checked" : "";
  $pregunta5=($posiciones_forzadas->tarea->pregunta5==1) ? "checked" : "";
  $pregunta6=($posiciones_forzadas->tarea->pregunta6==1) ? "checked" : "";
  $pregunta7=($posiciones_forzadas->tarea->pregunta7==1) ? "checked" : "";
  $pregunta8=($posiciones_forzadas->tarea->pregunta8==1) ? "checked" : "";
  $observacion_tarea=($posiciones_forzadas->tarea->observacion_tarea) ?: "";
  /* Tipos de tarea */
  //@include('posiciones_forzadass.tabla_semiologia');
  $dolor_articular=$posiciones_forzadas->dolor_articular;
  $forma=($posiciones_forzadas->dolor->forma) ?: "";
  $evolucion=($posiciones_forzadas->dolor->evolucion) ?: "";
  $observacion1_d=($posiciones_forzadas->dolor->observacion1_d) ?: "";
  $observacion2_d=($posiciones_forzadas->dolor->observacion2_d) ?: "";
  $pregunta1_d=($posiciones_forzadas->dolor->pregunta1_d==1) ? "checked" : "";
  $pregunta2_d=($posiciones_forzadas->dolor->pregunta2_d==1) ? "checked" : "";
  $pregunta3_d=($posiciones_forzadas->dolor->pregunta3_d==1) ? "checked" : "";
  $pregunta4_d=($posiciones_forzadas->dolor->pregunta4_d==1) ? "checked" : "";
  $pregunta5_d=($posiciones_forzadas->dolor->pregunta5_d==1) ? "checked" : "";
  $grado=($posiciones_forzadas->semiologica->grado) ?: "";
  $observacion1_s=($posiciones_forzadas->semiologica->observacion1_s) ?: "";
}
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header header-bg ">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fas fa-stethoscope"></i> Formulario de Posiciones Forzadas</p>
                </div>
            </div>
            <!-- /.card-header header-bg -->
            <div class="card-body">
                <div class="col-12">
                    <!-- Visita id HIDDEN -->
                    <div class="form-group">
                        <input type="number" name="voucher_id" value="{{$voucher->id }}" hidden>
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
                                            <p style="font-size:100%" class="text-left"> <strong> Nombre completo:    </strong> {{$voucher->paciente->nombreCompleto()     }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> CUIL:               </strong> {{$voucher->paciente->cuil                 }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Fecha de nacimiento:</strong> {{$voucher->paciente->fecha_nacimiento()   }} </p> 
                                            <p style="font-size:100%" class="text-left"> <strong> Edad:               </strong> {{$voucher->paciente->edad()               }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Sexo:               </strong> {{$voucher->paciente->sexo ? $voucher->paciente->sexo->definicion : " "     }} </p>        
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
                    <!-- / Datos del paciente -->
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
                                            <input type="text" class="form-control" name="puesto" value="<?=$puesto?>" placeholder="Ingrese el puesto de trabajo...">
                                        </div>
                                        <div class="form-group col">
                                            <label for="observacion1">Antigüedad (Años):</label>
                                            <input type="number" class="form-control" name="antiguedad" value="<?=$antiguedad?>" placeholder="Ingrese la antiguedad...">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label for="observacion1">Nº Horas/ días de trabajo:  </label>
                                            <input type="text" class="form-control" name="nroTrabajo" value="<?=$nroTrabajo?>" placeholder="Ingrese Nº Horas/días de trabajo:">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- / Datos laborales -->
                    <!-- Tareas -->
                        <div class="col-12">
                            <div class="card ">
                                <div class="card-header header-bg">
                                    <h3 class="card-title">Tarea</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <!-- Tiempo de Tarea -->
                                        <div class="form-group row">
                                            <label class="col" for="tarea_1"> <u> Tiempo de Tarea:</u> </label><?php
                                            foreach($aTiemposDeTrabajo as $tiempos){
                                              $checked="";
                                              if($tiempos==$tiempo){
                                                $checked="checked";
                                              }?>
                                              <div class="col">
                                                  <label><input type="radio" <?=$checked?> name="tiempo" value="<?=$tiempos?>"> <?=$tiempos?></label>
                                              </div><?php
                                            }?>
                                            <!-- <div class="col">
                                                <label><input type="radio" name="tiempo" value="Continuo > 2hs y < 4hs"> Continuo > 2hs y < 4hs</label>
                                            </div>
                                            <div class="col"> 
                                                <label><input type="radio" name="tiempo" value="Continuo > 4hs"> Continuo > 4hs</label>
                                            </div> -->
                                        </div><hr>
                                        <!-- Ciclo de trabajo: -->
                                        <div class="form-group row">
                                            <label class="col" for="tarea_1"> <u> Ciclo de trabajo:</u> </label><?php
                                            foreach($aCiclosDeTrabajo as $ciclos){
                                              $checked="";
                                              if($ciclos==$ciclo){
                                                $checked="checked";
                                              }?>
                                              <div class="col">
                                                  <label><input type="radio" <?=$checked?> name="ciclo" value="<?=$ciclos?>"> <?=$ciclos?></label>
                                              </div><?php
                                            }?>
                                            <!-- <div class="col"> 
                                                <label><input type="radio" name="ciclo" value="Corto: hasta 30 segundos"> hasta 30 segundos</label>
                                            </div>
                                            <div class="col">
                                                <label><input type="radio" name="ciclo" value="Moderado: 30 segundos - 1 a 2 minutos"> 30 segundos a 2 minutos</label>
                                            </div>
                                            <div class="col">
                                                <label><input type="radio" name="ciclo" value="Largo: < 2 minutos"> < 2 minutos</label>
                                            </div> -->
                                        </div><hr>
                                        <!-- Manipulación manual de cargas: -->
                                        <div class="form-group row">
                                            <label class="col" for="tarea_1"> <u> Manipulación manual de cargas:</u> </label><?php
                                            foreach($aManipManualCargas as $manip_cargas){
                                              $checked="";
                                              //var_dump($cargas);
                                              if($manip_cargas==$cargas){
                                                $checked="checked";
                                              }?>
                                              <div class="col">
                                                  <label><input type="radio" <?=$checked?> name="cargas" value="<?=$manip_cargas?>"> <?=$manip_cargas?></label>
                                              </div><?php
                                            }?>
                                            <!-- <div class="col">
                                                <label><input type="radio" name="cargas" value="Menor a 1 Kg "> Menor a 1 Kg </label>
                                            </div>
                                            <div class="col">
                                                <label><input type="radio" name="cargas" value="Entre 1 Kg y 3 Kgs"> Entre 1 Kg y 3 Kgs</label>
                                            </div>
                                            <div class="col"> 
                                                <label><input type="radio" name="cargas" value="Mayor a 3 Kgs"> Mayor a 3 Kgs</label>
                                            </div> -->
                                        </div><hr>
                                        <label for="tipo_tarea"> <u> Tipo de tarea:</u> </label>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta1" <?=$pregunta1?> value=1 id="checkboxPrimary8">
                                                    <label for="checkboxPrimary8">Movimiento de alcance repetidos por encima del hombro</label>
                                                </div>
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta2" <?=$pregunta2?> value=1 id="checkboxPrimary10">
                                                    <label for="checkboxPrimary10">Movimiento de extensión o flexión forzados de muñeca</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta3" <?=$pregunta3?> value=1 id="checkboxPrimary12">
                                                    <label for="checkboxPrimary12">Flexión sostenida de columna</label>
                                                </div>
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta4" <?=$pregunta4?> value=1 id="checkboxPrimary14">
                                                    <label for="checkboxPrimary14">Flexión extrema del codo</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta5" <?=$pregunta5?> value=1 id="checkboxPrimary16">
                                                    <label for="checkboxPrimary16">El cuello se mantiene flexionado</label>
                                                </div>
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta6" <?=$pregunta6?> value=1 id="checkboxPrimary18">
                                                    <label for="checkboxPrimary18">Giros de columna</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta7" <?=$pregunta7?> value=1 id="checkboxPrimary20">
                                                    <label for="checkboxPrimary20">Rotación extrema del antebrazo</label>
                                                </div>
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta8" <?=$pregunta8?> value=1 id="checkboxPrimary22">
                                                    <label for="checkboxPrimary22">Flexión mantenida de dedos</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="observacion_tarea">Otros, especificar: </label>
                                            <input type="text" class="form-control" id="observacion_tarea" name="observacion_tarea" value="<?=$observacion_tarea?>" placeholder="Otros...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- / Tareas -->
                    <!-- Semiología -->
                        <div class="col-12">
                          <div class="card ">
                            <div class="card-header header-bg">
                              <h3 class="card-title">Semiología del Segmento Corporal Comprometido - Relación Movilidad – Dolor Articular y estado de masa muscular relacionada.</h3>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                              </div>
                            </div>
                            <div class="card-body">
                              <div class="container">
                                <div class="row">
                                  <table class="table table-hover table-condensed table-bordered table-striped">
                                    <tr>
                                      <th colspan="2">
                                          Articulación
                                      </th>
                                      <th>Abducción</th>
                                      <th>Addución</th>
                                      <th>Flexión</th>
                                      <th>Extensión</th>
                                      <th>Rot. Externa</th>
                                      <th>Rot. Interna</th>
                                      <th>Irradiación</th>
                                      <th>Alt. Masa muscular</th>
                                    </tr>
                                    <!-- Iteración por cada articulación -->
                                    @foreach ($articulaciones as $art)
                                      <tr>
                                        <td rowspan="2" width="10%">{{$art}}</td>
                                        <!-- Iteración izquierda o derecha -->
                                        @for ($i = 0; $i < 2; $i++)
                                          @if ($i == 0)
                                            <td width="5%">Der.</td>
                                          @else
                                            <td width="5%">Izq.</td>
                                          @endif
                                          <!-- Iteración por cada cuadro -->
                                          @for ($j = $cuadro; $j < $cuadro+8; $j++)<?php
                                            $checked="";
                                            if(isset($dolor_articular) and $dolor_articular[$j]==1){
                                              $checked="checked";
                                            }?>
                                            <td>
                                              <div class="custom-control custom-checkbox">
                                                <!-- Que cargue 0 si no se selecciona -->
                                                <input type="text" hidden value=0 name={{$j}}>
                                                <div class="icheck-danger d-inline">
                                                  <!-- Que cargue 1 si se selecciona -->
                                                  <input type="checkbox" <?=$checked?> name={{$j}} value=1 id="cuadro{{$j}}">
                                                  <label for="cuadro{{$j}}"></label>
                                                </div>
                                              </div>
                                            </td>
                                          @endfor
                                          <div hidden> {{$cuadro = $cuadro + 8}} </div>
                                        </tr>
                                        @endfor
                                    @endforeach 
                                  </table>
                                </div>
                                <!-- <div class="form-group">
                                </div> -->
                              </div>
                            </div>
                          </div>
                        </div>
                    <!-- / Semiología -->
                    <!-- Características del dolor -->
                        <div class="col-12">
                            <div class="card ">
                                <div class="card-header header-bg">
                                    <h3 class="card-title">Características del dolor</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Por su forma de aparición -->
                                    <div class="form-group row">
                                        <label class="col" for="dolor_1"> <u> Por su forma de aparición:</u> </label><?php
                                        foreach($aFormaAparicionDolor as $formas){
                                          $checked="";
                                          if($formas==$forma){
                                            $checked="checked";
                                          }?>
                                          <div class="col">
                                              <label><input type="radio" <?=$checked?> name="forma" value="<?=$formas?>"> <?=$formas?></label>
                                          </div><?php
                                        }?>
                                        <!-- <div class="col">
                                            <label><input type="radio" name="forma" value="Agudo"> Agudo</label>
                                        </div>
                                        <div class="col">
                                             <label><input type="radio" name="forma" value="Insidioso"> Insidioso</label>
                                        </div>
                                        <div class="col"> 
                                            <label><input type="radio" name="forma" value="Ausente"> Ausente</label>
                                        </div> -->
                                    </div><hr>
                                    <!-- Por su evolución -->
                                    <div class="form-group row">
                                        <label class="col" for="dolor_1"> <u> Por su evolución:</u> </label><?php
                                        foreach($aEvolucionDolor as $evoluciones){
                                          $checked="";
                                          if($evoluciones==$evolucion){
                                            $checked="checked";
                                          }?>
                                          <div class="col">
                                              <label><input type="radio" <?=$checked?> name="evolucion" value="<?=$evoluciones?>"> <?=$evoluciones?></label>
                                          </div><?php
                                        }?>
                                        <!-- <div class="col">
                                            <label><input type="radio" name="evolucion" value="Continuo"> Continuo</label>
                                        </div>
                                        <div class="col">
                                            <label><input type="radio" name="evolucion" value="Brotes"> Brotes</label>
                                        </div>
                                        <div class="col"> 
                                            <label><input type="radio" name="evolucion" value="Cíclico"> Cíclico</label>
                                        </div> -->
                                    </div><hr>       
                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="observacion1">Puntos dolorosos: </label>
                                            <input type="text" class="form-control" id="observacion1_d" name="observacion1_d" value="<?=$observacion1_d?>" placeholder="Puntos dolorosos">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="observacion1">Localización: </label>
                                            <input type="text" class="form-control" id="observacion2_d" name="observacion2_d" value="<?=$observacion2_d?>" placeholder="Localización">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                        <!-- Otros signos y sintomas presentes en el segmento involucrado -->
                                            <label for="signos_1"> <u> Otros signos y sintomas presentes en el segmento involucrado:</u> </label>
                                            <div class="form-group">
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta1_d" <?=$pregunta1_d?> value=1 id="checkboxPrimary24">
                                                    <label for="checkboxPrimary24">Calambres musculares             </label> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta2_d" <?=$pregunta2_d?> value=1 id="checkboxPrimary26">
                                                    <label for="checkboxPrimary26">Parestesias                      </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta3_d" <?=$pregunta3_d?> value=1 id="checkboxPrimary28">
                                                    <label for="checkboxPrimary28">Calor                            </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta4_d" <?=$pregunta4_d?> value=1 id="checkboxPrimary30">
                                                    <label for="checkboxPrimary30">Cambios de coloración de la piel </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta5_d" <?=$pregunta5_d?> value=1 id="checkboxPrimary32">
                                                    <label for="checkboxPrimary32">Tumefacción                      </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                        <!-- Caracterización semiológica -->
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label for=""> <u> Caracterización semiológica:</u></label>
                                                </div><?php
                                                foreach($aGrados as $grados){
                                                  $checked="";
                                                  if($grados==$grado){
                                                    $checked="checked";
                                                  }?>
                                                  <div class="col-12">
                                                      <label><input type="radio" <?=$checked?> name="grado" value="<?=$grados?>"> <?=$grados?></label>
                                                  </div><?php
                                                }?>
                                                <!-- <div class="col-12">
                                                    <label><input type="radio" name="grado" value="Grado 0: Ausencia de signos y síntomas."> Grado 0: Ausencia de signos y síntomas.</label>
                                                </div>
                                                <div class="col-12">
                                                    <label><input type="radio" name="grado" value="Grado 1: Dolor en reposo y/o existencia de sintomatología sugestiva."> Grado 1: Dolor en reposo y/o existencia de sintomatología sugestiva.</label>
                                                </div>
                                                <div class="col-12">
                                                    <label><input type="radio" name="grado" value="Grado 2: Grado 1 mas contractura y/o dolor a la movilización."> Grado 2: Grado 1 mas contractura y/o dolor a la movilización.</label>
                                                </div>
                                                <div class="col-12">
                                                    <label><input type="radio" name="grado" value="Grado 3: Grado 2 mas dolor a la palpación y/o percusión."> Grado 3: Grado 2 mas dolor a la palpación y/o percusión.</label>
                                                </div>
                                                <div class="col-12">
                                                    <label><input type="radio" name="grado" value="Grado 4: Grado 3 mas limitación funcional evidente clínicamente."> Grado 4: Grado 3 mas limitación funcional evidente clínicamente.</label>
                                                </div> -->
                                            </div>    
                                        </div>
                                    </div>          
                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="observacion1">Observación: </label>
                                            <input type="text" class="form-control" id="observacion1_s" name="observacion1_s" value="<?=$observacion1_s?>" placeholder="Observación">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- / Características del dolor -->
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
        /*
        //Visita
            var select1 = $("#voucher_id").select2({width:'100%'});
            select1.data('select2').$selection.css('height', '34px');


            $("#voucher_id").change(function(){
                mostrarDatos();
            });

            function mostrarDatos()
            {
                voucher_id=$("#voucher_id").val();
                vouchers=$("#voucher_id option:selected").text();

                $.ajax({
                    type:'get',
                    url:'{!!URL::to('declaracion_jurada/create/traerDatosPaciente')!!}',
                    data:{'id':voucher_id},
                    success:function(data){

                        documento=data['documento'];
                        nombres=data['nombres'];
                        apellidos=data['apellidos'];
                        fecha_nacimiento=data['fecha_nacimiento'];
                        foto=data['foto'];
                        cuil=data['cuil'];
                        sexo=data['sexo'];

                        datosPaciente='<div class="added"> <input type="hidden" value="'+nombres+'"><p style="font-size:140%" class="text-left">Nombre y Apellido del paciente: '+nombres+'</p><input type="hidden" value="'+documento+'"><p style="font-size:140%" class="text-left">Documento del paciente: '+documento+'</p><input type="hidden" value="'+fecha_nacimiento+'"><p style="font-size:140%" class="text-left">Fecha de nacimiento del paciente: '+fecha_nacimiento+'</p><input type="hidden"  value="'+cuil+'"><p style="font-size:140%" class="text-left">CUIL: '+cuil+'</p><input type="hidden" value="'+sexo+'"><p style="font-size:140%" class="text-left">Sexo: '+sexo+'</p><input type="hidden" name="voucher_id" value="'+voucher_id+'"></div>';
                        fotoPaciente='<div class="added"> @if('+foto+'==null)<img class="img-thumbnail" height="85px" width="85px" src='+foto+'>@else<img class="img-thumbnail" height="350px" width="350px" src="{{ asset('imagenes/paciente/default.png')}}">@endif </div>';

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
            function eliminarDelSelect2 ()
            {
                $("#voucher_id option:selected").remove();

            }
        // */
    });  
    </script>
@endpush
@endsection

