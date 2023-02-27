<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Empresa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps=false;

    protected $fillable = ['definicion', 'cuit'];

    protected $table = 'origenes';

    public function domicilio()
    {
        return $this->hasOne('App\Domicilio', 'id', 'domicilio_id');
    }

}
