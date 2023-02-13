@extends('layouts.admin')
<!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/voucher">Indice de Visitas</a></li>
    <li class="breadcrumb-item active">Editar Visita</li>
@endsection

@section('content')

  {!!Form::model($voucher, [
      'method'=>'PATCH',
      'route'=>['voucher.update',$voucher->id]
  ])!!}

  {{Form::token()}}<?php
  $turno="";
  if(isset($voucher)){
    $turno=$voucher->turno;
    //dd($voucher_estudio);
  }

  ?>
  <div class="card card-outline">
    <div class="card-header header-bg">
      <div class="card-title">
        <p style="font-size:130%"> <i class="fa fa-voucher" aria-hidden="true"></i> Datos de la Visita</p>
      </div>
    </div>
    <div class="card-body fondo0">
      <!-- HIDDEN -->
      <input type="text" name="paciente_id" value="{{$paciente->id }}" hidden>
      <!-- Fecha -->
      <div class="col-12">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label> <p style="font-size:130%">Fecha: </p></label>
              <input class="form-control" type="date" name="turno" required value="<?=$turno?>">
            </div>
          </div> 
        </div>
      </div>
      <!-- / Fecha -->
      <!-- Paciente -->
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card flex-fill" >
          <div class="card-header header-bg">
            <h3 class="card-title">Datos del paciente</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-7">
                <div> 
                  <p style="font-size:100%" class="text-left"> <strong> Nombre completo:</strong> {{$paciente->nombreCompleto()}} </p>
                  <p style="font-size:100%" class="text-left"> <strong> CUIL:</strong> {{$paciente->cuil}} </p>
                  <p style="font-size:100%" class="text-left"> <strong> Fecha de nacimiento:</strong> {{$paciente->fecha_nacimiento()}} </p>
                  <p style="font-size:100%" class="text-left"> <strong> Edad:</strong> {{$paciente->edad()}} </p>
                  <p style="font-size:100%" class="text-left"> <strong> Domicilio:</strong> {{$paciente->domicilio ? $paciente->domicilio->direccion : " "}} </p>
                  <p style="font-size:100%" class="text-left"> <strong> Sexo:</strong> {{$paciente->sexo ? $paciente->sexo->definicion : " "}} </p>
                  <p style="font-size:100%" class="text-left"> <strong> Origen:</strong> {{$paciente->origen ? $paciente->origen->definicion : " "}} </p>
                  <p style="font-size:100%" class="text-left"> <strong> Cuit de origen:</strong> {{$paciente->origen ? $paciente->origen->cuit : " "}} </p>      
                </div>
              </div>
              <div class="col-4">
                <div class="added"> 
                  @if($paciente->imagen==null)
                    <img class="img-thumbnail" height="200px" width="200px" src="{{ asset('imagenes/paciente/default.png')}}">
                  @else
                    <img class="img-thumbnail" height="200px" width="200px" src="{{$paciente->imagen}}">
                  @endif 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- / Paciente -->
      <!-- Estudios -->
      @foreach ($tipo_estudios as $tipo)
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card estudios"> <!--collapsed-card -->
            <div class="card-header header-bg">
              <div class="row">
                <div class="col">
                  <h3 class="card-title">{{$tipo->nombre}}</h3> 
                </div>
                <div style="text-align: right" class="col">
                  <div class="icheck-danger d-inline">
                    <input id="a{{$tipo->id}}" type="checkbox" onClick="ActivarCasilla(this,{{$tipo->id}});"/>
                    <Label for="a{{$tipo->id}}">{{strtoupper("Seleccionar todo")}} </Label>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body" > <!--style="display: none;" -->
              <div class="row"><?php
                $c=$c2=0;
                $idChecked = ["45","46","47","48","49","50","56","57"];
                //dd($estudios)
                
                // && $item->id != 66?>
                @foreach ($estudios as $item)
                  @if ($item->tipo_estudio_id == $tipo->id)<?php
                    //var_dump($item->id);
                    if($item->id==73 or strtoupper($item->nombre)==strtoupper($item->tipoEstudio->nombre)){?>
                      <input class="{{$tipo->id}}" type="hidden" name="{{$item->id}}" value=1 id="{{$item->id}}"><?php
                    }else{?>
                      <div class="col-6">
                        <div class="custom-control custom-checkbox">
                          <div class="icheck-danger d-inline"><?php
                            $readonly=$checked="";
                            $c++;
                            //if(in_array($item->id,$voucher_estudio)){
                            if(isset($voucher_estudio[$item->id])){
                              //existe el estudio en el voucher
                              $checked=" checked";
                              $c2++;
                              if($voucher_estudio[$item->id]=="si"){
                                //el estudio ya fue completado
                                //$readonly=" onclick='return false;' required";
                                $readonly=" onclick='allwaysChecked(this);' required";
                              }
                            }
                            if($item->id==56){
                              //56 = Declaracion Jurada -> Va si o si
                              //$readonly=" onclick='return false;' required";
                              $readonly=" onclick='allwaysChecked(this);' required";
                              if($checked==""){
                                $checked=" checked";
                              }
                            }?>
                            <input class="{{$tipo->id}}" type="checkbox" name="{{$item->id}}" value=1 id="{{$item->id}}" <?=$checked.$readonly?>>
                            <label for="{{$item->id}}"> {{strtoupper($item->nombre)}} </label>
                          </div>
                        </div>
                      </div><?php
                    }?>
                  @endif
                @endforeach
                <script>
                  c=parseInt("<?=$c?>")
                  c2=parseInt("<?=$c2?>")
                  if(c==c2){
                    document.getElementById("a{{$tipo->id}}").checked=true;
                  }
                </script>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      <!-- / Estudios-->
    </div>
  </div>
  <div class="card  "> 
    <div class="card-header header-bg">
      <h3 class="card-title">Riesgos</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
      </div>
    </div>
    <div class="card-body" > 
      <div class="row">
        @foreach ($riesgos as $riesgo)<?php
          //dd($riesgo->id)?>
          <div class="form-group col-12">
            <input type="text" value=0  name="riesgos[{{$riesgo->id}}]" hidden>
            <div class="icheck-danger d-inline"><?php
              $checked="";
              //if(in_array($item->id, $idChecked)){
              if(in_array($riesgo->id,$voucher_riesgos)){
                $checked="checked";
              }?>
              <input type="checkbox" <?=$checked?> value=1 id="riesgo{{$riesgo->id}}" name="riesgos[{{$riesgo->id}}]">
              <label for="riesgo{{$riesgo->id}}">{{$riesgo->riesgo}}</label>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group" style="text-align:center">
      <a href="{{URL::action('PacienteController@voucher',$paciente->id)}}">
        <button title="Cancelar" class="btn btn-secondary btn-lg" type="button"><i class="fas fa-arrow-left"></i> Cancelar</button>
      </a>
      <button title="Guardar" id="confirmar" class="btn btn-danger btn-lg" type="submit"> <i class="fa fa-check"></i> Guardar</button>
    </div>
  </div>
{!!Form::close()!!}

@push('scripts')
<script type="text/javascript">
        function ActivarCasilla(casilla, id) 
        {
            miscasillas=document.getElementsByClassName(id); //Rescatamos controles tipo Input
            for(i=0;i<miscasillas.length;i++) //Ejecutamos y recorremos los controles
            {
                if(miscasillas[i].type == "checkbox") // Ejecutamos si es una casilla de verificacion
                {
                    miscasillas[i].checked=casilla.checked; // Si el input es CheckBox se aplica la funcion ActivarCasilla
                }
            }
        }
    </script>
<script>
  $(document).ready(function () {
    $(".card .estudios").each(function(){
      /*let cant_checkboxes=$(this).find(".card-body").find("input[type='checkbox']").length;
      let cant_checkboxes_checked=$(this).find(".card-body").find("input[type='checkbox']:checked").length;
      if(cant_checkboxes==cant_checkboxes_checked){
        $(this).find(".card-header").find("input[type='checkbox']").attr("checked",true)
      }*/
    })
  });
  function allwaysChecked(t){
    if(!t.checked){
      t.checked=true
    }
  }
</script>
@endpush
@endsection
