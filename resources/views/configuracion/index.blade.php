
@extends('layouts.admin')
@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/home">Menu Principal</a></li>
    <li class="breadcrumb-item active">Indice de Configuraciones</li>
@endsection



@section('content')
    <div class="card-body">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:#D2D6DE">
            @include('errors.request')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" >
                        <i class="fas fa-file-export" aria-hidden="true"></i> Exportacion de la Base de Datos
                    </h4>
                </div>
                <div class="card-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a href="{{ route('configuracion.export') }}" target="_blank">Click aqui para exportar y descargar</a>
                        <!-- generar_archivo_sql.php -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{asset('js/tablaDetalle.js')}}"></script>


    @endpush
    @endsection

