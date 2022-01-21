@extends('layouts.admin')

@section('navegacion')
    <li class="breadcrumb-item"><a href="/">Menu Principal</a></li>
    <li class="breadcrumb-item active">Auditoria</li>
@endsection

@section('content')
    <div class="card">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('errors.request')
            @include('audits.mensaje')
            <div class="card-header">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fa fa-tasks" aria-hidden="true"></i> Auditoria</p>
                </div>
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa fa-filter" aria-hidden="true"></i> Filtrar
                        </a>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">

                            @include('audits.search')<!-- aca colocar el include-->

                        </div>
                    </div>
                </div>
                @if($audits->isNotEmpty())
                    <div id="divDetalle" class="table-responsive">
                        <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                            <thead style="background-color:#222D32">
                                <tr class="text-uppercase" style="font-size:120%">
                                    <th  style="color:#F8F9F9">Tabla</th>
                                    <th  style="color:#F8F9F9">ID</th>
                                    <th  style="color:#F8F9F9">Evento</th>
                                    <th  style="color:#F8F9F9">Usuario</th>
                                    <th  style="color:#F8F9F9">Valores anteriores</th>
                                    <th  style="color:#F8F9F9">Valores Nuevos</th>
                                    <th  style="color:#F8F9F9">Fecha</th>
                                    <th  style="color:#F8F9F9">Mas Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($audits as $a)
                                    <tr  onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                                        <td>{{$a->auditable_type }}</td>
                                        <td>{{$a->auditable_id }}</td> <!-- ID del registro modificado -->
                                        <td> <!-- Evento -->
                                            @if ($a->event == 'created')
                                                <span class="label label-success">Creación</span>
                                            @endif
                                            @if ($a->event == 'updated')
                                                <span class="label label-warning">Actualización</span>
                                            @endif
                                            @if ($a->event == 'deleted')
                                                <span class="label label-danger">Eliminación</span>
                                            @endif
                                        </td>
                                        <td>{{$a->user->name }}</td> <!-- Usuario Responsable -->
                                        <td>
                                            <table class="table table-bordered table-condensed table-hover table-striped" style="border:3px solid #357CA5 width:100%">
                                                @foreach($a->old_values as $attribute => $value) <!-- Valores Anteriores -->
                                                    @if ($value!= NULL)
                                                        <tr onmouseover="cambiar_color_over2(this)" onmouseout="cambiar_color_out(this)">
                                                            <td><b>{{ $attribute }}</b></td>
                                                            <td>{{ $value }}</td>
                                                        </tr>
                                                    @else
                                                        <td>No hay datos previos</td>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered table-condensed table-hover table-striped" style="border:3px solid #357CA5 width:100%">
                                                @forelse($a->new_values as $attribute => $value) <!-- Valores Nuevos -->
                                                    <tr onmouseover="cambiar_color_over2(this)" onmouseout="cambiar_color_out(this)">
                                                        <td><b>{{ $attribute }}</b></td>
                                                        <td>{{ $value }}</td>
                                                    </tr>
                                                    @empty
                                                        No hay valores nuevos
                                                @endforelse
                                            </table>
                                        </td>
                                        <td>{{$a->created_at->format('d/m/Y h:i:s A') }}</td> <!-- Fecha -->
                                        <td style="text-align: center" colspan="1"> <!-- Opciones -->
                                            <a href="" data-target="#modal-show-{{$a->id}}" data-toggle="modal">
                                                <button title="ver" class="btn btn-info btn-responsive">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                    @include('audits.modalshow')
                                @endforeacH
                            </tbody>
                        </table>
                    </div>
                @else
                    <p
                        class="p-3 mb-2 bg-warning text-dark"
                        >
                        No hay registros
                    </p>
                @endif
            </div>
        </div>
    </div>


    @push('scripts')
    <script src="{{asset('js/tablaDetalle.js')}}"></script>


    @endpush
    @endsection
