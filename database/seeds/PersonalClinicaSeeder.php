<?php

use Illuminate\Database\Seeder;
use App\PersonalClinica;

class PersonalClinicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        PersonalClinica::create([
            'nombres'               =>  'Admin',
            'apellidos'             =>  'Administrador',
            'documento'             =>  '00000000',
            'fecha_nacimiento'      =>  '1974-09-15',
            'cuenta'                =>  true,
            'sexo_id'               =>  2,
            'puesto_id'             =>  1,
            'estado_id'             =>  2,
        ]);

        PersonalClinica::create([
            'nombres'               =>  'Axel',
            'apellidos'             =>  'Britzius',
            'documento'             =>  '22063440',
            'fecha_nacimiento'      =>  '1888-08-22',
            'cuenta'                =>  true,
            'sexo_id'               =>  2,
            'puesto_id'             =>  2,
            'estado_id'             =>  2,
        ]);

    }
}
