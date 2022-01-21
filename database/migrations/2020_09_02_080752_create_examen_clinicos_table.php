<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenClinicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen_clinicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('peso')->nullable();
            $table->double('estatura')->nullable();
            $table->boolean('sobrepeso')->nullable();
            $table->double('imc')->nullable();
            $table->string('medicacion_actual')->nullable();

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
        Schema::dropIfExists('examen_clinicos');
    }
}
