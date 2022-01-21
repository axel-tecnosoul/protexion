<!DOCTYPE html>
<html lang="en">
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
            font-weight: bold;
            text-decoration: underline;
            background-color: brown;
            color: white;
        }
        .subtitulo{
            font-weight: bold;
            text-decoration: underline;
            font-size: 12px;
        }
        .campos{
            font-size: 12px;
            font-weight: bold;
        }
        .datos{
            font-size: 12px;
        }
    </style>

    <title>ESPIROMETRIA</title>
</head>
<body style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">

    <div id="content" class="container">


        <div id="header" style="text-align: right">
            <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
        </div>
        <h3 class="titulo" style="text-align: center">ESTUDIO FUNCIONAL ESPIROMETRIA         </h3>

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
                        <label class="campos" for="">           Edad:</label> {{$voucher->paciente->edad()}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 350px">
                        <label class="campos" for="">           Peso:  </label>___________________________________
                    </td>
                    <td style="text-align: left; width: 350px">
                        <label class="campos" for="">           Altura:</label> ___________________________________
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 350px">
                        <label class="campos" for="">           Oximetría:  </label>_______________________________
                    </td>
                    <td style="text-align: left; width: 350px">
                        <label class="campos" for="">           Satura al</label> _______%
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 350px">
                        <label class="campos" for="">           Frecuencia Cardíaca:  </label> _______x´
                    </td>
                </tr>

            </tbody>
        </table>
        <hr>
        <h3 class="titulo" style="text-align: center">DECLARACION JURADA        </h3>
        <div id="header" style="text-align:center">
            <img src="{{public_path('imagenes/DJ _Espir.JPG')}}" width="650px">
        </div>
        <div id="header" style="text-align:center; padding-top: 7%">
            <img src="{{public_path('imagenes/Firma_esp.JPG')}}" width="650px">
        </div>
    </div>

</body>
</html>