@extends('layouts.admin')  <!-- Extiende de layout -->

@section('navegacion')
    <li class="breadcrumb-item"><a href="/">Menu Principal</a></li>
    <li class="breadcrumb-item active">Perfil</li>
@endsection

@section('content') <!-- Contenido -->
<div class="card">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('errors.request')
        <div class="card-header header-bg">
            <div class="card-title">
                <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Mi Perfil</p>
            </div>
        </div>
        <div class="card-body">
            <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                <thead style="background-color:#222D32">
                    <tr class="text-uppercase">
                        <th width="35%" style="color:#F8F9F9" >Nombre de Usuario</th>
                        <th width="20%" style="color:#F8F9F9" >Documento</th>
                        <th width="25%" style="color:#F8F9F9" >E-mail</th>
                        <th width="20%" style="color:#F8F9F9" >Opciones</th>

                    </tr>
                </thead>
                <tbody>
                    <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                        <td>{{ $user->name }}</td>
                        <td>{{  number_format( (intval($user->personal_clinica->documento)/1000), 3, '.', '.') }}</td>
                        <td>{{ $user->email }}</td>
                        <td style="text-align: center" colspan="3">

                            <a data-keyboard="false" data-target="#modal-show-{{ $user->id }}" data-toggle="modal">
                                <button title="ver" class="btn fondo1 btn-responsive">
                                    <i class="fa fa-eye"></i>
                                </button>

                            </a>
                            @include('user.modalshow')

                             <a href="{{URL::action('PerfilController@edit')}}">
                                <button title="editar" class="btn fondo2 btn-responsive">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </a>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('scripts')
    <!--script src="{{asset('js/tablaDetalle.js')}}"></script-->
@endpush
@endsection

