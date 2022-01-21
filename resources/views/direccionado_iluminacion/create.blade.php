@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('content')
<style>
    .jay-signature-pad {
        position: relative;
        display: -ms-flexbox;
        -ms-flex-direction: column;
        width: 100%;
        height: 100%;
        max-width: 600px;
        max-height: 315px;
        border: 1px solid #e8e8e8;
        background-color: #fff;
        box-shadow: 0 3px 20px rgba(0, 0, 0, 0.27), 0 0 40px rgba(0, 0, 0, 0.08) inset;
        border-radius: 15px;
        padding: 20px;
    }
    .txt-center {
        text-align: -webkit-center;
    }
</style>

{!!Form::open(array(
    'url'=>'iluminacion_direccionados',
    'method'=>'POST',
    'autocomplete'=>'off',
    'files' => true,
))!!}

{{Form::token()}}

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header fondo2 ">
                <div class="card-title">
                    <div class="row">
                        <div class="col-1">
                            <p style="font-size:130%"> <i class="fas fa-stethoscope"></i></p>
                        </div>
                        <div class="col-11">
                            <p style="font-size:130%">  Agente: Iluminación Insuficiente</p>
                            <p >Cuestionario Direccionado</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header header-bg -->
            <div class="card-body">
                <div class="col">
                    <!-- Voucher id HIDDEN -->
                    <div class="form-group">
                        <input type="number" name="voucher_id" value="{{$voucher->id }}" hidden>
                    </div>
                    <!-- Instrucciones -->
                    <div class="col-12">
                        <div class="card" >
                            <div class="card-header header-bg">
                                <h3 class="card-title">Instrucciones para el formulario</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <ul>
                                            <li><p>Completar los campos de los items que correspondan.</p></li>
                                            <li><p>Dejar vacíos los campos de los items que no correspondan.</p></li>
                                        </ul> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Criterios -->
                    <div class="col-12">
                        <div class="card" >
                            <div class="card-header header-bg">
                                <h3 class="card-title">Criterio de exposición al riesgo</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <ul>
                                            <li><p>Está orientado a trabajadores de minas o galerías subterráneas.</p></li>
                                        </ul> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Datos del paciente -->
                    <div class="col-12">
                        <div class="card" >
                            <div class="card-header header-bg">
                                <h3 class="card-title">Datos del paciente</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="added"> <input type="hidden" value="'+nombres+'">
                                            <p style="font-size:100%" class="text-left"> <strong> Nombre completo:    </strong> {{$voucher->paciente->nombreCompleto()             }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> CUIL:               </strong> {{$voucher->paciente->cuil                         }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Fecha de nacimiento:</strong> {{$voucher->paciente->fecha_nacimiento()           }} </p> 
                                            <p style="font-size:100%" class="text-left"> <strong> Edad:               </strong> {{$voucher->paciente->edad()                       }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Domicilio:          </strong> {{$voucher->paciente->domicilio ? $voucher->paciente->domicilio->direccion : " "        }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Sexo:               </strong> {{$voucher->paciente->sexo ? $voucher->paciente->sexo->definicion : " "                 }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Origen:             </strong> {{$voucher->paciente->origen ? $voucher->paciente->origen->definicion : " "             }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Cuit de origen:     </strong> {{$voucher->paciente->origen ? $voucher->paciente->origen->cuit : " "                   }} </p>        
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="added"> 
                                            @if($voucher->paciente->imagen==null)
                                                <img class="img-thumbnail" height="200px" width="200px" src="{{ asset('imagenes/paciente/default.png')}}">
                                            @else
                                                <img class="img-thumbnail" height="200px" width="200px" src="{{$voucher->paciente->imagen}}">
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Datos laborales -->
                    <div class="col-12">
                        <div class="card  "> <!--collapsed-card -->
                            <div class="card-header header-bg">
                                <h3 class="card-title">Datos laborales</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body" > <!--style="display: none;" -->
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="observacion1">Puesto de trabajo: </label>
                                        <input type="text" maxlength="255" class="form-control" name="puesto" placeholder="Ingrese el puesto de trabajo...">
                                    </div>
                                    <div class="form-group col">
                                        <label for="observacion1">Antigüedad (Años):</label>
                                        <input type="number" max="99" class="form-control" name="antiguedad" placeholder="Ingrese la antiguedad...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="observacion1">Dirección completa:   </label>
                                        <input type="text" maxlength="255" class="form-control" name="direccion_completa" placeholder="Lugar donde se desempeña el trabajador...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Antecedentes -->
                    <div class="col-12">
                        <div class="card  "> <!--collapsed-card -->
                            <div class="card-header header-bg">
                                <h3 class="card-title">Antecedentes</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body" > <!--style="display: none;" -->
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="observacion1">Antecedentes de enfermedades:                                      </label>
                                        <input type="text" maxlength="255" class="form-control" name="enfermedades" placeholder="Antecedentes...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="observacion1">Antecedentes de trastornos congénitos:                             </label>
                                        <input type="text" maxlength="255" class="form-control" name="transtornos_congenitos" placeholder="Antecedentes...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="observacion1">Antecedentes de enfermedades profesionales o accidentes de trabajo:</label>
                                        <input type="text" maxlength="255" class="form-control" name="enfermedades_profecionales" placeholder="Antecedentes...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Exposición al riesgo -->
                    <div class="col-12">
                        <div class="card  "> <!--collapsed-card -->
                            <div class="card-header header-bg">
                                <h3 class="card-title">Exposición al riesgo</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body" > <!--style="display: none;" -->
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="">Exposición anterior (Empresa, puesto y tiempo):                            </label>
                                        <input type="text" maxlength="255" class="form-control" name="exposicion_anterior" placeholder="Empresa puesto tiempo 1, empresa puesto tiempo 2, etc">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="">Exposición Actual</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <input type="text" maxlength="255" class="form-control" id="exposicion_actual" name="exposicion_actual" hidden>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="">Empresa/Establecimiento:                     </label>
                                        <input type="text" maxlength="25" class="form-control exp_actual" id="exp_act_1" name="exp_actual_empresa" placeholder="Empresa o establecimiento...">
                                    </div>
                                    <div class="form-group col">
                                        <label for="">Actividad:                                    </label>
                                        <input type="text" maxlength="60" class="form-control exp_actual" id="exp_act_2" name="exp_actual_actividad" placeholder="Actividad que desempeña...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="">Puesto de Trabajo:                            </label>
                                        <input type="text" maxlength="25" class="form-control exp_actual" id="exp_act_3" name="exp_actual_puesto" placeholder="Puesto de trabajo...">
                                    </div>
                                    <div class="form-group col">
                                        <label for="">Antigüedad en el puesto de trabajo (Años):    </label>
                                        <input type="number" max="99" class="form-control exp_actual" id="exp_act_4" name="exp_actual_antiguedad" placeholder="Antigüedad...">
                                    </div>
                                    <div class="form-group col">
                                        <label for="">Horario de trabajo:                           </label>
                                        <input type="text" maxlength="75" class="form-control exp_actual" id="exp_act_5" name="exp_actual_horario" placeholder="Ej: de 7:30 a 11:30">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Examen clínico -->
                    <div class="col-12">
                        <div class="card  "> <!--collapsed-card -->
                            <div class="card-header header-bg">
                                <h3 class="card-title">Examen clínico</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body" > <!--style="display: none;" -->
                                <!-- Instrucciones -->
                                <div class="row">
                                    <div class="card text-white bg-light col" style="width: max-content">
                                      <div class="card-body">
                                        <h4 class="card-title"><b>Instrucciones:</b></h4><br>
                                        <p>                                        
                                            <ul>
                                                <li>Describir si corresponde.</li>
                                                <li>En caso de que corresponda y no se desee ingresar una descripción, escriba "Si".</li>
                                            </ul> 
                                        </p>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="checkbox_cefaleas">Cefaleas: </label>
                                        <input type="text" maxlength="255" class="form-control"  id="describir_cefaleas" name="cefaleas" placeholder="Descripción...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="checkbox_vision_doble">Visión doble: </label>
                                        <input type="text" maxlength="255" class="form-control"  id="describir_vision_doble" name="vision_doble" placeholder="Descripción...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="checkbox_mareo_vertigo">Mareos / Vértigo: </label>
                                        <input type="text" maxlength="255" class="form-control"  id="describir_mareo_vertigo" name="mareo_vertigo" placeholder="Descripción...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="checkbox_conjuntivitis">Conjuntivitis: </label>
                                        <input type="text" maxlength="255" class="form-control"  id="describir_conjuntivitis" name="conjuntivitis" placeholder="Descripción...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="checkbox_vision_borrosa">Visión borrosa: </label>
                                        <input type="text" maxlength="255" class="form-control"  id="describir_vision_borrosa" name="vision_borrosa" placeholder="Descripción...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="checkbox_inseguridad_de_pie">Presencia de inseguridad en posición de pie: </label>
                                        <input type="text" maxlength="255" class="form-control"  id="describir_inseguridad_de_pie" name="inseguridad_de_pie" placeholder="Descripción...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Examen ocular -->
                    <div class="col-12">
                        <div class="card  "> <!--collapsed-card -->
                            <div class="card-header header-bg">
                                <h3 class="card-title">Examen ocular</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body" > <!--style="display: none;" -->
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="observacion1"><u>Ojos:</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 icheck-danger d-inline">
                                        <input value=1 type="checkbox" name="no_centrados" id="checkbox_no_centrados">
                                        <label for="checkbox_no_centrados">No centrados</label>
                                    </div>
                                    <div class="col-4 icheck-danger d-inline">
                                        <input value=1 type="checkbox" name="pupilas_anormales" id="checkbox_pupilas_anormales">
                                        <label for="checkbox_pupilas_anormales">Pupilas anormales</label>
                                    </div>
                                    <div class="col-4 icheck-danger d-inline">
                                        <input value=1 type="checkbox" name="conjuntivas_anormales" id="checkbox_conjuntivas_anormales">
                                        <label for="checkbox_conjuntivas_anormales">Conjuntivas anormales</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 icheck-danger d-inline">
                                        <input value=1 type="checkbox" name="corneas_anormales" id="checkbox_corneas_anormales">
                                        <label for="checkbox_corneas_anormales">Córneas anormales</label>
                                    </div>
                                    <div class="col-4 icheck-danger d-inline">
                                        <input value=1 type="checkbox" name="motilidad_anormal" id="checkbox_motilidad_anormal">
                                        <label for="checkbox_motilidad_anormal">Motilidad ocular anormal</label>
                                    </div>
                                    <div class="col-4 icheck-danger d-inline">
                                        <input value=1 type="checkbox" name="nistagmus_ausente" id="checkbox_nistagmus_ausente">
                                        <label for="checkbox_nistagmus_ausente">Nistagmus Ausente</label>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 2%">
                                    <div class="form-group col">
                                        <label>Informe:</label>
                                        <input type="text" maxlength="255" class="form-control" name="informe_ocular" placeholder="Informe...">
                                    </div>
                                </div><hr>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="observacion1"> <u>Agudeza visual:</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label>Con corrección:                                      </label>
                                        <input type="text" maxlength="255" class="form-control" name="av_correccion" placeholder="Describa...">
                                    </div>
                                    <div class="form-group col">
                                        <label>Sin corrección:                                      </label>
                                        <input type="text" maxlength="255" class="form-control" name="av_sin_correccion" placeholder="Describa...">
                                    </div>
                                </div>
                                <div class="row">

                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label>Observaciones:                                      </label>
                                        <input type="text" maxlength="255" class="form-control" name="observaciones" placeholder="Observaciones...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Firma -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header header-bg">
                                <h3 class="card-title">Firma del Paciente</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="form-group">
                                        <div id="signature-pad" class="jay-signature-pad" >
                                            <div class="jay-signature-pad--body">
                                                <canvas id="jay-signature-pad" width=550 height=200></canvas>
                                            </div>
                                            <div class="signature-pad--footer txt-center">
                                                <div class="signature-pad--actions txt-center">
                                                    <div>
                                                        <br>
                                                        <button type="button" class="button clear btn btn-dark" data-action="clear"><i class="fa fa-eraser" aria-hidden="true"></i>...Limpiar</button>
                                                        <button type="button" class="button btn btn-dark" data-action="change-color"><i class="fas fa-palette"></i> Cambiar color</button>
                                                        <!--<button type="button" class="button save btn btn-dark" data-action="save-svg"><i class="fas fa-save"></i> Guardar como SVG</button>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="firma" id="firma">
                    </div>
                </div>
            </div>
            <!-- Guardar -->
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
                    <div class="form-group">
                        <input id="guardar" name="_token" value="{{ csrf_token() }}" type="hidden">
                            <button class="btn btn-success btn-lg btn-block" id="confirmar"type="submit"><i class="fa fa-check"> </i>Cargar al formulario</button>
                    </div>
                </div>
            <!-- / Guardar -->
         </div>
    </div>
</div>

{!!Form::close()!!}

@push('scripts')
    <script>
    $(document).ready(function(){
        //Firma
            var wrapper = document.getElementById("signature-pad");
            var clearButton = wrapper.querySelector("[data-action=clear]");
            var changeColorButton = wrapper.querySelector("[data-action=change-color]");
            var guardar = document.getElementById("confirmar");
            var canvas = wrapper.querySelector("canvas");
            var signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)'
            });
            // Adjust canvas coordinate space taking into account pixel ratio,
            // to make it look crisp on mobile devices.
            // This also causes canvas to be cleared.
            function resizeCanvas() {
                // When zoomed out to less than 100%, for some very strange reason,
                // some browsers report devicePixelRatio as less than 1
                // and only part of the canvas is cleared then.
                var ratio =  Math.max(window.devicePixelRatio || 1, 1);
                // This part causes the canvas to be cleared
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
                // This library does not listen for canvas changes, so after the canvas is automatically
                // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
                // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
                // that the state of this library is consistent with visual state of the canvas, you
                // have to clear it manually.
                signaturePad.clear();
            }
            // On mobile devices it might make more sense to listen to orientation change,
            // rather than window resize events.
            window.onresize = resizeCanvas;
            resizeCanvas();
            function download(dataURL, filename) {
                var blob = dataURLToBlob(dataURL);
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement("a");
                a.style = "display: none";
                a.href = url;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            }
            // One could simply use Canvas#toBlob method instead, but it's just to show
            // that it can be done using result of SignaturePad#toDataURL.
            function dataURLToBlob(dataURL) {
                var parts = dataURL.split(';base64,');
                var contentType = parts[0].split(":")[1];
                var raw = window.atob(parts[1]);
                var rawLength = raw.length;
                var uInt8Array = new Uint8Array(rawLength);
                for (var i = 0; i < rawLength; ++i) {
                    uInt8Array[i] = raw.charCodeAt(i);
                }
                return new Blob([uInt8Array], { type: contentType });
            }
            clearButton.addEventListener("click", function (event) {
                signaturePad.clear();
            });
            changeColorButton.addEventListener("click", function (event) {
                var r = Math.round(Math.random() * 255);
                var g = Math.round(Math.random() * 255);
                var b = Math.round(Math.random() * 255);
                var color = "rgb(" + r + "," + g + "," + b +")";
                signaturePad.penColor = color;
            });
            guardar.addEventListener("click", function (event) {
                if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
                } else {
                var dataURL = signaturePad.toDataURL('image/svg+xml');
                document.getElementById('firma').value = dataURL;
                //image = image.replace('data:image/png;base64,', '');
                //save(dataURL, "signature.svg");
                //var dataURL = signaturePad.toDataURL('image/svg+xml');
                //download(dataURL, "signature.svg");
                }
            });

        //
        //Completar campo de exposicion actual
        $(".exp_actual").change(function()
        {
            var exp_act_1 = $("#exp_act_1").val();
            var exp_act_2 = $("#exp_act_2").val();
            var exp_act_3 = $("#exp_act_3").val();
            var exp_act_4 = $("#exp_act_4").val();
            var exp_act_5 = $("#exp_act_5").val();
            $("#exposicion_actual").val("Empresa: "+exp_act_1+", actividad: "+exp_act_2+ ", puesto: "+exp_act_3+
                                        ", antigüedad: "+exp_act_4+ " y Horario: " +exp_act_5);
        })
    });  
    </script>
@endpush
@endsection