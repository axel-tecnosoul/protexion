<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Estudio
 *
 * @property $id
 * @property $nombre
 * @property $tipo_estudio_id
 * @property $created_at
 * @property $updated_at
 *
 * @property TipoEstudio $tipoEstudio
 * @property VouchersEstudio[] $vouchersEstudios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Estudio extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'tipo_estudio_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','carga','tipo_estudio_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipoEstudio()
    {
        return $this->hasOne('App\Models\TipoEstudio', 'id', 'tipo_estudio_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vouchersEstudios()
    {
        return $this->hasMany('App\Models\VouchersEstudio', 'estudio_id', 'id');
    }
    

}
