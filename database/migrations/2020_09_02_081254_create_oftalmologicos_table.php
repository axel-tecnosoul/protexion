<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOftalmologicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oftalmologicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('observacion1_of')->nullable();
            $table->string('observacion2_of')->nullable();
            $table->string('observacion3_of')->nullable();
            $table->string('observacion4_of')->nullable();
            $table->string('observacion5_of')->nullable();
            $table->string('observacion6_of')->nullable();
            $table->boolean('pregunta7_of')->nullable();
            $table->string('observacion_of')->nullable();

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
        Schema::dropIfExists('oftalmologicos');
    }
}
