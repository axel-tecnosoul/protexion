<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntecedenteFamiliar extends Model
{
    public $timestamps=false;

    protected $fillable = [
        'su_padre_vive',
        'su_madre_vive',
        'cancer',
        'diabetes',
        'infarto',
        'hipertension_Arterial',
        'observacion',
        'declaracion_jurada_id'
    ];

    protected $table = 'antecedente_familiares';

    public function declaracionJurada()
    {
        return $this->belongsTo('App\DeclaracionJurada');
    }
}
