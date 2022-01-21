<?php

use Illuminate\Database\Seeder;
use App\Provincia;
class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prov_Arg = array(
            "Misiones",
            "Corrientes",
            "Entre Rios",
            "Chaco",
            "Formosa",
            "Santa Fe",
            "Jujuy",
            "Salta",
            "Tucuman",
            "Santiago del Estero",
            "Catamarca",
            "La Rioja",
            "Cordoba",
            "San Juan",
            "San Luis",
            "Mendoza",
            "La Pampa",
            "Buenos Aires",
            "Neuquen",
            "Rio Negro",
            "Chubut",
            "Santa Cruz",
            "Tierra del Fuego"
        );
        for ($i=0; $i < 23; $i++) {
            Provincia::create([
                'nombre'=>$prov_Arg[$i],
                'pais_id'=>1]);
        }
    }

}
