<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CabezaCuello extends Model
{
    public $timestamps=true;

    protected $fillable = [
        'pregunta1_cc',
        'observacion1_cc',
        'pregunta2_cc',
        'observacion2_cc',
        'pregunta3_cc',
        'observacion3_cc',
        'pregunta4_cc',
        'observacion4_cc',
        'pregunta5_cc',
        'observacion5_cc',
        'pregunta6_cc',
        'observacion6_cc',
        'hc_formulario_id'

    ];




    protected $table = 'cabeza_cuellos';

    public function hcFormulario()
    {
        return $this->belongsTo('App\HcFormulario');
    }
}
