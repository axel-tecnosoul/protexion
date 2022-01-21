@extends('layouts.admin')  <!-- Extiende de layout -->

@section('navegacion')
    <li class="breadcrumb-item"><a href="/roles">Indice de Roles</a></li>
    <li class="breadcrumb-item active">Crear Rol</li>
@endsection

@section('content')
<div class="card">

{!!Form::open(array(
    'url'=>'roles',
    'method'=>'POST',
    'autocomplete'=>'off',
))!!}

{{Form::token()}}
    @include('errors.request')
    @include('roles.mensaje')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="card-header">
            <div class="card-title" >
                <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Crear Rol</p>
            </div>
        </div>
        <div class="card-body">
            <div class="row m-2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Nombre','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                        <label>Permisos:</label>
                        <br/>
                        @foreach($permission as $value)
                            <div class="icheck-danger d-inline"> 
                                <input type="checkbox" value="{{$value->id}}" name=permission[] id="{{$value}}"> 
                                <label for="{{$value}}"> {{ $value->name }}</label>
                            </div>
                            <br>
                        @endforeach
                    </div>
                </div>                   

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group" style="text-align:center">
                        <br>
                        <a href="/roles">
                            <button title="Limpiar" class="btn btn-secondary btn-lg" type="button"><i class="fas fa-arrow-left"></i> Cancelar</button>
                        </a>
                        <button title="Guardar" id="confirmar" class="btn btn-danger btn-lg" type="submit"> <i class="fa fa-check"></i> Guardar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

    {!!Form::close()!!}

    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){






    });

</script>
@endpush

@endsection
