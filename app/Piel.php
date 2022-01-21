<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piel extends Model
{

    public $timestamps=true;

    protected $table = 'pieles';

    protected $fillable = [
        'pregunta1_piel',
        'observacion1_piel',
        'vesicula',
        'obs_vesicula',
        'ulceras',
        'obs_ulceras',
        'fisuras',
        'obs_fisuras',
        'prurito',
        'obs_prurito',
        'eczemas',
        'obs_eczemas',
        'dertmatitis',
        'obs_dertmatitis',
        'eritemas',
        'obs_eritemas',
        'petequias',
        'obs_petequias',
        'tejido',
        'hc_formulario_id'
    ];

    public function hcFormulario()
    {
        return $this->belongsTo('App\HcFormulario');
    }

}
