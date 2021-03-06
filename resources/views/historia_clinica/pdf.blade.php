<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    </style>
    <title>Formulario de Historia Clinica</title>
</head>
<body>
  <header>
    <div style="text-align: right">
      <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
    </div>
  </header>
  
    <div id="content" class="container">
      <h3 style="text-align: center;">HISTORIA CLINICA</h3>
      <!-- DATOS EMPRESA -->
      <table class="table table-condensed table-hover" >
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF" colspan="12">DATOS DE LA EMPRESA</td>
          </tr>
          <tr style="text-align: left;">
              <td style=" width: 350px" colspan="6">
                  <label>Razón Social:</label> {{$hc_formulario->voucher->paciente->origen ? $hc_formulario->voucher->paciente->origen->definicion : " "}}
              </td>
              <td style=" width: 350px" colspan="6">
                  <label>CUIT:</label> {{$hc_formulario->voucher->paciente->origen ? $hc_formulario->voucher->paciente->origen->cuit : " "}} 
              </td>
          </tr>
          <tr style="text-align: left;">
              <td style=" width: 350px" colspan="6">
                  <label>Domicilio:</label> 
                  @if ($hc_formulario->voucher->paciente->origen)
                      @if ($hc_formulario->voucher->paciente->origen->domicilio)
                          {{$hc_formulario->voucher->paciente->origen->domicilio->direccion}}
                      @endif
                  @endif 
              </td>
              <td style=" width: 350px" colspan="6"></td>
          </tr>
      </table>
      <!-- DATOS DEL TRABAJADOR -->
      <table class="table table-condensed table-hover" >
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF" colspan="12">DATOS DEL TRABAJADOR</td>
          </tr>
          <tr style="text-align: left;">
              <td style=" width: 350px" colspan="6">
                  <label>Apellidos y Nombres:</label> {{$hc_formulario->voucher->paciente->nombreCompleto()}}
              </td>
              <td style=" width: 350px" colspan="6">
                  <label>Fecha de nacimiento:</label> {{Carbon\Carbon::parse($hc_formulario->voucher->paciente->fecha_nacimiento)->format('d/m/Y') }} ({{Carbon\Carbon::parse($hc_formulario->voucher->paciente->fecha_nacimiento)->age }} años)
              </td>
          </tr>
          <tr style="text-align: left;">
              <td style=" width: 350px" colspan="6">
                  <label>CUIL:</label> {{$hc_formulario->voucher->paciente->cuil ?? number_format($hc_formulario->voucher->paciente->documento,0,",",".")}}
              </td>
              <td style=" width: 350px" colspan="6">
                  <label>Sexo:</label> {{$hc_formulario->voucher->paciente->sexo ? $hc_formulario->voucher->paciente->sexo->definicion : " " }}
              </td>
          </tr>
      </table>
      <!-- EXAMEN CLÌNICO -->
      <table class="table table-condensed table-hover" >
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">EXAMEN CLÍNICO</td>
          </tr>
          <tr style="text-align: left;">
              <td colspan="3">
                  <label for="">Estatura (Metros):</label> {{$hc_formulario->examenClinico->estatura}}
              </td>
              <td colspan="3">
                  <label for="">Peso (Kg):</label> {{$hc_formulario->examenClinico->peso}}
              </td>
              <td colspan="3">
                  <label for="">Sobrepeso:</label>
                  @if ($hc_formulario->examenClinico->sobrepeso==true)
                      Si
                  @else
                      No
                  @endif
              </td>
              <td colspan="3">
                  <label for="">IMC:</label> {{$hc_formulario->examenClinico->imc}}1
              </td>
          </tr>
          <tr>
              <td colspan="12">
                  <label for="">Medicación Act.:</label> <!--{{$hc_formulario->examenClinico->medicacion_actual}}-->
                  @if ($hc_formulario->examenClinico->medicacion_actual)
                      {{$hc_formulario->examenClinico->medicacion_actual}}
                  @else
                      No Posee
                  @endif
                  
              </td>
          </tr>
      </table>
      <!-- CARDIOVASCULAR -->
      <table class="table table-condensed table-hover" >
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">CARDIOVASCULAR</td>
          </tr>
          <tr style="text-align: left;">
              <td colspan="12">
                  <label for="">Frecuencia Cardíaca:</label> {{$hc_formulario->cardiovascular->frecuencia_cardiaca}} x'
              </td>
          </tr>
          <tr style="text-align: left;">
              <td colspan="8">
                  <!-- <label for="">Tensión Arterial:</label> {{$hc_formulario->cardiovascular->tension_arterial}} -->
                  <label for="">Tensión Arterial:</label> {{$hc_formulario->cardiovascular->sistolica}} / {{$hc_formulario->cardiovascular->diastolica}}
              </td>
              <td colspan="4"></td>
              <!-- <td colspan="2">
                  <label for="">Sistolica:</label> {{$hc_formulario->cardiovascular->sistolica}}
              </td>
              <td colspan="2">
                  <label for="">Diastolica:</label> {{$hc_formulario->cardiovascular->diastolica}}
              </td> -->
          </tr>
          <tr style="text-align: left;">
              <td colspan="6">
                  <label for="">Várices:</label> <!--{{$hc_formulario->cardiovascular->observacion_varices}} -->
                  @if ($hc_formulario->cardiovascular->observacion_varices)
                      {{$hc_formulario->cardiovascular->observacion_varices}}
                  @else
                      No
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Pulso:</label> <!--{{$hc_formulario->cardiovascular->pulso}}-->
                  @if ($hc_formulario->cardiovascular->pulso == "A")
                      Anormal
                  @else
                      Normal
                  @endif
              </td>
          </tr>
      </table>
      <!-- PIEL-->
      <table class="table table-condensed table-hover" >
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">PIEL</td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Cicatrices patológicas visibles:</label> <!--{{$hc_formulario->piel->observacion1_piel}}-->
                  @if ($hc_formulario->piel->observacion1_piel)
                      {{$hc_formulario->piel->observacion1_piel}}
                  @else
                      No
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Vesículas:</label> <!--{{$hc_formulario->piel->obs_vesicula}}-->
                  @if ($hc_formulario->piel->obs_vesicula)
                      {{$hc_formulario->piel->obs_vesicula}}
                  @else
                      No
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Úlceras:</label> <!--{{$hc_formulario->piel->obs_ulceras}}-->
                  @if ($hc_formulario->piel->obs_ulceras)
                      {{$hc_formulario->piel->obs_ulceras}}
                  @else
                      No
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Fisuras:</label> <!--{{$hc_formulario->piel->obs_fisuras}} -->
                  @if ($hc_formulario->piel->obs_fisuras)
                      {{$hc_formulario->piel->obs_fisuras}}
                  @else
                      No
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Prurito:</label> <!--{{$hc_formulario->piel->obs_prurito}}-->
                  @if ($hc_formulario->piel->obs_prurito)
                      {{$hc_formulario->piel->obs_prurito}}
                  @else
                      No
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Eczemas:</label> <!--{{$hc_formulario->piel->obs_eczemas}}-->
                  @if ($hc_formulario->piel->obs_eczemas)
                      {{$hc_formulario->piel->obs_eczemas}}
                  @else
                      No
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Dermatitis:</label> <!--{{$hc_formulario->piel->obs_dertmatitis}}-->
                  @if ($hc_formulario->piel->obs_dertmatitis)
                      {{$hc_formulario->piel->obs_dertmatitis}}
                  @else
                      No
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Eritemas:</label> <!--{{$hc_formulario->piel->obs_eritemas}}-->
                  @if ($hc_formulario->piel->obs_eritemas)
                      {{$hc_formulario->piel->obs_eritemas}}
                  @else
                      No
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Petequias:</label> <!--{{$hc_formulario->piel->obs_petequias}}-->
                  @if ($hc_formulario->piel->obs_eczemas)
                      {{$hc_formulario->piel->obs_eczemas}}
                  @else
                      No
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Tejido Celular Subcutáneo:</label> <!--{{$hc_formulario->piel->tejido}}-->
                  @if ($hc_formulario->piel->obs_petequias)
                      {{$hc_formulario->piel->obs_petequias}}
                  @else
                      No
                  @endif
              </td>
          </tr>
      </table>
      <!-- OSTEOARTICULAR -->
      <table class="table table-condensed table-hover" >
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">OSTEOARTICULAR</td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Limitaciones Funcionales:</label> <!--{{$hc_formulario->osteoarticular->observacion1_os}}-->
                  @if ($hc_formulario->osteoarticular->observacion1_os)
                      {{$hc_formulario->osteoarticular->observacion1_os}}
                  @else
                      No
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Amputaciones:</label> <!--{{$hc_formulario->osteoarticular->observacion2_os}}-->
                  @if ($hc_formulario->osteoarticular->observacion2_os)
                      {{$hc_formulario->osteoarticular->observacion2_os}}
                  @else
                      No
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Movilidad y Reflejos:</label> <!--{{$hc_formulario->osteoarticular->observacion3_os}}-->
                  @if ($hc_formulario->osteoarticular->observacion3_os)
                      {{$hc_formulario->osteoarticular->observacion3_os}}
                  @else
                      No
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Tonicidad y Fuerza Muscular Normal:</label> <!--{{$hc_formulario->osteoarticular->observacion4_os}}-->
                  @if ($hc_formulario->osteoarticular->observacion4_os)
                      {{$hc_formulario->osteoarticular->observacion4_os}}
                  @else
                      No
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="12">
                  <label for="">Observaciones:</label> <!--{{$hc_formulario->osteoarticular->observacion_os}}-->
                  @if ($hc_formulario->osteoarticular->observacion_os)
                      {{$hc_formulario->osteoarticular->observacion_os}}
                  @else
                      No
                  @endif
              </td>
          </tr>
      </table>
      <!-- COLUMNA VERTEBRAL -->
      <table class="table table-condensed table-hover" >
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">COLUMNA VERTEBRAL</td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Examen Normal:</label> <!--{{$hc_formulario->columna->observacion1_col}}-->
                  @if ($hc_formulario->columna->observacion1_col)
                      {{$hc_formulario->columna->observacion1_col}}
                  @else
                      No
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Contracturas:</label> <!--{{$hc_formulario->columna->observacion2_col}}-->
                  @if ($hc_formulario->columna->observacion2_col)
                      {{$hc_formulario->columna->observacion2_col}}
                  @else
                      No
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Puntos Dolorosos:</label> <!--{{$hc_formulario->columna->observacion3_col}}-->
                  @if ($hc_formulario->columna->observacion3_col)
                      {{$hc_formulario->columna->observacion3_col}}
                  @else
                      No
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Limitaciones Funcionales:</label> <!--{{$hc_formulario->columna->observacion4_col}}-->
                  @if ($hc_formulario->columna->observacion4_col)
                      {{$hc_formulario->columna->observacion4_col}}
                  @else
                      No
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="12">
                  <label for="">Observaciones:</label> <!--{{$hc_formulario->columna->observacion_col}}-->
                  @if ($hc_formulario->columna->observacion_col)
                      {{$hc_formulario->columna->observacion_col}}
                  @else
                      No
                  @endif
              </td>
          </tr>
      </table>
      <!--CABEZA Y CUELLO-->
      <table class="table table-condensed table-hover" >
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">CABEZA Y CUELLO</td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Cráneo:</label> <!--{{$hc_formulario->cabezaCuello->observacion1_cc}}-->
                  @if ($hc_formulario->cabezaCuello->observacion1_cc)
                      {{$hc_formulario->cabezaCuello->observacion1_cc}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Cara:</label> <!--{{$hc_formulario->cabezaCuello->observacion2_cc}}-->
                  @if ($hc_formulario->cabezaCuello->observacion2_cc)
                      {{$hc_formulario->cabezaCuello->observacion2_cc}}
                  @else
                      Normal
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Nariz:</label> <!--{{$hc_formulario->cabezaCuello->observacion3_cc}}-->
                  @if ($hc_formulario->cabezaCuello->observacion3_cc)
                      {{$hc_formulario->cabezaCuello->observacion3_cc}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Oídos:</label> <!--{{$hc_formulario->cabezaCuello->observacion4_cc}}-->
                  @if ($hc_formulario->cabezaCuello->observacion4_cc)
                      {{$hc_formulario->cabezaCuello->observacion4_cc}}
                  @else
                      Normal
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Boca:</label> <!--{{$hc_formulario->cabezaCuello->observacion5_cc}}-->
                  @if ($hc_formulario->cabezaCuello->observacion5_cc)
                      {{$hc_formulario->cabezaCuello->observacion5_cc}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Cuello y Tiroides:</label> <!--{{$hc_formulario->cabezaCuello->observacion6_cc}}-->
                  @if ($hc_formulario->cabezaCuello->observacion6_cc)
                      {{$hc_formulario->cabezaCuello->observacion6_cc}}
                  @else
                      Normal
                  @endif
              </td>
          </tr>
      </table>
      <!--OFTALMOLOGICO-->
      <table class="table table-condensed table-hover" style="page-break-after:always;">
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">OFTALMOLOGICO</td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Pupilas:</label> <!--{{$hc_formulario->oftalmologico->observacion1_of}}-->
                  @if ($hc_formulario->oftalmologico->observacion1_of)
                      {{$hc_formulario->oftalmologico->observacion1_of}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Córneas:</label> <!--{{$hc_formulario->oftalmologico->observacion2_of}}-->
                  @if ($hc_formulario->oftalmologico->observacion2_of)
                      {{$hc_formulario->oftalmologico->observacion2_of}}
                  @else
                      Normal
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Conjuntivas:</label> <!--{{$hc_formulario->oftalmologico->observacion3_of}}-->
                  @if ($hc_formulario->oftalmologico->observacion3_of)
                      {{$hc_formulario->oftalmologico->observacion3_of}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Visión en colores:</label> <!--{{$hc_formulario->oftalmologico->observacion4_of}}-->
                  @if ($hc_formulario->oftalmologico->observacion4_of)
                      {{$hc_formulario->oftalmologico->observacion4_of}}
                  @else
                      Normal
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="12">
                  <label for="">Examen de Agudeza Visual:</label>
              </td>
          </tr>
          <tr>
              <td colspan="4">
                  <label for="">Ojo derecho:</label> {{$hc_formulario->oftalmologico->observacion5_of}}
              </td>
              <td colspan="4">
                  <label for="">Ojo izquierdo:</label> {{$hc_formulario->oftalmologico->observacion6_of}}
              </td>
              <td colspan="4">
                  <label for="">Usa Lentes:</label>                 
                  @if ($hc_formulario->oftalmologico->pregunta7_of==true)
                      Si
                  @else
                      No
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="12">
                  <label for="">Observaciones:</label> <!--{{$hc_formulario->oftalmologico->observacion_of}}-->
                  @if ($hc_formulario->oftalmologico->observacion_of)
                      {{$hc_formulario->oftalmologico->observacion_of}}
                  @else
                      No
                  @endif
              </td>
          </tr>
      </table>

      <!-- <div style="page-break-after:always;"></div> -->

      <!-- NEUROLOGICO -->
      <table class="table table-condensed table-hover">
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">NEUROLOGICO</td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Motilidad Activa:</label> <!--{{$hc_formulario->neurologico->observacion1_neu}}-->
                  @if ($hc_formulario->neurologico->observacion1_neu)
                      {{$hc_formulario->neurologico->observacion1_neu}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Motilidad Pasiva:</label> <!--{{$hc_formulario->neurologico->observacion2_neu}}-->
                  @if ($hc_formulario->neurologico->observacion2_neu)
                      {{$hc_formulario->neurologico->observacion2_neu}}
                  @else
                      Normal
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Sensibilidad:</label> <!--{{$hc_formulario->neurologico->observacion3_neu}}-->
                  @if ($hc_formulario->neurologico->observacion3_neu)
                      {{$hc_formulario->neurologico->observacion3_neu}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Marcha:</label> <!--{{$hc_formulario->neurologico->observacion4_neu}}-->
                  @if ($hc_formulario->neurologico->observacion4_neu)
                      {{$hc_formulario->neurologico->observacion4_neu}}
                  @else
                      Normal
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Reflejos Osteotendinosos:</label> <!--{{$hc_formulario->neurologico->observacion5_neu}}-->
                  @if ($hc_formulario->neurologico->observacion5_neu)
                      {{$hc_formulario->neurologico->observacion5_neu}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Pares Craneales:</label> <!--{{$hc_formulario->neurologico->observacion6_neu}}-->
                  @if ($hc_formulario->neurologico->observacion6_neu)
                      {{$hc_formulario->neurologico->observacion6_neu}}
                  @else
                      Normal
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Taxia:</label> <!--{{$hc_formulario->neurologico->observacion7_neu}}-->
                  @if ($hc_formulario->neurologico->observacion7_neu)
                      {{$hc_formulario->neurologico->observacion7_neu}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Observaciones:</label> <!--{{$hc_formulario->neurologico->observacion_neu}}-->
                  @if ($hc_formulario->neurologico->observacion_neu)
                      {{$hc_formulario->neurologico->observacion_neu}}
                  @else
                      No
                  @endif
              </td>
          </tr>
      </table>
      <!-- ODONTOLOGICO -->
      <table class="table table-condensed table-hover" >
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">ODONTOLOGICO</td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Encias y Mucosas:</label> <!--{{$hc_formulario->odontologico->observacion1_od}}-->
                  @if ($hc_formulario->odontologico->observacion1_od)
                      {{$hc_formulario->odontologico->observacion1_od}}
                  @else
                      No
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Esmalte Dental:</label> <!--{{$hc_formulario->odontologico->observacion2_od}}-->
                  @if ($hc_formulario->odontologico->observacion2_od)
                      {{$hc_formulario->odontologico->observacion2_od}}
                  @else
                      No
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Caries:</label>
                  @if ($hc_formulario->odontologico->pregunta4_od==true)
                      Si
                  @else
                      No
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Faltan piezas dentales:</label>
                  @if ($hc_formulario->odontologico->pregunta5_od==true)
                      Si
                  @else
                      No
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Protesis Superior:</label> <!--{{$hc_formulario->odontologico->superior}}-->
                      @if ($hc_formulario->odontologico->superior)
                          {{$hc_formulario->odontologico->superior}}
                      @else
                          No
                      @endif
              </td>
              <td colspan="6">
                  <label for="">Protesis Inferior:</label> <!--{{$hc_formulario->odontologico->inferior}}-->
                      @if ($hc_formulario->odontologico->inferior)
                          {{$hc_formulario->odontologico->inferior}}
                      @else
                          No
                      @endif
              </td>
          </tr>
          <tr>
              <td colspan="12">
                  <label for="">Observaciones:</label> <!--{{$hc_formulario->odontologico->observacion_od}}-->
                  @if ($hc_formulario->odontologico->observacion_od)
                      {{$hc_formulario->odontologico->observacion_od}}
                  @else
                      No
                  @endif
              </td>
          </tr>
      </table>
      <!-- TORAX Y APARATO RESPIRATORIO -->
      <table class="table table-condensed table-hover" >
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">TORAX Y APARATO RESPIRATORIO</td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Caja Torácica:</label> <!--{{$hc_formulario->respiratorio->observacion1_re}}-->
                  @if ($hc_formulario->respiratorio->observacion1_re)
                      {{$hc_formulario->respiratorio->observacion1_re}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Pulmones:</label> <!--{{$hc_formulario->respiratorio->observacion2_re}}-->
                  @if ($hc_formulario->respiratorio->observacion2_re)
                      {{$hc_formulario->respiratorio->observacion2_re}}
                  @else
                      Normal
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">COVID 19:</label> {{$hc_formulario->respiratorio->covid19}}
              </td>
              <td colspan="6">
                  <label for="">Vacunas:</label> {{$hc_formulario->respiratorio->vacunado}}
              </td>
          </tr>
      </table>
      <!-- ABDOMEN -->
      <table class="table table-condensed table-hover" >
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">ABDOMEN</td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Forma:</label> <!--{{$hc_formulario->abdomen->observacion1_ab}}-->
                  @if ($hc_formulario->abdomen->observacion1_ab)
                      {{$hc_formulario->abdomen->observacion1_ab}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Hígado:</label> <!--{{$hc_formulario->abdomen->observacion2_ab}}-->
                  @if ($hc_formulario->abdomen->observacion2_ab)
                      {{$hc_formulario->abdomen->observacion2_ab}}
                  @else
                      Normal
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Bazo:</label> <!--{{$hc_formulario->abdomen->observacion3_ab}}-->
                  @if ($hc_formulario->abdomen->observacion3_ab)
                      {{$hc_formulario->abdomen->observacion3_ab}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Colon:</label> <!--{{$hc_formulario->abdomen->observacion4_ab}}-->
                  @if ($hc_formulario->abdomen->observacion4_ab)
                      {{$hc_formulario->abdomen->observacion4_ab}}
                  @else
                      Normal
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Ruidos Hidroaéreos:</label> <!--{{$hc_formulario->abdomen->observacion5_ab}}-->
                  @if ($hc_formulario->abdomen->observacion5_ab)
                      {{$hc_formulario->abdomen->observacion5_ab}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Puño percusión:</label> <!--{{$hc_formulario->abdomen->observacion6_ab}}-->
                  @if ($hc_formulario->abdomen->observacion6_ab)
                      {{$hc_formulario->abdomen->observacion6_ab}}
                  @else
                      Normal
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="12">
                  <label for="">Cicatrices quirúrgicas:</label> <!--{{$hc_formulario->abdomen->observacion_ab}}-->
                  @if ($hc_formulario->abdomen->observacion_ab)
                      {{$hc_formulario->abdomen->observacion_ab}}
                  @else
                      Normal
                  @endif
              </td>
          </tr>
      </table>
      <!-- REGIONES INGUINALES -->
      <table class="table table-condensed table-hover" >
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">REGIONES INGUINALES</td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Tono de la pared posterior:</label> <!--{{$hc_formulario->regionInguinal->observacion1_in}}-->
                  @if ($hc_formulario->regionInguinal->observacion1_in)
                      {{$hc_formulario->regionInguinal->observacion1_in}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Orificios Superficiales:</label> <!--{{$hc_formulario->regionInguinal->observacion2_in}}-->
                  @if ($hc_formulario->regionInguinal->observacion2_in)
                      {{$hc_formulario->regionInguinal->observacion2_in}}
                  @else
                      Normal
                  @endif
              </td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Orificios Profundos:</label> <!--{{$hc_formulario->regionInguinal->observacion3_in}}-->
                  @if ($hc_formulario->regionInguinal->observacion3_in)
                      {{$hc_formulario->regionInguinal->observacion3_in}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Observaciones:</label> <!--{{$hc_formulario->regionInguinal->observacion_in}}-->
                  @if ($hc_formulario->regionInguinal->observacion_in)
                      {{$hc_formulario->regionInguinal->observacion_in}}
                  @else
                      No
                  @endif
              </td>
          </tr>
      </table>
      <!-- GENITALES -->
      <table class="table table-condensed table-hover" >
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">GENITALES</td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Características:</label> <!--{{$hc_formulario->genital->observacion1_ge}}-->
                  @if ($hc_formulario->genital->observacion1_ge)
                      {{$hc_formulario->genital->observacion1_ge}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Observaciones:</label> <!--{{$hc_formulario->genital->observacion_ge}}-->
                  @if ($hc_formulario->genital->observacion_ge)
                      {{$hc_formulario->genital->observacion_ge}}
                  @else
                      No
                  @endif
              </td>
          </tr>
      </table>
      <!-- REGION ANAL -->
      <table class="table table-condensed table-hover" >
          <tr>
              <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">REGION ANAL</td>
          </tr>
          <tr>
              <td colspan="6">
                  <label for="">Características:</label> <!--{{$hc_formulario->regionAnal->observacion1_an}}-->
                  @if ($hc_formulario->regionAnal->observacion1_an)
                      {{$hc_formulario->regionAnal->observacion1_an}}
                  @else
                      Normal
                  @endif
              </td>
              <td colspan="6">
                  <label for="">Observaciones:</label> <!--{{$hc_formulario->regionAnal->observacion_an}}-->
                  @if ($hc_formulario->regionAnal->observacion_an)
                      {{$hc_formulario->regionAnal->observacion_an}}
                  @else
                      No
                  @endif
              </td>
          </tr>
      </table>
      <!-- Firma -->
      <table class="table table-condensed table-hover" >
          <tr >
              <td style="width: 350px;text-align:center" colspan="6">
                  <div>
                      <img src="{{$declaracion_jurada->firma}}" width=130 height=130 alt="firma del paciente">
                      <!-- <img src="{{$hc_formulario->firma}}" width=130 height=130 alt="firma del paciente"> -->
                  </div>
                  <label>Firma del Paciente</label>
              </td>
              <td style="width: 350px;text-align: center" colspan="6">
                  <div style="height:130px">
                      @if ($declaracion_jurada->personalClinica->foto)
                          <img src="{{public_path('imagenes/firmas/'.$declaracion_jurada->personalClinica->foto)}}" width="130" height="130" alt="firma del médico"> 
                      @endif
                  </div>
                  <label>Firma del Médico</label>
              </td>
          </tr>
      </table>
    </div>
  
</body>
</html>