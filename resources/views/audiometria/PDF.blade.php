<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>AUDIOMETRÍA</title>

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
</head>
<body style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">

    <div id="content" class="container">
        <div id="header" style="text-align: right">
            <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
        </div>
        <h3 class="titulo" style="text-align: center">ESTUDIO FUNCIONAL DE LA AUDICIÓN</h3>

        <p class="campos" >Fecha: _________/_________/_________</p>
        <!-- Datos precargados -->
        <p class="subtitulo">DATOS DE LA EMPRESA</p>
        <p class="datos"> <label class="campos" for="">Razón social:</label> {{$voucher->paciente->origen ? $voucher->paciente->origen->definicion : " "}} </p>

        <p class="subtitulo">DATOS DE LA TRABAJADOR</p>

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
                        <label class="campos" for="">CUIL-DNI:  </label>{{$voucher->paciente->cuil}}
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
                        <label class="campos" for="">Audiómetro utilizado:</label> KAMPLEK
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- / Datos precargados -->
        <h3 class="titulo" style="text-align: center">ANTECEDENTES</h3>
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
        <h3 class="titulo" style="text-align: center">AUDIOGRAMA</h3>

        <div id="header" style="text-align:center">
            <img src="{{public_path('imagenes/TablaAudiograma.JPG')}}" width="700px">
        </div>

        <h3 class="titulo" style="text-align: center">CONCLUSIÓN</h3>

        <br><hr><br><hr><br><hr>
        
    </div>

</body>
</html>