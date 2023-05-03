@extends('layouts.admin')

@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/home">Menu Principal</a></li>
    <li class="breadcrumb-item active">Indice de Estudios</li>
@endsection

@section('content') <!-- Contenido -->
<div class="card">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('errors.request')
        <div class="card-header header-bg">
            <div class="card-title">
                <p style="font-size:130%"> <i class="fa fa-file-alt" aria-hidden="true"></i> Indice de Estudios </p>
            </div>
            <div class="card-tools">
                <a href= {{ route('estudios.create') }}>
                    <button class="btn fondo1">
                        <i class="fas fa-plus"></i> Nuevo
                    </button>
                </a>
            </div>
        </div>
        <!-- / Cabecera -->
        @include('estudio.mensaje')
        <!-- Body -->
        <div class="card-body">
            <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-filter" aria-hidden="true"></i> Filtrar
                    </a>
                </p>
            </div> -->
            <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                <thead style="background-color:#222D32">
                    <tr>
                        <th width="10%" style="color:#F8F9F9">NRO</th>
                        <th width="40%" style="color:#F8F9F9">NOMBRE</th>
                        <th width="35%" style="color:#F8F9F9">TIPO</th>
                        <th width="15%" style="color:#F8F9F9">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estudios as $item)
                    <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                        <td>{{ $item->id }}                           </td>
                        <td style="text-align: left">{{ $item->nombre }}                       </td>
                        <td style="text-align: left">{{ $item->tipoEstudio->nombre }}          </td>
                        <!-- @if ($item->carga)
                            <td>Si</td>
                        @else
                            <td>No</td>
                        @endif
                        <td>{{($item->created_at)->format('d/m/Y') }} </td> -->
                        <td>
                            <a href="{{URL::action('EstudioController@edit',$item->id)}}">
                                <button title="editar" class="btn fondo2 btn-responsive">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </a>
                            
                            <a data-keyboard="false" data-target="#modal-delete-{{ $item->id }}" data-toggle="modal">
                                <button type="submit" class="btn fondo1 btn-responsive"><i class="fa fa-fw fa-trash"></i></button>
                            </a>
                            @include('estudio.modaldelete')
                        </td>
                    </tr>
                    <!-- aca colocar el modaldelete-->
                    @endforeach
                </tbody>
            </table>
        </div>
    <!-- / Body -->
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/tablaDetalle.js')}}"></script>
@endpush
@endsection