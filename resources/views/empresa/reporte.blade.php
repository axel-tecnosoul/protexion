@extends('layouts.admin')  <!-- Extiende de layout -->

@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/home">Menu Principal</a></li>
    <li class="breadcrumb-item active">Indice de Visitas por medico</li>
@endsection

@section('content') <!-- Contenido -->
<div class="card">
    <div >
        @include('errors.request')
        @include('voucher.mensaje')
        <div class="card-header fondo2">
            <div class="card-title">
                <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Indice de Visitas por medico</p>
            </div>
            <div class="card-tools">
                <a target="_blank" href="{{ route('empresa.reporte',[$desde,$hasta,$empresa_id]) }}">
                    <button title="exportar pdf paciente" class="btn fondo1 btn-responsive">
                        <i class="fas fa-file-pdf"></i>
                    </button>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!--p>
                    <a class="btn btn-danger" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-filter" aria-hidden="true"></i> Filtrar
                    </a>
                </p>
                <div class="collapse" id="collapseExample"-->
                    <div class="card card-body">
                        @include('empresa.search')
                    </div>
                <!--/div-->
            </div><?php
            //var_dump($aPacientes);
            ?>
            <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                <thead style="background-color:#222D32">
                    <tr class="text-uppercase">
                        <th width="30%" style="color:#F8F9F9" >Paciente</th>
                        <th width="70%" style="color:#F8F9F9" >Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $paciente =>$estudios)<?php
                    var_dump($paciente);
                    var_dump($estudios);
                    ?>
                    <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                        <td style="text-align:left"><?php //echo $paciente?></td>
                        <td style="text-align:left"><?php //echo $estudios?></td>
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

