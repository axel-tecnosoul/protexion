<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionInguinal extends Model
{

    public $timestamps=false;

    protected $fillable = [
        'pregunta1_in',
        'observacion1_in',
        'pregunta2_in',
        'observacion2_in',
        'pregunta3_in',
        'observacion3_in',
        'obervacion_in',
        'hc_formulario_id'
    ];


    protected $table = 'region_inguinales';

    public function hcFormulario()
    {
        return $this->belongsTo('App\HcFormulario');
    }


}
