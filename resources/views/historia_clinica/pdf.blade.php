<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        td{ 
            border-bottom:  0.1px solid rgb(202, 202, 202);
            padding: 3px;
            font-size: 12px;
        }
        label{
            font-weight: bold;
        }
    </style>
    <title>Formulario de Historia Clinica</title>
</head>
<body>
    <div id="content" class="container">
        <div style="text-align: right">
            <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
        </div>
        <h3 style="text-align: center">HISTORIA CLINICA</h3>
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
                    <label>CUIL:</label> {{$hc_formulario->voucher->paciente->cuil }}
                </td>
                <td style=" width: 350px" colspan="6">
                    <label>Sexo:</label> {{$hc_formulario->voucher->paciente->sexo ? $hc_formulario->voucher->paciente->sexo->abreviatura : " " }}
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
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td colspan="3">
                    <label for="">IMC:</label> {{$hc_formulario->examenClinico->imc}}
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <label for="">Medicación Act.:</label> {{$hc_formulario->examenClinico->medicacion_actual}}
                </td>
            </tr>
        </table>
        <!-- CARDIOVASCULAR -->
        <table class="table table-condensed table-hover" >
            <tr>
                <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">EXAMEN CLÍNICO</td>
            </tr>
            <tr style="text-align: left;">
                <td colspan="12">
                    <label for="">Frecuencia Cardíaca:</label> {{$hc_formulario->cardiovascular->frecuencia_cardiaca}}
                </td>
            </tr>
            <tr style="text-align: left;">
                <td colspan="8">
                    <label for="">Tensión Arterial:</label> {{$hc_formulario->cardiovascular->tension_arterial}}
                </td>
                <td colspan="2">
                    <label for="">Sistolica:</label> {{$hc_formulario->cardiovascular->sistolica}}
                </td>
                <td colspan="2">
                    <label for="">Diastolica:</label> {{$hc_formulario->cardiovascular->diastolica}}
                </td>
            </tr>
            <tr style="text-align: left;">
                <td colspan="6">
                    <label for="">Várices:</label> {{$hc_formulario->cardiovascular->observacion_varices}}
                </td>
                <td colspan="6">
                    <label for="">Pulso:</label> {{$hc_formulario->cardiovascular->pulso}}
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
                    <label for="">Cicatrices patológicas visibles:</label> {{$hc_formulario->piel->observacion1_piel}}
                </td>
                <td colspan="6">
                    <label for="">Vesículas:</label> {{$hc_formulario->piel->obs_vesicula}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Úlceras:</label> {{$hc_formulario->piel->obs_ulceras}}
                </td>
                <td colspan="6">
                    <label for="">Fisuras:</label> {{$hc_formulario->piel->obs_fisuras}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Prurito:</label> {{$hc_formulario->piel->obs_prurito}}
                </td>
                <td colspan="6">
                    <label for="">Eczemas:</label> {{$hc_formulario->piel->obs_eczemas}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Dermatitis:</label> {{$hc_formulario->piel->obs_dertmatitis}}
                </td>
                <td colspan="6">
                    <label for="">Eritemas:</label> {{$hc_formulario->piel->obs_eritemas}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Petequias:</label> {{$hc_formulario->piel->obs_petequias}}
                </td>
                <td colspan="6">
                    <label for="">Tejido Celular Subcutáneo:</label> {{$hc_formulario->piel->tejido}}
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
                    <label for="">Limitaciones Funcionales:</label> {{$hc_formulario->osteoarticular->observacion1_os}}
                </td>
                <td colspan="6">
                    <label for="">Amputaciones:</label> {{$hc_formulario->osteoarticular->observacion2_os}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Movilidad y Reflejos:</label> {{$hc_formulario->osteoarticular->observacion3_os}}
                </td>
                <td colspan="6">
                    <label for="">Tonicidad y Fuerza Muscular Normal:</label> {{$hc_formulario->osteoarticular->observacion4_os}}
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <label for="">Observaciones:</label> {{$hc_formulario->osteoarticular->observacion_os}}
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
                    <label for="">Examen Normal:</label> {{$hc_formulario->columna->observacion1_col}}
                </td>
                <td colspan="6">
                    <label for="">Contracturas:</label> {{$hc_formulario->columna->observacion2_col}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Puntos Dolorosos:</label> {{$hc_formulario->columna->observacion3_col}}
                </td>
                <td colspan="6">
                    <label for="">Limitaciones Funcionales:</label> {{$hc_formulario->columna->observacion4_col}}
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <label for="">Observaciones:</label> {{$hc_formulario->columna->observacion_col}}
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
                    <label for="">Cráneo:</label> {{$hc_formulario->cabezaCuello->observacion1_cc}}
                </td>
                <td colspan="6">
                    <label for="">Cara:</label> {{$hc_formulario->cabezaCuello->observacion2_cc}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Nariz:</label> {{$hc_formulario->cabezaCuello->observacion3_cc}}
                </td>
                <td colspan="6">
                    <label for="">Oídos:</label> {{$hc_formulario->cabezaCuello->observacion4_cc}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Boca:</label> {{$hc_formulario->cabezaCuello->observacion5_cc}}
                </td>
                <td colspan="6">
                    <label for="">Cuello y Tiroides:</label> {{$hc_formulario->cabezaCuello->observacion6_cc}}
                </td>
            </tr>
        </table>
        <!--OFTALMOLOGICO-->
        <table class="table table-condensed table-hover" >
            <tr>
                <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">OFTALMOLOGICO</td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Pupilas:</label> {{$hc_formulario->oftalmologico->observacion1_of}}
                </td>
                <td colspan="6">
                    <label for="">Córneas:</label> {{$hc_formulario->oftalmologico->observacion2_of}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Conjuntivas:</label> {{$hc_formulario->oftalmologico->observacion3_of}}
                </td>
                <td colspan="6">
                    <label for="">Visión en colores:</label> {{$hc_formulario->oftalmologico->observacion4_of}}
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
                        SI
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <label for="">Observaciones:</label> {{$hc_formulario->oftalmologico->observacion_of}}
                </td>
            </tr>
        </table>

        <div style="page-break-after:always;"></div>

        <!-- NEUROLOGICO -->
        <table class="table table-condensed table-hover" >
            <tr>
                <td style="text-align: center; background-color: brown; color: #FFFFFF; width: 710px" colspan="12">NEUROLOGICO</td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Motilidad Activa:</label> {{$hc_formulario->neurologico->observacion1_neu}}
                </td>
                <td colspan="6">
                    <label for="">Motilidad Pasiva:</label> {{$hc_formulario->neurologico->observacion2_neu}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Sensibilidad:</label> {{$hc_formulario->neurologico->observacion3_neu}}
                </td>
                <td colspan="6">
                    <label for="">Marcha:</label> {{$hc_formulario->neurologico->observacion4_neu}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Reflejos Osteotendinosos:</label> {{$hc_formulario->neurologico->observacion5_neu}}
                </td>
                <td colspan="6">
                    <label for="">Pares Craneales:</label> {{$hc_formulario->neurologico->observacion6_neu}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Taxia:</label> {{$hc_formulario->neurologico->observacion7_neu}}
                </td>
                <td colspan="6">
                    <label for="">Observaciones:</label> {{$hc_formulario->neurologico->observacion_neu}}
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
                    <label for="">Encias y Mucosas:</label> {{$hc_formulario->odontologico->observacion1_od}}
                </td>
                <td colspan="6">
                    <label for="">Esmalte Dental:</label> {{$hc_formulario->odontologico->observacion2_od}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Caries:</label>
                    @if ($hc_formulario->odontologico->pregunta4_od==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td colspan="6">
                    <label for="">Faltan piezas dentales:</label>
                    @if ($hc_formulario->odontologico->pregunta5_od==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Prótesis:</label>
                </td>
                <td colspan="3">
                    <label for="">Superior:</label> {{$hc_formulario->odontologico->superior}}
                </td>
                <td colspan="3">
                    <label for="">Inferior:</label> {{$hc_formulario->odontologico->inferior}}
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <label for="">Observaciones:</label> {{$hc_formulario->odontologico->observacion_od}}
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
                    <label for="">Caja Torácica:</label> {{$hc_formulario->respitario->observacion1_re}}
                </td>
                <td colspan="6">
                    <label for="">Pulmones:</label> {{$hc_formulario->respitario->observacion2_re}}
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
                    <label for="">Forma:</label> {{$hc_formulario->abdomen->observacion1_ab}}
                </td>
                <td colspan="6">
                    <label for="">Hígado:</label> {{$hc_formulario->abdomen->observacion2_ab}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Bazo:</label> {{$hc_formulario->abdomen->observacion3_ab}}
                </td>
                <td colspan="6">
                    <label for="">Colon:</label> {{$hc_formulario->abdomen->observacion4_ab}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Ruidos Hidroaéreos:</label> {{$hc_formulario->abdomen->observacion5_ab}}
                </td>
                <td colspan="6">
                    <label for="">Puño percusión:</label> {{$hc_formulario->abdomen->observacion6_ab}}
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <label for="">Cicatrices quirúrgicas:</label> {{$hc_formulario->abdomen->observacion_ab}}
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
                    <label for="">Tono de la pared posterior:</label> {{$hc_formulario->regionInguinal->observacion1_in}}
                </td>
                <td colspan="6">
                    <label for="">Orificios Superficiales:</label> {{$hc_formulario->regionInguinal->observacion2_in}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Orificios Profundos:</label> {{$hc_formulario->regionInguinal->observacion3_in}}
                </td>
                <td colspan="6">
                    <label for="">Observaciones:</label> {{$hc_formulario->regionInguinal->observacion_in}}
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
                    <label for="">Características:</label> {{$hc_formulario->genital->observacion1_ge}}
                </td>
                <td colspan="6">
                    <label for="">Observaciones:</label> {{$hc_formulario->genital->observacion_ge}}
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
                    <label for="">Características:</label> {{$hc_formulario->regionAnal->observacion1_an}}
                </td>
                <td colspan="6">
                    <label for="">Observaciones:</label> {{$hc_formulario->regionAnal->observacion_an}}
                </td>
            </tr>
        </table>
        <!-- Firma -->
        <table class="table table-condensed table-hover" >
            <tr >
                <td style="width: 350px;text-align:center">
                    <!-- Vacio -->
                </td>
                <td style="width: 350px;text-align:center">
                    <div>
                        <img src="{{$hc_formulario->firma}}" width=130 height=130 alt="firma del paciente">
                    </div>
                    <label>Firma del Paciente</label>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>