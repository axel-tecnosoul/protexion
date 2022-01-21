<?php

use Illuminate\Database\Seeder;
use App\Especialidad;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especialidad = Especialidad::create([

            'nombre' => 'Cardiólogo',
            'puesto_id' => 3,

        ]);

        $especialidad = Especialidad::create([

            'nombre' => 'Clínico',
            'puesto_id' => 3,

        ]);

        $especialidad = Especialidad::create([

            'nombre' => 'Oftalmologo',
            'puesto_id' => 3,

        ]);

        $especialidad = Especialidad::create([

            'nombre' => 'Psicologo',
            'puesto_id' => 3,

        ]);

        $especialidad = Especialidad::create([

            'nombre' => 'Traumatologo',
            'puesto_id' => 3,

        ]);
    }
}
