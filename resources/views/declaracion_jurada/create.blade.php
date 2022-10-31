@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/declaracion_jurada">Indice de Pacientes</a></li>
    <li class="breadcrumb-item active">Declaración jurada de Salud</li>
@endsection

@section('content')
{!!Form::open(array(
    'id'=>'declaracion_jurada',
    'url'=>'declaracion_jurada',
    'method'=>'POST',
    'autocomplete'=>'off',
    'files' => true,
))!!}

{{Form::token()}}

<style>
    .jay-signature-pad {
        position: relative;
        display: -ms-flexbox;
        -ms-flex-direction: column;
        width: 100%;
        height: 100%;
        max-width: 600px;
        max-height: 315px;
        border: 1px solid #e8e8e8;
        background-color: #fff;
        box-shadow: 0 3px 20px rgba(0, 0, 0, 0.27), 0 0 40px rgba(0, 0, 0, 0.08) inset;
        border-radius: 15px;
        padding: 20px;
    }
    .txt-center {
        text-align: -webkit-center;
    }
</style>

<?php
$fecha="";
$peso="";
$estatura="";
//ANTECEDENTES FAMILIARES
$su_padre_vive="";
$su_madre_vive="";
$cancer="";
$diabetes="";
$infarto="";
$hipertension_Arterial="";
$antecedenteFamiliarDetalle="";
//ANTECEDENTES PERSONALES
$fuma="";
$bebe="";
$actividad_fisica="";
$covid19="";
$vacunado=0;
//ANTECEDENTES DE LA INFANCIA
$sarampion="";
$rebeola="";
$epilepsia="";
$varicela="";
$parotiditis="";
$cefalea_prolongada="";
$hepatitis="";
$gastritis="";
$ulcera_gastrica="";
$hemorroide="";
$hemorragias="";
$neumonia="";
$asma="";
$tuberculosis="";
$tos_cronica="";
$catarro="";
$epilepsia="";
$antecedenteMedicoInfanciaDetalle="";
//ANTECEDENTES RECIENTES
$detalle1_reciente="";
$detalle2_reciente="";
$detalle3_reciente="";
$detalle4_reciente="";
$detalle5_reciente="";
$detalle6_reciente="";
$detalle7_reciente="";
$detalle8_reciente="";
$detalle9_reciente="";
$detalle10_reciente="";
$detalle11_reciente="";
$detalle12_reciente="";
$detalle13_reciente="";
$detalle14_reciente="";
//ANTECEDENTE QUIRURJICO
$detalle1_q="";
$detalle2_q="";
$detalle3_q="";
if(isset($declaracion_jurada_anterior)){
  $fecha=($declaracion_jurada_anterior->fecha_realizacion) ?: "";
  $peso=($declaracion_jurada_anterior->voucher->paciente->peso) ?: "";
  $estatura=($declaracion_jurada_anterior->voucher->paciente->estatura) ?: "";
  //ANTECEDENTES FAMILIARES
  $su_padre_vive=($declaracion_jurada_anterior->antecedenteFamiliar->su_padre_vive==1) ? "checked" : "";
  $su_madre_vive=($declaracion_jurada_anterior->antecedenteFamiliar->su_madre_vive==1) ? "checked" : "";
  $cancer=($declaracion_jurada_anterior->antecedenteFamiliar->cancer==1) ? "checked" : "";
  $diabetes=($declaracion_jurada_anterior->antecedenteFamiliar->diabetes==1) ? "checked" : "";
  $infarto=($declaracion_jurada_anterior->antecedenteFamiliar->infarto==1) ? "checked" : "";
  $hipertension_Arterial=($declaracion_jurada_anterior->antecedenteFamiliar->hipertension_Arterial==1) ? "checked" : "";
  $antecedenteFamiliarDetalle=$declaracion_jurada_anterior->antecedenteFamiliar->detalle;
  //ANTECEDENTES PERSONALES
  $fuma=($declaracion_jurada_anterior->antecedentePersonal->fuma) ?: "";
  $bebe=($declaracion_jurada_anterior->antecedentePersonal->bebe) ?: "";
  $actividad_fisica=($declaracion_jurada_anterior->antecedentePersonal->actividad_fisica) ?: "";
  $covid19=($declaracion_jurada_anterior->antecedentePersonal->covid19) ?: "";
  $vacunado=($declaracion_jurada_anterior->antecedentePersonal->vacunado) ?: 0;
  //ANTECEDENTES DE LA INFANCIA
  $sarampion=($declaracion_jurada_anterior->antecedenteMedicoInfancia->sarampion==1) ? "checked" : "";
  $rebeola=($declaracion_jurada_anterior->antecedenteMedicoInfancia->rebeola==1) ? "checked" : "";
  $epilepsia=($declaracion_jurada_anterior->antecedenteMedicoInfancia->epilepsia==1) ? "checked" : "";
  $varicela=($declaracion_jurada_anterior->antecedenteMedicoInfancia->varicela==1) ? "checked" : "";
  $parotiditis=($declaracion_jurada_anterior->antecedenteMedicoInfancia->parotiditis==1) ? "checked" : "";
  $cefalea_prolongada=($declaracion_jurada_anterior->antecedenteMedicoInfancia->cefalea_prolongada==1) ? "checked" : "";
  $hepatitis=($declaracion_jurada_anterior->antecedenteMedicoInfancia->hepatitis==1) ? "checked" : "";
  $gastritis=($declaracion_jurada_anterior->antecedenteMedicoInfancia->gastritis==1) ? "checked" : "";
  $ulcera_gastrica=($declaracion_jurada_anterior->antecedenteMedicoInfancia->ulcera_gastrica==1) ? "checked" : "";
  $hemorroide=($declaracion_jurada_anterior->antecedenteMedicoInfancia->hemorroide==1) ? "checked" : "";
  $hemorragias=($declaracion_jurada_anterior->antecedenteMedicoInfancia->hemorragias==1) ? "checked" : "";
  $neumonia=($declaracion_jurada_anterior->antecedenteMedicoInfancia->neumonia==1) ? "checked" : "";
  $asma=($declaracion_jurada_anterior->antecedenteMedicoInfancia->asma==1) ? "checked" : "";
  $tuberculosis=($declaracion_jurada_anterior->antecedenteMedicoInfancia->tuberculosis==1) ? "checked" : "";
  $tos_cronica=($declaracion_jurada_anterior->antecedenteMedicoInfancia->tos_cronica==1) ? "checked" : "";
  $catarro=($declaracion_jurada_anterior->antecedenteMedicoInfancia->catarro==1) ? "checked" : "";
  $epilepsia=($declaracion_jurada_anterior->antecedenteMedicoInfancia->epilepsia==1) ? "checked" : "";
  $antecedenteMedicoInfanciaDetalle=$declaracion_jurada_anterior->antecedenteMedicoInfancia->detalle1_m;
  //ANTECEDENTES RECIENTES
  $detalle1_reciente=($declaracion_jurada_anterior->antecedenteReciente->detalle1_reciente) ?: "";
  $detalle2_reciente=($declaracion_jurada_anterior->antecedenteReciente->detalle2_reciente) ?: "";
  $detalle3_reciente=($declaracion_jurada_anterior->antecedenteReciente->detalle3_reciente) ?: "";
  $detalle4_reciente=($declaracion_jurada_anterior->antecedenteReciente->detalle4_reciente) ?: "";
  $detalle5_reciente=($declaracion_jurada_anterior->antecedenteReciente->detalle5_reciente) ?: "";
  $detalle6_reciente=($declaracion_jurada_anterior->antecedenteReciente->detalle6_reciente) ?: "";
  $detalle7_reciente=($declaracion_jurada_anterior->antecedenteReciente->detalle7_reciente) ?: "";
  $detalle8_reciente=($declaracion_jurada_anterior->antecedenteReciente->detalle8_reciente) ?: "";
  $detalle9_reciente=($declaracion_jurada_anterior->antecedenteReciente->detalle9_reciente) ?: "";
  $detalle10_reciente=($declaracion_jurada_anterior->antecedenteReciente->detalle10_reciente) ?: "";
  $detalle11_reciente=($declaracion_jurada_anterior->antecedenteReciente->detalle11_reciente) ?: "";
  $detalle12_reciente=($declaracion_jurada_anterior->antecedenteReciente->detalle12_reciente) ?: "";
  $detalle13_reciente=($declaracion_jurada_anterior->antecedenteReciente->detalle13_reciente) ?: "";
  $detalle14_reciente=($declaracion_jurada_anterior->antecedenteReciente->detalle14_reciente) ?: "";
  //ANTECEDENTE QUIRURJICO
  $detalle1_q=($declaracion_jurada_anterior->antecedenteQuirurjico->detalle1_q) ?: "";
  $detalle2_q=($declaracion_jurada_anterior->antecedenteQuirurjico->detalle2_q) ?: "";
  $detalle3_q=($declaracion_jurada_anterior->antecedenteQuirurjico->detalle3_q) ?: "";
}


$dosis_vacuna=["Sin a dosis","Con 1ra dosis","Con 2da dosis","Con 3ra dosis","Con 4ta dosis"];?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header fondo2">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fas fa-stethoscope"></i> Declaración jurada de Salud</p>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="col">
                    <div class="col-12">
                        <!-- Voucher -->
                        <input type="number" name="voucher_id" value={{ $voucher->id }} hidden>
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
                    <!-- Datos de paciente -->
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Datos de paciente</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Seleccionar Medico</label>
                                            <select
                                                name="personal_clinica_id"
                                                id="personal_clinica_id"
                                                class="personal_clinica_id custom-select"
                                                required>
                                                @foreach ($personal_clinicas as $personal_clinica)
                                                    <option value="{{$personal_clinica->id }}">{{$personal_clinica->nombreCompleto() . " - " . $personal_clinica->puesto->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Fecha de último examen</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" name="fecha_realizacion" class="form-control" value="<?=$fecha?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Estatura</label>
                                        <div class="input-group">
                                            <input type="number" step="0.01" name="estatura" placeholder="Ingrese la estatura" class="form-control" title="Ingrese la Estatura" value="<?=$estatura?>" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Peso</label>
                                        <div class="input-group">
                                            <input type="number" step="0.01" name="peso" placeholder="Ingrese el peso" class="form-control" title="Ingrese el Peso" value="<?=$peso?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Antecedentes Familiares -->
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Antecedentes Familiares</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <!-- Padre y madre -->
                                    <div class="form-group row">
                                        <!-- ¿Su padre vive? -->
                                        <div class="col">
                                            <div class="icheck-danger d-inline">
                                                <input value=1 type="checkbox" <?=$su_padre_vive?> name="su_padre_vive" id="su_padre_vive">
                                                <label for="su_padre_vive">
                                                    ¿Su padre vive?
                                                </label>
                                            </div>
                                        </div>
                                        <!-- ¿Su madre vive? -->
                                        <div class="col">
                                            <div class="icheck-danger d-inline">
                                                <input value=1 type="checkbox" <?=$su_madre_vive?> name="su_madre_vive" id="su_madre_vive">
                                                <label for="su_madre_vive">
                                                    ¿Su madre vive?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label for=""><u>Su madre o padre padece alguna de las siguientes afecciones: </u></label>
                                    <h3></h3>
                                    <!-- Afecciones -->
                                    <div class="form-group row">
                                        <!-- Cancer -->
                                        <div class="col">
                                            <div class="icheck-danger d-inline">
                                                <input value=1 type="checkbox" name="cancer" id="cancer" <?=$cancer?>>
                                                <label for="cancer">Cáncer</label>
                                            </div>
                                        </div>
                                        <!-- Diabetes -->
                                        <div class="col">
                                            <div class="icheck-danger d-inline">
                                                <input value=1 type="checkbox" name="diabetes" id="diabetes" <?=$diabetes?>>
                                                <label for="diabetes">Diabetes</label>
                                            </div>
                                        </div>
                                        <!-- Infarto -->
                                        <div class="col">
                                            <div class="icheck-danger d-inline">
                                                <input value=1 type="checkbox" name="infarto" id="infarto" <?=$infarto?>>
                                                <label for="infarto">Infarto</label>
                                            </div>
                                        </div>
                                        <!-- Hipertension Arterial -->
                                        <div class="col">
                                            <div class="icheck-danger d-inline">
                                                <input value=1 type="checkbox" name="hipertension_Arterial" id="hipertension_Arterial" <?=$hipertension_Arterial?>>
                                                <label for="hipertension_Arterial">Hipertension Arterial</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Opcional: Ingrese algun detalle -->
                                    <div class="form-group row">
                                        <label for="detalle">Si su padre o madre padecen alguna enfermedad actualmente, mencione el diagnóstico:</label>
                                        <input type="text" class="form-control" id="detalle"  name="detalle"  placeholder="Diagnóstico" value="<?=$antecedenteFamiliarDetalle?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Antecedentes Personales -->
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Antecedentes Personales</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <!-- Instrucciones -->
                                    <div class="row">
                                        <div class="card text-white bg-light col" style="width: max-content">
                                        <div class="card-body">
                                            <h4 class="card-title"><b>Instrucciones:</b></h4><br>
                                            <p>                                        
                                                <ul>
                                                    <li>Describir si corresponde.</li>
                                                    <li>Indicar la cantidad.</li>
                                                    <li>Si el ítem no corresponde, dejar el campo vacío.</li>
                                                </ul> 
                                            </p>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- Fuma -->
                                    <div class="form-group row">
                                        <label for="fuma">
                                            Fuma:
                                        </label>
                                        <input type="text" class="form-control" name="fuma" id="fuma" value="<?=$fuma?>" placeholder="Describa e ingrese la cantidad si corresponde...">
                                    </div>
                                    <!-- Bebe -->
                                    <div class="form-group row">
                                        <label for="bebe">
                                            Bebe:
                                        </label>
                                        <input type="text" class="form-control" name="bebe" id="bebe" value="<?=$bebe?>" placeholder="Describa e ingrese la cantidad si corresponde...">
                                    </div>
                                    <!-- Actividad fisica -->
                                    <div class="form-group row">
                                        <label for="actividad_fisica">
                                            Actividad física:
                                        </label>
                                        <input type="text" class="form-control" name="actividad_fisica" id="actividad_fisica" value="<?=$actividad_fisica?>" placeholder="Describa e ingrese la cantidad si corresponde...">
                                    </div>
                                    <!-- Covid 1 -->
                                    <div class="form-group row">
                                        <label for="covid19" class="form-label">COVID 19</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="covid19" id="covid19" value="<?=$covid19?>">
                                    </div>
                                    <!-- Vacunas -->
                                    <div class="form-group row">
                                        <label for="vacunado" class="form-label">Vacunas</label>
                                        <!-- <input class="form-control" placeholder="Describa las dosis..." type="text" name="vacunado" id="vacunado"> -->
                                        <select class="form-control" name="vacunado" id="vacunado">
                                          <option value="0">Seleccione las dosis...</option><?php
                                          foreach ($dosis_vacuna as $key => $value) {
                                            $selected="";
                                            if($vacunado==$value){
                                              $selected="selected";
                                            }?>
                                            <option value="<?=$value?>" <?=$selected?>><?=$value?></option><?php
                                          }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Antecedentes de la Infancia -->
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Antecedentes de la Infancia</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <label for="">¿Padeció algunas de las siguientes afecciones?</label>
                                <div class="form-group">
                                    <div class="row">
                                        <input type="hidden" name=sarampion value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=sarampion id="todoCheck10" <?=$sarampion?>> 
                                            <label for="todoCheck10">Sarampión</label>
                                        </div>
                                        <input type="hidden" name=rebeola value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=rebeola id="todoCheck11" <?=$rebeola?>>
                                            <label for="todoCheck11"> Rubéola</label>
                                        </div>
                                        <input type="hidden" name=epilepsia value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=epilepsia id="todoCheck12" <?=$epilepsia?>> 
                                            <label for="todoCheck12">Epilepsias</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name=varicela value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=varicela id="todoCheck13" <?=$varicela?>> 
                                            <label for="todoCheck13">Varicela</label>
                                        </div>
                                        <input type="hidden" name=parotiditis value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=parotiditis id="todoCheck14" <?=$parotiditis?>>
                                            <label for="todoCheck14"> Parotiditis</label>
                                        </div>
                                        <input type="hidden" name=cefalea_prolongada value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=cefalea_prolongada id="todoCheck15" <?=$cefalea_prolongada?>> 
                                            <label for="todoCheck15">Cefalea prolongadas</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name=hepatitis value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=hepatitis id="todoCheck16" <?=$hepatitis?>> 
                                            <label for="todoCheck16">Hepatítis</label>
                                        </div>
                                        <input type="hidden" name=gastritis value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=gastritis id="todoCheck17" <?=$gastritis?>> 
                                            <label for="todoCheck17">Gastrítis</label>
                                        </div>
                                        <input type="hidden" name=ulcera_gastrica value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=ulcera_gastrica id="todoCheck18" <?=$ulcera_gastrica?>>
                                            <label for="todoCheck18"> Ulcera Gástrica</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name=hemorroide value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=hemorroide id="todoCheck19" <?=$hemorroide?>> 
                                            <label for="todoCheck19">Hemorroides</label>
                                        </div>
                                        <input type="hidden" name=hemorragias value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=hemorragias id="todoCheck20" <?=$hemorragias?>> 
                                            <label for="todoCheck20">Hemorragia</label>
                                        </div>
                                        <input type="hidden" name=neumonia value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=neumonia id="todoCheck21" <?=$neumonia?>> 
                                            <label for="todoCheck21">Neumonía</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name=asma value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=asma id="todoCheck22" <?=$asma?>> 
                                            <label for="todoCheck22">Asma</label>
                                        </div>
                                        <input type="hidden" name=tuberculosis value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=tuberculosis id="todoCheck23" <?=$tuberculosis?>> 
                                            <label for="todoCheck23">Tuberculosis</label>
                                        </div>
                                        <input type="hidden" name=tos_cronica value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=tos_cronica id="todoCheck24" <?=$tos_cronica?>> 
                                            <label for="todoCheck24">Tos Crónica</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name=catarro value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=catarro id="todoCheck25" <?=$catarro?>>
                                            <label for="todoCheck25"> Catarro</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="detalle1_m" class="form-label">Otras Afecciones:</label>
                                            <input type="text" class="form-control" name="detalle1_m" id="detalle1_m" value="<?=$antecedenteMedicoInfanciaDetalle?>" placeholder="Describa...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Antecedentes Recientes -->
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Antecedentes Recientes</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <!-- Instrucciones -->
                                    <div class="row">
                                        <div class="card text-white bg-light col" style="width: max-content">
                                        <div class="card-body">
                                            <h4 class="card-title"><b>Instrucciones:</b></h4><br>
                                            <p>                                        
                                                <ul>
                                                    <li>Detalle si corresponde.</li>
                                                    <li>Si el ítem no corresponde, dejar el campo vacío.</li>
                                                </ul> 
                                            </p>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- ¿Enfermedad de los ojos, oidos , nariz o garganta? -->
                                    <div class="form-group row">
                                        <label for="detalle1_reciente">
                                            ¿Enfermedad de los ojos, oidos , nariz o garganta?
                                        </label>
                                        <input type="text" class="form-control" name="detalle1_reciente" id="detalle1_reciente" value="<?=$detalle1_reciente?>" placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Mareos, desmayos, convulsiones, dolores de cabeza, parálisis o ataques, desordenes mentales o nerviosos? -->
                                    <div class="form-group row">
                                        <label for="detalle2_reciente">
                                            ¿Mareos, desmayos, convulsiones, dolores de cabeza, parálisis o ataques, desordenes mentales o nerviosos?
                                        </label>
                                        <input type="text" class="form-control" name="detalle2_reciente" id="detalle2_reciente" value="<?=$detalle2_reciente?>" placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Insuficiencia respiratoria,  ronquera persistente, tos, asma, bronquitis, enfisema, tuberculosis o enfermedad respiratoria crónica? -->
                                    <div class="form-group row">
                                        <label for="detalle3_reciente">
                                            ¿Insuficiencia respiratoria,  ronquera persistente, tos, asma, bronquitis, enfisema, tuberculosis o enfermedad respiratoria crónica?
                                        </label>
                                        <input type="text" class="form-control" name="detalle3_reciente" id="detalle3_reciente" value="<?=$detalle3_reciente?>" placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Dolor de pecho, palpitaciones, presión sanguínea, fiebre reumática, ataque al corazón u otra enfermedad del corazón o vasos sanguíneos? -->
                                    <div class="form-group row">
                                        <label for="detalle4_reciente">
                                            ¿Dolor de pecho, palpitaciones, presión sanguínea, fiebre reumática, ataque al corazón u otra enfermedad del corazón o vasos sanguíneos?
                                        </label>
                                        <input type="text" class="form-control" name="detalle4_reciente" id="detalle4_reciente" value="<?=$detalle4_reciente?>" placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Ictericia, hemorragia intestinal, úlcera, colitis, diverticulosis, otras enfermedades del intestino, hígado o vesícula? -->
                                    <div class="form-group row">
                                        <label for="detalle5_reciente">
                                            ¿Ictericia, hemorragia intestinal, úlcera, colitis, diverticulosis, otras enfermedades del intestino, hígado o vesícula?
                                        </label>
                                        <input type="text" class="form-control"name="detalle5_reciente" id="detalle5_reciente" value="<?=$detalle5_reciente?>"placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Azúcar, sangre o pus en la orina, enfermedad del riñón, vejiga o próstata? -->
                                    <div class="form-group row">
                                        <label for="detalle6_reciente">
                                            ¿Azúcar, sangre o pus en la orina, enfermedad del riñón, vejiga o próstata?
                                        </label>
                                        <input type="text" class="form-control" name="detalle6_reciente" id="detalle6_reciente" value="<?=$detalle6_reciente?>" placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Diabetes, Tiroides u otra enfermedad endócrinas? -->
                                    <div class="form-group row">
                                        <label for="detalle7_reciente">
                                            ¿Diabetes, Tiroides u otra enfermedad endócrinas?
                                        </label>
                                        <input type="text" class="form-control" name="detalle7_reciente" id="detalle7_reciente" value="<?=$detalle7_reciente?>" placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Gota, Afecciones musculares u óseas, incluidos columna, espalda o articulaciones? -->
                                    <div class="form-group row">
                                        <label for="detalle8_reciente">
                                            ¿Gota, Afecciones musculares u óseas, incluidos columna, espalda o articulaciones?
                                        </label>
                                        <input type="text" class="form-control" name="detalle8_reciente" id="detalle8_reciente" value="<?=$detalle8_reciente?>" placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Deformidades, rengueras o amputaciones? -->
                                    <div class="form-group row">
                                        <label for="detalle9_reciente">
                                            ¿Deformidades, rengueras o amputaciones?
                                        </label>
                                        <input type="text" class="form-control" name="detalle9_reciente" id="detalle9_reciente" value="<?=$detalle9_reciente?>" placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Enfermedades de la piel? -->
                                    <div class="form-group row">
                                        <label for="detalle10_reciente">
                                            ¿Enfermedades de la piel?
                                        </label>
                                        <input type="text" class="form-control" name="detalle10_reciente" id="detalle10_reciente" value="<?=$detalle10_reciente?>" placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Alergias, anemias u otras enfermedades de la sangre? -->
                                    <div class="form-group row">
                                        <label for="detalle11_reciente">
                                            ¿Alergias, anemias u otras enfermedades de la sangre?
                                        </label>
                                        <input type="text" class="form-control" name="detalle11_reciente" id="detalle11_reciente" value="<?=$detalle11_reciente?>" placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Está Ud. Actualmente bajo observación o tratamiento? -->
                                    <div class="form-group row">
                                        <label for="detalle12_reciente">
                                            ¿Está Ud. Actualmente bajo observación o tratamiento?
                                        </label>
                                        <input type="text" class="form-control" name="detalle12_reciente" id="detalle12_reciente" value="<?=$detalle12_reciente?>" placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Ha tenido algún cambio en su peso en el último año? -->
                                    <div class="form-group row">
                                        <label for="detalle13_reciente">
                                            ¿Ha tenido algún cambio en su peso en el último año?
                                        </label>
                                        <input type="text" class="form-control" name="detalle13_reciente" id="detalle13_reciente" value="<?=$detalle13_reciente?>" placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- HERNIA -->
                                    <div class="form-group row">
                                        <label for="detalle14_reciente">
                                            HERNIA
                                        </label>
                                        <input type="text" class="form-control" name="detalle14_reciente" id="detalle14_reciente" value="<?=$detalle14_reciente?>" placeholder="Detalle si corresponde...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Antecedentes Quirúrjicos -->
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Antecedentes Quirúrjicos</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <!-- ¿Fue intervenido/a quirúrgicamente por alguna causa? -->
                                    <div class="form-group row">
                                        <label for="detalle1_q">
                                            ¿Fue intervenido/a quirúrgicamente por alguna causa?
                                        </label>
                                        <input type="text" class="form-control" name="detalle1_q" id="detalle1_q" value="<?=$detalle1_q?>" placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Tiene pendiente alguna cirugía? -->
                                    <div class="form-group row">
                                        <label for="detalle2_q">
                                            ¿Tiene pendiente alguna cirugía? Por favor detallar Diagnóstico y fecha:
                                        </label>
                                        <input type="text" class="form-control" name="detalle2_q" id="detalle2_q" value="<?=$detalle2_q?>" placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Padece alguna otra enfermedad no especificada en el interrogatorio anterior? -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Enfermedad no especificada</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group row">
                                        <label for="detalle3_q">
                                            ¿Padece alguna otra enfermedad no especificada en el interrogatorio anterior?
                                        </label>
                                        <input type="text" class="form-control" name="detalle3_q" id="detalle3_q" value="<?=$detalle3_q?>" placeholder="Detalle si corresponde...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Firma -->
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Firma del Paciente</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Instrucciones -->
                                <div class="row">
                                    <div class="card text-white bg-light col" style="width: max-content">
                                    <div class="card-body">
                                        <h4 class="card-title"><b>Declaración:</b></h4><br>
                                        <p> Por la presente declaro bajo juramento que los datos de la presente declaración, de mi puño y
                                            letra, son reales y corresponden a mi Historia Clínica Personal. </p>
                                    </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="form-group">
                                        <div id="signature-pad" class="jay-signature-pad">
                                            <div class="jay-signature-pad--body">
                                                <canvas id="jay-signature-pad" width=550 height=200></canvas>
                                            </div>
                                            <div class="signature-pad--footer txt-center">
                                                <div class="signature-pad--actions txt-center">
                                                    <div>
                                                        <br>
                                                        <button type="button" class="button clear btn btn-dark" data-action="clear"><i class="fa fa-eraser" aria-hidden="true"></i>...Limpiar</button>
                                                        <button type="button" class="button btn btn-dark" data-action="change-color"><i class="fas fa-palette"></i> Cambiar color</button>
                                                        <!--<button type="button" class="button save btn btn-dark" data-action="save-svg"><i class="fas fa-save"></i> Guardar como SVG</button>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                         /* var canvas, ctx, flag = false,
            prevX = 0,
            currX = 0,
            prevY = 0,
            currY = 0,
            dot_flag = false;

            var x = "black",
                y = 2;
            
            function init() {
                canvas = document.getElementById('can');
                //canvas = document.getElementById('jay-signature-pad');
                ctx = canvas.getContext("2d");
                w = canvas.width;
                h = canvas.height;
            
                canvas.addEventListener("mousemove", function (e) {
                    findxy('move', e)
                }, false);
                canvas.addEventListener("mousedown", function (e) {
                    findxy('down', e)
                }, false);
                canvas.addEventListener("mouseup", function (e) {
                    findxy('up', e)
                }, false);
                canvas.addEventListener("mouseout", function (e) {
                    findxy('out', e)
                }, false);
            }
            
            function color(obj) {
                switch (obj.id) {
                    case "green":
                        x = "green";
                        break;
                    case "blue":
                        x = "blue";
                        break;
                    case "red":
                        x = "red";
                        break;
                    case "yellow":
                        x = "yellow";
                        break;
                    case "orange":
                        x = "orange";
                        break;
                    case "black":
                        x = "black";
                        break;
                    case "white":
                        x = "white";
                        break;
                }
                if (x == "white") y = 14;
                else y = 2;
            
            }
            
            function draw() {
                ctx.beginPath();
                ctx.moveTo(prevX, prevY);
                ctx.lineTo(currX, currY);
                ctx.strokeStyle = x;
                ctx.lineWidth = y;
                ctx.stroke();
                ctx.closePath();
            }
            
            function erase() {
                var m = confirm("Want to clear");
                if (m) {
                    ctx.clearRect(0, 0, w, h);
                    document.getElementById("canvasimg").style.display = "none";
                }
            }
            
            function save() {
                document.getElementById("canvasimg").style.border = "2px solid";
                var dataURL = canvas.toDataURL();
                document.getElementById("canvasimg").src = dataURL;
                document.getElementById("canvasimg").style.display = "inline";
            }
            
            function findxy(res, e) {
                if (res == 'down') {
                    prevX = currX;
                    prevY = currY;
                    currX = e.clientX - canvas.offsetLeft;
                    currY = e.clientY - canvas.offsetTop;
            
                    flag = true;
                    dot_flag = true;
                    if (dot_flag) {
                        ctx.beginPath();
                        ctx.fillStyle = x;
                        ctx.fillRect(currX, currY, 2, 2);
                        ctx.closePath();
                        dot_flag = false;
                    }
                }
                if (res == 'up' || res == "out") {
                    flag = false;
                }
                if (res == 'move') {
                    if (flag) {
                        prevX = currX;
                        prevY = currY;
                        currX = e.clientX - canvas.offsetLeft;
                        currY = e.clientY - canvas.offsetTop;
                        draw();
                    }
                }
            }*/

                                        </script>
                                        <!-- <div>
                                          <canvas id="can" width="400" height="400" style="position:absolute;top:10%;left:10%;border:2px solid;"></canvas>
                                          <div style="position:absolute;top:12%;left:43%;">Choose Color</div>
                                          <div style="position:absolute;top:15%;left:45%;width:10px;height:10px;background:green;" id="green" onclick="color(this)"></div>
                                          <div style="position:absolute;top:15%;left:46%;width:10px;height:10px;background:blue;" id="blue" onclick="color(this)"></div>
                                          <div style="position:absolute;top:15%;left:47%;width:10px;height:10px;background:red;" id="red" onclick="color(this)"></div>
                                          <div style="position:absolute;top:17%;left:45%;width:10px;height:10px;background:yellow;" id="yellow" onclick="color(this)"></div>
                                          <div style="position:absolute;top:17%;left:46%;width:10px;height:10px;background:orange;" id="orange" onclick="color(this)"></div>
                                          <div style="position:absolute;top:17%;left:47%;width:10px;height:10px;background:black;" id="black" onclick="color(this)"></div>
                                          <div style="position:absolute;top:20%;left:43%;">Eraser</div>
                                          <div style="position:absolute;top:22%;left:45%;width:15px;height:15px;background:white;border:2px solid;" id="white" onclick="color(this)"></div>
                                          <img id="canvasimg" style="position:absolute;top:10%;left:52%;" style="display:none;">
                                          <input type="button" value="save" id="btn" size="30" onclick="save()" style="position:absolute;top:55%;left:10%;">
                                          <input type="button" value="clear" id="clr" size="23" onclick="erase()" style="position:absolute;top:55%;left:15%;">
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="firma" id="firma">
                </div>
            </div>
            <div class="col-12">
            <div class="form-group" style="text-align:center">
                <label>

                </label>
                <br>
                <a href="/protexion/public/declaracion_jurada">
                  <button title="Cancelar" class="btn btn-secondary btn-lg" type="button"><i class="fas fa-arrow-left"></i> Cancelar</button>
                </a>
                <button title="Guardar" id="confirmar" class="btn btn-danger btn-lg" type="submit"> <i class="fa fa-check"></i> Guardar</button>
            </div>
         </div>
    </div>
</div>
{!!Form::close()!!}

@push('scripts')
    <script>
        $(document).ready(function(){

          //agregado axel
          //init();
            //fin agregado axel

        //Firma
            var wrapper = document.getElementById("signature-pad");
            var clearButton = wrapper.querySelector("[data-action=clear]");
            var changeColorButton = wrapper.querySelector("[data-action=change-color]");
            var guardar = document.getElementById("confirmar");
            var canvas = wrapper.querySelector("canvas");
            var signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)'
            });
            // Adjust canvas coordinate space taking into account pixel ratio,
            // to make it look crisp on mobile devices.
            // This also causes canvas to be cleared.
            function resizeCanvas() {
                // When zoomed out to less than 100%, for some very strange reason,
                // some browsers report devicePixelRatio as less than 1
                // and only part of the canvas is cleared then.
                var ratio =  Math.max(window.devicePixelRatio || 1, 1);
                // This part causes the canvas to be cleared
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
                // This library does not listen for canvas changes, so after the canvas is automatically
                // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
                // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
                // that the state of this library is consistent with visual state of the canvas, you
                // have to clear it manually.
                signaturePad.clear();
            }
            // On mobile devices it might make more sense to listen to orientation change,
            // rather than window resize events.
            window.onresize = resizeCanvas;
            resizeCanvas();
            function download(dataURL, filename) {
                var blob = dataURLToBlob(dataURL);
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement("a");
                a.style = "display: none";
                a.href = url;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            }
            // One could simply use Canvas#toBlob method instead, but it's just to show
            // that it can be done using result of SignaturePad#toDataURL.
            function dataURLToBlob(dataURL) {
                var parts = dataURL.split(';base64,');
                var contentType = parts[0].split(":")[1];
                var raw = window.atob(parts[1]);
                var rawLength = raw.length;
                var uInt8Array = new Uint8Array(rawLength);
                for (var i = 0; i < rawLength; ++i) {
                    uInt8Array[i] = raw.charCodeAt(i);
                }
                return new Blob([uInt8Array], { type: contentType });
            }
            clearButton.addEventListener("click", function (event) {
                signaturePad.clear();
            });
            changeColorButton.addEventListener("click", function (event) {
                var r = Math.round(Math.random() * 255);
                var g = Math.round(Math.random() * 255);
                var b = Math.round(Math.random() * 255);
                var color = "rgb(" + r + "," + g + "," + b +")";
                signaturePad.penColor = color;
            });

            /*guardar.addEventListener("click", function (event) {
                if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
                } else {
                var dataURL = signaturePad.toDataURL('image/svg+xml');
                document.getElementById('firma').value = dataURL;
                //image = image.replace('data:image/png;base64,', '');
                //save(dataURL, "signature.svg");
                //var dataURL = signaturePad.toDataURL('image/svg+xml');
                //download(dataURL, "signature.svg");
                }
            });*/
            $("#declaracion_jurada").submit(function(e){
              e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página  
              if (signaturePad.isEmpty()) {
                alert("Por favor ingrese una firma.");
              } else {
                var dataURL = signaturePad.toDataURL('image/svg+xml');
                document.getElementById('firma').value = dataURL;
                this.submit()
              }
            })
        //
        //Voucher
            var select1 = $("#voucher_id").select2({width:'100%'});
            select1.data('select2').$selection.css('height', '34px');

            var select2 = $("#personal_clinica_id").select2({width:'100%'});
            select2.data('select2').$selection.css('height', '34px');


            $("#voucher_id").change(function(){
                mostrarDatos();
            });

            function mostrarDatos()
            {
                voucher_id=$("#voucher_id").val();
                vouchers=$("#voucher_id option:selected").text();

                var datosPaciente=null;
                var fotoPaciente=null;

                /*   Aca iría el Ajax para obtener la cantidad por Paquete*/
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

        //    
        
        //Otros
            $('#radioPrimary5').click(function() {
                $('#opcion1').show("slow");
            });
            $('#radioPrimary6').click(function() {
                $('#opcion1').hide("slow");
            });


            $('#radioPrimary7').click(function() {
                $('#opcion2').show("slow");
            });
            $('#radioPrimary8').click(function() {
                $('#opcion2').hide("slow");
            });

            $('#radioPrimary9').click(function() {
                $('#opcion3').show("slow");
            });
            $('#radioPrimary10').click(function() {
                $('#opcion3').hide("slow");
            });


            $('#radioPrimary55').click(function() {
                $('#opcion4').show("slow");
            });
            $('#radioPrimary56').click(function() {
                $('#opcion4').hide("slow");
            });

            $('#radioPrimary57').click(function() {
                $('#opcion5').show("slow");
            });
            $('#radioPrimary58').click(function() {
                $('#opcion5').hide("slow");
            });

            $('#radioPrimary11112').click(function() {
                $('#opcion6').show("slow");
            });
            $('#radioPrimary8888').click(function() {
                $('#opcion6').hide("slow");
            });


            $('#radioPrimary60').click(function() {
                $('#opcion7').show("slow");
            });
            $('#radioPrimary61').click(function() {
                $('#opcion7').hide("slow");
            });


            $('#radioPrimary99').click(function() {
                $('#opcion8').show("slow");
            });
            $('#radioPrimary908').click(function() {
                $('#opcion8').hide("slow");
            });

            $('#radioPrimary635').click(function() {
                $('#opcion9').show("slow");
            });
            $('#radioPrimary646').click(function() {
                $('#opcion9').hide("slow");
            });

            $('#radioPrimary65').click(function() {
                $('#opcion10').show("slow");
            });
            $('#radioPrimary66').click(function() {
                $('#opcion10').hide("slow");
            });

            $('#radioPrimary67').click(function() {
                $('#opcion11').show("slow");
            });
            $('#radioPrimary68').click(function() {
                $('#opcion11').hide("slow");
            });

            $('#radioPrimary69').click(function() {
                $('#opcion12').show("slow");
            });
            $('#radioPrimary70').click(function() {
                $('#opcion12').hide("slow");
            });

            $('#radioPrimary71').click(function() {
                $('#opcion13').show("slow");
            });
            $('#radioPrimary72').click(function() {
                $('#opcion13').hide("slow");
            });

            $('#radioPrimary73').click(function() {
                $('#opcion14').show("slow");
            });
            $('#radioPrimary74').click(function() {
                $('#opcion14').hide("slow");
            });

            $('#radioPrimary76').click(function() {
                $('#opcion15').show("slow");
            });
            $('#radioPrimary77').click(function() {
                $('#opcion15').hide("slow");
            });

            $('#radioPrimary79').click(function() {
                $('#opcion16').show("slow");
            });
            $('#radioPrimary80').click(function() {
                $('#opcion16').hide("slow");
            });

            $('#radioPrimary81').click(function() {
                $('#opcion17').show("slow");
            });
            $('#radioPrimary82').click(function() {
                $('#opcion17').hide("slow");
            });


            $('#radioPrimary83').click(function() {
                $('#opcion18').show("slow");
            });
            $('#radioPrimary84').click(function() {
                $('#opcion18').hide("slow");
            });

            $('#radioPrimary88').click(function() {
                $('#opcion19').show("slow");
            });
            $('#radioPrimary89').click(function() {
                $('#opcion19').hide("slow");
            });


            $('#radioPrimary90').click(function() {
                $('#opcion20').show("slow");
            });
            $('#radioPrimary91').click(function() {
                $('#opcion20').hide("slow");
            });

        //
        });
    </script>
@endpush
@endsection

