<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntecedenteReciente extends Model
{
    protected $fillable = [
       
        'pregunta1_reciente',
        'detalle1_reciente',
        'especificacion1_reciente',

        'pregunta2_reciente',
        'detalle2_reciente',
        'especificacion2_reciente',

        'pregunta3_reciente',
        'detalle3_reciente',
        'especificacion3_reciente',

        'pregunta4_reciente',
        'detalle4_reciente',
        'especificacion4_reciente',

        'pregunta5_reciente',
        'detalle5_reciente',
        'especificacion5_reciente',

        'pregunta6_reciente',
        'detalle6_reciente',
        'especificacion6_reciente',

        'pregunta7_reciente',
        'detalle7_reciente',
        'especificacion7_reciente',

        'pregunta8_reciente',
        'detalle8_reciente',
        'especificacion8_reciente',

        'pregunta9_reciente',
        'detalle9_reciente',
        'especificacion9_reciente',

        'pregunta10_reciente',
        'detalle10_reciente',
        'especificacion10_reciente',

        'pregunta11_reciente',
        'detalle11_reciente',
        'especificacion11_reciente',

        'pregunta12_reciente',
        'detalle12_reciente',
        'especificacion12_reciente',

        'pregunta13_reciente',
        'detalle13_reciente',
        'especificacion13_reciente',

        'pregunta14_reciente',
        'detalle14_reciente',
        'especificacion14_reciente',

        'declaracion_jurada_id'
    ];

    protected $table = 'antecedente_recientes';

    public function declaracionJurada()
    {
        return $this->belongsTo('App\DeclaracionJurada');
    }
}
