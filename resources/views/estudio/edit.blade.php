@extends('layouts.admin')
<!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/estudios">Indice de Estudio</a></li>
    <li class="breadcrumb-item active">Editar Estudio</li>
@endsection
@section('content')

<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        @include('errors.request')
        @include('estudio.mensaje')

        {!!Form::model($estudio, ['method'=>'PATCH','route'=>['estudios.update',$estudio->id],'files' => true,])!!}
        {{Form::token()}}

        <div class="card card-dark">
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-file-alt" aria-hidden="true"></i> Editar Estudio</p>
                </div>
            </div>
            <div class="card-body">
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
                        @foreach ($tipo_estudios as $item)<?php
                            $selected="";
                            if($estudio->tipo_estudio_id==$item->id){
                              $selected="selected";
                            }?>
                            <option value="{{$item->id }}" <?=$selected?>>{{$item->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input 
                            type="string"
                            name="nombre"
                            value="{{ $estudio->nombre}}"
                            class="form-control"
                            title="Nombre de la estudio">
                    </div>
                </div>
                <input type="hidden" value="0" name="carga">

            </div>
        </div>

      </div>
      
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group" style="text-align:center">
        <label>

        </label>
        <br>
        <a href="/protexion/public/estudio">
            <button title="Cancelar" class="btn btn-secondary btn-lg" type="button"><i class="fas fa-arrow-left"></i> Cancelar</button>
        </a>
        <button title="Guardar" id="confirmar" class="btn btn-danger btn-lg" type="submit"> <i class="fa fa-check"></i> Guardar</button>
    </div>
</div>
    
</div>

{!!Form::close()!!}

    @push('scripts')
    <script type="text/javascript">    
        $(document).ready(function(){
            var select1 = $("#provincias_id").select2({width:'100%'});
            select1.data('select2').$selection.css('height', '100%');
        });
    </script>

<script>
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = [8, 37, 39, 46];
    
        tecla_especial = false
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }
    
        if(letras.indexOf(tecla) == -1 && !tecla_especial)
            return false;
    }
</script>

<script>
    function soloNumeros(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key);
        letras = " 1234567890";
        especiales = [8, 37, 39, 46];
    
        tecla_especial = false
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }
    
        if(letras.indexOf(tecla) == -1 && !tecla_especial)
            return false;
    }
</script>

@endpush

@endsection

