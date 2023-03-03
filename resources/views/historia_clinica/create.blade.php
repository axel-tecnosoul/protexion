@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/historia_clinica">Indice de Historias Clinicas</a></li>
    <li class="breadcrumb-item active">Historia Clinica</li>
@endsection

@section('content')
{!!Form::open(array(
    'url'=>'historia_clinica',
    'method'=>'POST',
    'autocomplete'=>'off',
    'files' => true,
))!!}

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
</style><?php

$estatura=$altura_decla_jurada;
$peso=$peso_decla_jurada;

//HISTORIA CLINICA
$estatura_anterior="";
$peso_anterior="";
$sobrepeso="";
$imc="";
$medicacion_actual="";
$frecuencia_cardiaca="";
$sistolica="";
$diastolica="";
$tension_arterial="";
$observacion_varices="";
$checked_pulso_anormal="";
$checked_pulso_normal="";
$observacion1_piel="";
$obs_vesicula="";
$obs_ulceras="";
$obs_fisuras="";
$obs_prurito="";
$obs_eczemas="";
$obs_dertmatitis="";
$obs_eritemas="";
$obs_petequias="";
$tejido="";
$observacion1_os="";
$observacion2_os="";
$observacion3_os="";
$observacion4_os="";
$observacion_os="";
$observacion1_col="";
$observacion2_col="";
$observacion3_col="";
$observacion4_col="";
$observacion_col="";
$observacion1_cc="";
$observacion2_cc="";
$observacion3_cc="";
$observacion4_cc="";
$observacion5_cc="";
$observacion6_cc="";
$observacion1_of="";
$observacion2_of="";
$observacion3_of="";
$observacion4_of="";
$observacion5_of="";
$observacion6_of="";
$usa_lentes="";
$observacion_of="";
$observacion1_neu="";
$observacion2_neu="";
$observacion3_neu="";
$observacion4_neu="";
$observacion5_neu="";
$observacion6_neu="";
$observacion7_neu="";
$observacion_neu="";
$observacion1_od="";
$observacion2_od="";
$pregunta4_od="";
$pregunta5_od="";
$superior="";
$inferior="";
$observacion_od="";
$observacion1_re="";
$observacion2_re="";
$observacion1_ab="";
$observacion2_ab="";
$observacion3_ab="";
$observacion4_ab="";
$observacion5_ab="";
$observacion6_ab="";
$observacion_ab="";
$observacion1_in="";
$observacion2_in="";
$observacion3_in="";
$observacion_in="";
$observacion1_ge="";
$observacion_ge="";
$observacion1_an="";
$observacion_an="";
/* EXAMEN CLÌNICO */
if(isset($historia_clinica_anterior)){
  $estatura_anterior=($historia_clinica_anterior->examenClinico->estatura) ? "Historia Clinica Anterior: ".$historia_clinica_anterior->examenClinico->estatura : "";
  $peso_anterior=($historia_clinica_anterior->examenClinico->peso) ? "Historia Clinica Anterior: ".$historia_clinica_anterior->examenClinico->peso : "";
  $sobrepeso=($historia_clinica_anterior->examenClinico->sobrepeso) ?: "";
  $imc=($historia_clinica_anterior->examenClinico->imc) ?: "";
  $medicacion_actual=($historia_clinica_anterior->examenClinico->medicacion_actual) ?: "";
  /* CARDIOVASCULAR */
  $frecuencia_cardiaca=($historia_clinica_anterior->cardiovascular->frecuencia_cardiaca) ?: "";
  $sistolica=($historia_clinica_anterior->cardiovascular->sistolica) ?: "";
  $diastolica=($historia_clinica_anterior->cardiovascular->diastolica) ?: "";
  $tension_arterial=($historia_clinica_anterior->cardiovascular->tension_arterial) ?: "";  
  $observacion_varices=($historia_clinica_anterior->cardiovascular->observacion_varices) ?: "";
  $checked_pulso_anormal=($historia_clinica_anterior->cardiovascular->pulso=="A") ? "checked" : "";
  $checked_pulso_normal=($historia_clinica_anterior->cardiovascular->pulso=="N") ? "checked" : "";
  /* PIEL*/
  $observacion1_piel=($historia_clinica_anterior->piel->observacion1_piel) ?: "";
  $obs_vesicula=($historia_clinica_anterior->piel->obs_vesicula) ?: "";
  $obs_ulceras=($historia_clinica_anterior->piel->obs_ulceras) ?: "";
  $obs_fisuras=($historia_clinica_anterior->piel->obs_fisuras) ?: "";
  $obs_prurito=($historia_clinica_anterior->piel->obs_prurito) ?: "";
  $obs_eczemas=($historia_clinica_anterior->piel->obs_eczemas) ?: "";
  $obs_dertmatitis=($historia_clinica_anterior->piel->obs_dertmatitis) ?: "";
  $obs_eritemas=($historia_clinica_anterior->piel->obs_eritemas) ?: "";
  $obs_petequias=($historia_clinica_anterior->piel->obs_petequias) ?: "";
  $tejido=($historia_clinica_anterior->piel->tejido) ?: "";
  /* OSTEOARTICULAR */
  $observacion1_os=($historia_clinica_anterior->osteoarticular->observacion1_os) ?: "";
  $observacion2_os=($historia_clinica_anterior->osteoarticular->observacion2_os) ?: "";
  $observacion3_os=($historia_clinica_anterior->osteoarticular->observacion3_os) ?: "";
  $observacion4_os=($historia_clinica_anterior->osteoarticular->observacion4_os) ?: "";
  $observacion_os=($historia_clinica_anterior->osteoarticular->observacion_os) ?: "";
  /* COLUMNA VERTEBRAL */
  $observacion1_col=($historia_clinica_anterior->columna->observacion1_col) ?: "";
  $observacion2_col=($historia_clinica_anterior->columna->observacion2_col) ?: "";
  $observacion3_col=($historia_clinica_anterior->columna->observacion3_col) ?: "";
  $observacion4_col=($historia_clinica_anterior->columna->observacion4_col) ?: "";
  $observacion_col=($historia_clinica_anterior->columna->observacion_col) ?: "";
  /*CABEZA Y CUELLO*/
  $observacion1_cc=($historia_clinica_anterior->cabezaCuello->observacion1_cc) ?: "";
  $observacion2_cc=($historia_clinica_anterior->cabezaCuello->observacion2_cc) ?: "";
  $observacion3_cc=($historia_clinica_anterior->cabezaCuello->observacion3_cc) ?: "";
  $observacion4_cc=($historia_clinica_anterior->cabezaCuello->observacion4_cc) ?: "";
  $observacion5_cc=($historia_clinica_anterior->cabezaCuello->observacion5_cc) ?: "";
  $observacion6_cc=($historia_clinica_anterior->cabezaCuello->observacion6_cc) ?: "";
  /*OFTALMOLOGICO*/
  $observacion1_of=($historia_clinica_anterior->oftalmologico->observacion1_of) ?: "";
  $observacion2_of=($historia_clinica_anterior->oftalmologico->observacion2_of) ?: "";
  $observacion3_of=($historia_clinica_anterior->oftalmologico->observacion3_of) ?: "";
  $observacion4_of=($historia_clinica_anterior->oftalmologico->observacion4_of) ?: "";
  /*Examen de Agudeza Visual*/
  $observacion5_of=($historia_clinica_anterior->oftalmologico->observacion5_of) ?: "";
  $observacion6_of=($historia_clinica_anterior->oftalmologico->observacion6_of) ?: "";
  $usa_lentes=($historia_clinica_anterior->oftalmologico->pregunta7_of==1) ? "checked" : "";
  $observacion_of=($historia_clinica_anterior->oftalmologico->observacion_of) ?: "";
  /* NEUROLOGICO */
  $observacion1_neu=($historia_clinica_anterior->neurologico->observacion1_neu) ?: "";
  $observacion2_neu=($historia_clinica_anterior->neurologico->observacion2_neu) ?: "";
  $observacion3_neu=($historia_clinica_anterior->neurologico->observacion3_neu) ?: "";
  $observacion4_neu=($historia_clinica_anterior->neurologico->observacion4_neu) ?: "";
  $observacion5_neu=($historia_clinica_anterior->neurologico->observacion5_neu) ?: "";
  $observacion6_neu=($historia_clinica_anterior->neurologico->observacion6_neu) ?: "";
  $observacion7_neu=($historia_clinica_anterior->neurologico->observacion7_neu) ?: "";
  $observacion_neu=($historia_clinica_anterior->neurologico->observacion_neu) ?: "";
  /* ODONTOLOGICO */
  $observacion1_od=($historia_clinica_anterior->odontologico->observacion1_od) ?: "";
  $observacion2_od=($historia_clinica_anterior->odontologico->observacion2_od) ?: "";
  $pregunta4_od=($historia_clinica_anterior->odontologico->pregunta4_od==1) ? "checked" : "";
  //$usa_lentes=($historia_clinica_anterior->oftalmologico->pregunta7_of==1) ? "checked" : "";
  $pregunta5_od=($historia_clinica_anterior->odontologico->pregunta5_od==1) ? "checked" : "";
  //$usa_lentes=($historia_clinica_anterior->oftalmologico->pregunta7_of==1) ? "checked" : "";
  $superior=($historia_clinica_anterior->odontologico->superior) ?: "";
  $inferior=($historia_clinica_anterior->odontologico->inferior) ?: "";
  $observacion_od=($historia_clinica_anterior->odontologico->observacion_od) ?: "";
  /* TORAX Y APARATO RESPIRATORIO */
  $observacion1_re=($historia_clinica_anterior->respiratorio->observacion1_re) ?: "";
  $observacion2_re=($historia_clinica_anterior->respiratorio->observacion2_re) ?: "";
  /* ABDOMEN */
  $observacion1_ab=($historia_clinica_anterior->abdomen->observacion1_ab) ?: "";
  $observacion2_ab=($historia_clinica_anterior->abdomen->observacion2_ab) ?: "";
  $observacion3_ab=($historia_clinica_anterior->abdomen->observacion3_ab) ?: "";
  $observacion4_ab=($historia_clinica_anterior->abdomen->observacion4_ab) ?: "";
  $observacion5_ab=($historia_clinica_anterior->abdomen->observacion5_ab) ?: "";
  $observacion6_ab=($historia_clinica_anterior->abdomen->observacion6_ab) ?: "";
  $observacion_ab=($historia_clinica_anterior->abdomen->observacion_ab) ?: "";
  /* REGIONES INGUINALES */
  $observacion1_in=($historia_clinica_anterior->regionInguinal->observacion1_in) ?: "";
  $observacion2_in=($historia_clinica_anterior->regionInguinal->observacion2_in) ?: "";
  $observacion3_in=($historia_clinica_anterior->regionInguinal->observacion3_in) ?: "";
  $observacion_in=($historia_clinica_anterior->regionInguinal->observacion_in) ?: "";
  /* GENITALES */
  $observacion1_ge=($historia_clinica_anterior->genital->observacion1_ge) ?: "";
  $observacion_ge=($historia_clinica_anterior->genital->observacion_ge) ?: "";
  /* REGION ANAL */
  $observacion1_an=($historia_clinica_anterior->regionAnal->observacion1_an) ?: "";
  $observacion_an=($historia_clinica_anterior->regionAnal->observacion_an) ?: "";
}
?>

{{Form::token()}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header fondo2 ">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fas fa-stethoscope"></i> Historia Clínica</p>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Visita -->
                    <input type="number" name="voucher_id" value={{$voucher->id}} hidden>
                    <!-- Descripción  -->
                    <div class="col-12">
                        <div class="card" >
                            <div class="card-header header-bg">
                                <h3 class="card-title">Descripción</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <p>
                                            DIRIGIDA A LA TAREA DESEMPEÑADA Y ORIENTADA A LA INVESTIGACION DE AGENTES DE RIESGO Y SU 
                                            REPERCUSION CLINICA EN EL EXAMINADO. <br> INCLUYE EL ANEXO I (ART. 13 Y 14 RESOLUCION S.R.T. 43/97)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <!-- Examen clinico  -->
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Examen Clínico</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Estatura (Mts): </label>
                                        <input class="form-control calculoIMC" type="number" step="0.01" id="estatura" name="estatura" value="<?=$estatura?>" placeholder="Estatura Ej. 1.72" required>
                                        <label style="font-size: 13px;" class="form-label"><?=$estatura_anterior?></label>
                                    </div>
                                    <div class="col">
                                        <label for="" class="form-label">Peso (Kgs):</label>
                                        <input class="form-control calculoIMC" type="number" step="0.01" id="peso" name="peso" value="<?=$peso?>" placeholder="Peso" required>
                                        <label style="font-size: 13px;" class="form-label"><?=$peso_anterior?></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Índice MC:</label>
                                        <input class="form-control" type="number" step="0.01" id="imc" name="imc" placeholder="IMC" readonly>
                                    </div>
                                    <div class="col" style="text-align: center;padding-top: 5%" hidden>
                                        <div class="icheck-danger d-inline">
                                            <input value=1 type="checkbox" name="sobrepeso" id="sobrepeso">
                                            <label for="sobrepeso">Sobrepeso</label>
                                        </div>
                                    </div>
                                    <div class="col" >
                                        <label class="form-label">Descripción:</label>
                                        <input class="form-control" type="text" id="descripcionIMC" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Medicación actual:</label>
                                        <input class="form-control" type="text" name="medicacion_actual" value="<?=$medicacion_actual?>" placeholder="Medicación...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cardiovascular -->
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Cardiovascular</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Frecuencia cardíaca:</label>
                                        <input class="form-control" type="text" name="frecuencia_cardiaca" value="<?=$frecuencia_cardiaca?>" placeholder="Frecuencia cardíaca" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label for="">Tensión arterial:</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input class="form-control" type="text" name="sistolica" value="<?=$sistolica?>" placeholder="Sistolica" required>
                                            </div>
                                            <div class="col-6">
                                                <input class="form-control" type="text" name="diastolica" value="<?=$diastolica?>" placeholder="Diastolica" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <label for="">Observaciones:</label>
                                        <input class="form-control" type="text" name="tension_arterial" value="<?=$tension_arterial?>" placeholder="Observaciones...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label for="">Pulso:</label>
                                    </div>
                                    <div class="col-3">
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" name="pulso" id="pulso_anormal" <?=$checked_pulso_anormal?> value="A" required>
                                            <label for="pulso_anormal">Anormal</label>
                                        </div>
                                        <!-- <label><input type="radio" name="pulso" <?=$checked_pulso_anormal?> value="A" required>Anormal</label> -->
                                    </div>
                                    <div class="col-3">
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" name="pulso" id="pulso_normal" <?=$checked_pulso_normal?> value="N" required>
                                            <label for="pulso_normal">Normal</label>
                                        </div>
                                        <!-- <label><input type="radio" name="pulso" <?=$checked_pulso_normal?> value="N">Normal</label> -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Várices:</label>
                                        <input class="form-control" type="text" name="observacion_varices" value="<?=$observacion_varices?>" placeholder="Si corresponde, indique el tipo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Piel -->
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Piel</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Cicatrices -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">¿Cicatrices patológicas visibles?          </label>
                                        <input class="form-control" type="text" name="observacion1_piel" value="<?=$observacion1_piel?>" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Vesícula -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Vesículas                                   </label>
                                        <input class="form-control" type="text" name="obs_vesicula" value="<?=$obs_vesicula?>" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Ulceras -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Ulceras                                    </label>
                                        <input class="form-control" type="text" name="obs_ulceras" value="<?=$obs_ulceras?>" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Fisuras -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Fisuras                                    </label>
                                        <input class="form-control" type="text" name="obs_fisuras" value="<?=$obs_fisuras?>" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Prurito -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Prurito                                    </label>
                                        <input class="form-control" type="text" name="obs_prurito" value="<?=$obs_prurito?>" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Eczemas -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Eczemas                                    </label>
                                        <input class="form-control" type="text" name="obs_eczemas" value="<?=$obs_eczemas?>" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Dermatitis -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Dermatitis                                 </label>
                                        <input class="form-control" type="text" name="obs_dertmatitis" value="<?=$obs_dertmatitis?>" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Eritemas -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Eritemas                                   </label>
                                        <input class="form-control" type="text" name="obs_eritemas" value="<?=$obs_eritemas?>" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Petequias -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Petequias                                  </label>
                                        <input class="form-control" type="text" name="obs_petequias" value="<?=$obs_petequias?>" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Tejido celular subcutaneo -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Tejido celular subcutaneo                                  </label>
                                        <input class="form-control" type="text" name="tejido" value="<?=$tejido?>" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Osteoarticular -->
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Osteoarticular</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Limitaciones funcionales -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Limitaciones funcionales</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion1_os" value="<?=$observacion1_os?>">
                                    </div>
                                </div>
                                <!-- Amputaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Amputaciones</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion2_os" value="<?=$observacion2_os?>">
                                    </div>
                                </div>
                                <!-- Movilidad y reflejo -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Movilidad y reflejo</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion3_os" value="<?=$observacion3_os?>">
                                    </div>
                                </div>
                                <!-- Tonicidad y fuerza muscular normal -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Tonicidad y fuerza muscular normal</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion4_os" value="<?=$observacion4_os?>">
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones" type="text" name="observacion_os" value="<?=$observacion_os?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Columna vertebral -->
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Columna vertebral</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Examen normal -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Examen normal</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion1_col" value="<?=$observacion1_col?>">
                                    </div>
                                </div>
                                <!-- Contracturas -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Contracturas</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion2_col" value="<?=$observacion2_col?>">
                                    </div>
                                </div>
                                <!-- Puntos dolorosos -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Puntos dolorosos</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion3_col" value="<?=$observacion3_col?>">
                                    </div>
                                </div>
                                <!-- Limitaciones funcionales -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Limitaciones funcionales</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion4_col" value="<?=$observacion4_col?>">
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones" type="text" name="observacion_col" value="<?=$observacion_col?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cabeza y cuello -->
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Cabeza y cuello</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Instrucciones -->
                                <div class="row">
                                    <div class="card text-white bg-light col" style="width: max-content">
                                      <div class="card-body">
                                        <h4 class="card-title"><b>Instrucciones:</b></h4><br>
                                        <p>                                        
                                            <ul>
                                                <li>Si posee alguna anormalidad en estos items, describir.</li>
                                                <li>Si no posee anormalidades, dejar el campo en vacío.</li>
                                            </ul> 
                                        </p>
                                      </div>
                                    </div>
                                </div>
                                <!-- Cráneo -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Cráneo</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion1_cc" value="<?=$observacion1_cc?>">
                                    </div>
                                </div>
                                <!-- Cara -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Cara</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion2_cc" value="<?=$observacion2_cc?>">
                                    </div>
                                </div>
                                <!-- Nariz -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Nariz</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion3_cc" value="<?=$observacion3_cc?>">
                                    </div>
                                </div>
                                <!-- Oídos -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Oídos</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion4_cc" value="<?=$observacion4_cc?>">
                                    </div>
                                </div>  
                                <!-- Boca -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Boca</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion5_cc" value="<?=$observacion5_cc?>">
                                    </div>
                                </div>   
                                <!-- Cuello y Tiroides -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Cuello y Tiroides</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion6_cc" value="<?=$observacion6_cc?>">
                                    </div>
                                </div>                 
                            </div>
                        </div>
                    </div>
                    <!-- Oftalmológico -->
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Oftalmológico</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Pupilas -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Pupilas</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion1_of" value="<?=$observacion1_of?>">
                                    </div>
                                </div>
                                <!-- Corneas -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Corneas</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion2_of" value="<?=$observacion2_of?>">
                                    </div>
                                </div>
                                <!-- Conjuntivas -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Conjuntivas</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion3_of" value="<?=$observacion3_of?>">
                                    </div>
                                </div>
                                <!-- Visión en colores -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Visión en colores</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion4_of" value="<?=$observacion4_of?>">
                                    </div>
                                </div>
                                <!-- Ojo derecho -->
                                <div class="form-group row">
                                    <div class="col input-group">
                                        <label for="" class="form-label w-100">Agudeza visual ojo derecho</label><br>
                                        <!-- <input aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion5_of" value="<?=$observacion5_of?>" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                          <span class="input-group-text" id="basic-addon2">/10</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Ojo izquierdo -->
                                <div class="form-group row">
                                    <div class="col input-group">
                                        <label for="" class="form-label w-100">Agudeza visual ojo izquierdo</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion6_of" value="<?=$observacion6_of?>">
                                        <div class="input-group-append">
                                          <span class="input-group-text" id="basic-addon2">/10</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Usa lentes -->
                                <div class="form-group row">
                                    <div class="col">
                                        <div class="icheck-danger d-inline">
                                            <input value=1 type="checkbox" name="pregunta7_of" <?=$usa_lentes?> id="pregunta7_of">
                                            <label for="pregunta7_of">Usa lentes</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones" type="text" name="observacion_of" value="<?=$observacion_of?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Neurológico -->
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Neurológico</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Instrucciones -->
                                <div class="row">
                                    <div class="card text-white bg-light col" style="width: max-content">
                                      <div class="card-body">
                                        <h4 class="card-title"><b>Instrucciones:</b></h4><br>
                                        <p>                                        
                                            <ul>
                                                <li>Si corresponde alguno de estos items, describirlos.</li>
                                                <li>En caso de que corresponda y no se desee ingresar una descripción, escriba "Si".</li>
                                                <li>Si el item no corresponde, dejar el campo en vacío.</li>
                                            </ul> 
                                        </p>
                                      </div>
                                    </div>
                                </div>
                                <!-- Motilidad activa -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Motilidad activa</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion1_neu" value="<?=$observacion1_neu?>">
                                    </div>
                                </div>
                                <!-- Motilidad pasiva -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Motilidad pasiva</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion2_neu" value="<?=$observacion2_neu?>">
                                    </div>
                                </div>
                                <!-- Sensibilidad -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Sensibilidad</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion3_neu" value="<?=$observacion3_neu?>">
                                    </div>
                                </div>
                                <!-- Marcha -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Marcha</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion4_neu" value="<?=$observacion4_neu?>">
                                    </div>
                                </div>
                                <!-- Reflejos osteotendinosos -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Reflejos osteotendinosos</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion5_neu" value="<?=$observacion5_neu?>">
                                    </div>
                                </div>
                                <!-- Pares craneales -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Pares craneales</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion6_neu" value="<?=$observacion6_neu?>">
                                    </div>
                                </div>
                                <!-- Taxia -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Taxia</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion7_neu" value="<?=$observacion7_neu?>">
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones" type="text" name="observacion_neu" value="<?=$observacion_neu?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Odontológico -->
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Odontológico</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Encias y mucosas -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Encias y mucosas</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion1_od" value="<?=$observacion1_od?>">
                                    </div>
                                </div>
                                <!-- Esmalte dental -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Esmalte dental</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion2_od" value="<?=$observacion2_od?>">
                                    </div>
                                </div>
                                <!-- Prótesis -->
                                <h3>Prótesis</h3>
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Superior</label>
                                        <input class="form-control" placeholder="Indique si posee..." type="text" name="superior" value="<?=$superior?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Inferior</label>
                                        <input class="form-control" placeholder="Indique si posee..." type="text" name="inferior" value="<?=$inferior?>">
                                    </div>
                                </div>
                                <!-- Caries -->
                                <div class="form-group row">
                                    <div class="col">
                                        <div class="icheck-danger d-inline">
                                            <input value=1 type="checkbox" name="pregunta4_od" <?=$pregunta4_od?> id="pregunta4_od">
                                            <label for="pregunta4_od">Caries</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Faltan piezas dentarias -->
                                <div class="form-group row">
                                    <div class="col">
                                        <div class="icheck-danger d-inline">
                                            <input value=1 type="checkbox" name="pregunta5_od" <?=$pregunta5_od?> id="pregunta5_od">
                                            <label for="pregunta5_od">Faltan piezas dentarias</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones" type="text" name="observacion_od" value="<?=$observacion_od?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tórax y aparato respiratorio -->
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Tórax y aparato respiratorio</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Caja torácica -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Caja torácica</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion1_re" value="<?=$observacion1_re?>">
                                    </div>
                                </div>
                                <!-- Pulmones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Pulmones</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion2_re" value="<?=$observacion2_re?>">
                                    </div>
                                </div>
                                <!-- Covid 1 -->
                                <div class="form-group row d-none">
                                    <div class="col">
                                        <label for="" class="form-label">COVID 19</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="covid19">
                                    </div>
                                </div>
                                <!-- Vacunas -->
                                <div class="form-group row d-none">
                                    <div class="col">
                                        <label for="" class="form-label">Vacunas</label>
                                        <input class="form-control" placeholder="Describa las dosis..." type="text" name="vacunado">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Abdomen -->
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Abdomen</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Forma -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Forma</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion1_ab" value="<?=$observacion1_ab?>">
                                    </div>
                                </div>
                                <!-- Hígado -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Hígado</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion2_ab" value="<?=$observacion2_ab?>">
                                    </div>
                                </div>
                                <!-- Bazo -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Bazo</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion3_ab" value="<?=$observacion3_ab?>">
                                    </div>
                                </div>
                                <!-- Colon -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Colon</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion4_ab" value="<?=$observacion4_ab?>">
                                    </div>
                                </div>
                                <!-- Ruidos hidroaéreos -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Ruidos hidroaéreos</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion5_ab" value="<?=$observacion5_ab?>">
                                    </div>
                                </div>
                                <!-- Puño percusión -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Puño percusión</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion6_ab" value="<?=$observacion6_ab?>">
                                    </div>
                                </div>
                                <!-- Cicatrices quirúrjicas -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Cicatrices quirúrjicas</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion_ab" value="<?=$observacion_ab?>">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Regiones inguinales -->
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Regiones inguinales</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Tono de la pared posterior -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Tono de la pared posterior</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion1_in" value="<?=$observacion1_in?>">
                                    </div>
                                </div>
                                <!-- Orificios superficiales -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Orificios superficiales</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion2_in" value="<?=$observacion2_in?>">
                                    </div>
                                </div>
                                <!-- Orificios profundos -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Orificios profundos</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion3_in" value="<?=$observacion3_in?>">
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones" type="text" name="observacion_in" value="<?=$observacion_in?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Genitales -->
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Genitales</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Características -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Características</label>
                                        <input class="form-control" placeholder="Describa las anormalidades" type="text" name="observacion1_ge" value="<?=$observacion1_ge?>">
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones." type="text" name="observacion_ge" value="<?=$observacion_ge?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Región anal -->
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Región anal</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Características -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Características</label>
                                        <input class="form-control" placeholder="Describa las anormalidades" type="text" name="observacion1_an" value="<?=$observacion1_an?>">
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones" type="text" name="observacion_an" value="<?=$observacion_an?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Firma -->
                    <!-- <div class="col-12">
                        <div class="card ">
                            <div class="card-header fondo2">
                                <h3 class="card-title">Firma del Paciente</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <input type="hidden" name="firma" id="firma">
                    <!-- Guardar -->
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
                        <div class="form-group">
                            <input id="guardar" name="_token" value="{{ csrf_token() }}" type="hidden">
                                <button class="btn btn-success btn-lg btn-block" id="confirmar"type="submit"><i class="fa fa-check"> </i>Cargar al formulario</button>
                        </div>
                    </div>
                <!-- / Guardar -->
                </div>  
            </div>
        </div>
    </div>
</div>


{!!Form::close()!!}

@push('scripts')
    <script>
        $(document).ready(function(){
          calcular_imc();
            //Firma
                /*var wrapper = document.getElementById("signature-pad");
                var clearButton = wrapper.querySelector("[data-action=clear]");
                var changeColorButton = wrapper.querySelector("[data-action=change-color]");
                var guardar = document.getElementById("confirmar");
                var canvas = wrapper.querySelector("canvas");
                var signaturePad = new SignaturePad(canvas, {
                    backgroundColor: 'rgb(255, 255, 255)'
                });
                function resizeCanvas() {
                    var ratio =  Math.max(window.devicePixelRatio || 1, 1);
                    canvas.width = canvas.offsetWidth * ratio;
                    canvas.height = canvas.offsetHeight * ratio;
                    canvas.getContext("2d").scale(ratio, ratio);
                    signaturePad.clear();
                }
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

                guardar.addEventListener("click", function (event) {
                    if (signaturePad.isEmpty()) {
                    alert("Please provide a signature first.");
                    } else {
                    var dataURL = signaturePad.toDataURL('image/svg+xml');
                    document.getElementById('firma').value = dataURL;
                    }
                });*/
            //
        });

        // Observaciones
        //$(".calculoIMC").change(function()
        $(".calculoIMC").on("change, keyup",calcular_imc)

        function calcular_imc(){
          let altura = $("#estatura").val();

          if(altura>100){
            altura/=100;
          }
          let peso = $("#peso").val();
          let imc = peso/(altura*altura);
            
          //Redondeo
          $("#imc").val(imc.toFixed(2));

          console.log(imc);
          if (imc >= 35) {
            $("#sobrepeso").prop('checked', true);
            $("#descripcionIMC").val('Obesidad');
          } else if (imc >= 25) {
            $("#sobrepeso").prop('checked', true);
            $("#descripcionIMC").val('Sobrepeso');
          } else {
            $("#sobrepeso").prop('checked', false);
            if (imc <= 18) {
              $("#descripcionIMC").val('Bajo peso');
            } else {
              $("#descripcionIMC").val('Normopeso');
            }
          }
        }

    </script>
@endpush

@endsection

