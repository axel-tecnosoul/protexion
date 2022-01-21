<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivoAdjunto extends Model
{
    public function voucher_estudio()
    {
        return $this->belongsTo('App\Models\VouchersEstudio', 'id', 'voucher_estudio_id');
    }
}
