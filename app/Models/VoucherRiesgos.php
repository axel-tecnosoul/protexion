<?php

namespace App\Models;

use App\Voucher;
use App\Riesgos;
use Illuminate\Database\Eloquent\Model;

class VoucherRiesgos extends Model
{
    protected $table = 'voucher_riesgos';

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function riesgo()
    {
        return $this->belongsTo(Riesgos::class);
    }

    /*public function archivo_adjunto()
    {
        return $this->hasMany('App\ArchivoAdjunto','voucher_estudio_id','id');
    }*/

    //---------------------------------------- Metodos ---------------------------------------//

    /*public function archivos()
    {   
        $archivos = [];
        foreach ($this->archivo_adjunto as $item) {
            $archivos[] = $item->anexo;
        }
        return $archivos;
    }*/
}
