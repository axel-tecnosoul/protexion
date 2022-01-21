<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedenteMedicoInfanciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedente_medico_infancias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('sarampion')->nullable();
            $table->boolean('rebeola')->nullable();
            $table->boolean('epilepsia')->nullable();
            $table->boolean('varicela')->nullable();
            $table->boolean('parotiditis')->nullable();
            $table->boolean('cefalea_prolongada')->nullable();
            $table->boolean('hepatitis')->nullable();
            $table->boolean('gastritis')->nullable();
            $table->boolean('ulcera_gastrica')->nullable();
            $table->boolean('hemorroide')->nullable();
            $table->boolean('hemorragias')->nullable();
            $table->boolean('neumonia')->nullable();
            $table->boolean('asma')->nullable();
            $table->boolean('tuberculosis')->nullable();
            $table->boolean('tos_cronica')->nullable();
            $table->boolean('catarro')->nullable();
            $table->string('detalle1_m')->nullable(); // (antes observacion)

            $table->unsignedBigInteger('declaracion_jurada_id');
            $table->foreign('declaracion_jurada_id')->references('id')->on('declaracion_juradas')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('antecedente_medico_infancias');
    }
}
