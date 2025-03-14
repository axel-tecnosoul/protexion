<!DOCTYPE html>
<html lang="en" style='margin-top: 5px;margin-bottom: 5px'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Iluminación Insuficiente</title>

    <style>
        h1{
            font-weight: bold;
            font-size: 25px;
            /*padding-bottom: 20px;*/
        }
        h2{
            font-weight: bold;
            font-size: 12px;
            background-color: brown;
            color: white;
            text-align: center;
            margin-bottom:0;
        }
        h3{
            font-weight: bold;
            font-size: 12px;
        }
        label{
            font-weight: bold;
        }
        .datos{
            font-size: 12px;
        }
    </style>

</head>
<body style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">
    <div id="content" class="container">
        <div id="header" style="text-align: right">
            <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
        </div>
        <h1 class="titulo" style="text-align: center"> Agente: Iluminación Insuficiente <br> Cuestionario Direccionado </h1>
        
        <!-- Criterio -->
        <h2>Criterio de exposición al riesgo</h2>
        <p class="datos"> Está orientado a trabajadores de minas o galerías subterráneas </p>

        <!-- Empresa -->
        <h2>Datos del trabajador</h2>
        <table>
            <tbody>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                        <!-- <p><label for=""> <u>Datos de la empresa o establecimiento:</u></label> </p> -->
                        <label for=""> <u>Datos de la empresa o establecimiento:</u></label>
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                       <label for=""> Nombre:</label>
                           {{$iluminacion->voucher->paciente->origen ? $iluminacion->voucher->paciente->origen->definicion : " " }}
                    </td>
                    <td class="datos" style="text-align: left; width: 350px">
                       <label for=""> CUIT:</label>
                           {{$iluminacion->voucher->paciente->origen ? $iluminacion->voucher->paciente->origen->cuit : " " }}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
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
        <hr>
        <table>
            <tbody>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                        <!-- <p><label for=""> <u>Datos personales:</u></label> </p> -->
                        <label for=""> <u>Datos personales:</u></label>
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for=""> Nombre completo:</label>
                            {{$iluminacion->voucher->paciente->nombreCompleto()}}
                    </td>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for=""> CUIL/DNI N°:</label>
                            {{$iluminacion->voucher->paciente->cuil ?? number_format($iluminacion->voucher->paciente->documento,0,",",".")}}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for=""> Sexo:</label>
                            {{$iluminacion->voucher->paciente->sexo ? $iluminacion->voucher->paciente->sexo->definicion : " "}}  
                    </td>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for=""> Fecha de nacimiento:</label>
                            {{$iluminacion->voucher->paciente->fecha_nacimiento()}}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for=""> Puesto de trabajo:</label>
                            {{$iluminacion->puesto}}
                    </td>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for=""> Antigüedad en la empresa:</label>
                            {{$iluminacion->antiguedad}}años.
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Antecedentes -->
        <h2>Antecedentes</h2>
        <table>
            <tbody>
                <tr>
                    <td class="datos" style="text-align: left; width: 700px;border-bottom: solid 1px">
                        <label for=""> Antecedentes de enfermedades:</label> 
                        <p>{{$iluminacion->enfermedades}}</p>
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 700px;border-bottom: solid 1px">
                        <label for=""> Antecedentes de trastornos congénitos:</label> 
                        <p>{{$iluminacion->transtornos_congenitos}}</p>
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 700px">
                        <label for=""> Antecedentes de enfermedades profesionales o accidentes de trabajo:</label> 
                        <p>{{$iluminacion->enfermedades_profecionales}}</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Exposición al riesgo -->
        <h2>Exposición al riesgo</h2>
        <table>
            <tbody>
                <tr>
                    <td class="datos" style="text-align: left; width: 700px;border-bottom: solid 1px">
                        <label for="">Exposición anterior: </label> {{$iluminacion->exposicion_anterior}}
                        <!-- <p>{{$iluminacion->exposicion_anterior}}</p> -->
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 700px">
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
        <h2>Examen clínico</h2>
        <table>
            <tbody>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                        <!-- <p><label for=""> <u>Presencia de:</u></label></p> -->
                        <label for=""> <u>Presencia de:</u></label>
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for="">Cefaleas:</label>
                            {{$iluminacion->cefaleas}}
                    </td>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for="">Visión doble:</label>
                            {{$iluminacion->vision_doble}}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for="">Mareos / Vértigo:</label>
                            {{$iluminacion->mareo_vertigo}}
                    </td>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for="">Conjuntivitis:</label>
                            {{$iluminacion->conjuntivitis}}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for="">Visión borrosa:</label>
                            {{$iluminacion->vision_borrosa}}
                    </td>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for="">Presencia de inseguridad en posición de pie:</label>
                            {{$iluminacion->inseguridad_de_pie}}
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Examen ocular -->
        <h2>Examen ocular</h2>
        <table>
            <tbody>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                        <!-- <p><label for=""> <u>Ojos:</u></label></p> -->
                        <label for=""> <u>Ojos:</u></label>
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for="">Centrados:</label>
                            @if ($iluminacion->no_centrados)
                                No
                            @else
                                Si
                            @endif
                    </td>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for="">Pupilase:</label>
                            @if ($iluminacion->pupilas_anormales)
                                Anormal
                            @else
                                Normal
                            @endif
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for="">Conjuntivas:</label>
                            @if ($iluminacion->conjuntivas_anormales)
                                Anormal
                            @else
                                Normal
                            @endif
                    </td>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for="">Córneas:</label>
                            @if ($iluminacion->corneas_anormales)
                                Anormal
                            @else
                                Normal
                            @endif
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for="">Motilidad ocular:</label>
                            @if ($iluminacion->motilidad_anormal)
                                Anormal
                            @else
                                Normal
                            @endif
                    </td>
                    <td class="datos" style="text-align: left; width: 350px">
                        <label for="">Nistagmus:</label>
                            @if ($iluminacion->nistagmus_ausente)
                                Ausente
                            @else
                                Presente
                            @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="datos" style="text-align: left;">
                        <label for="">Informe:</label>
                        {{$iluminacion->informe_ocular}}
                        <hr>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td class="datos" style="text-align: left; width: 350px">
                        <!-- <p><label for=""> <u>Agudeza visual:</u></label></p> -->
                        <label for=""> <u>Agudeza visual:</u></label>
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 700px">
                        <label for="">Con correción:</label>
                        {{$iluminacion->av_correccion}}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 700px">
                        <label for="">Sin correción:</label>
                        {{$iluminacion->av_sin_correccion}}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 700px">
                        <label for="">Fecha y hora:</label>
                        {{Carbon\Carbon::parse($iluminacion->created_at)->format('d/m/Y H:i') }}
                    </td>
                </tr>
                <tr>
                    <td class="datos" style="text-align: left; width: 700px">
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
                <td style="width: 350px;text-align: center" colspan="6">
                    <div>
                        <img src="{{$declaracion_jurada->firma}}" height=130 alt="firma del paciente"><!-- style="border:solid 1px black" -->
                    </div>
                    <label style="font-weight: inherit;font-size: 12px;">Firma del Paciente</label>
                </td>
                <td style="width: 350px;text-align: center" colspan="6">
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