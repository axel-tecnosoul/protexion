<!DOCTYPE html>
<html lang="en" style='margin-top: 5px;margin-bottom: 5px'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .marco{
            border: rgb(0, 0, 0) 1px solid;
        }
        .tabla {
            border-collapse: collapse;
        }
        .tabla th, .tabla td {
            border: rgb(0, 0, 0) 1px solid;
        }
        .titulo{
            background-color: brown;
            color: white;
        }
        .subtitulo{
            font-weight: bold;
            text-decoration: underline;
            font-size: 10px;
        }
        .campos{
            font-size: 10px;
            font-weight: bold;
        }
        .datos{
            font-size: 10px;
        }
    </style>
    <title>AUDIOMETRÍA</title>
</head>
<body style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; margin: 0px">

    <div id="content" class="container">
        <div id="header" style="text-align: right; ">
            <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
        </div>
        <h3 class="titulo" style="text-align: center;margin-top:5px">ESTUDIO FUNCIONAL DE LA AUDICIÓN</h3>

        <p class="campos" >Fecha: {{ \Carbon\Carbon::parse($voucher->turno)->format('d/m/Y') }}</p>
        <!-- Datos precargados -->
        <p class="subtitulo">DATOS DE LA EMPRESA</p>
        <p class="datos"> <label class="campos" for="">Razón social:</label> {{$voucher->paciente->origen ? $voucher->paciente->origen->definicion : " "}} </p>

        <p class="subtitulo">DATOS DEL TRABAJADOR</p>

        <table class="datos">
            <tbody>
                <tr>
                    <td style="text-align: left; width: 350px">
                        <label class="campos" for="">Apellido y nombre:  </label> {{$voucher->paciente->nombreCompleto()}}
                    </td>
                    <td style="text-align: left; width: 350px">
                        <label class="campos" for="">Fecha Nacimiento:   </label>{{$voucher->paciente->fecha_nacimiento()}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 350px">
                        <label class="campos" for="">CUIL - DNI:  </label>{{$voucher->paciente->cuil ?? number_format($voucher->paciente->documento,0,",",".")}}
                    </td>
                    <td style="text-align: left; width: 350px">
                        <label class="campos" for="">Ambiente: </label> CABINA
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 350px">
                        <label class="campos" for="">Puesto de trabajo:</label> _________________________________________
                    </td>
                    <td style="text-align: left; width: 350px">
                        <label class="campos" for="">Antigüedad en la Empresa:</label> __________________________________
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 350px">
                        <label class="campos" for="">Audiómetro utilizado:</label> KAMPLEX
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- / Datos precargados -->
        <h3 class="titulo" style="text-align: center;margin-top:5px">ANTECEDENTES</h3>
        <table class="datos">
            <tbody>
                <tr>
                    <td style="text-align: left; width: 150px">
                        En su familia hay hipoacusicos:
                    </td>
                    <td style="text-align: right; width: 50px">
                       SI
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                          
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                       
                    </td>
                    <td  style="text-align: left; width: 50px">
                        NO
                    </td>
                    <td style="text-align: left; width: 50px">
                       ¿Quién?: _______________________________
                </tr>
                <tr>
                    <td style="text-align: left; width: 150px">
                        Nota disminución en la audición:
                    </td>
                    <td  style="text-align: right; width: 50px">
                       SI
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                          
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                       
                    </td>
                    <td style="text-align: left; width: 50px">
                        NO
                    </td>
                    <td style="text-align: left; width: 50px">
                       ¿Desde cuándo?: ________________________
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 150px">
                        Usa protectores auditivos:
                    </td>
                    <td  style="text-align: right; width: 50px">
                       SI
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                          
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                       
                    </td>
                    <td style="text-align: left; width: 50px">
                        NO
                    </td>
                    <td colspan="2" style="text-align: left; width: 50px">

                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 150px">
                        Se los provee la empresa:
                    </td>
                    <td  style="text-align: right; width: 50px">
                       SI
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                          
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                       
                    </td>
                    <td style="text-align: left; width: 50px">
                        NO
                    </td>
                    <td colspan="2" style="text-align: left; width: 50px">

                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 150px">
                        Trabajo con ruido anteriormente:
                    </td>
                    <td  style="text-align: right; width: 50px">
                       SI
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                          
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                       
                    </td>
                    <td style="text-align: left; width: 50px">
                        NO
                    </td>
                    <td colspan="2" style="text-align: left; width: 50px">

                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 150px">
                        ¿Tiene acufenos?:
                    </td>
                    <td  style="text-align: right; width: 50px">
                       SI
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                          
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                       
                    </td>
                    <td style="text-align: left; width: 50px">
                        NO
                    </td>
                    <td colspan="2" style="text-align: left; width: 50px">

                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 150px">
                        ¿En que oído?:
                    </td>
                    <td  style="text-align: right; width: 50px">
                       Izquierdo
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                          
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                       
                    </td>
                    <td style="text-align: left; width: 50px">
                        Derecho
                    </td>
                    <td style="text-align: right; width: 10px">
                        Ambos
                    </td>
                    <td class="marco"  style="text-align: right;width: 20px">
                        
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 150px">

                    </td>
                    <td  style="text-align: right; width: 50px">
                        No permanente
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                          
                    </td>
                    <td class="marco" style="text-align: left; width: 30px">
                       
                    </td>
                    <td style="text-align: left; width: 50px">
                        Permanente
                    </td>
                    <td style="text-align: right; width: 10px">
                      
                    </td>
                    <td class="marco"  style="text-align: right;width: 20px">
                        
                    </td>
                </tr>
            </tbody>
        </table>
        <h3 class="titulo" style="text-align: center;margin-top:5px">AUDIOGRAMA</h3>

        <div id="header" style="text-align:center">
            <img src="{{public_path('imagenes/TablaAudiograma.JPG')}}" width="700px">
        </div>

        <h3 class="titulo" style="text-align: center;margin-top:5px">CONCLUSIÓN</h3>

        <hr><br><hr><br><hr>

        <!-- <br><br><br><br> -->
        <!-- FIRMAS -->
        <!-- <table class="table table-condensed table-hover" style="width: 100%;text-align: center">
            <tr >
                <td style="width: 50%;text-align: center">
                    <div>
                        <img src="{{$voucher->firma}}" width=130 height=130 alt="firma del paciente">
                    </div>
                    <label>Firma del Paciente</label>
                </td>
                <td style="width: 50%;text-align: center">
                    <div>
                        <img src="{{$voucher->firma}}" width=130 height=130 alt="firma del medico">
                    </div>
                    <label>Firma y sello del medico examinador</label>
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
                    <label style="font-weight: inherit;font-size: 12px;">Firma y sello del medico examinador</label>
                </td>
            </tr>
        </table>
        <h3 class="titulo" style="text-align: center; font-size:10px">Telf. 03743 - 476272 - Av. San Martin 1400,Esquina Rivadavia - Puerto Rico - Misiones - gerencia@protexionpr.com.ar - www.protexionpr.com.ar</h3>
    </div>

</body>
</html>