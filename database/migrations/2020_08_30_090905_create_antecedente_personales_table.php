<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentePersonalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedente_personales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fuma')->nullable();
            $table->string('bebe')->nullable();
            $table->string('actividad_fisica')->nullable();

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
        Schema::dropIfExists('antecedente_personales');
    }
}
