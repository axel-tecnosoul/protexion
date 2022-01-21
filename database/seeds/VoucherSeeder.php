<?php

use Illuminate\Database\Seeder;
use App\Voucher;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Voucher::create([

        	'codigo' => "0000000001",

        	'user_id' => 1,

        	'paciente_id' => 1

        ]);

        Voucher::create([

        	'codigo' => "0000000002",

        	'user_id' => 1,

        	'paciente_id' => 2

        ]);

        Voucher::create([

        	'codigo' => "0000000003",

        	'user_id' => 1,

        	'paciente_id' => 3

        ]);
    }
}
