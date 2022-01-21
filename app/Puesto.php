<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Puesto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps=false;

    protected $fillable = ['nombre'];

    public function personales()
    {
        return $this->hasMany('App\PersonalClinica');
    }

}
