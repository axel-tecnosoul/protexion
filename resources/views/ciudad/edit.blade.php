@extends('layouts.admin')
<!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/personal">Indice de Personal</a></li>
    <li class="breadcrumb-item active">Editar Personal</li>
@endsection
@section('content')

<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        @include('errors.request')
        @include('personal.mensaje')

        {!!Form::model($ciudad, ['method'=>'PATCH','route'=>['ciudad.update',$ciudad->id],'files' => true,])!!}
        {{Form::token()}}

        <div class="card card-dark">
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-user" aria-hidden="true"></i> Editar Ciudad</p>
                </div>
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input 
                            type="string"
                            name="nombre"
                            value="{{ $ciudad->nombre}}"
                            class="form-control"
                            title="nombre de la persona"
                            onkeypress="return soloLetras(event)">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="codigo_postal">Codigo Postal</label>
                        <input 
                            type="string"
                            name="codigo_postal"
                            value="{{ $ciudad->codigo_postal }}"
                            class="form-control"
                            title="apellido de la persona"
                            onkeypress="return soloNumeros(event)">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                    <label> Provincia</label>
                            <select
                                name="provincias_id"
                                id="provincias_id"
                                class="provincias_id form-control"
                                required
                                >
                                <option
                                    value="0"
                                    disabled="true"
                                    selected="true"
                                    title="Seleccione una provincia"
                                    >
                                    -Seleccione una provincia-
                                </option>
                                @foreach ($provincias as $provincia)
                                    @if ($provincia->id==$ciudad->provincia_id)
                                        <option value="{{$provincia->id}}" selected>{{$provincia->nombre}}</option> 
                                    @else
                                        <option value="{{$provincia->id}}">{{$provincia->nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                    </div>
                </div>

                
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
        <a href="/protexion/public/personal">
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

