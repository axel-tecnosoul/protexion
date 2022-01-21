<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionAnal extends Model
{
    public $timestamps=false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pregunta1_an',
        'observacion1_an',
        'observacion_an',
        'hc_formulario_id'

    ];


    protected $table = 'region_anales';

    public function hcFormulario()
    {
        return $this->belongsTo('App\HcFormulario');
    }
}
