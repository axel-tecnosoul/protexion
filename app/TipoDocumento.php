<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TipoDocumento extends Model implements Auditable
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

    protected $table = 'tipo_documentos';

       /*HAS es si tiene el id el otro
      BELONG es si el id lo tengo yo*/

    public function personal_clinicas()
    {
        return $this->hasMany('App\PersonalClinica');
    }

    public function documento()
    {
        return $this->abreviatura . " - " . $this->definicion;
    }


}
