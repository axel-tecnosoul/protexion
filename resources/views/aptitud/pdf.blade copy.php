<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Informe Final de Aptitud</title>
  <style>
    @page {
      margin: 72px 25px 25px 30px;
    }
    table{
      width: 100%;
    }
    td{
      border-bottom:  0.1px solid rgb(202, 202, 202);
      padding: 3px;
      font-size: 12px;
    }
    label{
      font-weight: bold;
    }
    h3{
      margin-top:0;
    }
    .hidden{
      display: none;
    }
    header {
      position: fixed;
      top: -72px;
      left: 0;
      right: 0;
      height: 70px;
    }
  </style>
</head>
<body>
<header>
    <div style="text-align: right">
      <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
      <!-- <span style="position: fixed; top: 0px; right: 0px;">{{Carbon\Carbon::parse($aptitud["fecha"])->format('d/m/Y') }}</span> -->
    </div>
  </header>
  <div id="content" class="container">
    <!-- <span style="position: fixed; top: 0px; right: 0px;"></span> -->
    <!-- <div id="header" style="text-align: right">
    </div> -->
    <h3 style="text-align: center">INFORME MEDICO LABORAL</h3>

    <table class="table table-condensed table-hover" >
      <tr style="text-align: left;">
        <td style=" width: 350px" colspan="6">
          <label>Fecha de realizacion:</label> {{Carbon\Carbon::parse($voucher->turno)->format('d/m/Y') }}
        </td>
        <td style=" width: 350px" colspan="6">
          <label>Fecha de impresion:</label> {{Carbon\Carbon::parse($aptitud["fecha"])->format('d/m/Y') }}
        </td>
      </tr>
    </table>

    <!-- DATOS DE EMPRESA -->
    <table class="table table-condensed table-hover" >
      <tr>
        <td style="text-align: center; background-color: brown; color: #FFFFFF" colspan="12">DATOS DE LA EMPRESA</td>
      </tr>
      <tr style="text-align: left;">
        <td style=" width: 350px" colspan="6">
          <label>Razón Social:</label> {{$voucher->paciente->origen ? $voucher->paciente->origen->definicion : " "}}
        </td>
        <td style=" width: 350px" colspan="6">
          <label>CUIT:</label> {{$voucher->paciente->origen ? $voucher->paciente->origen->cuit : " "}} 
        </td>
      </tr>
      <tr style="text-align: left;">
        <td style=" width: 350px" colspan="6">
          <label>Domicilio:</label> 
          @if ($voucher->paciente->origen)
            @if ($voucher->paciente->origen->domicilio)
              {{$voucher->paciente->origen->domicilio->direccion}}
            @endif
          @endif 
        </td>
        <td colspan="3"><label for="">Localidad:</label>
          @if ($voucher->paciente->origen)
            @if ($voucher->paciente->origen->domicilio)
              @if ($voucher->paciente->origen->domicilio->ciudad)
                {{$voucher->paciente->origen->domicilio->ciudad->nombre}}
              @endif
            @endif
          @endif 
        </td>
        <td colspan="3"><label for="">Provincia:</label> 
          @if ($voucher->paciente->origen)
            @if ($voucher->paciente->origen->domicilio)
              @if ($voucher->paciente->origen->domicilio->ciudad)
                @if ($voucher->paciente->origen->domicilio->ciudad->provincia)
                  {{$voucher->paciente->origen->domicilio->ciudad->provincia->nombre}}
                @endif
              @endif
            @endif
          @endif 
        </td>
      </tr>
    </table>

    <!-- DATOS DE TRABAJADOR -->
    <table class="table table-condensed table-hover" >
      <tr>
        <td style="text-align: center; background-color: brown; color: #FFFFFF" colspan="12">INFORME FINAL EXAMENES PREOCUPACIONALES</td>
      </tr>
      <tr style="text-align: left;">
        <td style=" width: 350px" colspan="6">
          <label>Apellidos y Nombres:</label> {{$voucher->paciente->nombreCompleto()}}
        </td>
        <td  colspan="3">
          <label>Edad:</label> {{$voucher->paciente->edad()}}
        </td>
        <td  colspan="3">
          <label>CUIL:</label> {{$voucher->paciente->cuil ?? number_format($voucher->paciente->documento,0,",",".")}}
        </td>
        <!-- <td  colspan="2">
          <label>Turno:</label> {{Carbon\Carbon::parse($voucher->turno)->format('d/m/Y') }}
        </td> -->
      </tr>
      <tr>
        <td style="text-align: center; background-color: brown; color: #FFFFFF" colspan="12">RESULTADO</td>
      </tr>
      <tr style="text-align: center;font-size: 22px;font-weight: bold;">
        <td style="font-size: 18px" class="text-center bold" colspan="12">
          {{$aptitud["aptitud_laboral"]}}
        </td>
      </tr>
    </table>

    <!-- PREEXISTENCIA Y OBSERVACIONES -->
    <table class="table table-condensed table-hover" >
      <tr>
        <td style="text-align: center; background-color: brown; color: #FFFFFF;width: 350px" colspan="6">PREEXISTENCIAS</td>
        <td style="text-align: center; background-color: brown; color: #FFFFFF;width: 350px" colspan="6">OBSERVACIONES</td>
      </tr>
      <tr>
        <td colspan="6" style="vertical-align: top;"> <?=nl2br($aptitud->preexistencias)?></td>
        <td colspan="6" style="vertical-align: top;"> <?=nl2br($aptitud->observaciones)?></td>
      </tr>
    </table>
    <!-- DECLARACION DE RIESGOS -->
    <table class="table table-condensed table-hover" >
      <tr>
        <td style="text-align: center; background-color: brown; color: #FFFFFF;width: 710px" colspan="12">DECLARACION DE RIESGOS</td>
      </tr><?php
      foreach ($riesgos as $riesgo) {
        if(in_array($riesgo->id,$voucher_riesgos)){?>
          <tr style="text-align: left;">
            <td colspan="11">{{$riesgo->riesgo}}</td>
            <td colspan="1"><label for="">Si</label></td>
          </tr><?php
        }
      }
      /*@for ($i = 0; $i < strlen($aptitud["riesgos"]); $i++)
          @if ($aptitud["riesgos"][$i] == "1")
              <tr style="text-align: left;">
                  <td colspan="11">
                      {{$riesgos[$i]}}
                  </td>
                  <td colspan="1">
                      <label for="">Si</label>
                  </td>
              </tr>
          @else
              <tr style="text-align: left;">
                  <td colspan="11">
                      {{$riesgos[$i]}}
                  </td>
                  <td colspan="1">
                      <label for="">No</label>
                  </td>
              </tr>
          @endif
      @endfor*/
      ?>
    </table>

    <!-- COMENTARIOS -->
    <table class="table table-condensed table-hover" >
      <tr>
        <td style="text-align: center; background-color: brown; color: #FFFFFF;width: 710px" colspan="12">COMENTARIOS SOBRE PATOLOGIAS NO RELACIONADAS CON EL TRABAJO</td>
      </tr>
      <tr>
        <td colspan="12">
          @if ($aptitud["comentarios"])
            {{$aptitud["comentarios"]}}
          @else
            Sin comentarios.
          @endif
        </td>
      </tr>
    </table>
    <!-- FIRMAS -->
    <table class="table table-condensed table-hover" >
        <tr >
            <td style="width: 350px;text-align: center" colspan="6">
                <div>
                    <img src="{{public_path('imagenes/firmas/firma Recalde chica.jpg')}}" height=130 alt="firma del paciente"><!-- style="border:solid 1px black" -->
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