<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntecedenteMedicoInfancia extends Model
{
    public $timestamps=false;

    protected $fillable = [
        'sarampion',
        'rebeola',
        'epilepsia',
        'varicela',
        'parotiditis',
        'cefalea_prolongada',
        'hepatitis',
        'gastritis',
        'ulcera_gastrica',
        'hemorroide',
        'hemorragias',
        'neumonia',
        'asma',
        'tuberculosis',
        'tos_cronica',
        'catarro',
        'detalle1_m',
        'especificacion1_m',
        'declaracion_jurada_id'
    ];

    protected $table = 'antecedente_medico_infancias';

    public function declaracionJurada()
    {
        return $this->belongsTo('App\DeclaracionJurada');
    }
}
