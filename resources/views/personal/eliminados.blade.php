@extends('layouts.admin')  <!-- Extiende de layout -->

@section('navegacion')
    <li class="breadcrumb-item"><a href="/">Menu Principal</a></li>
    <li class="breadcrumb-item active">Personal dados de baja</li>
@endsection

@section('content') <!-- Contenido -->
<div class="card">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('errors.request')
        @include('personal.mensaje')
        <div class="card-header">
            <div class="card-title">
                <p style="font-size:130%"> <i class="fas fa-user-minus" aria-hidden="true"></i> Personal dados de baja</p>
            </div>

        </div>
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-filter" aria-hidden="true"></i> Filtrar
                    </a>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">

                        <!-- aca colocar el include-->
                    </div>
                </div>
            </div>
            <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                <thead style="background-color:#222D32">
                    <tr>
                        <th width="5%" style="color:#F8F9F9"><p class="text-uppercase" >Documento</p></th>
                        <th width="10%" style="color:#F8F9F9"><p class="text-uppercase" >Apellido y Nombre</p></th>
                        <th width="10%" style="color:#F8F9F9"><p class="text-uppercase" >Puesto</p></th>
                        <th width="10%" style="color:#F8F9F9"><p class="text-uppercase" >Fecha de baja</p></th>
                        <th width="10%" style="color:#F8F9F9"><p class="text-uppercase" >Opciones</p></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($personalEliminados as $personalEliminado)
                    <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                        <td><p >{{  number_format( (intval($personalEliminado->documento)/1000), 3, '.', '.') }}</p></td>
                        <td><p >{{ $personalEliminado->nombreCompleto() }}</p></td>
                        <td><p >{{ $personalEliminado->puesto->nombre }}</p></td>
                        <td><p >{{($personalEliminado->updated_at)->format('d/m/Y H:i:s') }}</p></td>

                        <td style="text-align: center" colspan="3">
                            <a data-backdrop="static" data-keyboard="false" data-target="#modal-rehabilitar-{{ $personalEliminado->id }}" data-toggle="modal">
                                <button title="rehabilitar" class="btn btn-success btn-md">
                                    <i class="fa fa-user"></i><span><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                    </span>
                                </button>
                            </a>




                             <!-- aca colocar el modalshow-->


                        </td>
                    </tr>
                    <!-- aca colocar el modaldelete-->
                    @include('personal.modalrehabilitar')

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

