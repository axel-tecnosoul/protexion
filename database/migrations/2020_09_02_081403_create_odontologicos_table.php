<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdontologicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odontologicos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('observacion1_od')->nullable();
            $table->string('observacion2_od')->nullable();
            $table->boolean('pregunta4_od')->nullable();
            $table->boolean('pregunta5_od')->nullable();
            $table->string('observacion_od')->nullable();
            $table->string('superior')->nullable();
            $table->string('inferior')->nullable();
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
        Schema::dropIfExists('odontologicos');
    }
}
