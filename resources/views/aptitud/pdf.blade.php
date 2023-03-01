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
        #resultado{
          /*background-color:#ffff0080;*/
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
        .fila_riesgos{
          padding-top: 0;
          /*border-bottom: 0;*/
        }
        #tablaConFoto tr td{
          padding: 2px;
        }
    </style>
    <title>Informe Final de Aptitud</title>
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
      <!-- <span style="position: fixed; top: 0px; right: 0px;"></span> -->
      <!-- <div id="header" style="text-align: right">
      </div> -->
      <h3 style="text-align: center">INFORME MEDICO LABORAL</h3>

      <table class="table table-condensed table-hover" >
        <tr style="text-align: left;">
          <td style=" width: 250px" colspan="6">
            <label>Fecha de realizacion:</label> {{Carbon\Carbon::parse($voucher->turno)->format('d/m/Y') }}
          </td>
          <td style=" width: 250px" colspan="6">
            <label>Fecha de impresion:</label> {{Carbon\Carbon::parse($aptitud["fecha"])->format('d/m/Y') }}
          </td>
        </tr>
      </table>

      <!-- DATOS DE EMPRESA -->
      <table class="table table-condensed table-hover" id="tablaConFoto" >
        <tr>
          <td style="text-align: center; background-color: brown; color: #FFFFFF; width:400px;padding:4.9px" colspan="12">DATOS DE LA EMPRESA Y DEL PACIENTE</td>
        </tr>
        <tr style="text-align: left">
          <td style="width: 150px;" colspan="11">
            <label>Razón Social:</label> {{$voucher->paciente->origen ? $voucher->paciente->origen->definicion : " "}}
          </td>
          <td style="text-align: center; width:200px" rowspan="5"><?php
              if($voucher->paciente->imagen){
                $nombreImagen = 'imagenes/paciente/'.$voucher->paciente->imagen;
                //$nombreImagen = '../../../public/imagenes/paciente/'.$voucher->paciente->imagen;
                //$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));?>
                <img src="<?=$nombreImagen?>" width="200px" style="margin:0" alt="User Image"><?php
              }?>
          </td>
        </tr>
        <tr style="text-align: left">
          <td style=" width: 150px" colspan="11">
            <label>CUIT:</label> {{$voucher->paciente->origen ? $voucher->paciente->origen->cuit : " "}} 
          </td>
        </tr>
        <tr style="text-align: left">
          <td style=" width: 300px" colspan="11">
            <label>Domicilio:</label> <?php
            if ($voucher->paciente->origen){
              if ($voucher->paciente->origen->domicilio){
                echo $voucher->paciente->origen->domicilio->direccion;
                if ($voucher->paciente->origen->domicilio->ciudad){
                  echo ", ".$voucher->paciente->origen->domicilio->ciudad->nombre;
                  if ($voucher->paciente->origen->domicilio->ciudad->provincia){
                    echo ", ".$voucher->paciente->origen->domicilio->ciudad->provincia->nombre;
                  }
                }
              }
            }?>
          </td>
        </tr>
        <!-- DATOS DE TRABAJADOR -->
        <!-- <tr>
          <td style="text-align: center; background-color: brown; color: #FFFFFF" colspan="11">INFORME FINAL EXAMENES PREOCUPACIONALES</td>
        </tr> -->
        <tr style="text-align: left;">
          <td style="width: 150px" colspan="8">
            <label>Apellidos y Nombres:</label> {{$voucher->paciente->nombreCompleto()}}
          </td>
          <td style="width: 75px" colspan="3">
            <label>Edad:</label> {{$voucher->paciente->edad()}} años
          </td>
        </tr>
        <tr style="text-align: left;">
          <td style="width: 75px" colspan="11">
            <label>CUIL:</label> {{$voucher->paciente->cuil ?? number_format($voucher->paciente->documento,0,",",".")}}
          </td>
        </tr>
      </table>

      <!-- RESULTADO -->
      <table class="table table-condensed table-hover" >
        <tr>
          <td style="text-align: center; background-color: brown; color: #FFFFFF" colspan="12">RESULTADO</td>
        </tr>
        <tr style="text-align: center;font-size: 22px;font-weight: bold;">
          <td id="resultado" style="font-size: 18px;" class="text-center bold" colspan="12">
            {{$aptitud["aptitud_laboral"]}}
          </td>
        </tr>
      </table>

      <!-- PREEXISTENCIA Y OBSERVACIONES -->
      <table class="table table-condensed table-hover" >
        <tr>
          <td colspan="2" style="text-align: center; background-color: brown; color: #FFFFFF;">PREEXISTENCIAS</td>
        </tr>
        <tr>
          <td colspan="2" style="vertical-align: top;"><?php
          if($aptitud->preexistencias){
            echo nl2br($aptitud->preexistencias);
          }else{
            echo "No registra preexistencias";
          }?></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center; background-color: brown; color: #FFFFFF;">OBSERVACIONES</td>
        </tr>
        <tr><?php
          $aObs=explode("\r\n",$aptitud->observaciones);
          $cant_total=count($aObs);
          if($cant_total>7){
            $cant_x_col=ceil($cant_total/2);
            $newArObs=array_chunk($aObs, $cant_x_col);
            $width_col1=50;
          }else{
            $newArObs=[
              0=>$aObs,
              1=>[]
            ];
            $width_col1=100;
          }?>
          <td style="vertical-align: top;width:<?=$width_col1?>%;"><?=implode("<br>",$newArObs[0])?></td>
          <td style="vertical-align: top;"><?php
            if(isset($newArObs[1][0]) and $newArObs[1][0]=="") unset($newArObs[1][0]);
            echo implode("<br>",$newArObs[1])?>
          </td>
        </tr>
      </table>
      <!-- DECLARACION DE RIESGOS -->
      <table class="table table-condensed table-hover" >
        <tr>
          <td style="text-align: center; background-color: brown; color: #FFFFFF;width: 510px" colspan="12">DECLARACION DE RIESGOS</td>
        </tr><?php
        $cant_riesgos=count($voucher_riesgos);
        if($cant_riesgos>3){
          $aRiesgos=$riesgos->toArray();
          $auxRiesgos=[];
          $mitad=ceil($cant_riesgos/2);
          //var_dump($mitad);
          //var_dump($voucher_riesgos);
          for($i=0;$i<count($aRiesgos);$i++) {
            //echo "<label>".$aRiesgos[$i]["riesgo"]."</label><br>";
            if(in_array($aRiesgos[$i]["id"],$voucher_riesgos)){
              $auxRiesgos[]=$aRiesgos[$i]["riesgo"];
            }
          }
          //var_dump($auxRiesgos);
          //for($i=0;$i<count($auxRiesgos);$i+=2) {
          for($i=0;$i<$mitad;$i++) {?>
            <tr style="text-align: left;">
              <td class="fila_riesgos" style="vertical-align: top;" colspan="6"><?=$auxRiesgos[$i]?></td>
              <td class="fila_riesgos" style="vertical-align: top;" colspan="6"><?php
              $i2=$i+$mitad;
              if(isset($auxRiesgos[$i2])){
                echo $auxRiesgos[$i2];
              }?></td>
            </tr><?php
          }
        }else{
            foreach ($riesgos as $riesgo) {
              if(in_array($riesgo->id,$voucher_riesgos)){?>
                  <tr style="text-align: left;">
                    <td class="fila_riesgos" colspan="11">{{$riesgo->riesgo}}</td>
                  </tr><?php
              }
            }
        }
        ?>
      </table>

      <!-- COMENTARIOS -->
      <table class="table table-condensed table-hover" >
        <tr>
          <td style="text-align: center; background-color: brown; color: #FFFFFF;width: 510px" colspan="12">COMENTARIOS SOBRE PATOLOGIAS NO RELACIONADAS CON EL TRABAJO</td>
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
              <td style="width: 250px;text-align: center" colspan="6">
                  <div>
                      <img src="{{public_path('imagenes/firmas/firma Recalde chica.jpg')}}" height=130 alt="firma del paciente"><!-- style="border:solid 1px black" -->
                      <!-- <img src="../../../public/imagenes/firmas/firma Recalde chica.jpg" height=130 alt="firma del paciente"> -->
                  </div>
                  <!-- <label style="font-weight: inherit;font-size: 12px;">Firma del Paciente</label> -->
              </td>
              <td style="width: 250px;text-align: center" colspan="6">
                  <div style="height:130px">
                      @if ($declaracion_jurada->personalClinica->foto)
                          <img src="{{public_path('imagenes/firmas/'.$declaracion_jurada->personalClinica->foto)}}"  height="130" alt="firma del médico">
                      @endif
                  </div>
                  <!-- <label style="font-weight: inherit;font-size: 12px;">Firma del Médico examinador</label> -->
              </td>
          </tr>
      </table>
    </div>
</body>
</html>