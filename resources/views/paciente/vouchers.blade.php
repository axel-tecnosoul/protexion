@extends('layouts.admin')  <!-- Extiende de layout -->

@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/home">Menu Principal</a></li>
    <li class="breadcrumb-item active">Indice de Visitas</li>
@endsection

<style>
  .dropdown-item{
    padding: .1rem .1rem !important;
  }
  .dropdown-menu{
    padding: 0 !important;
    background-color: lightgray !important;
    min-width: 0 !important;
    border: 1px solid black !important;
  }
  .dropdown-menu .btn{
    font-size: 90%;
  }
</style>
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
        <div class="card-body"><?php
            $volver="paciente"?>
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
                        <td style="text-align: left" class="nombre_paciente" data-paciente-id="{{ $voucher->paciente->id }}">{{ $voucher->paciente->nombreCompleto() }}</td>
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
                        <td class="fecha_turno">{{ \Carbon\Carbon::parse($voucher->turno)->format('d/m/Y') }}</td>
                        <td style="text-align: center" colspan="3">
                          <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu4" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false">
                              Acciones
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu4">
                              <a class="dropdown-item" href="{{ route('voucher.edit',$voucher->id) }}">
                                  <button title="Editar visita" class="btn btn-warning btn-responsive w-100 text-left">
                                      <i class="fas fa-edit"></i> Editar visita
                                  </button>
                              </a>
                              <!-- <a class="dropdown-item" target="_blank" href="{{ route('voucher.pdf_medico',$voucher->id) }}">
                                  <button title="exportar pdf médico" class="btn fondo2 btn-responsive w-100 text-left">
                                      <i class="fas fa-file-pdf"></i>
                                  </button>
                              </a> -->
                              <a class="dropdown-item" href="{{ route('voucher.show',$voucher->id) }}">
                                  <button title="carpeta"  class="btn btn-success btn-responsive w-100 text-left">
                                      <i style="color: rgb(255, 255, 255)" class="fas fa-folder"></i> Turno
                                  </button>
                              </a>
                              <a class="dropdown-item btnDelete" data-keyboard="false" data-id="{{ $voucher->id }}">
                                  <button type="submit" class="btn fondo1 btn-responsive w-100 text-left"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                              </a>
                              <a class="dropdown-item" target="_blank" href="{{ route('voucher.pdf_paciente',$voucher->id) }}">
                                  <button title="exportar pdf paciente" class="btn fondo2 btn-responsive w-100 text-left">
                                      <i class="fas fa-file-pdf"></i> Voucher Paciente
                                  </button>
                              </a>
                              <a class="dropdown-item btnClonar" data-keyboard="false" data-id="{{ $voucher->id }}">
                                  <button type="submit" class="btn fondo2 btn-responsive w-100 text-left"><i class="fa fa-fw fa-clone"></i> Clonar visita</button>
                              </a>
                              
                            </div>
                          </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @include('voucher.modaldelete')

            @include('voucher.modalclonar')
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/tablaDetalle.js')}}"></script>
    <script type="text/javascript">

      $(document).ready(function(){
        var select6 = $(".paciente_id").select2({width:'100%'});
        select6.data('select2').$selection.css('height', '100%');
      })

      $(document).on("click",".btnDelete",function(){
        console.log(this);
        let fila=$(this).parents("tr");
        console.log(fila);
        let nombre_paciente=fila.find(".nombre_paciente").html();
        console.log(nombre_paciente);
        let fecha_turno=fila.find(".fecha_turno").html();
        let voucher_id=$(this).data("id");

        let modal=$("#modal-delete")
        modal.modal("show");
        modal.find("#lblPaciente").html(nombre_paciente)
        modal.find("#lblTurno").html(fecha_turno)
        modal.find("#hiddenVolver").val("paciente")
        console.log(voucher_id);
        modal.find("form").attr("action","/protexion/public/voucher/"+voucher_id)
      })

      $(document).on("click",".btnClonar",function(){
        console.log(this);
        let fila=$(this).parents("tr");
        let celda_paciente=fila.find(".nombre_paciente");
        let nombre_paciente=celda_paciente.html();
        let paciente_id=celda_paciente.data("pacienteId");
        $("#paciente_id").val(paciente_id).trigger('change');

        let fecha_turno=fila.find(".fecha_turno").html();
        let voucher_id=$(this).data("id");

        let modal=$("#modal-clonar")
        modal.modal("show");
        modal.find("#lblPaciente").html(nombre_paciente)
        modal.find("#lblTurno").html(fecha_turno)
        console.log(voucher_id);
        modal.find("form").attr("action","/protexion/public/voucher/"+voucher_id+"/clone")
      })

    </script>
@endpush
@endsection

