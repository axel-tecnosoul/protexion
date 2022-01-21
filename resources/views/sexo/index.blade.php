@extends('layouts.admin')
@section('titulo')
<div class="box-header" style="text-align:center">
    <a href="{{ asset('/') }}">
        <button title="atras" class="btn btn-default btn-responsive pull-left">
            <i class="fa fa-arrow-left"></i> Atras
        </button>
    </a>
</div>
@endsection

@section('content')
    <div class="box-body">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:#D2D6DE">
            @include('errors.request')
            @include('sexo.mensaje')
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title" >
                        <i class="fa fa-venus-mars" aria-hidden="true"></i> Indice de Sexos
                    </h4>
                    <div class="box-tools">
                        <a href= {{ route('sexo.create')}}>
                            <button class="btn btn-primary">
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                        </a>

                    </div>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                        <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                            <thead style="background-color:#222D32">
                                <tr>
                                    <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">ID</p></th>
                                    <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Descripción</p></th>
                                    <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Opciones</p></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sexos as $sexo)
                                <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                                    <td><p style="font-size:120%">{{ $sexo->id }}</p></td>
                                    <td><p style="font-size:120%">{{ $sexo->descripcion }}</p></td>
                                    <td style="text-align: center" colspan="1">
                                        <a data-backdrop="static" data-keyboard="false" data-target="#modal-delete-{{ $sexo->id }}" data-toggle="modal">
                                            <button title="eliminar" class="btn btn-primary btn-responsive">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </button>
                                        </a>
                                        <a href="{{URL::action('SexoController@edit',$sexo->id)}}">
                                            <button title="editar" class="btn btn-primary btn-responsive">
                                                <i class="fa fa-edit"></i> Modificar
                                            </button>
                                        </a>

                                    </td>
                                </tr>
                                @include('sexo.modaldelete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{asset('js/tablaDetalle.js')}}"></script>


    @endpush
    @endsection

