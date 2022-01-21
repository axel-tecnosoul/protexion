<?php

use Illuminate\Database\Seeder;
use App\Paciente;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paciente::create([
            'documento'         =>  '22543123',
            'nombres'           =>  'Maria Luciana',
            'apellidos'         =>  'Gonzales',
            'fecha_nacimiento'  =>  '1989-07-11',
            'cuil'              =>  '33-1232141-11',
            'ciudad_id'         =>  1, //nacio en Posadas Posadas
            'origen_id'         =>  1, //Agricultores S.A
            'sexo_id'           =>  1, //Femenino
            'domicilio_id'      =>  1, //altura 2000 	piso2, barrio 25 de Mayo, Posadas, Misiones, Argentina
            'obra_social_id'    =>  1, //IPS
            'estado_civil_id'   =>  1,  //Soltero
            'peso'              =>  69,
            'estatura'          =>  1.64,
            'telefono'          =>  '3764-44345876',
            'estado_id'         =>  1,  //Habilitado

        ]);

        Paciente::create([
            'documento'         =>  '24354654',
            'nombres'           =>  'Miguel',
            'apellidos'         =>  'Sanchez',
            'fecha_nacimiento'  =>  '1976-05-12',
            'cuil'              =>  '22-1235171-11',
            'ciudad_id'         =>  1, //nacio en Posadas Posadas
            'origen_id'         =>  2, //Seguros Campana
            'sexo_id'           =>  2, //Masculino
            'domicilio_id'      =>  2, //altura 654 	piso2,  barrioA-32, Posadas, Misiones, Argentina
            'obra_social_id'    =>  2, //OSUTHGRA
            'estado_civil_id'   =>  2,  //Casado
            'peso'              =>  74,
            'estatura'          =>  1.87,
            'telefono'          =>  '3768-44344866',
            'estado_id'         =>  1,  //Habilitado

        ]);

        Paciente::create([
            'documento'         =>  '23574612',
            'nombres'           =>  'Marta',
            'apellidos'         =>  'Serralima',
            'fecha_nacimiento'  =>  '1988-02-12',
            'cuil'              =>  '22-6532111-11',
            'ciudad_id'         =>  1, //nacio en Posadas Posadas
            'origen_id'         =>  2, //Seguros Campana
            'sexo_id'           =>  1,
            'domicilio_id'      =>  6, //
            'obra_social_id'    =>  2, //
            'estado_civil_id'   =>  2,  //Casada
            'peso'              =>  55,
            'estatura'          =>  1.45,
            'telefono'          =>  '3764-43756686',
            'estado_id'         =>  1,  //Habilitado


        ]);

        Paciente::create([
            'documento'         =>  '34657432',
            'nombres'           =>  'Carla',
            'apellidos'         =>  'Peterson',
            'fecha_nacimiento'  =>  '1974-02-12',
            'cuil'              =>  '21-6531214-12',
            'ciudad_id'         =>  1, //nacio en Posadas Posadas
            'origen_id'         =>  2, //Seguros Campana
            'sexo_id'           =>  1,
            'domicilio_id'      =>  6, //
            'obra_social_id'    =>  2, //
            'estado_civil_id'   =>  2,  //Casada
            'peso'              =>  50,
            'estatura'          =>  1.69,
            'telefono'          =>  '3764-43552616',
            'estado_id'         =>  1,  //Habilitado


        ]);

    }
}
