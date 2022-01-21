{!! Form::model(Request::only(
    ['empresa_id', 'obra_social_id', 'estado_id']),
    ['url' => 'paciente/', 'method'=>'GET', 'autocomplete'=>'on', 'role'=>'search']

    )!!}
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="origen_id">Origen</label>
            <select
                name="origen_id"
                id="origen_id"
                class="custom-select"
                >
                @foreach ($origenes as $origen)
                    <option
                        value="{{$origen->id}}"
                        @if($origen_id!=null && $origen_id==$origen->id)
                            selected
                        @endif
                    >
                    {{$origen->definicion}}
                    </option>
                @endforeach
                <option
                    value="0" @if($origen_id == null || $origen_id==0) selected @endif>
                    -- Todos los origenes --
                </option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="obra_social_id">Obra Social</label>
            <select
                name="obra_social_id"
                id="obra_social_id"
                class="custom-select"
                >
                @foreach ($obras_sociales as $obra_social)
                    <option
                        value="{{$obra_social->id}}"
                        @if($obra_social_id!=null && $obra_social_id==$obra_social->id)
                            selected
                        @endif
                    >
                    {{$obra_social->obraSocialCompleta()}}
                    </option>
                @endforeach
                <option
                    value="0" @if($obra_social_id == null || $obra_social_id==0) selected @endif>
                    -- Todas las obras sociales --
                </option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="estado_id">Habilitado</label>
            <select
                name="estado_id"
                id="estado_id"
                class="custom-select"
                >
                @foreach ($estados as $estado)
                    <option
                        value="{{$estado->id}}"
                        @if($estado_id!=null && $estado_id==$estado->id)
                            selected
                        @endif
                    >
                    {{$estado->nombre}}
                    </option>
                @endforeach
                <option
                    value="0" @if($estado_id == null || $estado_id==0) selected @endif>
                    -- Todos los estados --
                </option>
            </select>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-auto">
        <label for=""></label>
        <div class="form-group">
            <span class="input-group-btn">
                <button
                    title="buscar"
                    type="submit"
                    id="bt_add"
                    name="filtrar"
                    class="btn btn-primary btn-responsive">
                        <i class="fa fa-search"></i> Buscar
                </button>

                <a

                href= "{{ route('paciente.index') }}"
                class="btn btn-default"
                >
                <i class="fas fa-eraser"></i>
                    ... Limpiar
            </a>

            </span>
        </div>
    </div>

</div>






{{Form::close()}}

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){

    var select1 = $("#origen_id").select2({width:'100%'});
    select1.data('select2').$selection.css('height', '34px');

    var select2 = $("#obra_social_id").select2({width:'100%'});
    select2.data('select2').$selection.css('height', '34px');

    var select2 = $("#estado_id").select2({width:'100%'});
    select2.data('select2').$selection.css('height', '34px');

});







</script>
@endpush
