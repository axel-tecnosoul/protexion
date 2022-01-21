<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neurologico extends Model
{
    public $timestamps=false;

    protected $fillable = [
        'pregunta1_neu',
        'observacion1_neu',
        'pregunta2_neu',
        'observacion2_neu',
        'pregunta3_neu',
        'observacion3_neu'.
        'pregunta4_neu',
        'observacion4_neu',
        'pregunta5_neu',
        'observacion5_neu',
        'pregunta6_neu',
        'observacion6_neu',
        'pregunta7_neu',
        'observacion7_neu',
        'observacion_neu',
        'hc_formulario_id'
    ];




    protected $table = 'neurologicos';

    public function hcFormulario()
    {
        return $this->belongsTo('App\HcFormulario');
    }
}
