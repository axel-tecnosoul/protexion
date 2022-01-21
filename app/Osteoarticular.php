<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Osteoarticular extends Model
{
    public $timestamps=true;

    protected $table = 'osteoarticulares';


    protected $fillable = [
        'pregunta1_os',
        'observacion1_os',
        'pregunta2_os',
        'observacion2_os',
        'pregunta3_os',
        'observacion3_os',
        'pregunta4_os',
        'observacion4_os',
        'obervacion_os',
        'hc_formulario_id'
    ];

    public function hcFormulario()
    {
        return $this->belongsTo('App\HcFormulario');
    }
}
