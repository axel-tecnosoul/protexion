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
            padding: 1%;
        }
        .titulo{
            background-color: brown;
            color: white;
            font-weight: bold;
            font-size: 15px;
            text-align: center;
        }
        .subtitulo{
            font-weight: bold;
            font-size: 20px;
        }
        .campos{
            font-size: 8px;
            font-weight: bold;
        }
        .datos{
            font-size: 8px;
        }
    </style>

    <title>VOUCHER MEDICO</title>
</head>
<body style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 7px;">

    <div id="header" style="text-align: right">
        <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
    </div>
    
    <div style="text-align: center; font-size: 20px;font-weight: bold; text-decoration: underline;">VOUCHER MEDICO</div>

    <div class="row">
        <div class="col-12">
            <div class="added" style="font-size: 20px;">
              <p class="text-left"> <strong> Nombre completo:</strong> {{$voucher->paciente->nombreCompleto()}} </p>
              <!-- <p style="font-size:100%" class="text-left"> <strong> CUIL:               </strong> {{$voucher->paciente->cuil                         }} </p>
              <p style="font-size:100%" class="text-left"> <strong> Fecha de nacimiento:</strong> {{$voucher->paciente->fecha_nacimiento()           }} </p> 
              <p style="font-size:100%" class="text-left"> <strong> Edad:               </strong> {{$voucher->paciente->edad()                       }} </p>
              <p style="font-size:100%" class="text-left"> <strong> Domicilio:          </strong> {{$voucher->paciente->domicilio ? $voucher->paciente->domicilio->direccion : " "        }} </p>
              <p style="font-size:100%" class="text-left"> <strong> Sexo:               </strong> {{$voucher->paciente->sexo ? $voucher->paciente->sexo->definicion : " "                 }} </p>
              <p style="font-size:100%" class="text-left"> <strong> Origen:             </strong> {{$voucher->origen ? $voucher->origen->definicion : " "             }} </p>
              <p style="font-size:100%" class="text-left"> <strong> Cuit de origen:     </strong> {{$voucher->origen ? $voucher->origen->cuit : " "                   }} </p>      
              <p style="font-size:100%" class="text-left"> <strong> Turno:              </strong> {{$voucher->turno ? \Carbon\Carbon::parse($voucher->turno)->format('d/m/Y') : " "                   }} </p>       -->
            </div>
        </div>
    </div>

    @foreach ($tipo_estudios as $tipo)
    <div hidden style="color: white">{{$i = -1}}</div>
    <h3 class="titulo">{{ $tipo->nombre}}</h3>
    <div class="marco">
        <table class="tabla">
            <tbody>
                @foreach ($voucher->vouchersEstudios as $item)
                {{$cont++}}
                    @if ($item->estudio->tipo_estudio_id == $tipo->id)
                        {{$i++}} 
                        @if ($i%3 == 0)
                            <tr>
                        @endif
                        <td style="width: 240px">{{strtoupper($item->estudio->nombre)}}.  </td>
                        @if ($i%3 == 2/3)
                            </tr>
                        @endif
                    @endif
                    @if ($cont == sizeof($voucher->vouchersEstudios))
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
</body>
</html>