@extends('layouts.admin')

@section('navegacion')
    <li class="breadcrumb-item"><a href="/">Menu Principal</a></li>
    <li class="breadcrumb-item active">Estudios</li>
@endsection

@section('content')
    <div class="card">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('errors.request')
            <!--inlcude mensaje -->
            <!-- Cabecera -->
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Estudios </p>
                </div>
                <div class="card-tools">
                    <a href= {{ route('estudios.create') }}>
                        <button class="btn btn-primary">
                            <i class="fa fa-plus"></i> Nuevo
                        </button>
                    </a>
                </div>
            </div>
        <!-- / Cabecera -->
        <!-- Body -->
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa fa-filter" aria-hidden="true"></i> Filtrar
                        </a>
                    </p>
                </div>
                <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                    <thead style="background-color:#222D32">
                        <tr>
                            <th width="10%" style="color:#F8F9F9"><p class="text-uppercase" style="font-size:120%">Nro</p></th>
                            <th width="10%" style="color:#F8F9F9"><p class="text-uppercase" style="font-size:120%">Nombre</p></th>
                            <th width="10%" style="color:#F8F9F9"><p class="text-uppercase" style="font-size:120%">Tipo</p></th>
                            <th width="10%" style="color:#F8F9F9"><p class="text-uppercase" style="font-size:120%">Carga</p></th>
                            <th width="10%" style="color:#F8F9F9"><p class="text-uppercase" style="font-size:120%">Fecha de carga</p></th>
                            <th width="10%" style="color:#F8F9F9"><p class="text-uppercase" style="font-size:120%">Opciones</p></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estudios as $item)
                        <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                            <td><p style="font-size:120%">{{ $item->id }}                           </p></td>
                            <td><p style="font-size:120%">{{ $item->nombre }}                       </p></td>
                            <td><p style="font-size:120%">{{ $item->tipoEstudio->nombre }}          </p></td>
                            @if ($item->carga)
                                <td><p style="font-size:120%">Si</p></td>
                            @else
                                <td><p style="font-size:120%">No</p></td>
                            @endif
                            <td><p style="font-size:120%">{{($item->created_at)->format('d/m/Y') }} </p></td>
                            <td>
                                <form action="{{ route('estudios.destroy',$item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                </form>
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