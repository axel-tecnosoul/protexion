<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardiovascular extends Model
{

    public $timestamps=false;

    protected $fillable = [
        'frecuencia_cardiaca',
        'tension_arterial',
        'pulso',
        'varices',
        'observacion_varices',
        'hc_formulario_id'
    ];

    protected $table = 'cardiovasculares';

    public function hcFormulario()
    {
        return $this->belongsTo('App\HcFormulario');
    }


}
