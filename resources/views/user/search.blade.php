{!! Form::model(Request::only(
    ['estado_id']),
    ['url' => 'user/', 'method'=>'GET', 'autocomplete'=>'on', 'role'=>'search']

)!!}
<div class="row">
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

                href= "{{ route('user.index') }}"
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
    var select2 = $("#estado_id").select2({width:'100%'});
    select2.data('select2').$selection.css('height', '34px');

});







</script>
@endpush
