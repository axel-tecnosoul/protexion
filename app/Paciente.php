<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
//use Illuminate\Database\Eloquent\SoftDeletes;
class Paciente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    //use SoftDeletes;

    public $timestamps=true;

    protected $fillable = [
        'documento',
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'cuil',
        'ciudad_id',
        'origen_id',
        'telefono',
        'sexo_id',
        'estado_civil_id',
        'estado_id',
        'obra_social_id',
        'domicilio_id',
        'historia_clinica',
        'peso',
        'estatura',
        'imagen'

    ];

    protected $table = 'pacientes';

    public function nombreCompleto()
    {
        return $this->nombres . " " . $this->apellidos;
    }

    public function estado()
    {
        return $this->belongsTo('App\Estado');
    }

    public function origen()
    {
        return $this->belongsTo('App\Origen');
    }

    public function sexo()
    {
        return $this->belongsTo('App\Sexo');
    }

    public function obraSocial()
    {
        return $this->belongsTo('App\ObraSocial');
    }

    public function estadoCivil()
    {
        return $this->belongsTo('App\EstadoCivil');
    }

    public function documentoIdentidad()
    {
        return $this->documento;
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }

    public function lugarNacimiento()
    {
        return $this->ciudad->nombre . ", " . $this->ciudad->provincia->nombre . ", " . $this->ciudad->provincia->pais->nombre;
    }

    public function fecha_nacimiento()
    {   
        $fecha = new Carbon($this->fecha_nacimiento);
        return $fecha->format('d/m/Y');
    }

    public function edad(){
        $edad = new Carbon($this->fecha_nacimiento);
        return $edad->diffInYears();
    }

    public function domicilio()
    {
        return $this->belongsTo('App\Domicilio');
    }

    public function direccion()
    {
        return $this->domicilio->direccion;
    }

    /*public function direccionHastaBarrio()
    {
        return $this->domicilio->altura . " " . $this->domicilio->piso . ", " .  $this->domicilio->calle->nombre . ", " . $this->domicilio->calle->barrio->nombre;
    }*/



    public function telefono()
    {
        return $this->hasOne('App\Telefono');
    }

    //hacerlo volar despues
    public function declaracionesJuradas()
    {
        return $this->hasMany('App\DeclaracionJurada');
    }

    public function historiaClinica()
    {
        return $this->hasOne('App\HistoriaClinica');
    }

    public function posicionesForzada()
    {
        return $this->hasOne(PosicionesForzada::class);
    }

    public function existeReferencia()
    {

        $voucher = Voucher::wherePaciente_id($this->id)->count();

        if($voucher > 0) //existe referencia
        {
            return "Advertencia el paciente tiene $voucher estudios realizados en la clínica"; //existe referencia
        }
        else
        {
            return "El paciente no tiene estudios asociada a la clinica";//no existe referencia
        }
        //referencia para saber si el paciente tiene Declaracion Jurada asociada
        //$refDeclaracion = DeclaracionJurada::wherePaciente_id($this->id)->count();

        //referencia para saber si el paciente tiene Historia Clinica asociada
        //$refHistoria = HistoriaClinica::wherePaciente_id($this->id)->count();

      /*  if($refDeclaracion > 0 || $refHistoria > 0) //existe referencia
        {
            return "Advertencia el paciente tiene $refDeclaracion declaracion jurada y $refHistoria historia clinica"; //existe referencia
        }
        else
        {
            return "El paciente no tiene documentacion asociada a la clinica";//no existe referencia
        }*/

    }


    public function vouchers()
    {
        return $this->hasMany('App\Voucher');
    }

}
