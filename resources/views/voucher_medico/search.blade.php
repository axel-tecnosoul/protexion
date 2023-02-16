{!! Form::model(Request::only(
    ['fecha','tipo_estudio_id']),
    ['url' => 'voucher_medico/', 'method'=>'GET', 'autocomplete'=>'on', 'role'=>'search']

    )!!}
<div class="col-12">
    <div class="row">

        <div class="col-4">
           <label for="fecha">Fecha</label>
           <input
               type="date"
               name="fecha"
               id="fecha"
               class="fecha form-control"
               value="{{$fecha}}"
               required
           >
       </div>
       <div class="col-4">
           <label for="hasta">Tipo de estudio</label>
           <select
              name="tipo_estudio_id"
              id="tipo_estudio_id"
              class="tipo_estudio_id custom-select"
              required>
              <option
                  value=""
                  title="-Seleccione el tipo de estudio-">
                  -Seleccione el tipo de estudio-
              </option>
              @foreach ($aEstudios as $estudio)<?php
                  $selected="";
                  if($estudio["id"]===$tipo_estudio_id){
                    $selected="selected";
                  }?>
                  <option
                      {{$selected}}
                      value="{{$estudio['id'] }}">{{$estudio['nombre']}}
                  </option>
              @endforeach
            </select>
       </div>
       <div class="col-4">
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

                <a

                href= "{{ route('voucher.index') }}"
                class="btn btn-secondary"
                >
                <i class="fas fa-eraser"></i>
                    ... Limpiar
            </a>

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

     //si se clickea en "FIltrar"
      $('#bt_add').click(function () {
        //se debe refrescar (si es que hubo) la prop disabled de desde
        $("#desde").prop('disabled', false);


      });


});







</script>
@endpush
