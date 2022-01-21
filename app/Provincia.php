<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Provincia extends Model  implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps=false;

    protected $fillable = ['nombre','pais_id'];

    protected $table = 'provincias';

    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }
}
