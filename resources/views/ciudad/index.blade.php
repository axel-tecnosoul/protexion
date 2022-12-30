@extends('layouts.admin')  <!-- Extiende de layout -->

@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/home">Menu Principal</a></li>
    <li class="breadcrumb-item active">Indice de Ciudad</li>
@endsection


@section('content') <!-- Contenido -->

<div class="card">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('errors.request')
        <div class="card-header header-bg">
            <div class="card-title">
                <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Indice de Ciudad</p>
            </div>
            <div class="card-tools">
                <a href= {{ route('ciudad.create')}}>
                    <button class="btn fondo1">
                        <i class="fas fa-user-plus"></i> Nuevo
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
                    <tr>
                        <th width="30%" style="color:#F8F9F9">CIUDAD</th>
                        <th width="25%" style="color:#F8F9F9">CODIGO POSTAL</th>
                        <th width="25%" style="color:#F8F9F9">PROVINCIA</th>
                        <th width="20%" style="color:#F8F9F9">OPCIONES</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($ciudades as $ciudad)
                    
                    <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                       
                        <td>{{ $ciudad->nombre }}</td>
                        <td>{{ $ciudad->codigo_postal }}</td>
                        <td > <label style="font-size:90%" class="badge badge-success">{{ $ciudad->provincia->nombre }}</label></td>
                        <td style="text-align: center" colspan="3">
                            
                            <!-- <a data-keyboard="false" data-target="#modal-show-{{ $ciudad->id }}" data-toggle="modal">
                                <button title="ver" class="btn fondo1 btn-responsive">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </a> -->
                            <a href="{{URL::action('CiudadController@edit',$ciudad->id)}}">
                                <button title="editar" class="btn fondo2 btn-responsive">
                                    <i class="fa fa-edit"></i>
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

