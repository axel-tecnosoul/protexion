<?php

use Illuminate\Database\Seeder;
use App\Pais;
class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pais::create(['nombre'=>'Argentina']);
        Pais::create(['nombre'=>'Brasil']);

    }
}
