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
            font-size: 10px;
            font-weight: bold;
        }
        .datos{
            font-size: 10px;
        }
    </style>

    <title>VOUCHER PACIENTE</title>
</head>
<body style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 7px;">

    <div id="content" class="container">
        <div id="header" style="text-align: right">
            <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
        </div>
        <div style="text-align: center; font-size: 20px;font-weight: bold; text-decoration: underline;">VOUCHER PACIENTE</div>
           
    </div> 
    @foreach ($tipo_estudios as $tipo)
        @if ($tipo->id != 2)
        <div hidden style="color: white">{{$i = -1}}</div>
        <div class="marco">
            <table class="tabla">
                <tbody>
                    @foreach ($voucher->vouchersEstudios as $item)
                    {{$cont++}}
                    @if (($tipo->id == 3) || ($tipo->id == 4) )
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
                    @else
                        @if ($tipo->nombre == strtoupper($item->estudio->nombre))
                            <tr><td>{{ $tipo->nombre}}</td></tr>
                        @endif  
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    @endforeach
</body>
</html>