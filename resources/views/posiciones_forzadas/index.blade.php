@extends('layouts.admin')  <!-- Extiende de layout -->

@section('navegacion')
    <li class="breadcrumb-item"><a href="/">Menu Principal</a></li>
    <li class="breadcrumb-item active">Posiciones Forzadas</li>
@endsection

@section('content') <!-- Contenido -->
<div class="card">
    <div >
        @include('errors.request')
        <!--inlcude mensaje -->
        <div class="card-header fondo2">
            <div class="card-title">
                <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Posiciones Forzadas</p>
            </div>
        </div>
        <div class="card-body fondo0">
            <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                <thead class="fondo2">
                    <tr>
                        <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Nro</p></th>
                        <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Nombre del Paciente</p></th>
                        <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Fecha de carga</p></th>
                        <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Fecha de realizacion</p></th>
                        <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Opciones</p></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posiciones_forzadas as $posiciones_forzada)
                    <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                        <td><p style="font-size:120%">{{ $posiciones_forzada->codigo }}</p></td>
                        <td><p style="font-size:120%">{{ $posiciones_forzada->voucher->paciente->nombreCompleto() }}</p></td>
                        <td><p style="font-size:120%">{{($posiciones_forzada->created_at)->format('d/m/Y') }}</p></td>
                        <td><p style="font-size:120%">{{Carbon\Carbon::parse($posiciones_forzada->fecha_realizacion)->format('d/m/Y') }}</p></td>
                        <td>
                            <a href="{{ route('posiciones_forzadas.pdf',$posiciones_forzada->id) }}">
                                <button title="exportar pdf" class="btn btn-danger btn-responsive">
                                    <i class="fas fa-file-pdf"></i>
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

