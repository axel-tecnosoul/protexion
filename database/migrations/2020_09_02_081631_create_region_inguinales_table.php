<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionInguinalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_inguinales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('observacion1_in')->nullable();
            $table->string('observacion2_in')->nullable();
            $table->string('observacion3_in')->nullable();
            $table->string('observacion_in')->nullable();
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
        Schema::dropIfExists('region_inguinales');
    }
}
