<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oftalmologico extends Model
{
    public $timestamps=false;

    protected $fillable = [
        'pregunta1_of',
        'observacion1_of',
        'pregunta2_of',
        'observacion2_of',
        'pregunta3_of',
        'observacion3_of'.
        'pregunta4_of',
        'observacion4_of',
        'pregunta5_of',
        'observacion5_of',
        'pregunta6_of',
        'observacion6_of',
        'obervacion_of',
        'pregunta7_of',
        'hc_formulario_id'
    ];




    protected $table = 'oftalmologicos';

    public function hcFormulario()
    {
        return $this->belongsTo('App\HcFormulario');
    }
}
