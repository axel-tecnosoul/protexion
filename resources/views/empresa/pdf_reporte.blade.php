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
        .table {
            border-collapse: collapse;
            padding: 1%;
            width: 100%;
            font-size: 12px;
        }
        .table th, td{
          border: 1px solid black;
        }
        footer {
          position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px;
        }
        #footer {
          position: fixed;
          left: 0;
          right: 0;
          /*color: #aaa;*/
          color: #4d4d4d;
          /*font-size: 1em;*/
          bottom: 0;
          border-top: 0.1pt solid #aaa;
          text-align: right;
        }
        .page-number {
          text-align: center;
        }
        .page-number:before {
          content: "Pagina " counter(page);
        }
    </style>

    <title>Resumen empresarial</title>
</head>
<body style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 7px;">

    <div id="content" class="container">

        <div id="header">
            <span style="float:left">
                <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="100px">
            </span>
            <span style="float:right;font-size: 14px;"><?=date("d M Y")?></span>
        </div>

        <div id="footer">
            <div class="page-number"></div>
            <!-- <span class="page-number">Page <script type="text/php">echo $PAGE_NUM;</script></span> -->
          <!-- <span>
            PROTEXIÓN "CENTRO MÉDICO LABORAL"<br>
            Av. San Martín 1400- Puerto Rico,  Misiones - CP 3334
            Tel. (03743) 476272 - Whatsapp: (03743) 483004<br>
            E-mail: info@protexionpr.com.ar; gerencia@protexionpr.com.ar<br>
          </span> -->
        </div>
  
      <!-- <div id="header" style="text-align: right">
          <img src="{{public_path('imagenes/logo.png')}}" alt="logo" width="200px">
      </div> -->
      
      <div style="text-align: center; font-size: 20px;font-weight: bold; text-decoration: underline;">Resumen empresarial</div>

      <div class="marco2">
        <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
            <thead style="background-color: brown; color: #FFFFFF;font-weight: bold;">
                <tr class="text-uppercase">
                    <th colspan="5" style="color:#F8F9F9" >DATOS DE EMPRESA</th>
                </tr>
                <tr class="text-uppercase">
                    <th width="20%" style="color:#F8F9F9">Razon social</th>
                    <th width="10%" style="color:#F8F9F9">CUIT</th>
                    <th width="30%" style="color:#F8F9F9">Domicilio</th>
                    <th width="20%" style="color:#F8F9F9">Localidad</th>
                    <th width="20%" style="color:#F8F9F9">Provincia</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align:left">{{$empresa->definicion}}</td>
                    <td style="text-align:left"><?=$empresa->cuit?></td>
                    <td style="text-align:left"><?php
                        if(isset($empresa->domicilio->direccion)){
                            echo $empresa->domicilio->direccion;
                        }?>
                    </td>
                    <td style="text-align:left"><?php
                        if(isset($empresa->domicilio->ciudad)){
                          echo $empresa->domicilio->ciudad->nombre;
                        }?>
                    </td>
                    <td style="text-align:left"><?php
                        if(isset($empresa->domicilio->ciudad->provincia)){
                          echo $empresa->domicilio->ciudad->provincia->nombre;
                        }
                    ?></td>
                </tr>
            </tbody>
        </table>
      </div>
                        
      <div class="marco2">
        <table id="tablaDetalle" style="width:100%" class="table table-condensed table-hover">
            <thead style="background-color: brown; color: #FFFFFF;font-weight: bold; border:0px solid brown;">
                <tr class="text-uppercase">
                    <th colspan="6" style="color:#F8F9F9" >INFORME FINAL EXAMENES PREOCUPACIONALES</th>
                </tr>
                <tr class="text-uppercase">
                    <th width="7%" style="color:#F8F9F9" >Fecha</th>
                    <th width="8%" style="color:#F8F9F9" >Paciente</th>
                    <th width="9%" style="color:#F8F9F9" >CUIL/DNI</th>
                    <th width="11%" style="color:#F8F9F9" >Resultado</th>
                    <th width="25%" style="color:#F8F9F9" >Preexistencias</th>
                    <th width="40%" style="color:#F8F9F9" >Observaciones</th>
                </tr>
            </thead>
            <tbody style="border:1px solid black;">
                @foreach ($datos as $key =>$informe)<?php
                    $documento="";
                    if($informe->documento) $documento=number_format( (intval($informe->documento)/1000), 3, '.', '.');
                    if($informe->cuil) $documento=$informe->cuil;?>
                    <tr>
                        <td style="text-align:center">{{\Carbon\Carbon::parse($informe->turno)->format('d/m/Y')}}</td>
                        <td style="text-align:center"><?=$informe->apellidos." ".$informe->nombres?></td>
                        <td style="text-align:center"><?=$documento?></td>
                        <td style="text-align:center"><?=$informe->aptitud_laboral?></td>
                        <td style="text-align:center"><?=$informe->preexistencias?></td>
                        <td style="text-align:left"><?=$informe->observaciones?></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>

    </div>

</body>
</html>