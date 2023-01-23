<div class="col-12">
    <div class="card  "> <!--collapsed-card -->
        <div class="card-header header-bg">
            <h3 class="card-title">Aptitud laboral</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body" > 
            <!-- <div class="form-group row">
                <div class="col-12">
                    <label><input type="radio" name="aptitud_laboral" value="APTO “A”: TODO TIPO DE TAREAS SEGÚN EXPOSICIÓN A RIESGO DECLARADO"> APTO “A”: TODO TIPO DE TAREAS SEGÚN EXPOSICIÓN A RIESGO DECLARADO </label>
                </div>
                <div class="col-12">
                    <label><input type="radio" name="aptitud_laboral" value="APTO “B”: TODO TIPO DE TAREAS SEGÚN EXPOSICIÓN A RIESGO DECLARADO CON PROBLEMAS MEDICOS CONTROLADOS"> APTO “B”: TODO TIPO DE TAREAS SEGÚN EXPOSICIÓN A RIESGO DECLARADO CON PROBLEMAS MEDICOS CONTROLADOS </label>
                </div>
                <div class="col-12">
                    <label><input type="radio" name="aptitud_laboral" value="APTO “C”: CON CONDICIONANTES SEGÚN EXPOSICIÓN A RIESGO"> APTO “C”: CON CONDICIONANTES SEGÚN EXPOSICIÓN A RIESGO </label>
                </div>
                <div class="col-12">
                    <label><input type="radio" name="aptitud_laboral" value="APTO “D”: INCONVENIENTE SU INGRESO EN EL MOMENTO ACTUAL"> APTO “D”: INCONVENIENTE SU INGRESO EN EL MOMENTO ACTUAL </label>
                </div>
                <div class="col-12">
                    <label><input type="radio" name="aptitud_laboral" value="APTO “E”: NO APTO"> APTO “E”: NO APTO </label>
                </div>
            </div> --><?php
            $aAptitudes=[
              "apto_sin_pre"=>"APTO SIN PREEXISTENCIAS",
              "apto_con_pre"=>"APTO CON PREEXISTENCIAS",
              "no_apto"=>"INCONVENIENTE SU INGRESO EN EL MOMENTO ACTUAL"
            ]?>
            <div class="form-group row"><?php
                foreach ($aAptitudes as $id => $value) {?>
                    <div class="col-12">
                        <div class="icheck-danger">
                            <input type="radio" name="aptitud_laboral" id="<?=$id?>" value="<?=$value?>" <?php echo ($value==$aptitud->aptitud_laboral) ? "checked" : ""?>>
                            <label for="<?=$id?>"><?=$value?></label>
                        </div>
                    </div><?php
                }?>
                <!-- <div class="col-12">
                    <div class="icheck-danger">
                        <input type="radio" name="aptitud_laboral" id="apto_sin_pre" value="APTO SIN PREEXISTENCIAS">
                        <label for="apto_sin_pre">APTO SIN PREEXISTENCIAS</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="icheck-danger">
                        <input type="radio" name="aptitud_laboral" id="apto_con_pre" value="APTO CON PREEXISTENCIAS">
                        <label for="apto_con_pre">APTO CON PREEXISTENCIAS</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="icheck-danger">
                        <input type="radio" name="aptitud_laboral" id="no_apto" value="INCONVENIENTE SU INGRESO EN EL MOMENTO ACTUAL">
                        <label for="no_apto">INCONVENIENTE SU INGRESO EN EL MOMENTO ACTUAL</label>
                    </div>
                </div> -->
            </div>
            <div class="row form-group">
                <div class="col">
                    <label for="">COMENTARIOS SOBRE PATOLOGIAS NO RELACIONADAS CON EL TRABAJO: </label>
                    <textarea class="form-control" name="comentarios" id="" cols="15" rows="5"><?=$aptitud->comentarios?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>