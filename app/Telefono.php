<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Telefono extends Model  implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps=true;
    protected $table = 'telefonos';

    protected $fillable = ['numero', 'tipo_telefono_id', 'paciente_id'];

    public function tipoTelefono()
    {
        return $this->belongsToMany('App\TipoTelefono');
    }

    public function paciente()
    {
        return $this->belongsTo('App\Paciente');
    }

}
