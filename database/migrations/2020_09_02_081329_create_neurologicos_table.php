<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeurologicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neurologicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('observacion1_neu')->nullable();
            $table->string('observacion2_neu')->nullable();
            $table->string('observacion3_neu')->nullable();
            $table->string('observacion4_neu')->nullable();
            $table->string('observacion5_neu')->nullable();
            $table->string('observacion6_neu')->nullable();
            $table->string('observacion7_neu')->nullable();
            $table->string('observacion_neu')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('historia_clinica_id');
            $table->foreign('historia_clinica_id')->references('id')->on('historia_clinicas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('neurologicos');
    }
}
