adasdasdsadas

{!! Form::model(Request::only(
    ['desde','hasta','auditable_type']),
    ['url' => 'audits', 'method'=>'GET', 'autocomplete'=>'on', 'role'=>'search']

    )!!}

<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2 ">
    <label for="auditable_type">Tabla</label>
    <div class="form-group">
        <select
            name="auditable_type"
            id="auditable_type"
            class="auditable_type form-control"
            >

                @foreach ($types as $t)
                    <option
                        value="{{$t}}"
                        @if($auditable_type!=null && $auditable_type==$t)
                            selected
                        @endif
                    >
                    {{$t}}
                    </option>
                @endforeach

                <option
                    value="0"
                    @if($auditable_type == null || $auditable_type==0)
                        selected
                    @endif
                >
                    -- Todas las Tablas --
                </option>
        </select>
    </div>
</div>

<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2 ">
    <label for="desde">ID de la Tabla</label>
    <input
        type="numeric"
        name="auditable_id"
        id="auditable_id"
        class="auditable_id form-control"
        value="{{$auditable_id}}"
    >
</div>



<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2 ">
    <label for="desde">Fecha Desde</label>
    <input
        type="date"
        name="desde"
        id="desde"
        class="fecha form-control"
        value="{{$desde}}"
    >
</div>


<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2 ">
    <label for="hasta">Fecha Hasta</label>
    <input
        type="date"
        name="hasta"
        id="hasta"
        class="fecha form-control"
        value="{{$hasta}}"
    >
</div>


<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2 ">
    <label for=""></label>
    <div class="form-group">
        <span class="input-group-btn">
            <button
                title="buscar"
                type="submit"
                id="bt_add"
                name="filtrar"
                class="btn btn-warning btn-responsive">
                    <i class="fa fa-filter"></i> Filtrar
            </button>

            <a

            href= "{{ route('audits.index') }}"
            class="btn btn-default"
            >
            <i class="fas fa-eraser"></i>
                ... Limpiar
        </a>

        </span>
    </div>
</div>





{{Form::close()}}

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $("#auditable_type").select2({
        width: '100%',
        placeholder: '-- Todas las Tablas --'
    });


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
