<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TipoSangre extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps=false;

    protected $fillable = [
        'sangre'
    ];

    protected $table = 'tipo_sangres';



}
