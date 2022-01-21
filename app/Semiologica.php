<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semiologica extends Model
{
    public $timestamps=false;

    protected $fillable = [
        'grado',
        'observacion1_s',
        'posiciones_forzada_id'
    ];


    protected $table = 'semiologicas';

    public function posicionesForzada()
    {
        return $this->belongsTo('App\PosicionesForzada');
    }


}
