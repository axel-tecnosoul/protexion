<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respiratorio extends Model
{
    public $timestamps=true;

    protected $table = 'respiratorios';

    protected $fillable = [
        'pregunta1_re',
        'observacion1_re',
        'pregunta2_re',
        'observacion2_re',
        'hc_formulario_id'
    ];

    public function hcFormulario()
    {
        return $this->belongsTo('App\HcFormulario');
    }
}
