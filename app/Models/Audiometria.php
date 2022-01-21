<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Audiometria
 *
 * @property $id
 * @property $archivo
 * @property $voucher_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Voucher $voucher
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Audiometria extends Model
{
    
    static $rules = [
		'voucher_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['archivo','voucher_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function voucher()
    {
        return $this->hasOne('App\Voucher', 'id', 'voucher_id');
    }
    

}
