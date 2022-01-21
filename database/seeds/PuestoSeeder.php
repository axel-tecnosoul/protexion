<?php

use Illuminate\Database\Seeder;
use App\Puesto;

class PuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $puesto = Puesto::create([

            'nombre' => 'Administración',

        ]);

        $puesto = Puesto::create([

            'nombre' => 'Secretaría',

        ]);

        $puesto = Puesto::create([

            'nombre' => 'Médico',

        ]);
    }
}
