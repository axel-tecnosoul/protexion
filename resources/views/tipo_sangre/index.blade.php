@extends('layouts.admin')

@section('content')
    <div class="card-body">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:#D2D6DE">
            @include('errors.request')
            @include('sexo.mensaje')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" >
                        <i class="fa fa-venus-mars" aria-hidden="true"></i> Indice de Tipo de Sangre
                    </h4>
                    <div class="card-tools">
                        <a href= {{ route('tipo-sangre.create')}}>
                            <button class="btn btn-primary">
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                        </a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                        <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                            <thead style="background-color:#222D32">
                                <tr>
                                    <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Grupo Sanguineo</p></th>
                                    <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Factor</p></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipo_sangres as $tipo_sangre)
                                <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                                    <td><p style="font-size:120%">{{ $tipo_sangre->grupo_sanguineo }}</p></td>
                                    <td><p style="font-size:120%">{{ $tipo_sangre->factor }}</p></td>
                                    <td style="text-align: center" colspan="1">
                                        <a data-backdrop="static" data-keyboard="false" data-target="#modal-delete-{{ $tipo_sangre->id }}" data-toggle="modal">
                                            <button title="eliminar" class="btn btn-primary btn-responsive">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </button>
                                        </a>
                                        <a href="{{URL::action('TipoSangreController@edit',$tipo_sangre->id)}}">
                                            <button title="editar" class="btn btn-primary btn-responsive">
                                                <i class="fa fa-edit"></i> Modificar
                                            </button>
                                        </a>

                                    </td>
                                </tr>
                                @include('tipo_sangre.modaldelete')
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

