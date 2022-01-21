@extends('layouts.admin')  <!-- Extiende de layout -->

@section('navegacion')
    <li class="breadcrumb-item"><a href="/">Menu Principal</a></li>
    <li class="breadcrumb-item active">Historia Clinica</li>
@endsection

@section('content') <!-- Contenido -->
<div class="card">
    <div >
        @include('errors.request')
        @include('paciente.mensaje')
        <div class="card-header fondo2">
            <div class="card-title">
                <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Historia Clinica</p>
            </div>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                <thead style="background-color:#222D32">
                    <tr>
                        <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Nro Historia Clinica</p></th>
                        <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Nombre del Paciente</p></th>
                        <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Fecha</p></th>
                        <th width="10%" style="color:#F8F9F9" height="15px"><p class="text-uppercase" style="font-size:120%">Opciones</p></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historias_clinicas as $historia_clinica)
                    <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                        <td><p style="font-size:120%">{{ $historia_clinica->codigo }}</p></td>
                        <td><p style="font-size:120%">{{ $historia_clinica->voucher->paciente->nombreCompleto() }}</p></td>
                        <td><p style="font-size:120%">{{($historia_clinica->created_at)->format('d/m/Y') }}</p></td>
                        <td>
                            <a href="{{ route('historia_clinica.pdf',$historia_clinica->id) }}">
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

