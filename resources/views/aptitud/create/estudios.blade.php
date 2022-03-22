<div class="col-12">
    <div class="row">
        <!-- Declaracion Jurada -->
        @if ($declaracion_jurada)
            <div class="col-6">
                <div class="card">
                    <div class="card-header fondo2">
                        Declaracion Jurada
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-12"><label for=""><u>Diagnóstico:</u> </label></div>
                            <div class="col-12">
                                @php
                                    echo $diagnosticoD;
                                @endphp
                                <input type="hidden" id="lblDeclaracionJurada" value="Declaración Jurada: ">
                            </div>
                            <!-- Preexistencia u observaciones -->
                            <div class="col-12">
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Preexistencias</label>
                                        <textarea class="form-control textArea" data-target="preexistencias" data-label="lblDeclaracionJurada" id="pre_declaracion_jurada" name="" cols="15" rows="5"></textarea>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Observaciones</label>
                                        <textarea class="form-control textArea" data-target="observaciones" data-label="lblDeclaracionJurada" id="obs_declaracion_jurada" name="" cols="15" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Historia Clínica -->
        @if ($historia_clinica)
            <div class="col-6">
                <div class="card">
                    <div class="card-header fondo2">
                        Historia Clínica
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-12"><label for=""><u>Diagnóstico:</u> </label></div>
                            <div class="col">
                                @php
                                    echo $diagnosticoH[0];
                                @endphp
                                <input type="hidden" id="lblHistoriaClinica" value="Historia Clínica: ">
                            </div>
                            <!-- Preexistencia u observaciones -->
                            <div class="col-12">
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Preexistencias</label>
                                        <textarea class="form-control textArea" data-target="preexistencias" data-label="lblHistoriaClinica" name="" id="pre_historia_clinica" cols="15" rows="5"></textarea>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Observaciones</label>
                                        <textarea class="form-control textArea" data-target="observaciones" data-label="lblHistoriaClinica" id="obs_historia_clinica" name="" cols="15" rows="5"><?=$diagnosticoH[1]?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Posiciones Forzadas -->
        @if ($posiciones_forzada)
            <div class="col-6">
                <div class="card">
                    <div class="card-header fondo2">
                        Posiciones Forzadas
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-12"><label for=""><u>Diagnóstico:</u> </label></div>
                            <div class="col">
                                @php
                                    echo $diagnosticoP;
                                @endphp
                                <input type="hidden" id="lblPosicionesForzadas" value="Posiciones Forzadas: ">
                                <!-- Tabla de semiologia -->
                                <div class="card text-white bg-light">
                                  <div class="card-body">
                                    <!-- Tabla -->
                                    @include('posiciones_forzadas.tabla_semiologia')
                                    <!-- / Tabla -->
                                  </div>
                                </div>
                            </div>
                            <!-- Preexistencia u observaciones -->
                            <div class="col-12">
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Preexistencias</label>
                                        <textarea class="form-control textArea" data-target="preexistencias" data-label="lblPosicionesForzadas" name="" id="pre_posiciones_forzadas" cols="15" rows="5"></textarea>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Observaciones</label>
                                        <textarea class="form-control textArea" data-target="observaciones" data-label="lblPosicionesForzadas" id="obs_posiciones_forzadas" name="" cols="15" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Iluminacion Insuficiente -->
        @if ($iluminacion_direccionado)
            <div class="col-6">
                <div class="card">
                    <div class="card-header fondo2">
                        Iluminacion Insuficiente
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-12"><label for=""><u>Diagnóstico:</u> </label></div>
                            <div class="col">
                                @php
                                    echo $diagnosticoI;
                                @endphp
                                <input type="hidden" id="lblIlumincacionInsuficiente" value="Ilumincacion Insuficiente: ">
                            </div>
                            <!-- Preexistencia u observaciones -->
                            <div class="col-12">
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Preexistencias</label>
                                        <textarea class="form-control textArea" data-target="preexistencias" data-label="lblIlumincacionInsuficiente" name="" id="pre_iluminacion_insuficiente" cols="15" rows="5"></textarea>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Observaciones</label>
                                        <textarea class="form-control textArea" data-target="observaciones" data-label="lblIlumincacionInsuficiente" id="obs_iluminacion_insuficiente" name="" cols="15" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Estudios por cargar -->
        <!-- HIDDEN -->
        <input type="text" id="cantTipo" value={{sizeof($estudios)}} hidden>
        @for ($i = 0; $i < sizeof($estudios); $i++)
          @if (sizeof($estudios[$i][1])>0)
            <!-- HIDDEN -->
            <input type="text" id="cantEstudio{{$i}}" value={{sizeof($estudios[$i][1])}} hidden>
            <div class="col-6">
                <div class="card">
                    <div class="card-header fondo2">
                        {{$estudios[$i][0]->nombre}}
                    </div>
                    <div class="card-body">
                        <!-- Inputs de estudios por cada tipo de estudio -->
                          @for ($j = 0; $j < sizeof($estudios[$i][1]); $j++)
                            <div class="row form-group">
                                <div class="col-10">
                                    <label for=""  id="POinput_{{$i}}_{{$j}}_label">{{$estudios[$i][1][$j]->nombre}}: </label>
                                    <!-- <input type="hidden" id="POinput_{{$i}}_{{$j}}_hidden_label" value='{{$estudios[$i][1][$j]->nombre}}'> -->
                                    <input class="form-control inputText" type="text"  id="POinput_{{$i}}_{{$j}}">
                                    <!--  preexistencias observaciones -->
                                </div><?php

                                $checkedObs="checked";
                                $checkedPre="";?>

                                @if (($estudios[$i][0]->nombre == "ANALISIS BIOQUIMICO") or ($estudios[$i][0]->nombre == "ANALISIS BIOQUIMICO ANEXO 01"))<?php
                                    $checkedObs="";
                                    $checkedPre="checked";?>
                                @endif

                                <div class="col-1">
                                    <label><input class="radioObsPre" data-target="observaciones" type="radio" name="POinput_{{$i}}_{{$j}}_radio" id="POinput_{{$i}}_{{$j}}_check_obs" value="O" <?=$checkedObs?>>Obs</label>
                                </div>
                                <div class="col-1">
                                    <label><input class="radioObsPre" data-target="preexistencias" type="radio" name="POinput_{{$i}}_{{$j}}_radio" id="POinput_{{$i}}_{{$j}}_check_pre" value="P" <?=$checkedPre?>>Pre</label>
                                </div>
                            </div>
                            <hr>
                          @endfor
                    </div>
                </div>
            </div>
          @endif
        @endfor
    </div>
</div>