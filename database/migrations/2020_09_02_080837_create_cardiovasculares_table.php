<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardiovascularesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cardiovasculares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('frecuencia_cardiaca')->nullable();
            $table->string('observacion_varices')->nullable();
            $table->string('tension_arterial')->nullable();
            $table->string('diastolica')->nullable();
            $table->string('sistolica')->nullable();
            $table->char('pulso',1)->nullable();

            $table->unsignedBigInteger('historia_clinica_id');
            $table->foreign('historia_clinica_id')->references('id')->on('historia_clinicas')->onDelete('restrict');
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
        Schema::dropIfExists('cardiovasculares');
    }
}
