@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('content')

{!!Form::open(array(
    'route'=>['aptitudes.update',$aptitud->id],
    'method'=>'PATCH',
    'autocomplete'=>'off',
    'files' => true,
))!!}

{{Form::token()}}

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header header-bg header-bg">
                <div class="card-title">
                    <div class="row">
                        <div class="col">
                            <p style="font-size:130%"><i class="fas fa-stethoscope"></i>  Informe médico laboral</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header header-bg -->
            <div class="card-body">
                <div class="row">
                    <!-- Voucher id HIDDEN -->
                    <div class="form-group">
                        <input type="number" name="voucher_id" value="{{$voucher->id }}" hidden>
                    </div>
                    <!-- Datos del paciente -->
                    <div class="col-12">
                        @include('datos_paciente.card_datos')
                    </div>
                    <!-- Riesgos -->
                    @include('aptitud.create.riesgos')
                    <!-- Estudios -->
                    @include('aptitud.create.estudios')
                    <!-- Preexistencias y observaciones -->
                    @include('aptitud.create.pre_obs')
                    <!-- Aptitud laboral -->
                    @include('aptitud.create.apt_laboral')
                </div>
                <!-- Guardar -->
                <div class="form-group">
                    <input id="guardar" name="_token" value="{{ csrf_token() }}" type="hidden">
                    <button class="btn btn-success btn-lg btn-block" id="confirmar"type="submit"><i class="fa fa-check"> </i>Modificar el formulario</button>
                </div>
            </div>
         </div>
    </div>
</div>

{!!Form::close()!!}

@push('scripts')
    <script>
      var aObsPre={};

      $(document).ready(function(){
        /*let texto = $("#datosAdicionales").val();
        $("#observaciones").val(texto);*/
        fillObsPre()
      })
      //Tomy ya hice el gol y te muestro la jugada
      $(document).on("keyup",".inputText",fillObsPre);
      $(document).on("keyup",".textArea",fillObsPre);
      $(document).on("change",".radioObsPre",fillObsPre);

      function fillObsPre(){
        aObsPre["preexistencias"]="";
        aObsPre["observaciones"]=$("#datosAdicionales").val();
        $(".textArea").each(function(){
          let valor=this.value.trim();
          /*console.log(this);
          console.log(valor);*/
          if(valor!="" && valor.length>0){
            let hidden_label=$(this).data("label");
            let label=$("#"+hidden_label).val().trim();
            let target=$(this).data("target");
            //console.log($("#"+hidden_label));
            /*console.log(hidden_label);
            console.log(label);
            console.log(target);*/
            let saltoLinea="\n";
            if(aObsPre[target]==""){
              saltoLinea="";
            }
            aObsPre[target]=aObsPre[target]+saltoLinea+label+" "+valor;
          }
        });
        var lblBigLabelAux="";
        $(".inputText").each(function(){
          let valor=this.value.trim();
          //console.log(this);
          if(valor!="" && valor.length>0){
            let inputId=this.id;
            let label=$("#"+inputId+"_label").html().trim();
            let bigLabel=$(this).closest(".card").find(".card-header").html().trim();
            let lblBigLabel=""
            if(lblBigLabelAux!=bigLabel){
              lblBigLabelAux=bigLabel
              lblBigLabel="<b>"+bigLabel+":</b>\n"
            }
            //console.log(label);
            let target=$("input[name='"+inputId+"_radio']:checked").data("target");
            let saltoLinea="\n";
            if(aObsPre[target]==""){
              saltoLinea="";
            }
            aObsPre[target]=aObsPre[target]+saltoLinea+lblBigLabel+label+" "+valor;
          }
        });
        $("#preexistencias").val(aObsPre["preexistencias"]);
        $("#observaciones").val(aObsPre["observaciones"]);
      }

    </script>
@endpush
@endsection