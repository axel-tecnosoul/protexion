<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Especialidad extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'especialidades';

    protected $fillable = ['nombre',
        'puesto_id'
    ];

    public function personales()
    {
        return $this->hasMany('App\PersonalClinica');
    }

    public function puesto(){
        return $this->belongsTo('App\Puesto');
    }
}
