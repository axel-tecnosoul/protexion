<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ObraSocial extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $timestamps=true;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'definicion', 'abreviatura',
    ];

    protected $table = 'obra_sociales';

       /*HAS es si tiene el id el otro
      BELONG es si el id lo tengo yo*/

    public function pacientes()
    {
        return $this->hasMany('App\Paciente');
    }

    public function obraSocialCompleta()
    {
        return $this->abreviatura . " - " . $this->definicion;
    }
}
