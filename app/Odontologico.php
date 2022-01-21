<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Odontologico extends Model
{
    public $timestamps=false;

    protected $fillable = [
        'pregunta1_od',
        'observacion1_od',
        'pregunta2_od',
        'observacion2_od',
        'pregunta3_od',
        'pregunta4_od',
        'pregunta5_od',
        'observacion_od',
        'superior',
        'inferior',
        'hc_formulario_id'
    ];



    protected $table = 'odontologicos';

    public function hcFormulario()
    {
        return $this->belongsTo('App\HcFormulario');
    }
}
