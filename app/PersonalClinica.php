<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PersonalClinica extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps=true;

    protected $fillable = [
        'nombres',
        'apellidos',
        'documento',
        'nro_matricula',
        'fecha_nacimiento',
        'firma',
        'cuenta',
        'sexo_id',
        'especialidad_id',
        'estado_id'
    ];

    protected $table = 'personal_clinicas';

    /*HAS es si tiene el id el otro
    BELONG es si el id lo tengo yo*/

    public function nombreCompleto()
    {
        return $this->nombres . " " . $this->apellidos;
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function documentoCompleto()
    {
        return $this->documento;
    }

    public function sexoCompleto()
    {
        return $this->sexo->definicion . " (" . $this->sexo->abreviatura . ")";
    }

    public function sexo()
    {
        return $this->belongsTo('App\Sexo');
    }

    public function puesto()
    {
        return $this->belongsTo('App\Puesto');
    }

    public function especialidad(){
        return $this->belongsTo('App\Especialidad');
    }

    public function estado()
    {
        return $this->belongsTo('App\Estado');
    }

}
