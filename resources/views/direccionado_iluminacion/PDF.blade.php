<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @page {
            /* margin: 72px 25px 25px 30px; */
            margin: 3cm 2cm 2cm 2cm;
        }
        table{
          width: 100%;
        }
        td{ 
            border-bottom:  0.1px solid rgb(202, 202, 202);
            /* padding: 3px; */
            padding: 4.9px;
            font-size: 12px;
        }
        #tbl_tipo_tarea td{
            font-size: 11px;
        }
        label{
            font-weight: bold;
        }
        h3{
          margin-top:0;
        }
        header {
            position: fixed;
            top: -72px;
            left: 0;
            right: 0;
            height: 70px;

            /** Extra personal styles **/
            /*background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px;*/
        }
        /*main{
          margin-top: 20px;
        }*/
        footer {
          position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px;
        }
        #footer {
          position: fixed;
          left: 0;
          right: 0;
          /*color: #aaa;*/
          color: #4d4d4d;
          font-size: 0.7em;
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
        .letra9{
          font-size: 9px;
        }
    </style>
    <title>Iluminación Insuficiente</title>
</head>
<body>
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

    <header>
      <div style="text-align: right">
        <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
      </div>
    </header>
    
    <div id="content" class="container">

        <h3 class="titulo" style="text-align: center"> Agente: Iluminación Insuficiente <br> Cuestionario Direccionado </h3>

        <!-- Empresa -->
        <h2></h2>
        <table>
            <tbody>
                <tr>
                    <td class="datos" style="text-align: left; width: 135px"><!--  colspan="2" -->
                        <label for="">Fecha y hora:</label>
                        {{Carbon\Carbon::parse($iluminacion->created_at)->format('d/m/Y H:i') }}
                    </td>
                </tr>
                <!-- <tr>
                    <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;" colspan="3">Criterio de exposición al riesgo</td>
                </tr>
                <tr>
                    <td colspan="3">
                      Está orientado a trabajadores de minas o galerías subterráneas
                    </td>
                </tr> -->
                <!-- <tr>
                    <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;" colspan="2">Datos del trabajador</td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for=""> <u>Datos de la empresa o establecimiento:</u></label>
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 250px">
                       <label for=""> Nombre:</label>
                           {{$iluminacion->voucher->paciente->origen ? $iluminacion->voucher->paciente->origen->definicion : " " }}
                    </td>
                    <td class="datos" style="text-align: left; width: 250px">
                       <label for=""> CUIT:</label>
                           {{$iluminacion->voucher->paciente->origen ? $iluminacion->voucher->paciente->origen->cuit : " " }}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 250px">
                       <label for=""> Domicilio:</label>
                        @if ($iluminacion->voucher->paciente->origen)
                            @if ($iluminacion->voucher->paciente->origen->domicilio)
                                {{$iluminacion->voucher->paciente->origen->domicilio->direccion}}
                            @endif
                        @endif 
                    </td>
                </tr> -->
                <tr>
                    <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;" colspan="3">Datos de la empresa o establecimiento en donde se desempeña el trabajador</td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 190px">
                       <label for=""> Nombre:</label>
                           {{$iluminacion->voucher->paciente->origen ? $iluminacion->voucher->paciente->origen->definicion : " " }}
                    </td>
                    <td class="datos" style="text-align: left; width: 90px">
                       <label for=""> CUIT:</label>
                           {{$iluminacion->voucher->paciente->origen ? $iluminacion->voucher->paciente->origen->cuit : " " }}
                    </td>
                <!-- </tr>
                <tr> -->
                    <td class="datos" style="text-align: left; width: 230px">
                       <label for=""> Domicilio:</label>
                        @if ($iluminacion->voucher->paciente->origen)
                            @if ($iluminacion->voucher->paciente->origen->domicilio)
                                {{$iluminacion->voucher->paciente->origen->domicilio->direccion}}
                            @endif
                        @endif 
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Tabajador -->
        <!-- <hr> -->
        <table>
            <tbody>
                <tr>
                    <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;" colspan="3">Datos personales del trabajador</td>
                </tr>
                <!-- <tr>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for=""> <u>Datos personales:</u></label>
                    </td>
                </tr> -->
                <!-- <tr>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for=""> Nombre completo:</label>
                            {{$iluminacion->voucher->paciente->nombreCompleto()}}
                    </td>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for=""> CUIL/DNI N°:</label>
                            {{$iluminacion->voucher->paciente->cuil ?? number_format($iluminacion->voucher->paciente->documento,0,",",".")}}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for=""> Sexo:</label>
                            {{$iluminacion->voucher->paciente->sexo ? $iluminacion->voucher->paciente->sexo->definicion : " "}}  
                    </td>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for=""> Fecha de nacimiento:</label>
                            {{$iluminacion->voucher->paciente->fecha_nacimiento()}}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for=""> Puesto de trabajo:</label>
                            {{$iluminacion->puesto}}
                    </td>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for=""> Antigüedad en la empresa:</label>
                            {{$iluminacion->antiguedad}}años.
                    </td>
                </tr> -->
                <tr>
                    <td class="datos" style="text-align: left; width: 170px">
                        <label for=""> Nombre completo:</label>
                            {{$iluminacion->voucher->paciente->nombreCompleto()}}
                    </td>
                    <td class="datos" style="text-align: left; width: 170px">
                        <label for=""> CUIL/DNI N°:</label>
                            {{$iluminacion->voucher->paciente->cuil ?? number_format($iluminacion->voucher->paciente->documento,0,",",".")}}
                    </td>
                <!-- </tr>
                <tr> -->
                    <td class="datos" style="text-align: left; width: 170px">
                        <label for=""> Sexo:</label>
                            {{$iluminacion->voucher->paciente->sexo ? $iluminacion->voucher->paciente->sexo->definicion : " "}}  
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 170px">
                        <label for=""> Puesto de trabajo:</label>
                            {{$iluminacion->puesto}}
                    </td>
                    <td class="datos" style="text-align: left; width: 170px">
                        <label for=""> Antigüedad en la empresa:</label>
                            {{$iluminacion->antiguedad}}años.
                    </td>
                    <td class="datos" style="text-align: left; width: 170px">
                        <label for=""> Fecha de nacimiento:</label>
                            {{$iluminacion->voucher->paciente->fecha_nacimiento()}}
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Antecedentes -->
        <table>
            <tbody>
                <tr>
                    <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;">Antecedentes</td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 510px;border-bottom: solid 1px">
                        <label for=""> Antecedentes de enfermedades:</label> 
                        <!-- <p>{{$iluminacion->enfermedades}}</p> -->
                        {{$iluminacion->enfermedades}}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 510px;border-bottom: solid 1px">
                        <label for=""> Antecedentes de trastornos congénitos:</label> 
                        <!-- <p>{{$iluminacion->transtornos_congenitos}}</p> -->
                        {{$iluminacion->transtornos_congenitos}}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 510px">
                        <label for=""> Antecedentes de enfermedades profesionales o accidentes de trabajo:</label> 
                        <!-- <p>{{$iluminacion->enfermedades_profecionales}}</p> -->
                        {{$iluminacion->enfermedades_profecionales}}
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Exposición al riesgo -->
        <table>
            <tbody>
                <tr>
                    <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;">Exposición al riesgo</td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 510px;border-bottom: solid 1px">
                        <label for="">Exposición anterior: </label> {{$iluminacion->exposicion_anterior}}
                        <!-- <p>{{$iluminacion->exposicion_anterior}}</p> -->
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 510px">
                        <label for="">Exposición actual: </label> {{$iluminacion->exposicion_actual}}
                          Empresa: {{$iluminacion->exp_actual_empresa}},
                          actividad: {{$iluminacion->exp_actual_actividad}},
                          puesto: {{$iluminacion->exp_actual_puesto}},
                          antiguedad: {{$iluminacion->exp_actual_antiguedad}},
                          y horario: {{$iluminacion->exp_actual_horario}}
                        <!-- <p>{{$iluminacion->exposicion_actual}}</p> -->
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Salto de página -->
        <!-- <div style="page-break-after:always;"></div> -->
        <!-- Examen clínico -->
        <table>
            <tbody>
                <tr>
                    <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;" colspan="2">Examen clínico</td>
                </tr>
                <!-- <tr>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for=""> <u>Presencia de:</u></label>
                    </td>
                </tr> -->
                <tr>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for="">Cefaleas:</label>
                            {{$iluminacion->cefaleas}}
                    </td>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for="">Visión doble:</label>
                            {{$iluminacion->vision_doble}}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for="">Mareos / Vértigo:</label>
                            {{$iluminacion->mareo_vertigo}}
                    </td>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for="">Conjuntivitis:</label>
                            {{$iluminacion->conjuntivitis}}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for="">Visión borrosa:</label>
                            {{$iluminacion->vision_borrosa}}
                    </td>
                    <td class="datos" style="text-align: left; width: 250px">
                        <label for="">Presencia de inseguridad en posición de pie:</label>
                            {{$iluminacion->inseguridad_de_pie}}
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Examen ocular -->
        <table>
            <tbody>
                <tr>
                    <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;" colspan="3">Examen ocular</td>
                </tr>
                <!-- <tr>
                    <td class="datos" style="text-align: left;" colspan="3">
                        <label for=""> <u>Ojos:</u></label>
                    </td>
                </tr> -->
                <tr>
                    <td class="datos" style="text-align: left; width: 170px">
                        <label for="">Centrados:</label>
                            @if ($iluminacion->no_centrados)
                                No
                            @else
                                Si
                            @endif
                    </td>
                    <td class="datos" style="text-align: left; width: 170px">
                        <label for="">Pupilas:</label>
                            @if ($iluminacion->pupilas_anormales)
                                Anormal
                            @else
                                Normal
                            @endif
                    </td>
                    <td class="datos" style="text-align: left; width: 170px">
                        <label for="">Conjuntivas:</label>
                            @if ($iluminacion->conjuntivas_anormales)
                                Anormal
                            @else
                                Normal
                            @endif
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 170px">
                        <label for="">Córneas:</label>
                            @if ($iluminacion->corneas_anormales)
                                Anormal
                            @else
                                Normal
                            @endif
                    </td>
                <!-- </tr>
                <tr> -->
                    <td class="datos" style="text-align: left; width: 170px">
                        <label for="">Motilidad ocular:</label>
                            @if ($iluminacion->motilidad_anormal)
                                Anormal
                            @else
                                Normal
                            @endif
                    </td>
                    <td class="datos" style="text-align: left; width: 170px">
                        <label for="">Nistagmus:</label>
                            @if ($iluminacion->nistagmus_ausente)
                                Ausente
                            @else
                                Presente
                            @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="datos" style="text-align: left;">
                        <label for="">Informe:</label>
                        {{$iluminacion->informe_ocular}}
                        <!-- <hr> -->
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;" colspan="2">Agudeza visual</td>
                </tr>
                <!-- <tr>
                    <td class="datos" style="text-align: left; width: 250px" colspan="2">
                        <label for=""> <u>Agudeza visual:</u></label>
                    </td>
                </tr> -->
                <tr>
                    <td class="datos" style="text-align: left; width: 255px">
                        <label for="">Con correción:</label>
                        {{$iluminacion->av_correccion}}
                    </td>
                    <td class="datos" style="text-align: left; width: 255px">
                        <label for="">Sin correción:</label>
                        {{$iluminacion->av_sin_correccion}}
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            </tbody>
                <tr>
                <!-- </tr>
                <tr> -->
                    <td class="datos" style="text-align: left; width: 500px"><!--  colspan="2" -->
                        <label for="">Observaciones:</label>
                        {{$iluminacion->observaciones}}
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Firma -->
        <!-- <table class="table table-condensed table-hover" >
            <tr >
                <td style="width: 570px;text-align: right">
                    <div>
                        <img src="{{$iluminacion->firma}}" width=130 height=130 alt="firma del paciente">
                    </div>
                    <label>Firma del Paciente</label>
                </td>
            </tr>
        </table> -->
        <!-- FIRMAS -->
        <table class="table table-condensed table-hover" >
            <tr >
                <td style="width: 250px;text-align: center" colspan="6">
                    <div>
                        <img src="{{$declaracion_jurada->firma}}" height=130 alt="firma del paciente"><!-- style="border:solid 1px black" -->
                    </div>
                    <label style="font-weight: inherit;font-size: 12px;">Firma del Paciente</label>
                </td>
                <td style="width: 250px;text-align: center" colspan="6">
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