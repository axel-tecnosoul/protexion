<?php

use Illuminate\Database\Seeder;
use App\Sexo;

class SexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sexo::create(['definicion'=>'Femenino','abreviatura'=>'F']);
        Sexo::create(['definicion'=>'Masculino','abreviatura'=>'M']);

    }
}
