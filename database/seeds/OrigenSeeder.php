<?php

use Illuminate\Database\Seeder;
use App\Origen;

class OrigenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Origen::create([
            'definicion'    =>  'Agricultores S.A',
            'cuit'          =>  '33-21231221-11',
            'domicilio_id'  =>  1
        ]);

        Origen::create([
            'definicion'  =>  'Seguros Campana',
            'cuit'          =>  '32-24211221-11',
            'domicilio_id'  =>  1
        ]);

        Origen::create([
            'definicion'  =>  'Tabacalera Apóstoles',
            'cuit'          =>  '33-2431251-11',
            'domicilio_id'  =>  1
        ]);

        Origen::create([
            'definicion'  =>  'Particular'
        ]);

        Origen::create([
            'definicion'  =>  'Gendarmeria',
            'domicilio_id'  =>  1
        ]);

    }
}
