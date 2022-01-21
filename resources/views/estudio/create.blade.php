@extends('layouts.admin')

@section('navegacion')
    <li class="breadcrumb-item"><a href="/estudios">Índice de Estudios</a></li>
    <li class="breadcrumb-item active">Nuevo estudio</li>
@endsection

@section('content')
    {!!Form::open(array(
        'url'=>'estudios',
        'method'=>'POST',
        'autocomplete'=>'off',
        'files' => true,
    ))!!}

    {{Form::token()}}

    <div class="col-6 offset-3">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fas fa-stethoscope"></i> Nuevo estudio</p>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="col-12">
                    <div class="form-group col-12">
                        <label>Seleccionar tipo de Estudio</label>
                        <select 
                            name="tipo_estudio_id"
                            id="tipo_estudio_id"
                            class="tipo_estudio_id custom-select"
                            >
                            <option
                                value=null
                                disabled="true"
                                selected="true"
                                title="-Seleccione tipo de estudio-">
                                -Seleccione un tipo de estudio-
                            </option>
                            @foreach ($tipo_estudios as $item)
                                <option value="{{$item->id }}">{{$item->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        {{ Form::label('nombre') }}
                        {{ Form::text('nombre', $estudio->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                        {!! $errors->first('nombre', '<div class="invalid-feedback">:message</p>') !!}
                    </div>
                    <div class="form-group col-12">
                        <label>¿Este estudio tiene un formulario propio?</label>
                        <select 
                            name="carga"
                            id="carga"
                            class="custom-select">
                            <option value=1>Si</option>
                            <option value=0>No</option>
                        </select>
                    </div>
                    <!-- Guardar -->
                        <div class="form-group col-12 " id="guardar" style="padding-top: 5%">
                            <input id="guardar" name="_token" value="{{ csrf_token() }}" type="hidden">
                            <button class="btn btn-success btn-lg btn-block" id="confirmar"type="submit"><i class="fa fa-check"> </i>Cargar estudio</button>
                    </div>
                    <!-- / Guardar -->
                </div>
            </div>
        </div>
    </div>

    {!!Form::close()!!}

    @push('scripts')
        <script>
        
        $(document).ready(function(){
            var select1 = $("#tipo_estudio_id").select2({width:'100%'});
            select1.data('select2').$selection.css('height', '34px');
        });  
        </script>
    
    @endpush
@endsection