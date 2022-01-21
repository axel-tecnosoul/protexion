<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntecedenteQuirurjico extends Model
{
    protected $fillable = [
        'pregunta1_q',
        'detalle1_q',
        'especificacion1_q',
        'pregunta2_q',
        'detalle2_q',
        'pregunta3_q',
        'detalle3_q',
        'especificacion3_q',
        'declaracion_jurada_id'
    ];

    protected $table = 'antecedente_quirurjicos';

    public function declaracionJurada()
    {
        return $this->belongsTo('App\DeclaracionJurada');
    }
}
