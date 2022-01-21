<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTelefono extends Model
{
    public $timestamps=true;
    protected $table = 'tipo_telefonos';

    protected $fillable = ['tipo'];


    public function telefonos()
    {
        return $this->hasMany('App\Telefono');
    }
}
