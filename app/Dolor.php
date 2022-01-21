<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dolor extends Model
{
    public $timestamps=false;

    protected $fillable = [
        'forma',
        'evolucion',
        'observacion1_d',
        'observacion2_d',
        'pregunta1_d',
        'pregunta2_d',
        'pregunta3_d',
        'pregunta4_d',
        'pregunta5_d',
        'posiciones_forzada_id'
    ];


    protected $table = 'dolores';

    public function posicionesForzada()
    {
        return $this->belongsTo('App\PosicionesForzada');
    }
}
