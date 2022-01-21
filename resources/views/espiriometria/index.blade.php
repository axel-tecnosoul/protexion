@extends('layouts.admin')

@section('navegacion')
    <li class="breadcrumb-item"><a href="/">Menu Principal</a></li>
    <li class="breadcrumb-item active">Espiriometría</li>
@endsection

@section('content')
    <div class="card">
        <div class="">
            @include('errors.request')
            <!--inlcude mensaje -->
        <!-- Cabecera -->
            <div class="card-header header-bg">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Espiriometría</p>
                </div>
            </div>
        <!-- / Cabecera -->
        <!-- Body -->
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                   <!--  <p>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa fa-filter" aria-hidden="true"></i> Filtrar
                        </a>
                    </p>-->
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">

                            <!-- aca colocar el include-->

                        </div>
                    </div>
                </div>
                <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                    <thead class="tableHeader-bg">
                        <tr>
                            <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Nro Espiriometría</p></th>
                            <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Nombre del Paciente</p></th>
                            <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Fecha de carga</p></th>
                            <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Opciones</p></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($espiriometrias as $item)
                        <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                            <td><p style="font-size:120%">{{ $item->id }}</p></td>
                            <td><p style="font-size:120%">{{ $item->voucher->paciente->nombreCompleto() }}</p></td>
                            <td><p style="font-size:120%">{{($item->created_at)->format('d/m/Y') }}</p></td>
                            <td>
                                <!--aca incluir al modal show cuando todo funcione-->
                                <a href="{{ route('espiriometrias.pdf', $item->id) }}">
                                    <button title="exportar pdf" class="btn btn-danger btn-responsive">
                                        <i class="fas fa-file-pdf"></i>
                                    </button>
                                </a>
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