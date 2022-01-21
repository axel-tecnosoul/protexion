<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Domicilio extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps=true;

    protected $fillable = [
        'direccion',
        'ciudad_id'
        ];

    protected $table = 'domicilios';

    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }

    /*public function direccion()
    {
        return $this->altura . " " . $this->calle->nombre . " " . $this->calle->barrio->nombre;
    }*/

    public function origen()
    {
        return $this->hasOne('App\Origen');
    }
}
