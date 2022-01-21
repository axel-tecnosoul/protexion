@extends('layouts.admin')  <!-- Extiende de layout -->

@section('navegacion')
    <li class="breadcrumb-item"><a href="/">Menu Principal</a></li>
    <li class="breadcrumb-item active">Indice de Usuarios</li>
@endsection

@section('content') <!-- Contenido -->
<div class="card">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('errors.request')
        @include('user.mensaje')
        <div class="card-header header-bg">
            <div class="card-title">
                <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Indice de Usuarios</p>
            </div>
            <div class="card-tools">
                <a href= {{ route('user.create')}}>
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
                        <th width="30%" style="color:#F8F9F9" >Nombre de Usuario</th>
                        <th width="20%" style="color:#F8F9F9" >Documento</th>
                        <th width="30%" style="color:#F8F9F9" >E-mail</th>
                        <th width="20%" style="color:#F8F9F9" >Opciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                        <td>{{ $user->name }}</p></td>
                        <td><p >{{  number_format( (intval($user->personal_clinica->documento)/1000), 3, '.', '.') }}</td>
                        <td>{{ $user->email }}</td>
                        <td style="text-align: center" colspan="3">

                            <a data-keyboard="false" data-target="#modal-show-{{ $user->id }}" data-toggle="modal">
                                <button title="ver" class="btn fondo1 btn-responsive">
                                    <i class="fa fa-eye"></i>
                                </button>

                            </a>
                            @include('user.modalshow')

                             <a href="{{URL::action('UserController@edit',$user->id)}}">
                                <button title="editar" class="btn fondo2 btn-responsive">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                    @include('user.modaldelete')
                    @include('user.modalhabilitar')
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

