<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ExamenClinico extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


    public $timestamps=true;

    protected $table = 'examen_clinicos';


    protected $fillable = [
        'peso',
        'estatura',
        'sobrepeso',
        'imc',
        'medicacion_actual',
        'hc_formulario_id'

    ];

    public function hcFormulario()
    {
        return $this->belongsTo('App\HcFormulario');
    }
}
