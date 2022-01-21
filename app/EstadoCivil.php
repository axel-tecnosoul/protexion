<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    public $timestamps=false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'definicion', 'abreviatura',
    ];

    protected $table = 'estado_civiles';

       /*HAS es si tiene el id el otro
      BELONG es si el id lo tengo yo*/

    public function pacientes()
    {
        return $this->hasMany('App\Paciente');
    }
}
