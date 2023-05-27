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
                <a target="_blank" href="{{ route('voucher_medico.pdf_medico',[$desde,$hasta,$tipo_estudio_id]) }}">
                    <button title="Exportar PDF" class="btn fondo1 btn-responsive">
                        <i class="fas fa-file-pdf"></i>
                    </button>
                </a>
                <a target="_blank" href="{{ route('voucher_medico.excel_medico',[$desde,$hasta,$tipo_estudio_id]) }}">
                    <button title="Exportar Excel" class="btn btn-responsive" style="background-color: rgb(31 176 76);color: white;">
                        <i class="fa fa-file-excel"></i>
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
                        @include('voucher_medico.search')
                    </div>
                <!--/div-->
            </div><?php
            //var_dump($aPacientes);
            ?>
            <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                <thead style="background-color:#222D32">
                    <tr class="text-uppercase">
                        <th width="10%" style="color:#F8F9F9">Turno</th>
                        <th width="18%" style="color:#F8F9F9">Paciente</th>
                        <th width="8%" style="color:#F8F9F9">DNI</th>
                        <th width="7%" style="color:#F8F9F9">Edad</th>
                        <th width="17%" style="color:#F8F9F9">Empresa</th>
                        <th width="40%" style="color:#F8F9F9">Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aPacientes as $paciente =>$datos)
                    <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                        <td style="text-align:right"><?=$datos["turno"] ?: ''?></td>
                        <td style="text-align:left">{{ $paciente }}</td>
                        <td style="text-align:right"><?=$datos["dni"] ?: ''?></td>
                        <td style="text-align:center"><?=$datos["edad"] ?: ''?></td>
                        <td style="text-align:left"><?=$datos["empresa"] ?: ''?>
                          <?php //if($datos["empresa"]) echo $datos["empresa"]?>
                        </td>
                        <td style="text-align:left"><?=implode(", ",$datos["estudios"])?></td>
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

