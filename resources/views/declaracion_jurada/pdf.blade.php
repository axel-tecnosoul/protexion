<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Declaracion Jurada</title>
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
</head>
<body>
    <div id="content" class="container">
        <div id="header" style="text-align: right">
            <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
        </div>
        <h3 style="text-align: center">DECLARACION JURADA DE SALUD</h3>
        <!-- DATOS PERSONALES -->
        <table class="table table-condensed table-hover" >
            <tr>
                <td style="text-align: center; background-color: brown; color: #FFFFFF" colspan="12">DATOS PERSONALES</td>
            </tr>
            <tr style="text-align: left;">
                <td style=" width: 350px" colspan="6"> <b> Nombre Completo:</b> {{$declaracion_jurada->voucher->paciente->nombreCompleto()}}</td>
                <td style=" width: 350px" colspan="6"><b>Sexo:</b> {{$declaracion_jurada->voucher->paciente->sexo ? $declaracion_jurada->voucher->paciente->sexo->abreviatura : " " }}  </td>
            </tr>
            <tr style="text-align: left;" >
                <td style=" width: 350px" colspan="6"> <b> Fecha de Nacimiento:</b> {{Carbon\Carbon::parse($declaracion_jurada->voucher->paciente->fecha_nacimiento)->format('d/m/Y') }}</td>
                <td style=" width: 350px" colspan="6"> <b>Lugar:</b>  {{$declaracion_jurada->voucher->paciente->ciudad ? $declaracion_jurada->voucher->paciente->lugarNacimiento() : " " }} </td>
            </tr>
            <tr style="text-align: left;" >
                <td style=" width: 350px" colspan="6"> <b> Documento de identidad: </b>    {{$declaracion_jurada->voucher->paciente->documentoIdentidad() }}           </td>
                <td style=" width: 350px" colspan="6"> <b> Estado Civil:           </b>    {{$declaracion_jurada->voucher->paciente->estadoCivil ? $declaracion_jurada->voucher->paciente->estadoCivil->abreviatura : " "  }}       </td>
            </tr>
            <tr style="text-align: left;" >
                <td style=" width: 350px" colspan="6"> <b> Domicilio: </b>     {{$declaracion_jurada->voucher->paciente->domicilio ? $declaracion_jurada->voucher->paciente->direccion() : " "}}                               </td>
                <td style=" width: 350px" colspan="6"> <b> CP:        </b>     {{$declaracion_jurada->voucher->paciente->domicilio ? $declaracion_jurada->voucher->paciente->domicilio->ciudad->codigo_postal : " "}}          </td>
            </tr>
            <tr style="text-align: left;" >
                <td style=" width: 350px" colspan="6"> <b> Provincia: </b>     {{$declaracion_jurada->voucher->paciente->domicilio ? $declaracion_jurada->voucher->paciente->domicilio->ciudad->provincia->nombre : " "}}      </td>
                <td style=" width: 350px" colspan="6"> <b> Localidad: </b>     {{$declaracion_jurada->voucher->paciente->ciudad ? $declaracion_jurada->voucher->paciente->lugarNacimiento() : " " }} <!-- No corresponde ciudad, debe ir el domicilio -->      </td>
            </tr>
            <tr style="text-align: left;" >
                <td style=" width: 350px" colspan="6"> <b> Teléfono:      </b>     {{$declaracion_jurada->voucher->paciente->telefono }}      </td>
                <td style=" width: 350px" colspan="6"> <b> Peso (Kgrs.):  </b>     {{$declaracion_jurada->voucher->paciente->peso }}          </td>
            </tr>
            <tr style="text-align: left;" >
                <td style=" width: 350px" colspan="6"> <b> Estatura: (Mts.)    </b>   {{$declaracion_jurada->voucher->paciente->estatura }}        </td>
                <td style=" width: 350px" colspan="6"> <b> Fecha último examen: </b>   {{$declaracion_jurada->fecha_realizacion }}        </td>
            </tr>
        </table>
        <!-- ANTECEDENTES FAMILIARES -->
        <table class="table table-condensed table-hover" >
            <tr>
                <td style="text-align: center; background-color: brown; color: #FFFFFF" colspan="12">ANTECEDENTES FAMILIARES</td>
            </tr>
            <tr style="text-align: left;">
                <td style=" width: 350px" colspan="6">
                    <label for="">Su padre vive: </label>
                    @if ($declaracion_jurada->antecedenteFamiliar->su_padre_vive==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td style=" width: 350px" colspan="6">
                    <label for="">Su madre vive:</label>
                    @if ($declaracion_jurada->antecedenteFamiliar->su_madre_vive==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left;">
                <td style=" width: 350px" colspan="12">
                    ¿Su madre o padre padece alguna de las siguientes afecciones?
                </td>
            </tr>
            <tr style="text-align: left;">
                <td  colspan="3">
                    <label for="">Cáncer:</label>
                    @if ($declaracion_jurada->antecedenteFamiliar->cancer==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td  colspan="3">
                    <label for=""> Diabetes:</label>
                    @if ($declaracion_jurada->antecedenteFamiliar->diabetes==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td  colspan="3">
                    <label for="">Infarto:</label>
                    @if ($declaracion_jurada->antecedenteFamiliar->infarto==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td  colspan="3">
                    <label for="">Hipertension Arterial:</label>
                    @if ($declaracion_jurada->antecedenteFamiliar->hipertension_Arterial==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left;">
                <td style=" width: 350px" colspan="12">
                    <label for="">Si su padre o madre padecen alguna enfermedad actualmente, mencione el diagnóstico: </label>
                </td>
            </tr>
            <tr style="text-align: left;">
                <td style=" width: 350px" colspan="12">
                    {{$declaracion_jurada->antecedenteFamiliar->detalle}}
                </td>
            </tr>
        </table>
        <!-- ANTECEDENTES PERSONALES -->
        <table class="table table-condensed table-hover" >
            <tr>
                <td style="text-align: center; background-color: brown; color: #FFFFFF;width: 710px" colspan="12">ANTECEDENTES PERSONALES</td>
            </tr>
            <tr >
                <td colspan="12">
                    <label for="">Fuma:</label> 
                    @if ($declaracion_jurada->antecedentePersonal->fuma)
                        {{$declaracion_jurada->antecedentePersonal->fuma}}
                    @else
                        No
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <label for="">Bebe:</label> 
                    @if ($declaracion_jurada->antecedentePersonal->bebe)
                        {{$declaracion_jurada->antecedentePersonal->bebe}}
                    @else
                        No
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <label for="">Act. Física:</label> 
                    @if ($declaracion_jurada->antecedentePersonal->actividad_fisica)
                        {{$declaracion_jurada->antecedentePersonal->actividad_fisica}}
                    @else
                        No
                    @endif
                </td>
            </tr>
        </table>
        <!-- ANTECEDENTES INFANCIA -->
        <table class="table table-condensed table-hover" >
            <tr>
                <td style="text-align: center; background-color: brown; color: #FFFFFF;width: 710px" colspan="12">ANTECEDENTES MÉDICOS DE LA INFANCIA</td>
            </tr>
            <tr>
                <td colspan="12">
                    <label for="">¿Padeció algunas de las siguientes afecciones?</label>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label for="">Sarampión: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->sarampion==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td colspan="3">
                    <label for="">Rubéola: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->rebeola==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td colspan="3">
                    <label for="">Epilepsias: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->epilepsia==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td colspan="3">
                    <label for="">Varicela: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->varicela==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label for="">Parotiditis: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->parotiditis==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td colspan="3">
                    <label for="">Cefalea prolongada: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->cefalea_prolongada==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td colspan="3">
                    <label for="">Hepatitis: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->hepatitis==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td colspan="3">
                    <label for="">Gastritis: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->gastritis==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label for="">Úlcera gástrica: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->ulcera_gastrica==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td colspan="3">
                    <label for="">Hemorroide: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->hemorroide==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td colspan="3">
                    <label for="">Hemorragias: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->hemorragias==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td colspan="3">
                    <label for="">Neumonía: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->neumonia==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label for="">Asma: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->asma==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td colspan="3">
                    <label for="">Tuberculosis: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->tuberculosis==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td colspan="3">
                    <label for="">Tos cronica: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->tos_cronica==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td colspan="3">
                    <label for="">Catarro: </label> 
                    @if ($declaracion_jurada->antecedenteMedicoInfancia->catarro==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <label for="">Otras Afecciones: </label>{{$declaracion_jurada->antecedenteMedicoInfancia->detalle1_m}}
                </td>
            </tr>
        </table>
        <div style="page-break-after:always;"></div>
        <!-- ANTECEDENTES RECIENTES -->
        <table class="table table-condensed table-hover" >
            <tr>
                <td style="text-align: center; background-color: brown; color: #FFFFFF;width: 710px" colspan="12">ANTECEDENTES RECIENTES</td>
            </tr>
            <tr>
                <td colspan="12">
                    <label for="">Ha tenido Ud. O ha sido tratado en los últimos años por:</label>
                </td>
            </tr>
            <tr style="text-align: left" valign="middle">
                <td colspan="12">
                    <label>Enfermedad de los ojos, oidos , nariz o garganta:</label>
                    @if ($declaracion_jurada->antecedenteReciente->detalle1_reciente)
                        {{$declaracion_jurada->antecedenteReciente->detalle1_reciente}}
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left" valign="middle">
                <td colspan="12">
                    <label>Mareos, desmayos, convulsiones, dolores de cabeza, parálisis o ataques, desordenes mentales o nerviosos: </label>
                    @if ($declaracion_jurada->antecedenteReciente->detalle2_reciente)
                        {{$declaracion_jurada->antecedenteReciente->detalle2_reciente}}
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left" valign="middle">
                <td colspan="12">
                    <label>Insuficiencia respiratoria, ronquera persistente, tos, asma, bronquitis, enfisema, tuberculosis o enfermedad respiratoria crónica:</label>
                    @if ($declaracion_jurada->antecedenteReciente->detalle3_reciente)
                        {{$declaracion_jurada->antecedenteReciente->detalle3_reciente}}
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left" valign="middle">
                <td colspan="12">
                    <label>Dolor de pecho, palpitaciones, presión sanguínea, fiebre reumática, ataque al corazón u otra enfermedad del corazón o vasos sanguíneos</label>
                    @if ($declaracion_jurada->antecedenteReciente->detalle4_reciente)
                        {{$declaracion_jurada->antecedenteReciente->detalle4_reciente}}
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left" valign="middle">
                <td colspan="12">
                    <label>Ictericia, hemorragia intestinal, úlcera, colitis, diverticulosis, otras enfermedades del intestino, hígado o vesícula:</label>
                    @if ($declaracion_jurada->antecedenteReciente->detalle5_reciente)
                        {{$declaracion_jurada->antecedenteReciente->detalle5_reciente}}
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left" valign="middle">
                <td colspan="12">
                    <label>Azúcar, sangre o pus en la orina, enfermedad del riñón, vejiga o próstata:</label>
                    @if ($declaracion_jurada->antecedenteReciente->detalle6_reciente)
                        {{$declaracion_jurada->antecedenteReciente->detalle6_reciente}}
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left" valign="middle">
                <td colspan="12">
                    <label>Diabetes, Tiroides u otra enfermedad endócrinas:</label>
                    @if ($declaracion_jurada->antecedenteReciente->detalle7_reciente)
                        {{$declaracion_jurada->antecedenteReciente->detalle7_reciente}}
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left" valign="middle">
                <td colspan="12">
                    <label>Gota, Afecciones musculares u óseas, incluidos columna, espalda o articulaciones:</label>
                    @if ($declaracion_jurada->antecedenteReciente->detalle8_reciente)
                        {{$declaracion_jurada->antecedenteReciente->detalle8_reciente}}
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left" valign="middle">
                <td colspan="12">
                    <label>Deformidades, rengueras o amputaciones:</label>
                    @if ($declaracion_jurada->antecedenteReciente->detalle9_reciente)
                        {{$declaracion_jurada->antecedenteReciente->detalle9_reciente}}
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left" valign="middle">
                <td colspan="12">
                    <label>Enfermedades de la piel:</label>
                    @if ($declaracion_jurada->antecedenteReciente->detalle10_reciente)
                        {{$declaracion_jurada->antecedenteReciente->detalle10_reciente}}
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left" valign="middle">
                <td colspan="12">
                    <label>Alergias, anemias u otras enfermedades de la sangre:</label>
                    @if ($declaracion_jurada->antecedenteReciente->detalle11_reciente)
                        {{$declaracion_jurada->antecedenteReciente->detalle11_reciente}}
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left" valign="middle">
                <td colspan="12">
                    <label>Está Ud. Actualmente bajo observación o tratamiento:</label>
                    @if ($declaracion_jurada->antecedenteReciente->detalle12_reciente)
                        {{$declaracion_jurada->antecedenteReciente->detalle12_reciente}}
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left" valign="middle">
                <td colspan="12">
                    <label>Ha tenido algún cambio en su peso en el último año:</label>
                    @if ($declaracion_jurada->antecedenteReciente->detalle13_reciente)
                        {{$declaracion_jurada->antecedenteReciente->detalle13_reciente}}
                    @else
                        NO
                    @endif
                </td>
            </tr>
            <tr style="text-align: left" valign="middle">
                <td colspan="12">
                    <label>HERNIA:</label>
                    @if ($declaracion_jurada->antecedenteReciente->detalle14_reciente)
                        {{$declaracion_jurada->antecedenteReciente->detalle14_reciente}}
                    @else
                        NO
                    @endif
                </td>
            </tr>
        </table>
        <!-- ANTECEDENTES QUIRURGICOS -->
        <table class="table table-condensed table-hover" >
            <tr>
                <td style="text-align: center; background-color: brown; color: #FFFFFF;width: 710px" colspan="12">ANTECEDENTES QUIRURGICOS</td>
            </tr>
            <tr >
                <td colspan="12">
                    <label for="">¿Fue intervenido/a quirúrgicamente por alguna causa?</label> 
                    @if ($declaracion_jurada->antecedenteQuirurjico->detalle1_q)
                        {{$declaracion_jurada->antecedenteQuirurjico->detalle1_q}}
                    @else
                        No
                    @endif
                </td>
            </tr>
            <tr >
                <td colspan="12">
                    <label for="">¿Tiene pendiente alguna cirugía?</label> 
                    @if ($declaracion_jurada->antecedenteQuirurjico->detalle2_q)
                        {{$declaracion_jurada->antecedenteQuirurjico->detalle2_q}}
                    @else
                        No
                    @endif
                </td>
            </tr>
            <tr >
                <td colspan="12">
                    <label for="">¿Padece alguna otra enfermedad no especificada en el interrogatorio anterior?</label> 
                    @if ($declaracion_jurada->antecedenteQuirurjico->detalle3_q)
                        {{$declaracion_jurada->antecedenteQuirurjico->detalle3_q}}
                    @else
                        No
                    @endif
                </td>
            </tr>
        </table>
        <p style="font-size: 12px">
            Por la presente declaro bajo juramento que los datos de la presente declaración, de mi puño y letra, son reales y corresponden a mi Historia Clínica Personal.
        </p>
        <p style="font-size: 12px">Lugar y Fecha: Puerto Rico {{Carbon\Carbon::parse($declaracion_jurada->fecha_realizacion)->format('d/m/Y') }}</p>
        <!-- FIRMAS -->
        <table class="table table-condensed table-hover" >
            <tr >
                <td style="width: 350px;text-align: center" colspan="6">
                    <div>
                        <img src="{{$declaracion_jurada->firma}}" width=130 height=130 alt="firma del paciente">
                    </div>
                    <label>Firma del Paciente</label>
                </td>
                <td style="width: 350px;text-align: center" colspan="6">
                    <div>
                        @if ($declaracion_jurada->personalClinica->foto)
                            <img src="{{public_path('imagenes/firmas/'.$declaracion_jurada->personalClinica->foto)}}" width=130 height=130 alt="firma del médico">
                        @endif
                    </div>
                    <label>Firma del Médico</label>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
