<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    public $timestamps=false;

    protected $fillable = [
        'tiempo',
        'ciclo',
        'cargas',
        'pregunta1',
        'pregunta2',
        'pregunta3',
        'pregunta4',
        'pregunta5',
        'pregunta6',
        'pregunta7',
        'pregunta8',
        'observacion_tarea',
        'posiciones_forzada_id'
    ];


    protected $table = 'tareas';

    public function posicionesForzada()
    {
        return $this->belongsTo('App\PosicionesForzada');
    }


}
