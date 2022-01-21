@extends('layouts.admin')
  <!-- Extiende de layout -->
@section('navegacion')
    <li class="breadcrumb-item"><a href="/posiciones_forzadas">Indice de Pacientes</a></li>
    <li class="breadcrumb-item active">Formulario de Posiciones Forzadas</li>
@endsection

@section('content')
{!!Form::open(array(
    'url'=>'posiciones_forzadas',
    'method'=>'POST',
    'autocomplete'=>'off',
    'files' => true,
))!!}

{{Form::token()}}

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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header header-bg ">
                <div class="card-title">
                    <p style="font-size:130%"> <i class="fas fa-stethoscope"></i> Formulario de Posiciones Forzadas</p>
                </div>
            </div>
            <!-- /.card-header header-bg -->
            <div class="card-body">
                <div class="col-12">
                    <!-- Voucher id HIDDEN -->
                    <div class="form-group">
                        <input type="number" name="voucher_id" value="{{$voucher->id }}" hidden>
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
                                            <p style="font-size:100%" class="text-left"> <strong> Nombre completo:    </strong> {{$voucher->paciente->nombreCompleto()     }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> CUIL:               </strong> {{$voucher->paciente->cuil                 }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Fecha de nacimiento:</strong> {{$voucher->paciente->fecha_nacimiento()   }} </p> 
                                            <p style="font-size:100%" class="text-left"> <strong> Edad:               </strong> {{$voucher->paciente->edad()               }} </p>
                                            <p style="font-size:100%" class="text-left"> <strong> Sexo:               </strong> {{$voucher->paciente->sexo ? $voucher->paciente->sexo->definicion : " "     }} </p>        
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
                    <!-- / Datos del paciente -->
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
                                            <input type="text" class="form-control" name="puesto" placeholder="Ingrese el puesto de trabajo...">
                                        </div>
                                        <div class="form-group col">
                                            <label for="observacion1">Antigüedad (Años):</label>
                                            <input type="number" class="form-control" name="antiguedad" placeholder="Ingrese la antiguedad...">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label for="observacion1">Nº Horas/ días de trabajo:  </label>
                                            <input type="text" class="form-control" name="nroTrabajo" placeholder="Ingrese Nº Horas/días de trabajo:">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- / Datos laborales -->
                    <!-- Tareas -->
                        <div class="col-12">
                            <div class="card ">
                                <div class="card-header header-bg">
                                    <h3 class="card-title">Tarea</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <!-- Tiempo de Tarea -->
                                        <div class="form-group row">
                                            <label class="col" for="tarea_1"> <u> Tiempo de Tarea:</u> </label>
                                            <div class="col">
                                                <label><input type="radio" name="tiempo" value="Esporádico"> Esporádico</label>
                                            </div>
                                            <div class="col">
                                                <label><input type="radio" name="tiempo" value="Continuo > 2hs y < 4hs"> Continuo > 2hs y < 4hs</label>
                                            </div>
                                            <div class="col"> 
                                                <label><input type="radio" name="tiempo" value="Continuo > 4hs"> Continuo > 4hs</label>
                                            </div>
                                        </div><hr>
                                        <!-- Ciclo de trabajo: -->
                                        <div class="form-group row">
                                            <label class="col" for="tarea_1"> <u> Ciclo de trabajo:</u> </label>
                                            <div class="col"> 
                                                <label><input type="radio" name="ciclo" value="Corto: hasta 30 segundos"> hasta 30 segundos</label>
                                            </div>
                                            <div class="col">
                                                <label><input type="radio" name="ciclo" value="Moderado: 30 segundos - 1 a 2 minutos"> 30 segundos a 2 minutos</label>
                                            </div>
                                            <div class="col">
                                                <label><input type="radio" name="ciclo" value="Largo: < 2 minutos"> < 2 minutos</label>
                                            </div>
                                        </div><hr>
                                        <!-- Manipulación manual de cargas: -->
                                        <div class="form-group row">
                                            <label class="col" for="tarea_1"> <u> Manipulación manual de cargas:</u> </label>
                                            <div class="col">
                                                <label><input type="radio" name="cargas" value="Menor a 1 Kg "> Menor a 1 Kg </label>
                                            </div>
                                            <div class="col">
                                                <label><input type="radio" name="cargas" value="Entre 1 Kg y 3 Kgs"> Entre 1 Kg y 3 Kgs</label>
                                            </div>
                                            <div class="col"> 
                                                <label><input type="radio" name="cargas" value="Mayor a 3 Kgs"> Mayor a 3 Kgs</label>
                                            </div>
                                        </div><hr>
                                        <label for="tipo_tarea"> <u> Tipo de tarea:</u> </label>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta1" value=1 id="checkboxPrimary8">
                                                    <label for="checkboxPrimary8">Movimiento de alcance repetidos por encima del hombro</label>
                                                </div>
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta2" value=1 id="checkboxPrimary10">
                                                    <label for="checkboxPrimary10">Movimiento de extensión o flexión forzados de muñeca</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta3" value=1 id="checkboxPrimary12">
                                                    <label for="checkboxPrimary12">Flexión sostenida de columna</label>
                                                </div>
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta4" value=1 id="checkboxPrimary14">
                                                    <label for="checkboxPrimary14">Flexión extrema del codo</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta5" value=1 id="checkboxPrimary16">
                                                    <label for="checkboxPrimary16">El cuello se mantiene flexionado</label>
                                                </div>
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta6" value=1 id="checkboxPrimary18">
                                                    <label for="checkboxPrimary18">Giros de columna</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta7" value=1 id="checkboxPrimary20">
                                                    <label for="checkboxPrimary20">Rotación extrema del antebrazo</label>
                                                </div>
                                                <div class="col icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta8" value=1 id="checkboxPrimary22">
                                                    <label for="checkboxPrimary22">Flexión mantenida de dedos</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="observacion_tarea">Otros, especificar: </label>
                                            <input type="text" class="form-control" id="observacion_tarea"  name="observacion_tarea"  placeholder="Otros...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- / Tareas -->
                    <!-- Semiología -->
                        <div class="col-12">
                            <div class="card ">
                                <div class="card-header header-bg">
                                    <h3 class="card-title">Semiología del Segmento Corporal Comprometido - Relación Movilidad – Dolor Articular y estado de masa muscular relacionada.</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                        <div class="container">
                                            <div class="row">
                                                <table class="table table-hover table-condensed table-bordered table-striped">
                                                    <tr>
                                                        <th colspan="2">
                                                            Articulación
                                                        </th>
                                                        <th>Abducción</th>
                                                        <th>Addución</th>
                                                        <th>Flexión</th>
                                                        <th>Extensión</th>
                                                        <th>Rot. Externa</th>
                                                        <th>Rot. Interna</th>
                                                        <th>Irradiación</th>
                                                        <th>Alt. Masa muscular</th>
                                                    </tr>
                                                <!-- Iteración por cada articulación -->
                                                @foreach ($articulaciones as $art)
                                                    <tr>
                                                        <td rowspan="2" width="10%">{{$art}}</td>
                                                        <!-- Iteración izquierda o derecha -->
                                                        @for ($i = 0; $i < 2; $i++)
                                                            @if ($i == 0)
                                                                <td width="5%">Der.</td>
                                                            @else
                                                                <td width="5%">Izq.</td>
                                                            @endif
                                                            <!-- Iteración por cada cuadro -->
                                                            @for ($j = $cuadro; $j < $cuadro+8; $j++)
                                                                <td>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <!-- Que cargue 0 si no se selecciona -->
                                                                        <input type="text" hidden value=0 name={{$j}}>
                                                                        <div class="icheck-danger d-inline">
                                                                            <!-- Que cargue 1 si se selecciona -->
                                                                            <input type="checkbox" name={{$j}} value=1 id="cuadro{{$j}}">
                                                                            <label for="cuadro{{$j}}"></label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            @endfor
                                                            <div hidden> {{$cuadro = $cuadro + 8}} </div>
                                                        </tr>
                                                        @endfor
                                                @endforeach 
                                                </table>
                                            </div>
                                        <div class="form-group">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    <!-- / Semiología -->
                    <!-- Características del dolor -->
                        <div class="col-12">
                            <div class="card ">
                                <div class="card-header header-bg">
                                    <h3 class="card-title">Características del dolor</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Por su forma de aparición -->
                                    <div class="form-group row">
                                        <label class="col" for="dolor_1"> <u> Por su forma de aparición:</u> </label>
                                        <div class="col">
                                            <label><input type="radio" name="forma" value="Agudo"> Agudo</label>
                                        </div>
                                        <div class="col">
                                             <label><input type="radio" name="forma" value="Insidioso"> Insidioso</label>
                                        </div>
                                        <div class="col"> 
                                            <label><input type="radio" name="forma" value="Ausente"> Ausente</label>
                                        </div>
                                    </div><hr>
                                    <!-- Por su evolución -->
                                    <div class="form-group row">
                                        <label class="col" for="dolor_1"> <u> Por su evolución:</u> </label>
                                        <div class="col">
                                            <label><input type="radio" name="evolucion" value="Continuo"> Continuo</label>
                                        </div>
                                        <div class="col">
                                            <label><input type="radio" name="evolucion" value="Brotes"> Brotes</label>
                                        </div>
                                        <div class="col"> 
                                            <label><input type="radio" name="evolucion" value="Cíclico"> Cíclico</label>
                                        </div>
                                    </div><hr>       
                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="observacion1">Puntos dolorosos: </label>
                                            <input type="text" class="form-control" id="observacion1_d"  name="observacion1_d"  placeholder="Puntos dolorosos">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="observacion1">Localización: </label>
                                            <input type="text" class="form-control" id="observacion2_d"  name="observacion2_d"  placeholder="Localización">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                        <!-- Otros signos y sintomas presentes en el segmento involucrado -->
                                            <label for="signos_1"> <u> Otros signos y sintomas presentes en el segmento involucrado:</u> </label>
                                            <div class="form-group">
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta1_d" value=1 id="checkboxPrimary24">
                                                    <label for="checkboxPrimary24">Calambres musculares             </label> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta2_d" value=1 id="checkboxPrimary26">
                                                    <label for="checkboxPrimary26">Parestesias                      </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta3_d" value=1 id="checkboxPrimary28">
                                                    <label for="checkboxPrimary28">Calor                            </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta4_d" value=1 id="checkboxPrimary30">
                                                    <label for="checkboxPrimary30">Cambios de coloración de la piel </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="pregunta5_d" value=1 id="checkboxPrimary32">
                                                    <label for="checkboxPrimary32">Tumefacción                      </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                        <!-- Caracterización semiológica -->
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label for=""> <u> Caracterización semiológica:</u></label>
                                                </div>
                                                <div class="col-12">
                                                    <label><input type="radio" name="grado" value="Grado 0: Ausencia de signos y síntomas."> Grado 0: Ausencia de signos y síntomas.</label>
                                                </div>
                                                <div class="col-12">
                                                    <label><input type="radio" name="grado" value="Grado 1: Dolor en reposo y/o existencia de sintomatología sugestiva."> Grado 1: Dolor en reposo y/o existencia de sintomatología sugestiva.</label>
                                                </div>
                                                <div class="col-12">
                                                    <label><input type="radio" name="grado" value="Grado 2: Grado 1 mas contractura y/o dolor a la movilización."> Grado 2: Grado 1 mas contractura y/o dolor a la movilización.</label>
                                                </div>
                                                <div class="col-12">
                                                    <label><input type="radio" name="grado" value="Grado 3: Grado 2 mas dolor a la palpación y/o percusión."> Grado 3: Grado 2 mas dolor a la palpación y/o percusión.</label>
                                                </div>
                                                <div class="col-12">
                                                    <label><input type="radio" name="grado" value="Grado 4: Grado 3 mas limitación funcional evidente clínicamente."> Grado 4: Grado 3 mas limitación funcional evidente clínicamente.</label>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>          
                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="observacion1">Observación: </label>
                                            <input type="text" class="form-control" id="observacion1_s"  name="observacion1_s"  placeholder="Observación">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- / Características del dolor -->
                    <!-- Firma -->
                        <div class="col-12">
                            <div class="card ">
                                <div class="card-header header-bg">
                                    <h3 class="card-title">Firma del Paciente</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="form-group">
                                            <div id="signature-pad" class="jay-signature-pad">
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
                        </div>
                        <input type="hidden" name="firma" id="firma">
                    <!-- / Firma -->
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
        /*
        //Voucher
            var select1 = $("#voucher_id").select2({width:'100%'});
            select1.data('select2').$selection.css('height', '34px');


            $("#voucher_id").change(function(){
                mostrarDatos();
            });

            function mostrarDatos()
            {
                voucher_id=$("#voucher_id").val();
                vouchers=$("#voucher_id option:selected").text();

                $.ajax({
                    type:'get',
                    url:'{!!URL::to('declaracion_jurada/create/traerDatosPaciente')!!}',
                    data:{'id':voucher_id},
                    success:function(data){

                        documento=data['documento'];
                        nombres=data['nombres'];
                        apellidos=data['apellidos'];
                        fecha_nacimiento=data['fecha_nacimiento'];
                        foto=data['foto'];
                        cuil=data['cuil'];
                        sexo=data['sexo'];

                        datosPaciente='<div class="added"> <input type="hidden" value="'+nombres+'"><p style="font-size:140%" class="text-left">Nombre y Apellido del paciente: '+nombres+'</p><input type="hidden" value="'+documento+'"><p style="font-size:140%" class="text-left">Documento del paciente: '+documento+'</p><input type="hidden" value="'+fecha_nacimiento+'"><p style="font-size:140%" class="text-left">Fecha de nacimiento del paciente: '+fecha_nacimiento+'</p><input type="hidden"  value="'+cuil+'"><p style="font-size:140%" class="text-left">CUIL: '+cuil+'</p><input type="hidden" value="'+sexo+'"><p style="font-size:140%" class="text-left">Sexo: '+sexo+'</p><input type="hidden" name="voucher_id" value="'+voucher_id+'"></div>';
                        fotoPaciente='<div class="added"> @if('+foto+'==null)<img class="img-thumbnail" height="85px" width="85px" src='+foto+'>@else<img class="img-thumbnail" height="350px" width="350px" src="{{ asset('imagenes/paciente/default.png')}}">@endif </div>';

                        //Limpiar datos agregadoss
                        $('.added').remove();
                        
                        $("#datos_paciente").append(datosPaciente).hide().show('slow');
                        $("#foto_paciente").append(fotoPaciente).hide().show('slow');
                    },
                    error:function(){
                        console.log('no anda AJAX');
                    }
                });

            }
            function eliminarDelSelect2 ()
            {
                $("#voucher_id option:selected").remove();

            }
        // */
    });  
    </script>
@endpush
@endsection

