@extends('layouts.admin')
<!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/empresa">Indice de Empresa</a></li>
    <li class="breadcrumb-item active">Crear Empresa</li>
@endsection
@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        @include('errors.request')
        @include('empresa.mensaje')
        
        {!!Form::open(array('url'=>'empresa','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}

        <div class="card card-dark">
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-building" aria-hidden="true"></i> Datos de la Empresa</p>
                </div>
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="definicion"> Nombre</label>
                        <input
                            type="string"
                            name="definicion"
                            maxlength="30"
                            value="{{old('definicion')}}"
                            class="form-control"
                            placeholder="Ingrese el nombre..."
                            title="Introduzca un nombre"
                            required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="cuit">CUIT</label>
                        <input
                            type="string"
                            name="cuit"
                            maxlength="30"
                            value="{{old('cuit')}}"
                            class="form-control"
                            placeholder="Ingrese el cuit..."
                            title="Introduzca el cuit">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group" style="text-align:center">
        <a href="/protexion/public/empresa">
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

