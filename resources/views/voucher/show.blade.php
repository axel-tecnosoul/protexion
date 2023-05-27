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
                <button title="Exportar pdf" class="btn fondo1 btn-responsive">
                    <i class="fas fa-file-pdf"></i> Imprimir
                </button>
            </a>
            <a href="{{ route('voucher.edit',$voucher->id) }}">
                <button title="Editar voucher" class="btn btn-light btn-responsive">
                    <i class="fas fa-edit"></i>
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
            <!-- boton para editar el informe final -->
            <a title="Editar informe final" class="btn btn-light btn-responsive" href="{{ route('aptitudes.edit', $voucher->id)}}" >
              <i class="fa fa-edit" ></i>
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
                    @foreach ($estudios_sistema[2] as $item)<?php
                      $disabled="disabled";
                      $title="Cargue la declaracion jurada para poder imprimir estos documentos";
                      if($puede_imprimir==1){
                        $disabled="";
                        $title="Imprimir";
                      }?>
                      <tr>
                        @if ($estudios_sistema[0][$item]->estudio->nombre == "ESPIROMETRIA")
                          <td style="width: 65%">ESPIROMETRIA (FORMULARIO)</td>
                          <td style="text-align: center" title="<?=$title?>">
                            <a target="_blank" href="{{ route('espiriometrias.pdf',$voucher->id) }}" class="btn fondo1 btn-responsive <?=$disabled?>">
                              <i class="fas fa-file-pdf"></i>
                            </a>
                          </td>
                        @else
                          @if ($estudios_sistema[0][$item]->estudio->nombre == "AUDIOMETRIA")
                            <td style="width: 65%">AUDIOMETRIA (FORMULARIO)</td>
                            <td style="text-align: center" title="Imprimir">
                              <a target="_blank" href="{{ route('audiometrias.pdf',$voucher->id) }}" class="btn fondo1 btn-responsive">
                                <i class="fas fa-file-pdf"></i>
                              </a>
                            </td>
                          @else<?php
                            //var_dump($estudios_sistema);
                            //var_dump($estudios_sistema[0][$item]->estudio->id);
                            //var_dump($estudios_sistema[0][$item]->estudio->nombre)?>
                            <td style="width: 65%">{{ $estudios_sistema[0][$item]->estudio->nombre }}</td><?php
                            // @if ($estudios_sistema[0][$item]->archivo_adjunto != "[]") ?>
                            @if ($estudios_sistema[3][$item] > 0)
                              <td style="text-align: center" title="<?=$title?>">
                                <!-- editar formulario -->
                                <a title="Editar estudio" class="btn fondo2 btn-responsive" href="{{ route($estudios_sistema[4][$item], $voucher->id)}}">
                                  <i class="fa fa-edit" ></i>
                                </a>
                                <!-- imprimir formulario -->
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
          <!-- ESTUDIOS CARGADOS NEW -->
          <div class="col">
            <div class="card flex-fill">
              <div style="text-align: center" class="card-header fondo2">ESTUDIOS CARGADOS</div>
              <div class="card-body">
                <table data-page-length='10' id="tablaDetalle" style="border:1px solid black; width:100%" class="table-sm table-bordered table-condensed table-hover ">
                  <thead class="fondo2">
                    <tr>
                      <th style="width: 10%"> Tipo                  </th>
                      <th style="width: 70%"> Estudios              </th>
                      <th style="width: 10%"> Estado                </th>
                      <th style="width: 10%"> Acción                </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    //dd($estudios_cargar)?>
                    @foreach ($estudios_cargar as $item)
                      <tr>
                        <td style="text-align: left">{{($item->estudio->nombre) }}</td> 
                        <td style="text-align: left"><?php
                        //var_dump($item->estudio);
                          if($item->estudio->nombre=="RADIOLOGIA"){
                            if(isset($estudios_voucher["RADIOLOGIA"])){
                              echo implode(", ",$estudios_voucher["RADIOLOGIA"]);
                              echo "<br>";
                            }
                          }else{
                            //var_dump($estudios_voucher);
                            
                            foreach ($estudios_voucher as $tipo_estudio => $estudios) {
                              //var_dump($tipo_estudio);
                              if($tipo_estudio!="RADIOLOGIA"){

                                if($tipo_estudio=="COMPLEMENTARIO"){
                                  if(count($estudios)){
                                    //unset($estudios);
                                    //continue;
                                  }
                                  //var_dump($estudios);
                                  unset($estudios[73]);
                                }
                                echo "<b>".$tipo_estudio.":</b> ";
                                echo implode(", ",$estudios);
                                echo "<br>";
                              }
                            }
                          }
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
                      //var_dump($estudios_voucher);?>
                    @endforeach
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
        console.log(recipient);
        console.log(modal.find('#estudio').val(recipient[0].nombre))
        console.log(recipient[0].nombre)
        console.log(modal.find('#voucher_estudio').val(recipient[1].id))
        console.log(recipient[1].id)
        modal.find('#voucher_id').val($("#header_voucher_id").html())
      })
    </script>
  @endpush
@endsection