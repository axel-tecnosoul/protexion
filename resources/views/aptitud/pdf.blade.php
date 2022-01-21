<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        td{
            border-bottom:  0.1px solid rgb(202, 202, 202);
            padding: 3px;
            font-size: 12px;
        }
        label{
            font-weight: bold;
        }
        .hidden{
            display: none;
        }
    </style>
</head>
<body>
    <div id="content" class="container">
        <div id="header" style="text-align: right">
            <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
        </div>
        <h3 style="text-align: center">INFORME MEDICO LABORAL</h3>

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
                <td style="width: 170px" colspan="3">
                    <label>CUIL:</label> {{$voucher->paciente->cuil }}
                </td>
                <td style="width: 170px" colspan="3">
                    <label>Fecha:</label> {{Carbon\Carbon::parse($aptitud["fecha"])->format('d/m/Y') }}
                </td>
            </tr>
            <tr style="text-align: left;">
                <td colspan="12">
                    <label for="">Resultado: </label> {{$aptitud["aptitud_laboral"]}}
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
                <td colspan="6"> {{$aptitud["preexistencias"]}}</td>
                <td colspan="6"> {{$aptitud["observaciones"]}}</td>
            </tr>
        </table>
        <!-- DECLARACION DE RIESGOS -->
        <table class="table table-condensed table-hover" >
            <tr>
                <td style="text-align: center; background-color: brown; color: #FFFFFF;width: 710px" colspan="12">DECLARACION DE RIESGOS</td>
            </tr>
            @for ($i = 0; $i < strlen($aptitud["riesgos"]); $i++)
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
            @endfor
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
    </div>
</body>
</html>