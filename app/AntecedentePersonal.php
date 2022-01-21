<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntecedentePersonal extends Model
{
protected $fillable = [
    'fuma',
    'bebe',
    'actividad_fisica',
    'detalle1_p',
    'especificacion1_p',
    'detalle2_p',
    'especificacion2_p',
    'detalle3_p',
    'especificacion3_p',
    'declaracion_jurada_id'

];

protected $table = 'antecedente_personales';

public function declaracionJurada()
{
    return $this->belongsTo('App\DeclaracionJurada');
}

}
