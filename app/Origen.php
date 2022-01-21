<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Origen extends Model  implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps=true;

    protected $fillable = [
        'definicion',
        'cuit',
        'domicilio_id'
    ];

    protected $table = 'origenes';

    public function domicilio()
    {
        return $this->belongsTo('App\Domicilio');
    }

    public function pacientes()
    {
        return $this->hasMany('App\Paciente');
    }
}
