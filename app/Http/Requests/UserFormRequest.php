<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'apellido'  => 'required',
            'name'      => 'required',
            'dni'       => 'required',
            'domicilio' => 'required',
            'password'  => 'required',
            'email'     => 'required',
            'telefono'  => 'required',
            'fecha_nac' => 'required',
            'cuit'      => 'required',
            'sexo_id'   => 'required',

        ];
    }

    public function messages()
    {
        return [
            'apellido.required'     =>  'El apellido de la persona es requerido',
            'name.required'         =>  'El nombre de la persona es requerido',
            'dni.required'          =>  'La descripcion de la persona es requerido',
            'password.required'     =>  'La contraseña de la persona es requerida',
            'domicilio.required'    =>  'El domicilio de la persona es requerido',
            'email.required'        =>  'El email de la persona es requerido',
            'telefono.required'     =>  'El telefono de la persona es requerido',
            'fecha_nac.required'    =>  'La fechad de nacimiento de la persona es requerido',
            'cuit.required'         =>  'El cuit de la persona es requerido',
            'sexo_id.required'      =>  'El sexo de la persona es requerido',
            'rol_id.required'       =>  'El rol de la personsa es requerido',



        ];
    }
}
