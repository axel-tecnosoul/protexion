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
            padding: 4.6px;
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
    <title>AUDIOMETRÍA</title>
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
        
        <!-- <h3 class="titulo" style="text-align: center;margin-top:5px">ESTUDIO FUNCIONAL DE LA AUDICIÓN</h3>

        <p class="campos" >Fecha: {{ \Carbon\Carbon::parse($voucher->turno)->format('d/m/Y') }}</p>
        <p class="subtitulo">DATOS DE LA EMPRESA</p>
        <p class="datos"> <label class="campos" for="">Razón social:</label> {{$voucher->origen ? $voucher->origen->definicion : " "}} </p>

        <p class="subtitulo">DATOS DEL TRABAJADOR</p> -->
        <table class="datos">
            <tbody>
                <tr>
                    <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;font-weight: bold;" colspan="3">ESTUDIO FUNCIONAL DE LA AUDICIÓN</td>
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
                    <td style="text-align: left; width: 120px">Fecha: {{ \Carbon\Carbon::parse($voucher->turno)->format('d/m/Y') }}</td>
                    <td style="text-align: right; width: 140px"><label>Razón social de la empresa: </label></td>
                    <td style="text-align: left; width: 240px">{{$voucher->origen ? $voucher->origen->definicion : " "}}</td>
                </tr>
            </tbody>
        </table>
        <table class="datos">
            <tbody>
                <tr>
                    <td colspan="3"><label class="label-bold"><u>DATOS DEL TRABAJADOR:</u></label></td>
                </tr>
                <!-- <tr>
                    <td colspan="2" style="text-align: left;">
                        <label class="campos" for="">Apellido y Nombre:  </label> {{$voucher->paciente->nombreCompleto()}}
                    </td>
                    <td style="text-align: left;">
                        <label class="campos" for="">Fecha Nacimiento:   </label>{{$voucher->paciente->fecha_nacimiento()}}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: left;">
                        <label class="campos" for="">CUIL - DNI:  </label><?php
                        if(empty($voucher->paciente->cuil)){
                          if(!empty($voucher->paciente->documento)){
                            echo number_format($voucher->paciente->documento,0,",",".");
                          }
                        }else{
                          echo $voucher->paciente->cuil;
                        }?>
                        
                    </td>
                    <td style="text-align: left;">
                        <label class="campos" for="">Ambiente: </label> CABINA
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: left;">
                        <label class="campos" for="">Puesto de trabajo:</label>
                    </td>
                    <td style="text-align: left;">
                        <label class="campos" for="">Antigüedad en la Empresa:</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: left;">
                        <label class="campos" for="">Audiómetro utilizado:</label> KAMPLEX
                    </td>
                </tr> -->
                <tr>
                    <td style="text-align: left;">
                        <label class="campos" for="">Apellido y Nombre:  </label> {{$voucher->paciente->nombreCompleto()}}
                    </td>
                    <td style="text-align: left;">
                        <label class="campos" for="">Fecha Nacimiento:   </label>{{$voucher->paciente->fecha_nacimiento()}}
                    </td>
                    <td style="text-align: left;">
                        <label class="campos" for="">CUIL - DNI:  </label><?php
                        if(empty($voucher->paciente->cuil)){
                          if(!empty($voucher->paciente->documento)){
                            echo number_format($voucher->paciente->documento,0,",",".");
                          }
                        }else{
                          echo $voucher->paciente->cuil;
                        }?>
                        
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        <label class="campos" for="">Antigüedad:</label>
                    </td>
                    <td style="text-align: left;">
                        <label class="campos" for="">Audiómetro:</label> KAMPLEX
                    </td>
                    <td style="text-align: left;">
                        <label class="campos" for="">Ambiente: </label> CABINA
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- / Datos precargados -->
        <!-- <h3 class="titulo" style="text-align: center;margin-top:5px">ANTECEDENTES</h3> -->
        <!-- <table class="datos" style="width: 643px;">
            <tbody>
                <tr>
                    <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;" colspan="8">ANTECEDENTES</td>
                </tr>
            </tbody>
        </table> -->
        <table class="datos" style="width: 643px;">
            <tbody>
                <tr>
                    <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;font-weight: bold;" colspan="8">ANTECEDENTES</td>
                </tr>
                <tr>
                    <!-- <td style="text-align: left; width: 100px">En su familia hay hipoacusicos:</td>
                    <td style="text-align: right; width: 50px">SI</td>
                    <td style="text-align: left; width: 30px" class="marco" ></td>
                    <td style="text-align: left; width: 30px" class="marco" ></td>
                    <td style="text-align: left; width: 50px">NO</td>
                    <td style="text-align: left; width: 90px" colspan="3">¿Quién?:</td> -->
                    <td style="text-align: left; width: 170px">En su familia hay hipoacusicos:</td>
                    <td style="text-align: right; width: 90px">SI</td>
                    <td style="text-align: left; width: 30px" class="marco"> </td>
                    <td style="text-align: left; width: 30px" class="marco"> </td>
                    <td style="text-align: left; width: 90px">NO</td>
                    <td style="text-align: left; width: 153px" colspan="3">¿Quién?:</td>
                </tr>
                <tr>
                    <td style="text-align: left;">Nota disminución en la audición:</td>
                    <td style="text-align: right;">SI</td>
                    <td style="text-align: left;" class="marco"></td>
                    <td style="text-align: left;" class="marco"></td>
                    <td style="text-align: left;">NO</td>
                    <td style="text-align: left;" colspan="3" >¿Desde cuándo?:</td>
                </tr>
                <tr>
                    <td style="text-align: left;">Usa protectores auditivos:</td>
                    <td style="text-align: right;">SI</td>
                    <td style="text-align: left;" class="marco"></td>
                    <td style="text-align: left;" class="marco"></td>
                    <td style="text-align: left;">NO</td>
                    <td style="text-align: left;" colspan="3" ></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Se los provee la empresa:</td>
                    <td style="text-align: right;">SI</td>
                    <td style="text-align: left;" class="marco"></td>
                    <td style="text-align: left;" class="marco"></td>
                    <td style="text-align: left;">NO</td>
                    <td style="text-align: left;" colspan="3" ></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Trabajo con ruido anteriormente:</td>
                    <td style="text-align: right;">SI</td>
                    <td style="text-align: left;" class="marco"></td>
                    <td style="text-align: left;" class="marco"></td>
                    <td style="text-align: left;">NO</td>
                    <td style="text-align: left;" colspan="3" ></td>
                </tr>
                <tr>
                    <td style="text-align: left;">¿Tiene acufenos?:</td>
                    <td style="text-align: right;">SI</td>
                    <td style="text-align: left;" class="marco"></td>
                    <td style="text-align: left;" class="marco"></td>
                    <td style="text-align: left;">NO</td>
                    <td style="text-align: left;" colspan="3" ></td>
                </tr>
                <tr>
                    <td style="text-align: left;">¿En que oído?:</td>
                    <td style="text-align: right;">Izquierdo</td>
                    <td style="text-align: left;" class="marco"></td>
                    <td style="text-align: left;" class="marco"></td>
                    <td style="text-align: left;">Derecho</td>
                    <td style="text-align: right;">Ambos</td>
                    <td style="text-align: left; width: 30px" class="marco"> </td>
                    <td> </td>
                </tr>
                <tr>
                    <td style="text-align: left;"></td>
                    <td style="text-align: right;">No permanente</td>
                    <td style="text-align: left;" class="marco"></td>
                    <td style="text-align: left;" class="marco"></td>
                    <td style="text-align: left;">Permanente</td>
                    <td style="text-align: right;" colspan="3" ></td>
                </tr>
            </tbody>
        </table>
        <!-- <h3 class="titulo" style="text-align: center;margin-top:5px">AUDIOGRAMA</h3> -->
        <table style="margin-bottom: 0;">
          <tbody>
              <tr>
                  <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;font-weight: bold;">AUDIOGRAMA</td>
              </tr>
              <tr>
                  <td style="text-align: center;">
                      <img src="{{public_path('imagenes/TablaAudiograma.png')}}" width="605px">
                  </td>
              </tr>
              <tr>
                  <td style="text-align: center; background-color: brown; color: #FFFFFF;text-transform: uppercase;margin-bottom: 0;font-weight: bold;">CONCLUSIÓN</td>
              </tr>
          </tbody>
        </table>

        <!-- <div id="header" style="text-align:center">
            
        </div>

        <h3 class="titulo" style="text-align: center;margin-top:5px">CONCLUSIÓN</h3> -->


        <br><hr><br><hr>

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
                <td style="width: 250px;text-align: center" colspan="6">
                    <div style="height:130px">
                        @if ($declaracion_jurada)
                          <img src="{{$declaracion_jurada->firma}}" height=130 alt="firma del paciente"><!-- style="border:solid 1px black" -->
                        @endif
                    </div>
                    <label style="font-weight: inherit;font-size: 12px;">Firma del Paciente</label>
                </td>
                <td style="width: 250px;text-align: center" colspan="6">
                    <div style="height:130px">
                        <!-- @if ($declaracion_jurada)
                            <img src="{{public_path('imagenes/firmas/'.$declaracion_jurada->personalClinica->foto)}}"  height="130" alt="firma del médico">
                        @endif -->
                    </div>
                    <label style="font-weight: inherit;font-size: 12px;">Firma y sello del medico examinador</label>
                </td>
            </tr>
        </table>
        <!-- <h3 class="titulo" style="text-align: center; font-size:10px">Telf. 03743 - 476272 - Av. San Martin 1400,Esquina Rivadavia - Puerto Rico - Misiones - gerencia@protexionpr.com.ar - www.protexionpr.com.ar</h3> -->
    </div>

</body>
</html>