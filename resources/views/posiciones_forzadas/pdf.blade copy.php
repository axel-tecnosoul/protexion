<!DOCTYPE html>
<html lang="en" style='margin-top: 5px;margin-bottom: 0px'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @page {
            /* margin: 72px 25px 25px 30px; */
            margin: 3cm 2cm 2cm 2cm;
        }
        .tabla {
            border-collapse: collapse;
        }
        .tabla th, .tabla td {
            border: rgb(0, 0, 0) 1px solid;
        }
        tbody td {
            text-align: center;
        }
        tfoot th {
            text-align: right;
        }
        .letra11{ 
            font-size: 12px;
        }
        .letra10{ 
            font-size: 10px;
        }
        .subtitulo{
            font-weight: bold;
            font-size: 12px;
            background-color: brown;
            color: white;
            text-align: center;
            margin: 0;
        }
        label{
            font-weight: bold;
        }
        .hidden{
            display: none;
        }
        footer {
          position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px;
        }
        #footer {
          position: fixed;
          left: 0;
          right: 0;
          color: #aaa;
          font-size: 0.8em;
          bottom: 0;
          border-top: 0.1pt solid #aaa;
          text-align: right;
        }

        .page-number {
          text-align: center;
        }

        .page-number:before {
          content: "Page " counter(page);
        }

    </style>
    <title>POSICIONES FORZADAS</title>
</head>
<body style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">

    <div id="footer">
      <!-- <div class="page-number"></div> -->
      <span>
        PROTEXIÓN "CENTRO MÉDICO LABORAL"<br>
        Av. San Martín 1400- Puerto Rico,  Misiones - CP 3334
        <!-- <br> -->
        Tel. (03743) 476272 - Whatsapp: (03743) 483004<br>
        E-mail: info@protexionpr.com.ar; gerencia@protexionpr.com.ar<br>
      </span>
    </div>

    <div id="header" style="text-align: right">
        <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
    </div>
    
    <div id="content" class="container">
        
        <h3 style="text-align: center;margin: 0;">Cuestionario Direccionado <br>
            Agente de Riesgo: Gestos repetitivos y posiciones forzadas <br>
            Anexo V – Resolución SRT N° 37/2010 
        </h3>
        <p class="subtitulo">Datos del paciente</p>
        <!-- Datos de PF -->
            <table class="letra11" style="width: 510px">
                <tbody>
                    <tr>
                        <td style="text-align: left; width: 200px">
                           <label for=""> Empresa:                   </label>    
                               {{$posiciones_forzada->voucher->paciente->origen ? $posiciones_forzada->voucher->paciente->origen->definicion : " " }}  
                        </td>
                        <td style="text-align: left; width: 200px">
                           <label for=""> CUIT:                      </label>    
                               {{$posiciones_forzada->voucher->paciente->origen ? $posiciones_forzada->voucher->paciente->origen->cuit : " "       }}  
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 200px">
                           <label for=""> Paciente:                  </label>    
                               {{$posiciones_forzada->voucher->paciente->nombreCompleto()   }}  
                        </td>
                        <td style="text-align: left; width: 200px">
                           <label for=""> CUIL:                      </label>    
                               {{$posiciones_forzada->voucher->paciente->cuil ?? number_format($posiciones_forzada->voucher->paciente->documento,0,",",".")}}  
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 200px">
                           <label for=""> Puesto:                    </label>    
                               {{$posiciones_forzada->puesto                                }}      
                        </td>
                        <td style="text-align: left; width: 200px">
                           <label for=""> Antigüedad:                </label>    
                               {{$posiciones_forzada->antiguedad                            }}      
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: left; width: 510px">
                           <label for=""> Nº Horas/ días de trabajo: </label>    
                               {{$posiciones_forzada->nroTrabajo                            }}  
                        </td>
                    </tr>
                </tbody>
            </table>
        <!-- / Datos de PF -->
        <hr>
        <!-- Tarea -->
            @if ($posiciones_forzada->tarea != null)
                <table class="letra11" style="width: 510px">
                    <tbody>
                        <tr>
                            <!-- Tiempo -->
                            <td style="text-align: left; width: 205px">
                                <label for="">Tiempo de tarea:</label>                                
                                {{$posiciones_forzada->tarea->tiempo}}
                            </td>
                            <!-- Ciclo -->
                            <td style="text-align: left; width: 205px">
                                <label for="">Ciclo de trabajo:</label> 
                                {{$posiciones_forzada->tarea->ciclo}}
                            </td>
                        </tr>
                        <tr>
                             <!-- Cargas -->
                            <td style="text-align: left;" colspan="2">
                                <label for=""> Manipulación manual de cargas:  </label>
                                {{$posiciones_forzada->tarea->cargas}}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            <!-- Tipos de tarea -->
                <table class="letra10">
                    <tbody>
                        <tr >
                            <td colspan="4" style="text-align: left; ">
                                <p class="subtitulo">Tipo de tareas</p>
                            </td>
                        </tr>
                        <tr>
                            <td  style="width: 290px; text-align: left;">
                                    Movimiento de alcance repetidos por encima del hombro
                            </td>
                            <td style="width: 25px; border: rgb(0, 0, 0) 1px solid;">
                                @if ($posiciones_forzada->tarea->pregunta1)
                                    X
                                @endif
                            </td>
                            <td style="width: 25px; border: rgb(0, 0, 0) 1px solid;">
                                @if ($posiciones_forzada->tarea->pregunta2)
                                    X
                                @endif
                            </td>
                            <td  style="width: 290px; text-align: left;">
                                    Movimiento de extensión o flexión forzados de muñeca
                            </td>
                        </tr>
                        <tr>
                            <td  style="width: 290px; text-align: left;">
                                    Flexión sostenida de columna
                            </td>
                            <td style="width: 25px; border: rgb(0, 0, 0) 1px solid;">
                                @if ($posiciones_forzada->tarea->pregunta3)
                                    X
                                @endif
                            </td>
                            <td style="width: 25px; border: rgb(0, 0, 0) 1px solid;">
                                @if ($posiciones_forzada->tarea->pregunta4)
                                    X
                                @endif
                            </td>
                            <td  style="width: 290px; text-align: left;">
                                    Flexión extrema del codo 
                            </td>
                        </tr>
                        <tr>
                            <td  style="width: 290px; text-align: left;">
                                    El cuello se mantiene flexionado
                            </td>
                            <td style="width: 25px; border: rgb(0, 0, 0) 1px solid;">
                                @if ($posiciones_forzada->tarea->pregunta5)
                                    X
                                @endif
                            </td>
                            <td style="width: 25px; border: rgb(0, 0, 0) 1px solid;">
                                @if ($posiciones_forzada->tarea->pregunta6)
                                    X
                                @endif
                            </td>
                            <td  style="width: 290px; text-align: left;">
                                    Giros de columna 
                            </td>
                        </tr>
                        <tr>
                            <td  style="width: 290px; text-align: left;">
                                    Rotación extrema del antebrazo
                            </td>
                            <td style="width: 25px; border: rgb(0, 0, 0) 1px solid;">
                                @if ($posiciones_forzada->tarea->pregunta7)
                                    X
                                @endif
                            </td>
                            <td style="width: 25px; border: rgb(0, 0, 0) 1px solid;">
                                @if ($posiciones_forzada->tarea->pregunta8)
                                    X
                                @endif
                            </td>
                            <td  style="width: 290px; text-align: left;">
                                    Flexión mantenida de dedos
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left">
                                @if ($posiciones_forzada->tarea->observacion_tarea != null)
                                    Otros: {{$posiciones_forzada->tarea->observacion_tarea }} 
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

            <!-- / Tipos de tarea -->
            @endif
        <!-- / Tarea -->
        <hr>
        <!-- Tabla -->
            @include('posiciones_forzadas.tabla_semiologia')
        <!-- / Tabla -->
        <hr>
        <!-- Dolor -->
            @if ($posiciones_forzada->dolor != null)
            <p class="subtitulo">Características del Dolor</p>
            <table class="letra11" style="width: 510px">
                <tbody>
                    <!-- Forma -->
                    <tr>
                        <td style="text-align: left; width: 255px">
                            <label for="">Por su forma de aparición:</label>
                            {{$posiciones_forzada->dolor->forma}}
                        </td>
                        <td style="text-align: left; width: 255px">
                            <label for=""> Por su evolución:  </label>
                            {{$posiciones_forzada->dolor->evolucion}}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 255px">
                           <label for=""> Puntos dolorosos:    </label> {{$posiciones_forzada->dolor->observacion1_d    }}
                        </td>
                        <td style="text-align: left; width: 255px">
                            <label for=""> Localización:         </label> {{$posiciones_forzada->dolor->observacion2_d    }} 
                         </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: left">
                            <label for="">Otros Signos y Síntomas Presentes en el Segmento Involucrado:</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2 style="text-align: left; width: 100px">
                            @if ($posiciones_forzada->dolor->pregunta1_d)
                                Calambres musculares.
                            @endif
                            @if ($posiciones_forzada->dolor->pregunta2_d)
                                Parestesias.
                            @endif
                            @if ($posiciones_forzada->dolor->pregunta3_d)
                                Calor.
                            @endif
                            @if ($posiciones_forzada->dolor->pregunta4_d)
                                Cambios de coloración de la piel.
                            @endif
                            @if ($posiciones_forzada->dolor->pregunta5_d)
                                Tumefacción.
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            @endif
        <!-- / Dolor -->
        <!-- <div style="page-break-after:always;"></div> -->
        <!-- Semiológica -->
            @if ($posiciones_forzada->semiologica != null)
                <p class="subtitulo">Caracterización Semiológica </p>
                <table class="tabla letra11" style="width: 510px">
                    <tbody>
                        <tr>
                            <td style="text-align: left; width: 100px">
                                Grado 0
                            </td>
                            <td style="text-align:centert; width: 25px">
                            @if ($posiciones_forzada->semiologica->grado == "Grado 0: Ausencia de signos y síntomas.")
                                x
                            @endif
                            </td>
                            <td style="text-align: left; width: 385px">
                                Ausencia de signos y síntomas     
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; width: 100px">
                                Grado 1
                            </td>
                            <td style="text-align: center; width: 25px">
                                @if ($posiciones_forzada->semiologica->grado == "Grado 1: Dolor en reposo y/o existencia de sintomatología sugestiva.")
                                x
                                @endif
                            </td>
                            <td style="text-align: left; width: 385px">
                                Dolor en reposo y/o existencia de sintomatologia sugestiva   
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; width: 100px">
                                Grado 2
                            </td>
                            <td style="text-align: center; width: 25px">
                                @if ($posiciones_forzada->semiologica->grado == "Grado 2: Grado 1 mas contractura y/o dolor a la movilización.")
                                x
                                @endif
                            </td>
                            <td style="text-align: left; width: 385px">
                                Grado 1 mas contrac tura y/o dolor a la movilizacion
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; width: 100px">
                                Grado 3
                            </td>
                            <td style="text-align: center; width: 25px">
                                @if ($posiciones_forzada->semiologica->grado == "Grado 3: Grado 2 mas dolor a la palpación y/o percusión.")
                                x
                                @endif
                            </td>
                            <td style="text-align: left; width: 385px">
                                Grado 2 mas dolor a la palpación y/o percusiòn
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; width: 100px">
                                Grado 4
                            </td>
                            <td style="text-align: center; width: 25px">
                                @if ($posiciones_forzada->semiologica->grado == "Grado 4: Grado 3 mas limitación funcional evidente clínicamente.")
                                x
                                @endif
                            </td>
                            <td style="text-align: left; width: 385px">
                                Grado 3 mas limitacion funcional evidente clinicamente
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Observación -->
                <div class="letra11" style="padding-top: 1%">
                    <label  for="">Observaciones:</label> {{$posiciones_forzada->semiologica->observacion1_s   }}
                </div>
            @endif
        <!-- / Semiológica -->
        <!-- <hr> -->
        <!-- FIRMAS -->
        <!-- <table class="table table-condensed table-hover" >
            <tr >
                <td style="width: 570px;text-align: right">
                    <div>
                        <img src="{{$posiciones_forzada->firma}}" width=130 height=130 alt="firma del paciente">
                    </div>
                    <label>Firma del Paciente</label>
                </td>
            </tr>
        </table> -->
        <!-- <br><br><br><br> -->
        
        <!-- <table class="table table-condensed table-hover" style="width: 100%;text-align: center">
            <tr >
                <td style="width: 50%;text-align: center">
                    <div>
                        <img src="" width=130 height=130 alt="firma del paciente">
                    </div>
                    <label>Firma del Pacientes</label>
                </td>
                <td style="width: 50%;text-align: center">
                    <div>
                        <img src="" width=130 height=130 alt="firma del medico">
                    </div>
                    <label>Firma y sello del medico examinador</label>
                </td>
            </tr>
        </table> -->
        <!-- FIRMAS -->
        <table class="table table-condensed table-hover" >
            <tr >
                <td style="width: 150px;text-align: center" colspan="6">
                    <div>
                        <img src="{{$declaracion_jurada->firma}}" height=130 alt="firma del paciente"><!-- style="border:solid 1px black" -->
                    </div>
                    <label style="font-weight: inherit;font-size: 12px;">Firma del Paciente</label>
                </td>
                <td style="width: 150px;text-align: center" colspan="6">
                    <div style="height:130px">
                        @if ($declaracion_jurada->personalClinica->foto)
                            <img src="{{public_path('imagenes/firmas/'.$declaracion_jurada->personalClinica->foto)}}"  height="130" alt="firma del médico">
                        @endif
                    </div>
                    <label style="font-weight: inherit;font-size: 12px;">Firma del Médico examinador</label>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
