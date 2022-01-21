<!-- Recibe como parametro $cuadro, $articulaciones, $posiciones_forzadas -->

<style>
    .tabla {
        border-collapse: collapse;
    }
    .tabla th, .tabla td {
        border: rgb(0, 0, 0) 1px solid;
    }
    tbody td {
        text-align: center;
    }
    tfoot th {
        text-align: right;
    }
    .letra11{ 
        font-size: 12px;
    }
    .subtitulo{
        font-weight: bold;
        font-size: 12px;
        background-color: brown;
        color: white;
        text-align: center;
    }
    label{
        font-weight: bold;
    }
    .hidden{
        display: none;
    }

</style>

<p class="subtitulo">Semiología del Segmento Corporal Comprometido-Relación Movilidad-Dolor Articular y estado de M.M </p>
<div style="padding-left: 5%; padding-top: 1%" >
    <table class="tabla" style="font-size: 10px">
        <!-- Titulos -->
            <thead>
                <tr>
                    <th scope="col" colspan="2">Articulación</th>
                    <th style="width: 60px">Abduc.</th>
                    <th style="width: 60px">Adduc.</th>
                    <th style="width: 60px">Flexión</th>
                    <th style="width: 60px">Extens.</th>
                    <th style="width: 60px">Rot. Externa</th>
                    <th style="width: 60px">Rot. Interna</th>
                    <th style="width: 60px">Irradiac.</th>
                    <th style="width: 60px">Alt. M. Muscular</th>
                </tr>
            </thead>
        <!-- / Titulos -->
        <tbody>
            @foreach ($articulaciones as $art)
                <!-- Iteración izquierda o derecha -->
                @for ($i = 0; $i < 2; $i++)
                    @if ($i == 0)
                    <tr>
                        <th scope="row" rowspan="2">{{$art}}</th>
                        <td>Der.</td>
                    @else
                    <tr>
                        <td>Izq.</td>
                    @endif
                    <!-- Iteración por cada cuadro -->
                    @for ($j = $cuadro; $j < $cuadro+8; $j++)
                        @if ($posiciones_forzada->dolor_articular[$j])
                            <td style="text-align: center">x</td>
                        @else
                            <td style="text-align: center"></td>
                        @endif
                    @endfor
                    <div class="hidden"> {{$cuadro = $cuadro + 8}} </div>
                </tr>
                @endfor
            @endforeach 
        </tbody>
    </table>
</div>