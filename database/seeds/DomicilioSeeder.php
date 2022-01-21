<?php

use Illuminate\Database\Seeder;
use App\Domicilio;

class DomicilioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Domicilio::create([
            'direccion'      =>  'Chaquito, S/N',
            'ciudad_id'    =>  '1'
            ]);

        Domicilio::create([
            'direccion'      =>  'Evita, Lavalle, 654',
            'ciudad_id'    =>  '2'
            ]);

        Domicilio::create([
            'direccion'      =>  'Las Heras 123',
            'ciudad_id'    =>  '2'
            ]);

        Domicilio::create([
            'direccion'      =>  'Sarmiento, 546',
            'ciudad_id'    =>  '2'
            ]);


        Domicilio::create([
            'direccion'      =>  'MItre, 456',
            'ciudad_id'    =>  '2'
            ]);

        Domicilio::create([
            'direccion'      =>  'Villa Hollywood, 321',
            'ciudad_id'    =>  '1'
            ]);

        Domicilio::create([
            'direccion'      =>  'Villa Poujade, San Martin, 54',
            'ciudad_id'    =>  '2'
            ]);

    }
}
