<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoEstudio
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property Estudio[] $estudios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoEstudio extends Model
{
    
    static $rules = [
		'nombre' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estudios()
    {
        return $this->hasMany('App\Models\Estudio', 'tipo_estudio_id', 'id');
    }
    

}
