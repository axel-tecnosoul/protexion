<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genital extends Model
{
    public $timestamps=false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pregunta1_ge',
        'observacion1_ge',
        'observacion_ge',
        'hc_formulario_id'

    ];


    protected $table = 'genitales';

    public function hcFormulario()
    {
        return $this->belongsTo('App\HcFormulario');
    }
}
