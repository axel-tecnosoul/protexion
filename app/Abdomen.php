<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abdomen extends Model
{
    public $timestamps=false;

    protected $fillable = [
        'pregunta1_ab',
        'observacion1_ab',
        'pregunta2_ab',
        'observacion2_ab',
        'pregunta3_ab',
        'observacion3_ab',
        'pregunta4_ab',
        'observacion4_ab',
        'pregunta5_ab',
        'observacion5_ab',
        'pregunta6_ab',
        'observacion6_ab',
        'obervacion_ab',
        'hc_formulario_id'
    ];


    protected $table = 'abdomenes';

    public function hcFormulario()
    {
        return $this->belongsTo('App\HcFormulario');
    }
}
