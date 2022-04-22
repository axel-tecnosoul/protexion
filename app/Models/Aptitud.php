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
        return ['RIESGO COD. 01: Sin exposición a agentes o actividades de riesgo específicos.',
                'RIESGO COD. 02: Sustancias químicas (polvos, humos, vapores o gases).',
                'RIESGO COD. 03: Ruido.',
                'RIESGO COD. 04: Vibraciones transmitidas al cuerpo entero.',
                'RIESGO COD. 05: Vibraciones transmitidas a la extremidad superior.',
                'RIESGO COD. 06: Vibraciones transmitidas a la extremidad inferior.',
                'RIESGO COD. 07: Posiciones forzadas y gestos repetitivos.',
                'RIESGO COD. 08: Trabajo en altura.',
                'RIESGO COD. 09: Ingreso en espacios confinados.',
                'RIESGO COD. 10: Operación de vehículos motorizados.',
                'RIESGO COD. 11: Toxicológico.',
                'RIESGO COD. 12: Test Embarazo.',
                'RIESGO COD. 13: Docencia.',];
    }

}
