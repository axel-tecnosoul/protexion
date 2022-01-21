
@extends('layouts.admin')
@section('navegacion')
    <li class="breadcrumb-item"><a href="/">Menu Principal</a></li>
    <li class="breadcrumb-item active">Indice de Configuraciones</li>
@endsection



@section('content')
    <div class="card-body">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:#D2D6DE">
            @include('errors.request')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" >
                        <i class="fa fa-cogs" aria-hidden="true"></i> Indice de Configuraciones
                    </h4>
                </div>
                <div class="card-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                <h3>3</h3>
                                <p>Tipo de Sangre</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-tint"></i>
                            </div>
                                <a href="{{ route('user.index') }}" class="small-box-footer">Ir a gestion de tipo de sangre <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{asset('js/tablaDetalle.js')}}"></script>


    @endpush
    @endsection

