<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class Sexo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps=true;

    protected $fillable = [
        'definicion', 'abreviatura',
    ];

    protected $table = 'sexos';

    /*HAS es si tiene el id el otro
    BELONG es si el id lo tengo yo*/

    //Un sexo puede tener asociadas muchas personas
    public function personales()
    {
        return $this->hasMany('App\PersonalClinica');
    }

    public function pacientes()
    {
        return $this->hasMany('App\Paciente');
    }

    

}
