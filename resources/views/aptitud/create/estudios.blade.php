<div class="col-12">
    <div class="row">
        <!-- Declaracion Jurada -->
        @if ($declaracion_jurada)
            <div class="col-6 d-none">
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
                                <!-- Tabla de semiologia --><?php
                                //$posiciones_forzada->dolor_articular trae un string con muchos 0 y 1, si son todos 0 este if da falso y no entra, asi no se muestra estando vacío
                                if($posiciones_forzada->dolor_articular!=0){?>
                                  <div class="card text-white bg-light">
                                    <div class="card-body">
                                      <!-- Tabla -->
                                      @include('posiciones_forzadas.tabla_semiologia')
                                      <!-- / Tabla -->
                                    </div>
                                  </div><?php
                                }?>
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
        <input type="text" id="cantTipo" value={{sizeof($estudios)}} hidden><?php
        //var_dump($estudios);
        $i=$j=0;
        foreach ($estudios as $tipo_estudio){
          $id_tipo_estudio=$tipo_estudio[0]->id;
          $nombre_tipo_estudio=$tipo_estudio[0]->nombre;
          $estudios_tipo_estudio=$tipo_estudio[1];
          //var_dump($estudios_tipo_estudio);
          
          if (sizeof($estudios_tipo_estudio)>0){?>
            <!-- HIDDEN -->
            <input type="text" id="cantEstudio{{$id_tipo_estudio}}" value={{sizeof($estudios_tipo_estudio)}} hidden>
            <div class="col-6">
                <div class="card">
                    <div class="card-header fondo2">{{$nombre_tipo_estudio}}</div>
                    <div class="card-body">
                        <!-- Inputs de estudios por cada tipo de estudio --><?php
                          foreach ($estudios_tipo_estudio as $estudio){
                            $id_estudio=$estudio->id;
                            $nombre_estudio=$estudio->nombre;
                            //var_dump($id_estudio);
                            
                            $name="POinput_".$id_tipo_estudio."_".$id_estudio;?>
                            <div class="row form-group">
                                <div class="col-12 d-inline">
                                    <label for="{{$name}}" class="w-100" id="{{$name}}_label">{{$nombre_estudio}}: </label>
                                    <!-- <input type="hidden" id="{{$name}}_hidden_label" value='{{$nombre_estudio}}'> -->
                                    <input class="form-control inputText d-inline w-50" name="{{$name}}" type="text" id="{{$name}}">
                                    <!--  preexistencias observaciones --><?php

                                    $checkedObs="checked";
                                    $checkedPre="";
                                    if (($nombre_tipo_estudio == "ANALISIS BIOQUIMICO") or ($nombre_tipo_estudio == "ANALISIS BIOQUIMICO ANEXO 01")){
                                        $checkedObs="checked";
                                        $checkedPre="";
                                    }?>
                                
                                    <div class="icheck-danger d-inline w-25 ml-2">
                                        <input class="radioObsPre" data-target="observaciones" type="radio" name="{{$name}}_radio" id="{{$name}}_check_obs" value="O" <?=$checkedObs?>>
                                        <label for="{{$name}}_check_obs">Obs</label>
                                    </div>
                                    <!-- <label><input class="radioObsPre" data-target="observaciones" type="radio" name="{{$name}}_radio" id="{{$name}}_check_obs" value="O" <?=$checkedObs?>>Obs</label> -->
                                
                                    <div class="icheck-danger d-inline w-25 ml-2">
                                        <input class="radioObsPre" data-target="preexistencias" type="radio" name="{{$name}}_radio" id="{{$name}}_check_pre" value="P" <?=$checkedPre?>>
                                        <label for="{{$name}}_check_pre">Pre</label>
                                    </div>
                                    <!-- <label><input class="radioObsPre" data-target="preexistencias" type="radio" name="{{$name}}_radio" id="{{$name}}_check_pre" value="P" <?=$checkedPre?>>Pre</label> -->
                                </div>
                            </div>
                            <hr><?php
                          }?>
                    </div>
                </div>
            </div><?php
          }
        }?>
        
    </div>
</div>