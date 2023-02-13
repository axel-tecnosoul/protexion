@extends('layouts.admin')
<!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/estudios">Índice de Estudios</a></li>
    <li class="breadcrumb-item active">Crear Estudio</li>
@endsection
@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        @include('errors.request')
        @include('empresa.mensaje')

        {!!Form::open(array('url'=>'estudios','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}

        <div class="card card-dark">
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-file-alt" aria-hidden="true"></i> Datos del Estudio</p>
                </div>
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
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
                    <div class="form-group">
                        {{ Form::label('nombre') }}
                        {{ Form::text('nombre', $estudio->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                        {!! $errors->first('nombre', '<div class="invalid-feedback">:message</p>') !!}
                    </div>
                    <input type="hidden" value="0" name="carga">
                    <!-- <div class="form-group col-12">
                        <label>¿Este estudio tiene un formulario propio?</label>
                        <select 
                            name="carga"
                            id="carga"
                            class="custom-select">
                            <option value=1>Si</option>
                            <option value=0>No</option>
                        </select>
                    </div> -->
                    <!-- Guardar -->
                    <!-- <div class="form-group col-12 " id="guardar" style="padding-top: 5%">
                        <input id="guardar" name="_token" value="{{ csrf_token() }}" type="hidden">
                        <button class="btn btn-success btn-lg btn-block" id="confirmar"type="submit"><i class="fa fa-check"> </i>Cargar estudio</button>
                    </div> -->
                    <!-- / Guardar -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group" style="text-align:center">
        <a href="/protexion/public/estudios">
            <button title="Cancelar" class="btn btn-secondary btn-lg" type="button"><i class="fas fa-arrow-left"></i> Cancelar</button>
        </a>
        <button title="Guardar" id="confirmar" class="btn btn-danger btn-lg" type="submit"> <i class="fa fa-check"></i> Guardar</button>
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