@extends('layouts.admin')  <!-- Extiende de layout -->

@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/home">Menu Principal</a></li>
    <li class="breadcrumb-item active">Indice de Empresa</li>
@endsection

<style>
    /* Agrega un estilo de rotación al icono */
    .fa-rotate {
        animation: spin 2s infinite linear;
    }

    /* Define la animación de rotación */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

@section('content') <!-- Contenido -->
<div class="card">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('errors.request')
        <div class="card-header header-bg">
            <div class="card-title">
                <p style="font-size:130%"> <i class="fa fa-building" aria-hidden="true"></i> Indice de Empresa</p>
            </div>
            <div class="card-tools">
                <a href= {{ route('empresa.create')}}>
                    <button class="btn fondo1">
                        <i class="fas fa-plus"></i> Nuevo
                    </button>
                </a>

                <a href="{{ route('origen.exportar') }}">
                    <button class="btn" style="background-color: rgb(31 176 76);color: white;">
                      <i class="nav-icon fas fa-file-excel"></i> Exportar
                    </button>
                </a>

                <a href="{{ route('empresa.sincronizar') }}">
                    <button class="btn btn-primary" id="btnSincronizar">
                      <i class="nav-icon fa fa-sync"></i> <span>Sincronizar</span>
                    </button>
                </a>
                
            </div>
        </div>
        <!-- / Cabecera -->
        @include('empresa.mensaje')
        <!-- Body -->
        <div class="card-body">
            <!--div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-filter" aria-hidden="true"></i> Filtrar
                    </a>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">

                        
                    </div>
                </div>
            </div-->
            <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                <thead style="background-color:#222D32">
                    <tr>
                        <th width="10%" style="color:#F8F9F9">NRO</th>
                        <th width="25%" style="color:#F8F9F9">NOMBRE</th>
                        <th width="15%" style="color:#F8F9F9">CUIT</th>
                        <th width="15%" style="color:#F8F9F9">LOCALIDAD</th>
                        <th width="20%" style="color:#F8F9F9">DOMICILIO</th>
                        <th width="15%" style="color:#F8F9F9">OPCIONES</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas as $empresa)
                    
                    <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                       
                        <td style="text-align: center">{{ $empresa->id }}</td>
                        <td style="text-align: left">{{ $empresa->definicion }}</td>
                        <td style="text-align: left">{{ $empresa->cuit }}</td>
                        <td style="text-align: left"><?php
                        if(isset($empresa->domicilio->ciudad)){
                          echo $empresa->domicilio->ciudad->nombre;
                        }?></td>
                        <td style="text-align: left"><?php
                        if(isset($empresa->domicilio->direccion)){
                          echo $empresa->domicilio->direccion;
                        }?></td>
                        <td colspan="3">
                            
                            <!-- <a data-keyboard="false" data-target="#modal-show-{{ $empresa->id }}" data-toggle="modal">
                                <button title="ver" class="btn fondo1 btn-responsive">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </a> -->
                            <a href="{{URL::action('EmpresaController@edit',$empresa->id)}}">
                                <button title="editar" class="btn fondo2 btn-responsive">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </a>
                            <!-- <form action="{{route('empresa.destroy',$empresa->id)}}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i></button>
                            </form> -->
                            
                            <a data-keyboard="false" data-target="#modal-delete-{{ $empresa->id }}" data-toggle="modal">
                                <button type="submit" class="btn fondo1 btn-responsive"><i class="fa fa-fw fa-trash"></i></button>
                            </a>
                            @include('empresa.modaldelete')
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

    <script>
        // Agrega un event listener al botón
        document.getElementById("btnSincronizar").addEventListener("click", function() {
            var btn = this;
            var icono = btn.querySelector("i");
            var label = btn.querySelector("span");

            // Agrega la clase de rotación al icono
            icono.classList.add("fa-rotate");
            label.textContent="Sincronizando..."

            // Cambia solo el texto del botón
            //btn.insertAdjacentHTML('beforeend', ' Sincronizando...');
            //btn.textContent.replace('Sincronizar', 'Sincronizando...');

        });
    </script>

@endpush
@endsection

