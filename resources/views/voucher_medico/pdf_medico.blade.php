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
        .titulo{
            background-color: brown;
            color: white;
            font-weight: bold;
            font-size: 15px;
            text-align: center;
        }
        #content{
          /*width: 45%;
          height: 45%;
          border: solid 1px;*/
          padding: 5px;
        }
        #header{
          height: 40px;
        }
        .tabla {
            border-collapse: collapse;
            padding: 1%;
            width: 100%;
            font-size: 12px;
        }
        .tabla th, td{
          border: 1px solid black;
        }
    </style>

    <title>VISITA MEDICO</title>
</head>
<body style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 7px;">

    <div id="content" class="container">

        <div id="header">
            <span style="float:left">
                <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="100px">
            </span>
            <span style="float:right;font-size: 14px;"><?=date("d M Y")?></span>
        </div>
  
      <!-- <div id="header" style="text-align: right">
          <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
      </div> -->
      
      <div style="text-align: center; font-size: 20px;font-weight: bold; text-decoration: underline;">VISITA MEDICO</div>

      <div class="row" style="height: 45px;">
          <div style="float:left">
              <div class="added" style="font-size: 16px;">
                <p class="text-left"> <strong> Tipo de estudio:</strong> {{$tipo_estudio->nombre}} </p>
              </div>
          </div>
          <div style="float:right">
              <div class="added" style="font-size: 16px;">
                <p class="text-left"> <strong> Fecha:</strong> <?=date("d M Y",strtotime($fecha))?> </p>
              </div>
          </div>
      </div>

      <!-- <h3 class="titulo">{{ $fecha}}</h3> -->
      <div class="marco2">
        <table class="tabla">
          <thead style="background-color:#222D32">
              <tr class="text-uppercase">
                  <th width="30%" style="color:#F8F9F9" >Paciente</th>
                  <th width="70%" style="color:#F8F9F9" >Detalle</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($aPacientes as $paciente =>$estudios)
              <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                  <td style="text-align:left">{{ $paciente }}</td>
                  <td style="text-align:left"><?=implode(", ",$estudios)?></td>
              </tr>
              @endforeach
          </tbody>
      </table>

  </div>

</body>
</html>