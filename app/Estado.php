<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Estado extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps=true;

    protected $fillable = ['nombre'];

    protected $table = 'estados';

    public function personalClinicas()
    {
        return $this->hasMany('App\PersonalClinica');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function pacientes()
    {
        return $this->hasMany('App\Paciente');
    }

}