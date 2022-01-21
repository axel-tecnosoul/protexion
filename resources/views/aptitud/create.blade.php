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
                    <button class="btn btn-success btn-lg btn-block" id="confirmar"type="submit"><i class="fa fa-check"> </i>Cargar al formulario</button>
                </div>
            </div>
         </div>
    </div>
</div>

{!!Form::close()!!}

@push('scripts')
    <script>
        $(document).ready(function(){
            let texto = $("#datosAdicionales").val();
            $("#observaciones").val(texto);
        })

        // Preexistencias
        $(".preexistencias").change(function()
        {   
            //Variables
                //Estudios
                let cantTipo = $("#cantTipo").val();
                let cantEstudios = [];
                let texto = "";

                //Declaracion_jurada
                $("#pre_declaracion_jurada").val() == undefined 
                    ? (declaracion_jurada = "") 
                    : (declaracion_jurada = $("#pre_declaracion_jurada").val()) + " ";

                //Historia_clinica
                $("#pre_historia_clinica").val() == undefined 
                    ? (historia_clinica = "") 
                    : (historia_clinica = $("#pre_historia_clinica").val()) + " ";

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

                        if (
                            $("input:radio[name=POinput_"+i+"_"+j+"_check]:checked").val() == "P"
                        ) { 
                            texto = texto + $("#POinput_"+i+"_"+j).val() + " ";
                        }
                    }
                }
            }
            
            //Cargar estudios por sistema
            texto = declaracion_jurada + historia_clinica + posiciones_forzadas + iluminacion_insuficiente + texto;

            $("#preexistencias").val(texto);
        })

        // Observaciones
        $(".observaciones").change(function()
        {
            //Variables
                //Estudios
                let cantTipo = $("#cantTipo").val();
                let cantEstudios = [];
                let texto = $("#datosAdicionales").val();
                //Declaracion_jurada
                $("#obs_declaracion_jurada").val() == undefined 
                    ? (declaracion_jurada = "") 
                    : (declaracion_jurada = $("#obs_declaracion_jurada").val() + " ");

                //Historia_clinica
                $("#obs_historia_clinica").val() == undefined 
                    ? (historia_clinica = "") 
                    : (historia_clinica = $("#obs_historia_clinica").val() + " ");

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
        })
    </script>
@endpush
@endsection