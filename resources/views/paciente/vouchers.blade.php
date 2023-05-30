@extends('layouts.admin')  <!-- Extiende de layout -->

@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/home">Menu Principal</a></li>
    <li class="breadcrumb-item active">Indice de Visitas</li>
@endsection

@section('content') <!-- Contenido -->
<div class="card">
    <div >
        @include('errors.request')
        @include('voucher.mensaje')
        <div class="card-header fondo2">
            <div class="card-title">
                <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Visitas de {{ $paciente->nombreCompleto() }}</p>
            </div>
            <div class="card-tools">
                
                <a href= {{ route('voucher.create',$paciente->id)}}>
                    <button class="btn fondo1">
                        <i class="fa fa-plus"></i> Nueva visita
                    </button>
                </a>
                
            </div>
        </div>
        <div class="card-body">

            <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                <thead style="background-color:#222D32">
                    <tr class="text-uppercase">
                        <th width="10%" style="color:#F8F9F9" >Código</th>
                        <th width="29%" style="color:#F8F9F9" >Paciente</th>
                        <th width="29%" style="color:#F8F9F9" >Empresa</th>
                        <th width="10%" style="color:#F8F9F9" >HHCC</th>
                        <th width="10%" style="color:#F8F9F9" >Fecha</th>
                        <th width="11%" style="color:#F8F9F9" >Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vouchers as $voucher)
                    <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                        <td>{{ $voucher->codigo }}</td>
                        <td style="text-align: left">{{ $voucher->paciente->nombreCompleto() }}</td>
                        <td style="text-align: left"><?php
                          if($voucher->origen){
                            echo $voucher->origen->definicion;
                          }?>
                        </td>
                        <td style="text-align: left"><?php
                        if($voucher->historiaClinica){
                          echo '<label style="font-size:90%" class="badge badge-success">REALIZADA</label>';
                        }else{
                          echo '<label style="font-size:90%" class="badge badge-warning">PENDIENTE</label>';
                        }?></td>
                        <td>{{ \Carbon\Carbon::parse($voucher->turno)->format('d/m/Y') }}</td>
                        <td style="text-align: center" colspan="3">
                          <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu4" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false">
                              Acciones
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu4">
                              <a class="dropdown-item" href="{{ route('voucher.edit',$voucher->id) }}">
                                  <button title="Editar visita" class="btn fondo2 btn-responsive w-100 text-left">
                                      <i class="fas fa-edit"></i> Editar visita
                                  </button>
                              </a>
                              <a class="dropdown-item" target="_blank" href="{{ route('voucher.pdf_paciente',$voucher->id) }}">
                                  <button title="exportar pdf paciente" class="btn fondo1 btn-responsive w-100 text-left">
                                      <i class="fas fa-file-pdf"></i> Exportar PDF
                                  </button>
                              </a>
                              <!-- <a class="dropdown-item" target="_blank" href="{{ route('voucher.pdf_medico',$voucher->id) }}">
                                  <button title="exportar pdf médico" class="btn fondo2 btn-responsive w-100 text-left">
                                      <i class="fas fa-file-pdf"></i>
                                  </button>
                              </a> -->
                              <a class="dropdown-item" href="{{ route('voucher.show',$voucher->id) }}">
                                  <button title="carpeta"  class="btn fondo3 btn-responsive w-100 text-left">
                                      <i style="color: rgb(255, 255, 255)" class="fas fa-folder"></i> Carpeta
                                  </button>
                              </a>
                              <a class="dropdown-item" data-keyboard="false" data-target="#modal-delete-{{ $voucher->id }}" data-toggle="modal">
                                  <button type="submit" class="btn fondo1 btn-responsive w-100 text-left"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                              </a>
                              <a class="dropdown-item" data-keyboard="false" data-target="#modal-clonar-{{ $voucher->id }}" data-toggle="modal">
                                  <button type="submit" class="btn fondo2 btn-responsive w-100 text-left"><i class="fa fa-fw fa-clone"></i> Clonar visita</button>
                              </a>
                              
                              <!-- <a class="dropdown-item" href="#">Action</a>
                              <a class="dropdown-item" href="#">Another action</a>
                              <a class="dropdown-item" href="#">Something else here</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">Separated link</a> -->
                            </div>
                          </div>
                          <!-- <a target="_blank" href="{{ route('voucher.pdf_medico',$voucher->id) }}">
                                <button title="exportar pdf médico" class="btn fondo2 btn-responsive">
                                    <i class="fas fa-file-pdf"></i>
                                </button>
                            </a> -->
                            <!-- <a href="{{ route('voucher.edit',$voucher->id) }}">
                                <button title="Editar visita" class="btn fondo2 btn-responsive">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </a>
                            <a target="_blank" href="{{ route('voucher.pdf_paciente',$voucher->id) }}">
                                <button title="exportar pdf paciente" class="btn fondo1 btn-responsive">
                                    <i class="fas fa-file-pdf"></i>
                                </button>
                            </a>
                            <a href="{{ route('voucher.show',$voucher->id) }}">
                                <button title="carpeta"  class="btn fondo3 btn-responsive">
                                    <i style="color: rgb(255, 255, 255)" class="fas fa-folder"></i>
                                </button>
                            </a>

                            <a data-keyboard="false" data-target="#modal-delete-{{ $voucher->id }}" data-toggle="modal">
                                <button type="submit" class="btn fondo1 btn-responsive"><i class="fa fa-fw fa-trash"></i></button>
                            </a> -->
                            @include('voucher.modaldelete')

                            @include('voucher.modalclonar')

                            <!-- <form action="{{route('paciente.destroy_voucher',[$voucher->id,$voucher->paciente->id])}}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn fondo1 btn-responsive"><i class="fa fa-fw fa-trash"></i></button>
                            </form> -->
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

