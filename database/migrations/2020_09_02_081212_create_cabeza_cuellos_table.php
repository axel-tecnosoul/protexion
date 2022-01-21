<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabezaCuellosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabeza_cuellos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('observacion1_cc')->nullable();
            $table->string('observacion2_cc')->nullable();
            $table->string('observacion3_cc')->nullable();
            $table->string('observacion4_cc')->nullable();
            $table->string('observacion5_cc')->nullable();
            $table->string('observacion6_cc')->nullable();
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
        Schema::dropIfExists('cabeza_cuellos');
    }
}
