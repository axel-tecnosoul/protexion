@extends('layouts.admin')

@section('navegacion')
    <li class="breadcrumb-item"><a href="/roles">Indice de Roles</a></li>
    <li class="breadcrumb-item active">Editar Rol</li>
@endsection

@section('content')
<div class="row m-2">
    <div class="col-lg-12">
        <div class="pull-left">
            <h2>Editar Rol</h2>
        </div>
    </div>
</div>


@include('errors.request')


{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row m-2">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <strong>Nombre:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Nombre','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <strong>Permisos:</strong>
            <br/>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id,
                in_array($value->id, $rolePermissions) ? true : false,
                array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group" style="text-align:center">
            <label>

            </label>
            <br>
            <a href="/personal">
                <button title="Limpiar" class="btn btn-secondary btn-lg" type="button"><i class="fas fa-arrow-left"></i> Cancelar</button>
            </a>
            <button title="Guardar" id="confirmar" class="btn btn-danger btn-lg" type="submit"> <i class="fa fa-check"></i> Guardar</button>
        </div>
    </div>
</div>
{!! Form::close() !!}


@endsection