{!! Form::model(Request::only(
    ['fecha','tipo_estudio_id']),
    ['url' => 'empresa/reporte/empresarial', 'method'=>'GET', 'autocomplete'=>'on', 'role'=>'search']

    )!!}
<div class="col-12">
    <div class="row">

      <div class="col-2">
           <label for="desde">Fecha desde</label>
           <input
               type="date"
               name="desde"
               id="desde"
               class="fecha form-control"
               value="{{$desde}}"
           >
       </div>
       <div class="col-2">
           <label for="hasta">Fecha Hasta</label>
           <input
               type="date"
               name="hasta"
               id="hasta"
               class="fecha form-control"
               value="{{$hasta}}"
           >
       </div>
       <div class="col-3">
           <label for="hasta">Empresa</label>
           <select
              name="empresa_id"
              id="empresa_id"
              class="empresa_id custom-select">
              <option
                  value=""
                  title="-Seleccione una empresa-">
                  -Seleccione una empresa-
              </option>
              @foreach ($empresas as $empresa)<?php
                  $selected="";
                  if($empresa["id"]==$empresa_id){
                    $selected="selected";
                  }?>
                  <option {{$selected}} value="{{$empresa['id'] }}">{{$empresa['definicion']}}</option>
              @endforeach
            </select>
       </div>
       <div class="col-3">
           <label for="hasta">Resultado</label>
           <select
              name="resultado"
              id="resultado"
              class="resultado custom-select">
              <option
                  value=""
                  title="-Seleccione un resultado-">
                  -Seleccione un resultado-
              </option>
              @foreach ($aResultados as $resultado)
                  <option {{$resultado['selected']}} value="{{$resultado['nombre'] }}">{{$resultado['nombre']}}</option>
              @endforeach
            </select>
       </div>
       <div class="col-2">
        <label for=""></label>
        <div class="form-group">
            <span class="input-group-btn">
                <button
                    title="buscar"
                    type="submit"
                    id="bt_add"
                    name="filtrar"
                    class="btn btn-danger btn-responsive">
                        <i class="fa fa-search"></i> Buscar
                </button>
            </span>
        </div>
    </div>
   </div>
</div>


{{Form::close()}}

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){


  //si existe un cambio en Fecha Desde
  $('#desde').change(function() {
      //Se captura su valor
      var desde = $(this).val();
      var hasta = $('#hasta');
      console.log(desde, 'Se cambio la fecha DESDE')
      //y establesco ese valor capturado como minimo en Fecha Hasta
      $('#hasta').attr({"min" : desde});

      if(desde>hasta.val()){
        hasta.val(desde)
      }

    });

    //si existe un cambio en Fecha Hasta
    $('#hasta').change(function() {
      //Se captura su valor
      var desde = $("#desde");
      var hasta = $(this).val();
      console.log(hasta, 'Se cambio la fecha HASTA');
      //si ese valor es diferente a nulo (osea si hay algo dentro)
      if(hasta<desde.val()){
        desde.val(hasta)
      }
      /*if (hasta != ""){
        //se deshabilita el desde (para evitar que desde sea mayor que hasta)
        $("#desde").prop('disabled', true);
      }*/

    });

    /*
    //si existe un cambio en Fecha Desde
    $('#desde').change(function() {

        //Se captura su valor
        var desde = $(this).val();
        console.log(desde, 'Se cambio la fecha DESDE')
        //y establesco ese valor capturado como minimo en Fecha Hasta
        $('#hasta').attr({"min" : desde});;


        });

    //si existe un cambio en Fecha Hasta
    $('#hasta').change(function() {

        //Se captura su valor
        var hasta = $(this).val();
        console.log(hasta, 'Se cambio la fecha HASTA');

        //si ese valor es diferente a nulo (osea si hay algo dentro)
        if (hasta != "")
        {
            //se deshabilita el desde (para evitar que desde sea mayor que hasta)
            $("#desde").prop('disabled', true);

        }


      });

      */

     //si se clickea en "FIltrar"
      $('#bt_add').click(function () {
        //se debe refrescar (si es que hubo) la prop disabled de desde
        $("#desde").prop('disabled', false);


      });


});







</script>
@endpush
