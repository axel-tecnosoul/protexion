@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/declaracion_jurada">Indice de Pacientes</a></li>
    <li class="breadcrumb-item active">Declaración jurada de Salud</li>
@endsection

@section('content')
{!!Form::open(array(
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
                        <input type="number" name="voucher_id" value={{$voucher->id}} hidden>
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
                                            <input type="date" name="fecha_realizacion" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Estatura</label>
                                        <div class="input-group">
                                            <input type="number" step="0.01" name="estatura" placeholder="Ingrese la estatura" class="form-control" title="Ingrese la Estatura" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Peso</label>
                                        <div class="input-group">
                                            <input type="number" step="0.01" name="peso" placeholder="Ingrese el peso" class="form-control" title="Ingrese el Peso" required>
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
                                                <input value=1 type="checkbox" name="su_padre_vive" id="su_padre_vive">
                                                <label for="su_padre_vive">
                                                    ¿Su padre vive?
                                                </label>
                                            </div>
                                        </div>
                                        <!-- ¿Su madre vive? -->
                                        <div class="col">
                                            <div class="icheck-danger d-inline">
                                                <input value=1 type="checkbox" name="su_madre_vive" id="su_madre_vive">
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
                                                <input value=1 type="checkbox" name="cancer" id="cancer">
                                                <label for="cancer">Cáncer</label>
                                            </div>
                                        </div>
                                        <!-- Diabetes -->
                                        <div class="col">
                                            <div class="icheck-danger d-inline">
                                                <input value=1 type="checkbox" name="diabetes" id="diabetes">
                                                <label for="diabetes">Diabetes</label>
                                            </div>
                                        </div>
                                        <!-- Infarto -->
                                        <div class="col">
                                            <div class="icheck-danger d-inline">
                                                <input value=1 type="checkbox" name="infarto" id="infarto">
                                                <label for="infarto">Infarto</label>
                                            </div>
                                        </div>
                                        <!-- Hipertension Arterial -->
                                        <div class="col">
                                            <div class="icheck-danger d-inline">
                                                <input value=1 type="checkbox" name="hipertension_Arterial" id="hipertension_Arterial">
                                                <label for="hipertension_Arterial">Hipertension Arterial</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Opcional: Ingrese algun detalle -->
                                    <div class="form-group row">
                                        <label for="detalle">Si su padre o madre padecen alguna enfermedad actualmente, mencione el diagnóstico:</label>
                                        <input type="text" class="form-control" id="detalle"  name="detalle"  placeholder="Diagnóstico">
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
                                        <label for="detalle">
                                            Fuma:
                                        </label>
                                        <input type="text" class="form-control"  name="fuma"  placeholder="Describa e ingrese la cantidad si corresponde...">
                                    </div>
                                    <!-- Bebe -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            Bebe:
                                        </label>
                                        <input type="text" class="form-control"  name="bebe"  placeholder="Describa e ingrese la cantidad si corresponde...">
                                    </div>
                                    <!-- Actividad fisica -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            Actividad física:
                                        </label>
                                        <input type="text" class="form-control"  name="actividad_fisica"  placeholder="Describa e ingrese la cantidad si corresponde...">
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
                                            <input type="checkbox" value=1 name=sarampion id="todoCheck10"> 
                                            <label for="todoCheck10">Sarampión</label>
                                        </div>
                                        <input type="hidden" name=rebeola value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=rebeola id="todoCheck11">
                                            <label for="todoCheck11"> Rubéola</label>
                                        </div>
                                        <input type="hidden" name=epilepsia value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=epilepsia id="todoCheck12"> 
                                            <label for="todoCheck12">Epilepsias</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name=varicela value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=varicela id="todoCheck13"> 
                                            <label for="todoCheck13">Varicela</label>
                                        </div>
                                        <input type="hidden" name=parotiditis value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=parotiditis id="todoCheck14">
                                            <label for="todoCheck14"> Parotiditis</label>
                                        </div>
                                        <input type="hidden" name=cefalea_prolongada value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=cefalea_prolongada id="todoCheck15"> 
                                            <label for="todoCheck15">Cefalea prolongadas</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name=hepatitis value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=hepatitis id="todoCheck16"> 
                                            <label for="todoCheck16">Hepatítis</label>
                                        </div>
                                        <input type="hidden" name=gastritis value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=gastritis id="todoCheck17"> 
                                            <label for="todoCheck17">Gastrítis</label>
                                        </div>
                                        <input type="hidden" name=ulcera_gastrica value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=ulcera_gastrica id="todoCheck18">
                                            <label for="todoCheck18"> Ulcera Gástrica</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name=hemorroide value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=hemorroide id="todoCheck19"> 
                                            <label for="todoCheck19">Hemorroides</label>
                                        </div>
                                        <input type="hidden" name=hemorragias value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=hemorragias id="todoCheck20"> 
                                            <label for="todoCheck20">Hemorragia</label>
                                        </div>
                                        <input type="hidden" name=neumonia value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=neumonia id="todoCheck21"> 
                                            <label for="todoCheck21">Neumonía</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name=asma value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=asma id="todoCheck22"> 
                                            <label for="todoCheck22">Asma</label>
                                        </div>
                                        <input type="hidden" name=tuberculosis value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=tuberculosis id="todoCheck23"> 
                                            <label for="todoCheck23">Tuberculosis</label>
                                        </div>
                                        <input type="hidden" name=tos_cronica value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=tos_cronica id="todoCheck24"> 
                                            <label for="todoCheck24">Tos Crónica</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name=catarro value=0>
                                        <div class="col icheck-primary d-inline">
                                            <input type="checkbox" value=1 name=catarro id="todoCheck25">
                                            <label for="todoCheck25"> Catarro</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="" class="form-label">Otras Afecciones:</label>
                                            <input type="text" class="form-control" name="detalle1_m" placeholder="Describa...">
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
                                        <label for="detalle">
                                            ¿Enfermedad de los ojos, oidos , nariz o garganta?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle1_reciente"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Mareos, desmayos, convulsiones, dolores de cabeza, parálisis o ataques, desordenes mentales o nerviosos? -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            ¿Mareos, desmayos, convulsiones, dolores de cabeza, parálisis o ataques, desordenes mentales o nerviosos?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle2_reciente"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Insuficiencia respiratoria,  ronquera persistente, tos, asma, bronquitis, enfisema, tuberculosis o enfermedad respiratoria crónica? -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            ¿Insuficiencia respiratoria,  ronquera persistente, tos, asma, bronquitis, enfisema, tuberculosis o enfermedad respiratoria crónica?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle3_reciente"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Dolor de pecho, palpitaciones, presión sanguínea, fiebre reumática, ataque al corazón u otra enfermedad del corazón o vasos sanguíneos? -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            ¿Dolor de pecho, palpitaciones, presión sanguínea, fiebre reumática, ataque al corazón u otra enfermedad del corazón o vasos sanguíneos?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle4_reciente"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Ictericia, hemorragia intestinal, úlcera, colitis, diverticulosis, otras enfermedades del intestino, hígado o vesícula? -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            ¿Ictericia, hemorragia intestinal, úlcera, colitis, diverticulosis, otras enfermedades del intestino, hígado o vesícula?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle5_reciente"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Azúcar, sangre o pus en la orina, enfermedad del riñón, vejiga o próstata? -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            ¿Azúcar, sangre o pus en la orina, enfermedad del riñón, vejiga o próstata?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle6_reciente"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Diabetes, Tiroides u otra enfermedad endócrinas? -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            ¿Diabetes, Tiroides u otra enfermedad endócrinas?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle7_reciente"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Gota, Afecciones musculares u óseas, incluidos columna, espalda o articulaciones? -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            ¿Gota, Afecciones musculares u óseas, incluidos columna, espalda o articulaciones?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle8_reciente"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Deformidades, rengueras o amputaciones? -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            ¿Deformidades, rengueras o amputaciones?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle9_reciente"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Enfermedades de la piel? -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            ¿Enfermedades de la piel?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle10_reciente"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Alergias, anemias u otras enfermedades de la sangre? -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            ¿Alergias, anemias u otras enfermedades de la sangre?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle11_reciente"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Está Ud. Actualmente bajo observación o tratamiento? -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            ¿Está Ud. Actualmente bajo observación o tratamiento?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle12_reciente"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Ha tenido algún cambio en su peso en el último año? -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            ¿Ha tenido algún cambio en su peso en el último año?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle13_reciente"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- HERNIA -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            HERNIA
                                        </label>
                                        <input type="text" class="form-control"  name="detalle14_reciente"  placeholder="Detalle si corresponde...">
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
                                        <label for="detalle">
                                            ¿Fue intervenido/a quirúrgicamente por alguna causa?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle1_q"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Tiene pendiente alguna cirugía? -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            ¿Tiene pendiente alguna cirugía? Por favor detallar Diagnóstico y fecha:
                                        </label>
                                        <input type="text" class="form-control"  name="detalle2_q"  placeholder="Detalle si corresponde...">
                                    </div>
                                    <!-- ¿Padece alguna otra enfermedad no especificada en el interrogatorio anterior? -->
                                    <div class="form-group row">
                                        <label for="detalle">
                                            ¿Padece alguna otra enfermedad no especificada en el interrogatorio anterior?
                                        </label>
                                        <input type="text" class="form-control"  name="detalle3_q"  placeholder="Detalle si corresponde...">
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
                <a href="/declaracion_jurada">
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

            guardar.addEventListener("click", function (event) {
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
            });
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

