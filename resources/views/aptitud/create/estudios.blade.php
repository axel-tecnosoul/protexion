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
                    <div class="card-header fondo2"><?php
                        $titulo=strtoupper("Historia Clinica");
                        echo $titulo?>
                        <div class="card-tools">
                            <button type="button" class="btnCollapse btn btn-tool collapsed" data-toggle="collapse" href="#collapseExample"><i class="fas fa-plus"></i> Detalles</button>
                        </div>
                    </div>
                    <div class="card-body collapse" id="collapseExample">
                        <div class="row">
                            <div class="col-12"><label for=""><u>Diagnóstico:</u> </label></div>
                            <div class="col">
                                @php
                                    echo $diagnosticoH[0];
                                @endphp
                                <input type="hidden" id="lblHistoriaClinica" value="<?=$titulo?>: ">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!-- Preexistencia u observaciones -->
                        <div class="col-12">
                            <hr><?php
                            $pre_historia_clinica=($historia_clinica->informe_final_preexistencias) ?: "";
                            $obs_historia_clinica=($historia_clinica->informe_final_observaciones) ?: "";
                            //$aDiagnostico=$diagnosticoH[2];
                            $aDiagnostico=[];
                            //$diagnosticoH=str_replace("<br><br>","<br>",$diagnosticoH[1]);
                            $diagnosticoH=str_replace("<br>","\n",$diagnosticoH[1]);
                            //var_dump($diagnosticoH);
                            //echo "<hr>";
                            //echo nl2br($diagnosticoH);?>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Preexistencias</label>
                                    <textarea class="form-control textArea" data-target="preexistencias" data-label="lblHistoriaClinica" name="pre_historia_clinica" id="pre_historia_clinica" cols="15" rows="3"><?=$pre_historia_clinica?></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="">Observaciones</label>
                                    <textarea class="form-control textArea" data-target="observaciones" data-label="lblHistoriaClinica" name="obs_historia_clinica" id="obs_historia_clinica" cols="15" rows="5"><?=$diagnosticoH?><?php //echo $obs_historia_clinica?></textarea>
                                </div>
                            </div><?php
                            //para mostrar los datos de la historia clinica cada uno en input
                            foreach ($aDiagnostico as $seccion => $campos) {
                              /*foreach ($campos as $clave => $valor) {?>
                              <div class="row form-group">
                                <div class="col-12 d-inline">
                                    <label for="{{$name}}" class="w-100" id="{{$name}}_label">{{$nombre_estudio}}: </label>
                                    <input class="form-control inputText d-inline w-50" name="{{$name}}" type="text" id="{{$name}}" value="<?=$valor?>">
                                    <!--  preexistencias observaciones --><?php

                                    $checkedObs="checked";
                                    $checkedPre="";

                                    if($estudio["pre_obs"]=="P"){
                                      $checkedObs="";
                                      $checkedPre="checked";
                                    }
                                    if($estudio["pre_obs"]=="O"){
                                      $checkedObs="checked";
                                      $checkedPre="";
                                    }
                                    ?>
                                
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
                              }*/
                            }?>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Posiciones Forzadas -->
        @if ($posiciones_forzada)
            <div class="col-6">
                <div class="card">
                    <div class="card-header fondo2"><?php
                        $titulo=strtoupper("Posiciones Forzadas");
                        echo $titulo?>
                        <div class="card-tools">
                            <button type="button" class="btnCollapse btn btn-tool collapsed" data-toggle="collapse" href="#collapseExample2"><i class="fas fa-plus"></i> Detalles</button>
                        </div>
                    </div>
                    <div class="card-body collapse" id="collapseExample2">
                        <div class="row">
                            <div class="col-12"><label for=""><u>Diagnóstico:</u> </label></div>
                            <div class="col">
                                @php
                                    echo $diagnosticoP[0];
                                @endphp
                                <input type="hidden" id="lblPosicionesForzadas" value="<?=$titulo?>: ">
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
                        </div>
                    </div>
                    <div class="card-footer">
                        <!-- Preexistencia u observaciones -->
                        <div class="col-12">
                            <hr><?php
                            $pre_posiciones_forzadas=($posiciones_forzada->informe_final_preexistencias) ?: "";
                            $obs_posiciones_forzadas=($posiciones_forzada->informe_final_observaciones) ?: "";
                            
                            $diagnosticoP=str_replace("<br>","\n",$diagnosticoP[1]);?>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Preexistencias</label>
                                    <textarea class="form-control textArea" data-target="preexistencias" data-label="lblPosicionesForzadas" name="pre_posiciones_forzadas" id="pre_posiciones_forzadas" cols="15" rows="3"><?=$pre_posiciones_forzadas?></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="">Observaciones</label>
                                    <textarea class="form-control textArea" data-target="observaciones" data-label="lblPosicionesForzadas" name="obs_posiciones_forzadas" id="obs_posiciones_forzadas" cols="15" rows="5"><?=$diagnosticoP//$obs_posiciones_forzadas?></textarea>
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
                    <div class="card-header fondo2"><?php
                        $titulo=strtoupper("Iluminacion Insuficiente");
                        echo $titulo?>
                        <div class="card-tools">
                            <button type="button" class="btnCollapse btn btn-tool collapsed" data-toggle="collapse" href="#collapseExample3"><i class="fas fa-plus"></i> Detalles</button>
                        </div>
                    </div>
                    <div class="card-body collapse" id="collapseExample3">
                        <div class="row">
                            <div class="col-12"><label for=""><u>Diagnóstico:</u> </label></div>
                            <div class="col">
                                @php
                                    echo $diagnosticoI[0];
                                @endphp
                                <input type="hidden" id="lblIlumincacionInsuficiente" value="<?=$titulo?>: ">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!-- Preexistencia u observaciones -->
                        <div class="col-12">
                            <hr><?php
                            $pre_iluminacion_insuficiente=($iluminacion_direccionado->informe_final_preexistencias) ?: "";
                            $obs_iluminacion_insuficiente=($iluminacion_direccionado->informe_final_observaciones) ?: "";
                            
                            $diagnosticoI=str_replace("<br>","\n",$diagnosticoI[1]);?>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Preexistencias</label>
                                    <textarea class="form-control textArea" data-target="preexistencias" data-label="lblIlumincacionInsuficiente" name="pre_iluminacion_insuficiente" id="pre_iluminacion_insuficiente" cols="15" rows="3"><?=$pre_iluminacion_insuficiente?></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="">Observaciones</label>
                                    <textarea class="form-control textArea" data-target="observaciones" data-label="lblIlumincacionInsuficiente" name="obs_iluminacion_insuficiente" id="obs_iluminacion_insuficiente" cols="15" rows="5"><?=$diagnosticoI//$obs_iluminacion_insuficiente?></textarea>
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
                            $id_estudio=$estudio["estudio"]->id;
                            $nombre_estudio=$estudio["estudio"]->nombre;
                            //dd($estudio->pre_obs);
                            //dd($nombre_estudio);
                            //var_dump($estudio);
                            //$valor="";
                            $valor=($estudio["valor"]) ?: "";
                            if (strpos($nombre_estudio, "gravindex") !== false and $valor=="") {
                              $valor="Negativo";
                            }
                            if (strpos($nombre_estudio, "Toxicologico") !== false and $valor=="") {
                              $valor="Negativo";
                            }

                            $name="POinput_".$id_tipo_estudio."_".$id_estudio;?>
                            <div class="row form-group">
                                <div class="col-12 d-inline">
                                    <label for="{{$name}}" class="w-100" id="{{$name}}_label">{{$nombre_estudio}}: </label>
                                    <!-- <input type="hidden" id="{{$name}}_hidden_label" value='{{$nombre_estudio}}'> -->
                                    <input class="form-control inputText d-inline w-50" name="{{$name}}" type="text" id="{{$name}}" value="<?=$valor?>">
                                    <!--  preexistencias observaciones --><?php

                                    $checkedObs="checked";
                                    $checkedPre="";
                                    if (($nombre_tipo_estudio == "ANALISIS BIOQUIMICO") or ($nombre_tipo_estudio == "ANALISIS BIOQUIMICO ANEXO 01")){
                                        $checkedObs="checked";
                                        $checkedPre="";
                                    }

                                    if($estudio["pre_obs"]=="P"){
                                      $checkedObs="";
                                      $checkedPre="checked";
                                    }
                                    if($estudio["pre_obs"]=="O"){
                                      $checkedObs="checked";
                                      $checkedPre="";
                                    }
                                    ?>
                                
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

<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    let btnCollapse=document.querySelectorAll(".btnCollapse")
    btnCollapse.forEach(function(elem) {
      elem.addEventListener("click", function(event) {
        let i=this.querySelectorAll("i");
        let iconClasses=i[0].classList;
        if(iconClasses.contains("fa-plus")){
          iconClasses.remove("fa-plus")
          iconClasses.add("fa-minus")
        }else{
          iconClasses.remove("fa-minus")
          iconClasses.add("fa-plus")
        }
      })
    });
  });
  
 
</script>