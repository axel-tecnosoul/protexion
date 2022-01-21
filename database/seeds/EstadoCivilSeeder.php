<?php

use Illuminate\Database\Seeder;
use App\EstadoCivil;

class EstadoCivilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadoCivil = EstadoCivil::create([

        	'definicion' => 'Soltero/a',

        	'abreviatura' => 'S'

        ]);

        $estadoCivil = EstadoCivil::create([

        	'definicion' => 'Casado/a',

        	'abreviatura' => 'C'

        ]);

        $estadoCivil = EstadoCivil::create([

        	'definicion' => 'Viudo/a',

        	'abreviatura' => 'V'

        ]);

        $estadoCivil = EstadoCivil::create([

        	'definicion' => 'Divorciado/a',

        	'abreviatura' => 'D'

        ]);
    }
}
