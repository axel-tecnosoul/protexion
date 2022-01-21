@extends('layouts.admin')
@section('navegacion')
    <li class="breadcrumb-item"><a href="/">Menu Principal</a></li>
    <li class="breadcrumb-item active">Indice de Roles</li>
@endsection


@section('content')
<div class="card">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('errors.request')
        @include('roles.mensaje')
        <div class="card-header header-bg">
            <div class="card-title">
                <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Indice de Roles</p>
            </div>
            <div class="card-tools">
                <a href= {{ route('roles.create')}}>
                    <button class="btn fondo1">
                        <i class="fa fa-plus"></i> Nuevo
                    </button>
                </a>
            </div>
        </div>
        <div class="card-body">
            <!--div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-filter" aria-hidden="true"></i> Filtrar
                    </a>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">

                    </div>
                </div>
            </div-->
            <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                <thead style="background-color:#222D32">
                    <tr class="text-uppercase">
                        <th width="30%" style="color:#F8F9F9" >Codigo de Rol</th>
                        <th width="50%" style="color:#F8F9F9" >Rol</th>
                        <th width="20%" style="color:#F8F9F9" >Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                    <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td style="text-align: center" colspan="3">

                             <a href="{{URL::action('RoleController@edit',$role->id)}}">
                                <button title="editar" class="btn fondo2 btn-responsive">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </a>
                            
                            <a data-backdrop="static" data-keyboard="false" data-target="#modal-delete-{{ $role->id }}" data-toggle="modal">
                                <button title="eliminar" class="btn fondo1 btn-responsive">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@push('scripts')
    <script src="{{asset('js/tablaDetalle.js')}}"></script>
@endpush
@endsection
