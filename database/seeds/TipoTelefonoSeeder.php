<?php

use Illuminate\Database\Seeder;
use App\TipoTelefono;
class TipoTelefonoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoTelefono::create(['tipo'=>'celular']);
        TipoTelefono::create(['tipo'=>'fijo']);

    }
}
