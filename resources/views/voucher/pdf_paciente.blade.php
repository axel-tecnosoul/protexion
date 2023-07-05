<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        #content{
          width: 45%;
          height: 45%;
          border: solid 1px;
          padding: 5px;
        }
        #header{
          height: 40px;
        }
        .marco{
            border: rgb(0, 0, 0) 1px solid;
        }
        .tabla {
            border-collapse: collapse;
            padding: 1%;
        }
    </style>

    <title>VISITA PACIENTE</title>
</head>
<body style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 7px;">

    <div id="content" class="container">
        
        <div id="header">
            <span style="float:left">
                <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="100px">
            </span>
            <span style="float:right"><?=date("d M Y")?></span>
        </div>
        
        <div style="text-align: center;font-size: 16px;font-weight: bold; text-decoration: underline;">VISITA PACIENTE</div>

        <div class="row">
            <div class="col-12">
                <div class="added" style="font-size: 14px;">
                  <div style="margin-top:10px" class="text-left"> <strong> Nombre:</strong> {{$voucher->paciente->nombreCompleto()}} </div>
                  <div style="margin-top:10px" class="text-left"> <strong> Turno:</strong> <?=date("d M Y",strtotime($voucher->turno))?></div>
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
           
    
    <ul style="font-size: 12px;">
      <!-- @foreach ($tipo_estudios as $tipo)
          @if ($tipo->id != 2)
              @foreach ($voucher->vouchersEstudios as $item)
                  @if (($tipo->id == 3) || ($tipo->id == 4) )
                      @if ($item->estudio->tipo_estudio_id == $tipo->id and $item->estudio->id!=73)
                          <li>{{strtoupper($item->estudio->nombre)}}.</li>
                      @endif
                  @else
                      @if ($tipo->nombre == strtoupper($item->estudio->nombre))
                          <li>{{ $tipo->nombre}}</li>
                      @endif  
                  @endif
              @endforeach
          @else
              <li>ANALISIS BIOQUIMICO</li>
          @endif
      @endforeach -->
      @foreach ($aVoucherPaciente as $estudio)
          <li>{{strtoupper($estudio)}}.</li>
      @endforeach
    </ul>
    <!-- @foreach ($tipo_estudios as $tipo)
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
    @endforeach -->
    </div>
</body>
</html>