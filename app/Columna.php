<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Columna extends Model
{


    public $timestamps=false;

    protected $fillable = [
        'pregunta1_col',
        'observacion1_col',
        'pregunta2_col',
        'observacion2_col',
        'pregunta3_col',
        'observacion3_col'.
        'pregunta4_col',
        'observacion4_col',
        'obervacion_col',
        'hc_formulario_id'
    ];

    protected $table = 'columnas';


    public function hcFormulario()
    {
        return $this->belongsTo('App\HcFormulario');
    }


}
