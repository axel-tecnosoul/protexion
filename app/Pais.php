<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Pais extends Model  implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps=false;

    protected $fillable = ['nombre'];

    protected $table = 'paises';
}
