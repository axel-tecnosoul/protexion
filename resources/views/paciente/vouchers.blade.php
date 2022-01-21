@extends('layouts.admin')  <!-- Extiende de layout -->

@section('navegacion')
    <li class="breadcrumb-item"><a href="/">Menu Principal</a></li>
    <li class="breadcrumb-item active">Indice de Vouchers</li>
@endsection

@section('content') <!-- Contenido -->
<div class="card">
    <div >
        @include('errors.request')
        @include('voucher.mensaje')
        <div class="card-header fondo2">
            <div class="card-title">
                <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Vouchers de {{ $paciente->nombreCompleto() }}</p>
            </div>
            <div class="card-tools">
                @if ($paciente->documento!=null)
                <a href= {{ route('voucher.create',$paciente->id)}}>
                    <button class="btn fondo1">
                        <i class="fa fa-plus"></i> Nuevo estudio
                    </button>
                </a>
                @else
                <p style="color:white">Falta completar datos del paciente</p>
                @endif
            </div>
        </div>
        <div class="card-body">

            <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                <thead style="background-color:#222D32">
                    <tr class="text-uppercase">
                        <th width="20%" style="color:#F8F9F9" >Código</th>
                        <th width="40%" style="color:#F8F9F9" >Paciente</th>
                        <th width="20%" style="color:#F8F9F9" >Fecha</th>
                        <th width="20%" style="color:#F8F9F9" >Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vouchers as $voucher)
                    <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                        <td>{{ $voucher->codigo }}</td>
                        <td>{{ $voucher->paciente->nombreCompleto() }}</td>
                        <td>{{ \Carbon\Carbon::parse($voucher->turno)->format('d/m/Y') }}</td>
                        <td style="text-align: center" colspan="3">
                            <a target="_blank" href="{{ route('voucher.pdf_paciente',$voucher->id) }}">
                                <button title="exportar pdf paciente" class="btn fondo1 btn-responsive">
                                    <i class="fas fa-file-pdf"></i>
                                </button>
                            </a>
                            <a target="_blank" href="{{ route('voucher.pdf_medico',$voucher->id) }}">
                                <button title="exportar pdf médico" class="btn fondo2 btn-responsive">
                                    <i class="fas fa-file-pdf"></i>
                                </button>
                            </a>
                            <a href="{{ route('voucher.show',$voucher->id) }}">
                                <button title="carpeta"  class="btn fondo3 btn-responsive">
                                    <i style="color: rgb(255, 255, 255)" class="fas fa-folder"></i>
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

