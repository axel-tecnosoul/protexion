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
            padding: 5px;
            font-size: 12px;
        }
        #tbl_tipo_tarea td{
            font-size: 11px;
        }
        /*label{
            font-weight: bold;
        }*/
        .label-bold{
            font-weight: bold;
        }
        h3{
          margin-top:0;
        }
        .marco{
            border: rgb(0, 0, 0) 1px solid;
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
        hr{
          margin-top: 0;
          margin-bottom: 0;
        }
    </style>

    <title>ESPIROMETRIA</title>
</head>
<body>

    <div id="footer">
      <!-- <div class="page-number"></div> -->
      <span>
        PROTEXIÓN "CENTRO MÉDICO LABORAL"<br>
        Av. José M. de Estrada 1400 esquina Av. Pres. Raúl Alfonsín- Puerto Rico,  Misiones - CP 3334
        <!-- <br> --><br>
        Tel. (03743) 476272 - Whatsapp: (03743) 483004.
        E-mail: info@protexionpr.com.ar; gerencia@protexionpr.com.ar<br>
      </span>
    </div>

    <header>
      <div style="text-align: right">
        <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
      </div>
    </header>

    <div id="content" class="container">

        <!-- <h3 class="titulo" style="text-align: center">ESTUDIO FUNCIONAL ESPIROMETRIA         </h3>

        <p class="campos" >Fecha: _________/_________/_________</p>
        <p class="subtitulo">DATOS DE LA EMPRESA</p>
        <p class="datos"> <label class="campos" for="">Razón social:</label> {{$voucher->origen ? $voucher->origen->definicion : " "}} </p>

        <p class="subtitulo">DATOS DEL TRABAJADOR</p> -->

        <table class="datos">
            <tbody>
                <tr>
                    <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;font-weight: bold;" colspan="3">ESTUDIO FUNCIONAL ESPIROMETRIA</td>
                </tr>
                <!-- <tr>
                    <td colspan="2">Fecha: {{ \Carbon\Carbon::parse($voucher->turno)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td colspan="2"><label class="label-bold"><u>DATOS DE LA EMPRESA</u></label></td>
                </tr>
                <tr>
                    <td colspan="2">
                      <label class="campos" for="">Razón social:</label> {{$voucher->origen ? $voucher->origen->definicion : " "}}
                    </td>
                </tr> -->
                <tr>
                    <td style="text-align: left; width: 130px">
                      Fecha: {{ \Carbon\Carbon::parse($voucher->turno)->format('d/m/Y') }}
                      <!-- Fecha: ______/______/______ -->
                    </td>
                    <td style="text-align: right; width: 130px"><label>Razón social de la empresa: </label></td>
                    <td style="text-align: left; width: 240px">{{$voucher->origen ? $voucher->origen->definicion : " "}}</td>
                </tr>
                <tr>
                    <td colspan="3"><label class="label-bold"><u>DATOS DEL TRABAJADOR:</u></label></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: left;">
                        <label class="campos" for="">Apellido y nombre:  </label> {{$voucher->paciente->nombreCompleto()}}
                    </td>
                    <td style="text-align: left;">
                        <label class="campos" for="">Fecha Nacimiento:   </label>{{$voucher->paciente->fecha_nacimiento()}}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: left;">
                        <label class="campos" for="">CUIL-DNI:  </label>{{$voucher->paciente->cuil ?? number_format($voucher->paciente->documento,0,",",".")}}
                    </td>
                    <td style="text-align: left;">
                        <label class="campos" for="">           Edad:</label> {{$voucher->paciente->edad()}}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: left;">
                        <label class="campos" for="">           Peso:  </label>
                    </td>
                    <td style="text-align: left;">
                        <label class="campos" for="">           Altura:</label> 
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: left;">
                        <label class="campos" for="">           Oximetría: Satura al </label> _______%
                    </td>
                    <td style="text-align: left;">
                        <label class="campos" for="">           Frecuencia Cardíaca:  </label> _______x´</label>
                    </td>
                </tr>
                <!-- <tr>
                    <td colspan="3" style="text-align: left;">
                        <label class="campos" for="">           
                    </td>
                </tr> -->

            </tbody>
        </table>

        <table class="datos">
            <tbody>
                <tr>
                    <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;font-weight: bold;">DECLARACION JURADA</td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <img src="{{public_path('imagenes/DJ _Espir.JPG')}}" width="600px">
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- FIRMAS -->
        <table class="table" >
            <tr >
                <td style="width: 350px;text-align: center" colspan="6">
                    <div style="height:130px">
                        @if ($declaracion_jurada)
                            <img src="{{$declaracion_jurada->firma}}" height=130 alt="firma del paciente"><!-- style="border:solid 1px black" -->
                        @endif
                    </div>
                    <label style="font-weight: inherit;font-size: 12px;">Firma del Paciente</label>
                </td>
                <td style="width: 350px;text-align: center;" colspan="6">
                    <div style="height:130px">
                        @if ($declaracion_jurada)
                            @if ($declaracion_jurada->personalClinica->foto)
                                <img src="{{public_path('imagenes/firmas/'.$declaracion_jurada->personalClinica->foto)}}"  height="130" alt="firma del médico">
                            @endif
                        @endif
                    </div>
                    <label style="font-weight: inherit;font-size: 12px;">Firma del Médico</label>
                </td>
            </tr>
        </table>
        <!-- <div style="text-align: center;border-top: solid 1px black;position:fixed;bottom:50px;font-size:10px">
            PROTEXIÓN "CENTRO MÉDICO LABORAL"<br>
            Av. San Martin 1400, Esquina Rivadavia  - Puerto Rico Misiones - CP 3334<br>
            Tel. (03743) 476272<br>
            E-mail: info@protexionpr.com.ar; gerencia@protexionpr.com.ar<br>
        </div> -->
    </div>

</body>
</html>