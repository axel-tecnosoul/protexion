@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/historia_clinica">Indice de Historias Clinicas</a></li>
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
</style>

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
                    <!-- Voucher -->
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
                                        <input class="form-control calculoIMC" type="number" step="0.01" id="estatura" name="estatura" placeholder="Estatura">
                                    </div>
                                    <div class="col">
                                        <label for="" class="form-label">Peso (Kgs):</label>
                                        <input class="form-control calculoIMC" type="number" step="0.01" id="peso" name="peso" placeholder="Peso">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Índice MC:</label>
                                        <input class="form-control" type="number" step="0.01" id="imc" name="imc" placeholder="IMC" readonly>
                                    </div>
                                    <div class="col" style="text-align: center;padding-top: 5%" hidden>
                                        <div class="icheck-danger d-inline" style="">
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
                                        <input class="form-control" type="text" name="medicacion_actual" placeholder="Medicación...">
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
                                        <input class="form-control" type="text" name="frecuencia_cardiaca" placeholder="Frecuencia cardíaca">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label for="">Tensión arterial:</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input class="form-control" type="text" name="sistolica" placeholder="Sistolica">
                                            </div>
                                            <div class="col-6">
                                                <input class="form-control" type="text" name="diastolica" placeholder="Diastolica">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <label for="">Observaciones:</label>
                                        <input class="form-control" type="text" name="tension_arterial" placeholder="Observaciones...">
                                    </div>
                                </div> <hr>
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label for="">Pulso:</label>
                                    </div>
                                    <div class="col-2">
                                        <label><input type="radio" name="pulso" value="A">Anormal</label>
                                    </div>
                                    <div class="col-2">
                                        <label><input type="radio" name="pulso" value="N">Normal</label>
                                    </div>
                                </div><hr>
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Várices:</label>
                                        <input class="form-control" type="text" name="observacion_varices" placeholder="Si corresponde, indique el tipo">
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
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion1_neu">
                                    </div>
                                </div>
                                <!-- Motilidad pasiva -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Motilidad pasiva</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion2_neu">
                                    </div>
                                </div>
                                <!-- Sensibilidad -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Sensibilidad</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion3_neu">
                                    </div>
                                </div>
                                <!-- Marcha -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Marcha</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion4_neu">
                                    </div>
                                </div>
                                <!-- Reflejos osteotendinosos -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Reflejos osteotendinosos</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion5_neu">
                                    </div>
                                </div>
                                <!-- Pares craneales -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Pares craneales</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion6_neu">
                                    </div>
                                </div>
                                <!-- Taxia -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Taxia</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion7_neu">
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones" type="text" name="observacion_neu">
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
                                        <input class="form-control" type="text" name="observacion1_piel" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Vesícula -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Vesículas                                   </label>
                                        <input class="form-control" type="text" name="obs_vesicula" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Ulceras -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Ulceras                                    </label>
                                        <input class="form-control" type="text" name="obs_ulceras" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Fisuras -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Fisuras                                    </label>
                                        <input class="form-control" type="text" name="obs_fisuras" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Prurito -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Prurito                                    </label>
                                        <input class="form-control" type="text" name="obs_prurito" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Eczemas -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Eczemas                                    </label>
                                        <input class="form-control" type="text" name="obs_eczemas" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Dermatitis -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Dermatitis                                 </label>
                                        <input class="form-control" type="text" name="obs_dertmatitis" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Eritemas -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Eritemas                                   </label>
                                        <input class="form-control" type="text" name="obs_eritemas" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Petequias -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Petequias                                  </label>
                                        <input class="form-control" type="text" name="obs_petequias" placeholder="Describa si corresponde...">
                                    </div>
                                </div>
                                <!-- Tejido celular subcutaneo -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Tejido celular subcutaneo                                  </label>
                                        <input class="form-control" type="text" name="tejido" placeholder="Describa si corresponde...">
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
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion1_os">
                                    </div>
                                </div>
                                <!-- Amputaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Amputaciones</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion2_os">
                                    </div>
                                </div>
                                <!-- Movilidad y reflejo -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Movilidad y reflejo</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion3_os">
                                    </div>
                                </div>
                                <!-- Tonicidad y fuerza muscular normal -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Tonicidad y fuerza muscular normal</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion4_os">
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones" type="text" name="observacion_os">
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
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion1_col">
                                    </div>
                                </div>
                                <!-- Contracturas -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Contracturas</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion2_col">
                                    </div>
                                </div>
                                <!-- Puntos dolorosos -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Puntos dolorosos</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion3_col">
                                    </div>
                                </div>
                                <!-- Limitaciones funcionales -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Limitaciones funcionales</label>
                                        <input class="form-control" placeholder="Describa si corresponde..." type="text" name="observacion4_col">
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones" type="text" name="observacion_col">
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
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion1_cc">
                                    </div>
                                </div>
                                <!-- Cara -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Cara</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion2_cc">
                                    </div>
                                </div>
                                <!-- Nariz -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Nariz</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion3_cc">
                                    </div>
                                </div>
                                <!-- Oídos -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Oídos</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion4_cc">
                                    </div>
                                </div>  
                                <!-- Boca -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Boca</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion5_cc">
                                    </div>
                                </div>   
                                <!-- Cuello y Tiroides -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Cuello y Tiroides</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion6_cc">
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
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion1_of">
                                    </div>
                                </div>
                                <!-- Corneas -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Corneas</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion2_of">
                                    </div>
                                </div>
                                <!-- Conjuntivas -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Conjuntivas</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion3_of">
                                    </div>
                                </div>
                                <!-- Visión en colores -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Visión en colores</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion4_of">
                                    </div>
                                </div>
                                <!-- Ojo derecho -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Agudeza visual ojo derecho</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion5_of">
                                    </div>
                                </div>
                                <!-- Ojo izquierdo -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Agudeza visual ojo izquierdo</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion6_of">
                                    </div>
                                </div>
                                <!-- Usa lentes -->
                                <div class="form-group row">
                                    <div class="col">
                                        <div class="icheck-danger d-inline">
                                            <input value=1 type="checkbox" name="pregunta7_of" id="pregunta7_of">
                                            <label for="pregunta7_of">Usa lentes</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones" type="text" name="observacion_of">
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
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion1_ab">
                                    </div>
                                </div>
                                <!-- Hígado -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Hígado</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion2_ab">
                                    </div>
                                </div>
                                <!-- Bazo -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Bazo</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion3_ab">
                                    </div>
                                </div>
                                <!-- Colon -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Colon</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion4_ab">
                                    </div>
                                </div>
                                <!-- Ruidos hidroaéreos -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Ruidos hidroaéreos</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion5_ab">
                                    </div>
                                </div>
                                <!-- Puño percusión -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Puño percusión</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion6_ab">
                                    </div>
                                </div>
                                <!-- Cicatrices quirúrjicas -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Cicatrices quirúrjicas</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion_ab">
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
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion1_od">
                                    </div>
                                </div>
                                <!-- Esmalte dental -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Esmalte dental</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion2_od">
                                    </div>
                                </div>
                                <!-- Prótesis -->
                                <h3>Prótesis</h3>
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Superior</label>
                                        <input class="form-control" placeholder="Indique si posee..." type="text" name="superior">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Inferior</label>
                                        <input class="form-control" placeholder="Indique si posee..." type="text" name="inferior">
                                    </div>
                                </div>
                                <!-- Caries -->
                                <div class="form-group row">
                                    <div class="col">
                                        <div class="icheck-danger d-inline">
                                            <input value=1 type="checkbox" name="pregunta4_od" id="pregunta4_od">
                                            <label for="pregunta4_od">Caries</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Faltan piezas dentarias -->
                                <div class="form-group row">
                                    <div class="col">
                                        <div class="icheck-danger d-inline">
                                            <input value=1 type="checkbox" name="pregunta5_od" id="pregunta5_od">
                                            <label for="pregunta5_od">Faltan piezas dentarias</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones" type="text" name="observacion_od">
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
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion1_re">
                                    </div>
                                </div>
                                <!-- Pulmones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Pulmones</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion2_re">
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
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion1_in">
                                    </div>
                                </div>
                                <!-- Orificios superficiales -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Orificios superficiales</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion2_in">
                                    </div>
                                </div>
                                <!-- Orificios profundos -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Orificios profundos</label>
                                        <input class="form-control" placeholder="Describa las anormalidades..." type="text" name="observacion3_in">
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones" type="text" name="observacion_in">
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
                                        <input class="form-control" placeholder="Describa las anormalidades" type="text" name="observacion1_ge">
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones." type="text" name="observacion_ge">
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
                                        <input class="form-control" placeholder="Describa las anormalidades" type="text" name="observacion1_an">
                                    </div>
                                </div>
                                <!-- Observaciones -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input class="form-control" placeholder="Observaciones" type="text" name="observacion_an">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            //Firma
                var wrapper = document.getElementById("signature-pad");
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
                });
            //
        });

        // Observaciones
        //$(".calculoIMC").change(function()
        $(".calculoIMC").on("change, keyup",function()
        {
            //Variables
                let altura = $("#estatura").val();
                let peso = $("#peso").val();
                let imc = peso/(altura*altura);
            //
            
            //Redondeo
            $("#imc").val(imc.toFixed(2));

            //Calculo de IMC
            if (imc >= "30") {
                $("#sobrepeso").prop('checked', true);
                $("#descripcionIMC").val('Sobrepeso');
            } else {
                $("#sobrepeso").prop('checked', false);
                if (imc <= "18") {
                    $("#descripcionIMC").val('Muy bajo');
                } else {
                    $("#descripcionIMC").val('Normal');
                }
            }
        })

    </script>
@endpush

@endsection

