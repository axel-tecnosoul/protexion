<?php

use Illuminate\Database\Seeder;
use App\ObraSocial;
class ObraSocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obraSocial = ObraSocial::create([

        	'definicion' => 'Instituto Provincial de Salud',

        	'abreviatura' => 'IPS'

        ]);

        $obraSocial = ObraSocial::create([

        	'definicion' => 'Obra Social De Gastronómicos Y Hoteleros',

        	'abreviatura' => 'OSUTHGRA'

        ]);
    }
}
