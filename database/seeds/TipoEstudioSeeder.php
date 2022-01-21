<?php

use App\Models\TipoEstudio;
use Illuminate\Database\Seeder;

class TipoEstudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tipoEstudio = TipoEstudio::create([
        	'nombre' => 'ANALISIS BIOQUIMICO',
        ]);
        $tipoEstudio = TipoEstudio::create([
        	'nombre' => 'ANALISIS BIOQUIMICO ANEXO 01',
        ]);
        $tipoEstudio = TipoEstudio::create([
        	'nombre' => 'COMPLEMENTARIO',
        ]);
        $tipoEstudio = TipoEstudio::create([
        	'nombre' => 'EXAMEN CLINICO',
        ]);
        $tipoEstudio = TipoEstudio::create([
        	'nombre' => 'PSICOTECNICO',
        ]);
        $tipoEstudio = TipoEstudio::create([
        	'nombre' => 'RADIOLOGIA',
        ]);
    }
}
