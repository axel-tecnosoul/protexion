@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('content')

{!!Form::open(array(
    'url'=>'aptitudes',
    'method'=>'POST',
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
                    <button class="btn btn-success btn-lg btn-block" id="confirmar"type="submit"><i class="fa fa-check"> </i>Cargar el formulario</button>
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
            console.log("hidden_label");
            console.log(hidden_label);
            console.log("label");
            console.log(label);
            console.log("target");
            console.log(target);
            boldLabel="<b>"+label+"</b>"
            if(aObsPre[target]!=""){
              //boldLabel="\n"+boldLabel//SOLO PARA SEPARAR LAS LINEAS
            }
            if(label=="HISTORIA CLINICA:" && target=="observaciones"){
              boldLabel=""
            }
            //console.log(boldLabel);
            let saltoLinea="\n";
            if(aObsPre[target]==""){
              saltoLinea="";
            }
            aObsPre[target]=aObsPre[target]+saltoLinea+boldLabel+" "+valor;
          }
        });
        /*$(".inputText").each(function(){
          let valor=this.value.trim();
          //console.log(this);
          if(valor!="" && valor.length>0){
            let inputId=this.id;
            let label=$("#"+inputId+"_label").html().trim();
            console.log(label);
            let target=$("input[name='"+inputId+"_radio']:checked").data("target");
            let saltoLinea="\n";
            if(aObsPre[target]==""){
              saltoLinea="";
            }
            aObsPre[target]=aObsPre[target]+saltoLinea+label+" "+valor;
          }
        });*/
        var lblBigLabelAux="";
        $(".inputText").each(function(){
          let valor=this.value.trim();
          //console.log(this);
          if(valor!="" && valor.length>0){
            let inputId=this.id;
            let label=$("#"+inputId+"_label").html().trim();
            let bigLabel=$(this).closest(".card").find(".card-header").html().trim();

            if(bigLabel=="ANALISIS BIOQUIMICO ANEXO 01"){
              bigLabel="ANALISIS BIOQUIMICO";
            }
            if(bigLabel=="COMPLEMENTARIO" || bigLabel=="Historia Clínica"){
              bigLabel=""
            }
            //label=""
            //label+="\n"
            label="<b>"+label+"</b>"

            let lblBigLabel=""
            if(bigLabel!="" && lblBigLabelAux!=bigLabel && bigLabel!="RADIOLOGIA"){
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

      // Preexistencias
      /*$(".preexistencias2").change(function(){   //Axel te paso la pelota y mete el gol :v 
          let idCheck = $("input[name='"+this.id+"_check']:checked");
          let lenghtCheck = idCheck[0].id.length;
          console.log(this.id);
          console.log(($(this))[0].type);
          console.log(idCheck);
          console.log(idCheck[0].id);
          console.log(idCheck[0]);
          console.log("lenght: " + lenghtCheck);
          let sbCheck = idCheck[0].id.substr(-21, 11);
          console.log(sbCheck);
          
          //print(idCheck.html().substring(4,7));
          /console.log($("#"+this.id+"_obs"));
          //console.log($("#"+this.id+"_pre"));
          //console.log("#"+this.id+"_hidden_label");
          //console.log($("#"+this.id+"_hidden_label"));
          //console.log($("#"+this.id+"_hidden_label").html());
          
          //Variables
              //Estudios
              let cantTipo = $("#cantTipo").val();
              let cantEstudios = [];
              let texto = "";
              let declaJuradaPre = $("#declaJuradaPre").val();
              let histoClinPre = $("#histoClinPre").val();
              
              //Declaracion_jurada
              $("#pre_declaracion_jurada").val() == undefined || $("#pre_declaracion_jurada").val() == ""
                  ? (declaracion_jurada = "") 
                  : (declaracion_jurada = declaJuradaPre + $("#pre_declaracion_jurada").val() + "\n");

              //Historia_clinica
              $("#pre_historia_clinica").val() == undefined || $("#pre_historia_clinica").val() == ""
                  ? (historia_clinica = "") 
                  : (historia_clinica = histoClinPre + $("#pre_historia_clinica").val() + "\n");

              //Posiciones_forzada
              $("#pre_posiciones_forzadas").val() == undefined 
                  ? (posiciones_forzadas = "") 
                  : (posiciones_forzadas = $("#pre_posiciones_forzadas").val()) + " ";

              //Iluminacion_insuficiente
              $("#pre_iluminacion_insuficiente").val() == undefined 
                  ? (iluminacion_insuficiente = "") 
                  : (iluminacion_insuficiente = $("#pre_iluminacion_insuficiente").val()) + " ";
          //

          //Cargar cantidad de estudios por tipo
          for (let i = 0; i < cantTipo; i++) {
              cantEstudios.push($("#cantEstudio"+i).val());
          }

          //Recorrer inputs y cargar sus valores en variable "texto"
          for (let i = 0; i < cantTipo; i++) {
              for (let j = 0; j < cantEstudios[i]; j++) {
                  if ($("#POinput_"+i+"_"+j).val() != "") {
                      //console.log($("#POinput_"+i+"_"+j+"_label").val());
                      if (
                          $("input:radio[name=POinput_"+i+"_"+j+"_check]:checked").val() == "P"
                      ) { 
                          texto =texto + $("#POinput_"+i+"_"+j).val() + " ";
                      }
                  }
              }
          }
          
          //Cargar estudios por sistema
          texto = declaracion_jurada + historia_clinica + posiciones_forzadas + iluminacion_insuficiente + texto;

          $("#preexistencias").val(texto);
      })*/

      // Observaciones
      /*$(".observaciones2").change(function(){
          //Variables
              //Estudios
              let cantTipo = $("#cantTipo").val();
              let cantEstudios = [];
              let texto = $("#datosAdicionales").val();
              let declaJuradaObs = $("#declaJuradaObs").val();
              let histoClinObs = $("#histoClinObs").val();
              //Declaracion_jurada
              $("#obs_declaracion_jurada").val() == undefined || $("#obs_declaracion_jurada").val() == ""
                  ? (declaracion_jurada = "") 
                  : (declaracion_jurada = declaJuradaObs + $("#obs_declaracion_jurada").val() + "\n");

              //Historia_clinica
              $("#obs_historia_clinica").val() == undefined  || $("#obs_historia_clinica").val() == ""
                  ? (historia_clinica = "") 
                  : (historia_clinica = histoClinObs + $("#obs_historia_clinica").val() + "\n");

              //Posiciones_forzada
              $("#obs_posiciones_forzadas").val() == undefined 
                  ? (posiciones_forzadas = "") 
                  : (posiciones_forzadas = $("#obs_posiciones_forzadas").val() + " ");

              //Iluminacion_insuficiente
              $("#obs_iluminacion_insuficiente").val() == undefined 
                  ? (iluminacion_insuficiente = "") 
                  : (iluminacion_insuficiente = $("#obs_iluminacion_insuficiente").val() + " ");
          //

          //Cargar cantidad de estudios por tipo
          for (let i = 0; i < cantTipo; i++) {
              cantEstudios.push($("#cantEstudio"+i).val());
          }

          //Recorrer inputs y cargar sus valores en variable "texto"
          for (let i = 0; i < cantTipo; i++) {
              for (let j = 0; j < cantEstudios[i]; j++) {
                  
                  if ($("#POinput_"+i+"_"+j).val() != "") {

                      if (
                          $("input:radio[name=POinput_"+i+"_"+j+"_check]:checked").val() == "O"
                      ) { 
                          texto = texto + $("#POinput_"+i+"_"+j).val() + " ";
                      }
                  }
              }
          }
          
          //Cargar estudios por sistema
          texto = declaracion_jurada + historia_clinica + posiciones_forzadas + iluminacion_insuficiente + texto;

          $("#observaciones").val(texto);
      })*/
    </script>
@endpush
@endsection