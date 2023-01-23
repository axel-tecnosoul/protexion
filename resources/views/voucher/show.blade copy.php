@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('navegacion')
  <li class="breadcrumb-item"><a href="/protexion/public/voucher">Indice de Visitas</a></li>
  <li class="breadcrumb-item active">Datos de Visita</li>
@endsection

@section('content')
  <div class="container col-12"><?php
    //var_dump($voucher->aptitud);?>
    @if(Session::has('message'))
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('message')}}
      </div>
    @endif<?php
      
    //var_dump($voucher);?>
    <div class="card">
      <div class="card-header fondo2">
        <div class="card-title">
          <p style="font-size:130%"> <i class="fa fa-voucher" aria-hidden="true"></i>Datos de la Visita #<span id="header_voucher_id">{{$voucher->id}}</span>
            <a target="_blank" class="ml-2" href="{{ route('voucher.pdf_paciente',$voucher->id) }}">
                <button title="exportar pdf paciente" class="btn fondo1 btn-responsive">
                    <i class="fas fa-file-pdf"></i> Imprimir
                </button>
            </a>
          </p>
        </div>
        <div class="card-tools">
          @if (isset($voucher->aptitud->voucher_id))
            <!-- descargamos el archivo generado al crear el informe -->
            <a target="_blank" href=" {{ route('aptitudes.descargar',$voucher->aptitud->id)}}" class="btn fondo1">
              <i class="fas fa-file-pdf"></i> Informe Final
            </a>
          @else
            @if ($voucher->voucherListo())
              <a href=" {{ route('aptitudes.create',$voucher->id)}}" class="btn fondo1">Generar Informe Final</a>
            @else
            @endif
          @endif
        </div>
      </div><?php
      $aRutasPDF=[
        "DECLARACION JURADA"=>"declaracion_jurada.pdf",
        "HISTORIA CLINICA"=>"historia_clinica.pdf",
        "POSICIONES FORZADAS"=>"posiciones_forzadas.pdf",
        "ILUMINACION"=>"iluminacion_direccionados.pdf",
      ];?>
      <div class="card-body">
        <div class="row">
          <!-- PACIENTE -->
          <div class="col-6 d-flex align-items-stretch">
              @include('datos_paciente.card_datos')
          </div>
          <!-- ESTUDIOS DEL SISTEMA -->
          <div class="col-6 d-flex align-items-stretch ">
            <div class="card flex-fill">
              <div style="text-align: center" class="card-header fondo2">ESTUDIOS DEL SISTEMA</div>
              <div class="card-body">
                <table id="tablaEstudios" style="width:100%" class="table-sm table-bordered table-condensed table-hover">
                  <tbody>
                    @foreach ($estudios_sistema[2] as $item)
                      <tr>
                        @if ($estudios_sistema[0][$item]->estudio->nombre == "ESPIRIOMETRIA")
                          <td style="width: 65%">ESPIRIOMETRIA (FORMULARIO)</td>
                          <td style="text-align: center">
                            <a target="_blank" href="{{ route('espiriometrias.pdf',$voucher->id) }}" class="btn fondo1 btn-responsive">
                              <i class="fas fa-file-pdf"></i>
                            </a>
                          </td>
                        @else
                          @if ($estudios_sistema[0][$item]->estudio->nombre == "AUDIOMETRIA")
                            <td style="width: 65%">AUDIOMETRIA (FORMULARIO)</td>
                            <td style="text-align: center">
                              <a target="_blank" href="{{ route('audiometrias.pdf',$voucher->id) }}" class="btn fondo1 btn-responsive">
                                <i class="fas fa-file-pdf"></i>
                              </a>
                            </td>
                          @else<?php
                            //var_dump($estudios_sistema);
                            //var_dump($estudios_sistema[0][$item]->estudio);
                            //var_dump($estudios_sistema[0][$item]->estudio->nombre)?>
                            <td style="width: 65%">{{ $estudios_sistema[0][$item]->estudio->nombre }}</td><?php
                            // @if ($estudios_sistema[0][$item]->archivo_adjunto != "[]") ?>
                            @if ($estudios_sistema[3][$item] > 0)<?php
                              $disabled="disabled";
                              $title="Cargue la declaracion jurada para poder imprimir estos documentos";
                              if($puede_imprimir==1){
                                $disabled="";
                                $title="Imprimir";
                              }?>
                              <!-- imprimir formulario -->
                              <td style="text-align: center" title="<?=$title?>">
                                <a target="_blank" href="<?=route($aRutasPDF[$estudios_sistema[0][$item]->estudio->nombre],$voucher->id)?>" class="btn fondo1 btn-responsive <?=$disabled?>">
                                  <i class="fas fa-file-pdf"></i>
                                </a>
                              </td>
                            @else
                              <!-- generar formulario -->
                              <td> 
                                <a title="Cargar pdf" class="btn fondo2 btn-responsive" href={{ route($estudios_sistema[1][$item], $voucher->id)}} >
                                  <i class="fa fa-plus" ></i>
                                </a>
                              </td>
                            @endif
                          @endif
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- ESTUDIOS CARGADOS OLD -->
          <div class="col">
            <div class="card flex-fill">
              <div style="text-align: center" class="card-header fondo2">ESTUDIOS CARGADOS</div>
              <div class="card-body">
                <table data-page-length='10' id="tablaDetalle" style="border:1px solid black; width:100%" class="table-sm table-bordered table-condensed table-hover ">
                  <thead class="fondo2">
                    <tr>
                      <th style="width: 30%"> Tipo                  </th>
                      <th style="width: 30%"> Estudio               </th>
                      <th style="width: 25%"> Estado                </th>
                      <th style="width: 15%"> Acción                </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($estudios_cargar as $item)
                      <tr>
                        <td style="text-align: left"> {{($item->estudio->tipoEstudio->nombre) }}    </td> 
                        <td style="text-align: left"> {{strtoupper($item->estudio->nombre)    }}    </td>
                        @if ($item->archivo_adjunto != "[]")
                          <td><label class="badge badge-success" style="font-size:90%">Cargado</label></td>
                          <td style="text-align: center">
                            <button type="button" class="btn fondo2" data-toggle="modal" data-target="#archivoModal" data-whatever="[{{$item->estudio}}, {{$item}}]">
                              <i class="fa fa-plus" ></i>
                            </button>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn fondo1 btn-responsive" data-toggle="modal" data-target="#modelArchivos{{$item->id}}">
                              <i class="fas fa-file-pdf"></i>
                            </button>
                            <!-- MODAL PARA MOSTRAR ARCHIVOS -->
                            @include('voucher.modal_archivos')
                          </td>
                        @else
                          <td><label class="badge badge-danger" style="font-size:90%">Pendiente</label></td>
                          <td style="text-align: center">
                            <button type="button" class="btn fondo2" data-toggle="modal" data-target="#archivoModal" data-whatever="[{{$item->estudio}}, {{$item}}]">
                              <i class="fa fa-plus" ></i>
                            </button>
                          </td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- ESTUDIOS CARGADOS NEW -->
          <div class="col">
            <div class="card flex-fill">
              <div style="text-align: center" class="card-header fondo2">ESTUDIOS CARGADOS</div>
              <div class="card-body">
                <table data-page-length='10' id="tablaDetalle" style="border:1px solid black; width:100%" class="table-sm table-bordered table-condensed table-hover ">
                  <thead class="fondo2">
                    <tr>
                      <th style="width: 10%"> Tipo                  </th>
                      <th style="width: 70%"> Estudio               </th>
                      <th style="width: 10%"> Estado                </th>
                      <th style="width: 10%"> Acción                </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="text-align: left">RESUMEN</td> 
                      <td style="text-align: left"><?php
                      var_dump($estudios_voucher);
                      
                      foreach ($estudios_voucher as $tipo_estudio => $estudios) {
                        if($tipo_estudio!="RADIOLOGIA"){
                          echo "<b>".$tipo_estudio.":</b> ";
                          echo implode(", ",$estudios);
                          echo "<br>";
                        }
                      }
                      var_dump($item);
                      var_dump($item->archivo_adjunto);
                      ?></td>
                      @if ($item->archivo_adjunto != "[]")
                        <td><label class="badge badge-success" style="font-size:90%">Cargado</label></td>
                        <td style="text-align: center">
                          <button type="button" class="btn fondo2" data-toggle="modal" data-target="#archivoModal" data-whatever="[{{$item->estudio}}, {{$item}}]">
                            <i class="fa fa-plus" ></i>
                          </button>
                          <!-- Button trigger modal -->
                          <button type="button" class="btn fondo1 btn-responsive" data-toggle="modal" data-target="#modelArchivos{{$item->id}}">
                            <i class="fas fa-file-pdf"></i>
                          </button>
                          <!-- MODAL PARA MOSTRAR ARCHIVOS -->
                          @include('voucher.modal_archivos')
                        </td>
                      @else
                        <td><label class="badge badge-danger" style="font-size:90%">Pendiente</label></td>
                        <td style="text-align: center">
                          <button type="button" class="btn fondo2" data-toggle="modal" data-target="#archivoModal" data-whatever="[{{$item->estudio}}, {{$item}}]">
                            <i class="fa fa-plus" ></i>
                          </button>
                        </td>
                      @endif
                    </tr><?php
                    //var_dump($estudios_voucher);
                    
                    if(in_array("RADIOLOGIA",array_keys($estudios_voucher))){?>
                      <tr>
                        <td style="text-align: left">RADIOLOGIA</td> 
                        <td style="text-align: left"><?php
                          echo implode(", ",$estudios_voucher["RADIOLOGIA"]);
                          echo "<br>";?>
                        </td>
                        @if ($item->archivo_adjunto != "[]")
                          <td><label class="badge badge-success" style="font-size:90%">Cargado</label></td>
                          <td style="text-align: center">
                            <button type="button" class="btn fondo2" data-toggle="modal" data-target="#archivoModal" data-whatever="[{{$item->estudio}}, {{$item}}]">
                              <i class="fa fa-plus" ></i>
                            </button>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn fondo1 btn-responsive" data-toggle="modal" data-target="#modelArchivos{{$item->id}}">
                              <i class="fas fa-file-pdf"></i>
                            </button>
                            <!-- MODAL PARA MOSTRAR ARCHIVOS -->
                            @include('voucher.modal_archivos')
                          </td>
                        @else
                          <td><label class="badge badge-danger" style="font-size:90%">Pendiente</label></td>
                          <td style="text-align: center">
                            <button type="button" class="btn fondo2" data-toggle="modal" data-target="#archivoModal">
                              <i class="fa fa-plus" ></i>
                            </button>
                          </td>
                        @endif
                      </tr><?php
                    }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- MODAL PARA CARGAR ARCHIVOS -->
  @include('voucher.modal_carga')
  @push('scripts')
    <script src="{{asset('js/tablaDetalle.js')}}"></script>
    <script>
      $('#archivoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('Carga de archivo de ' + recipient[0].nombre)
        /*modal.find('#estudio').val(recipient[0].nombre)
        modal.find('#voucher_estudio').val(recipient[1].id)*/
        modal.find('#voucher_id').val($("#header_voucher_id").html())
      })
    </script>
  @endpush
@endsection