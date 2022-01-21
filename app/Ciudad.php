<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Ciudad extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps=false;

    protected $fillable = ['nombre', 'codigo_postal','provincia_id'];

    protected $table = 'ciudades';

    public function declaracionesJuradas()
    {
        return $this->hasMany('App\DeclaracionJurada');
    }

    public function provincia()
    {
        return $this->belongsTo('App\Provincia');
    }

    public function domicilios()
    {
        return $this->hasMany('App\Domicilio');
    }
}
