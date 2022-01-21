<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aptitud extends Model
{
    protected $fillable = [ 'voucher_id'
                          ];

    public function voucher()
    {
        return $this->hasOne('App\Voucher', 'id', 'voucher_id');
    }

    public function riesgos(){
        return ['RIESGO COD. 01: SIN EXPOSICIÓN A AGENTES O ACTIVIDADES DE RIESGO ESPECÍFICOS.',
                'RIESGO COD. 02: SUSTANCIAS QUÍMICAS (POLVOS, HUMOS, VAPORES O GASES).',
                'RIESGO COD. 03: RUIDO.',
                'RIESGO COD. 04: VIBRACIONES TRANSMITIDAS AL CUERPO ENTERO.',
                'RIESGO COD. 05: VIBRACIONES TRANSMITIDAS A LA EXTREMIDAD SUPERIOR.',
                'RIESGO COD. 06: VIBRACIONES TRANSMITIDAS A LA EXTREMIDAD INFERIOR.',
                'RIESGO COD. 07: POSICIONES FORZADAS Y GESTOS REPETITIVOS.',
                'RIESGO COD. 08: TRABAJO EN ALTURA.',
                'RIESGO COD. 09: INGRESO EN ESPACIOS CONFINADOS.',
                'RIESGO COD. 10: OPERACIÓN DE VEHÍCULOS MOTORIZADOS.',];
    }

}
