<div class="col-12">
    <!-- Riesgos -->
    <div class="card  "> 
        <div class="card-header header-bg">
            <h3 class="card-title">Riesgos</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body" > 
            <div class="row">
              @foreach ($riesgos as $riesgo)<?php
                //dd($riesgo->id)?>
                  <div class="form-group col-12">
                      <input type="text" value=0  name="riesgos[{{$riesgo->id}}]" hidden>
                      <div class="icheck-danger d-inline"><?php
                          $checked="";
                          //if(in_array($item->id, $idChecked)){
                          if(in_array($riesgo->id,$voucher_riesgos)){
                            $checked="checked";
                          }?>
                          <input type="checkbox" value=1 id="{{$riesgo->id}}" <?=$checked?> name="riesgos[{{$riesgo->id}}]">
                          <label for="{{$riesgo->id}}">{{$riesgo->riesgo}}</label>
                      </div>
                  </div>
                @endforeach
                <!-- @for ($i = 0; $i < sizeof($riesgos); $i++)
                <div class="form-group col-12">
                    <input type="text" value=0  name="riesgos[{{$i}}]" hidden>
                    <div class="icheck-danger d-inline">
                        <input type="checkbox" value=1 id="{{$i}}" name="riesgos[{{$i}}]">
                        <label for="{{$i}}">{{$riesgos[$i]}}</label>
                    </div>
                </div>
                @endfor -->
            </div>
        </div>
    </div>
</div>