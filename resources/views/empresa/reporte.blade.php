@extends('layouts.admin')  <!-- Extiende de layout -->

@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/home">Menu Principal</a></li>
    <li class="breadcrumb-item active">Resumen empresarial</li>
@endsection

@section('content') <!-- Contenido -->
<div class="card">
    <div >
        @include('errors.request')
        @include('voucher.mensaje')
        <div class="card-header fondo2">
            <div class="card-title">
                <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Resumen empresarial</p>
            </div>
            <div class="card-tools">
                <a target="_blank" title="Exportar pdf paciente" class="btn fondo1 btn-responsive" id="btnImprimirReporte">
                    <i class="fas fa-file-pdf"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card card-body">
                    @include('empresa.search')
                </div>
            </div>
            <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                <thead style="background-color:#222D32">
                    <tr class="text-uppercase">
                        <th width="5%" style="color:#F8F9F9">
                          <div class="icheck-danger d-inline">
                              <input id="select_all" type="checkbox" checked/>
                              <Label for="select_all"> </Label>
                          </div>
                        </th>
                        <th width="10%" style="color:#F8F9F9" >Fecha</th>
                        <th width="40%" style="color:#F8F9F9" >Paciente</th>
                        <!-- <th width="10%" style="color:#F8F9F9" >CUIL/DNI</th> -->
                        <th width="40%" style="color:#F8F9F9" >Resultado</th>
                        <!-- <th width="28%" style="color:#F8F9F9" >Preexistencias</th>
                        <th width="28%" style="color:#F8F9F9" >Observaciones</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $key =>$informe)<?php
                    
                        $documento="";
                        if($informe->documento) $documento=number_format( (intval($informe->documento)/1000), 3, '.', '.');
                        if($informe->cuil) $documento=$informe->cuil;
                        /*var_dump($paciente);
                        var_dump($estudios);*/
                        ?>
                        <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                            <td style="text-align: center;vertical-align: middle;">
                                <div class="icheck-danger d-inline">
                                    <input type="checkbox" checked name="informe[]" value="{{$informe->id}}" class="informe" id="{{$informe->id}}">
                                    <label for="{{$informe->id}}"> </label>
                                </div>
                            </td>
                            <td style="text-align:left">{{\Carbon\Carbon::parse($informe->turno)->format('d/m/Y')}}</td>
                            <td style="text-align:left"><?=$informe->apellidos." ".$informe->nombres?></td>
                            <!-- <td style="text-align:left"><?=$documento?></td> -->
                            <td style="text-align:left"><?=$informe->aptitud_laboral?></td>
                            <!-- <td style="text-align:left"><?=$informe->preexistencias?></td>
                            <td style="text-align:left"><?=$informe->observaciones?></td> -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/tablaDetalle.js')}}"></script>
    <script type="text/javascript">
    $("#select_all").on("click",function(){
      if(this.checked){
        $(".informe").prop("checked",true)
      }else{
        $(".informe").prop("checked",false)
      }
      checkPacientesCheckeados()
    })

    $(document).on("click",".informe",function(){
      checkPacientesCheckeados()
    })

    $(document).ready(function () {
      $("#btnImprimirReporte").on("click",function(e){
        let empresa_id=$("#empresa_id")
        if(empresa_id.val()>0){
          if($(this).hasClass("disabled")){

          }else{
            let aIdInforme=[]
            $(".informe:checked").each(function(){
              //console.log(this.value);
              aIdInforme.push(this.value)
            })
            console.log(aIdInforme);
            console.log("empresa/pdf_empresarial/"+empresa_id.val()+"/"+aIdInforme.join(","));

            //enviar(aIdInforme.join(","))
            //$("#formVisitaMasiva").submit();
            //window.open("pdf_empresarial/"+encodeURIComponent(aIdInforme.join(",")),"_blank")
            window.open("pdf_empresarial/"+empresa_id.val()+"/"+encodeURIComponent(aIdInforme.join(",")),"_blank")
          }
        }else{
          alert("Por favor seleccione una empresa para generar el PDF")
        }
      })
    });

    function checkPacientesCheckeados(){
      if($(".informe:checked").length>0){
        $("#btnImprimirReporte").removeClass("disabled")
      }else{
        $("#btnImprimirReporte").addClass("disabled")
      }
    }
  </script>
@endpush
@endsection

