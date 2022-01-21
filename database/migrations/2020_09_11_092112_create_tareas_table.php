<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('tiempo')->nullable();
            $table->string('ciclo')->nullable();
            $table->string('cargas')->nullable();
            $table->boolean('pregunta1')->nullable();
            $table->boolean('pregunta2')->nullable();
            $table->boolean('pregunta3')->nullable();
            $table->boolean('pregunta4')->nullable();
            $table->boolean('pregunta5')->nullable();
            $table->boolean('pregunta6')->nullable();
            $table->boolean('pregunta7')->nullable();
            $table->boolean('pregunta8')->nullable();
            $table->string('observacion_tarea')->nullable();

            $table->unsignedBigInteger('posiciones_forzada_id');
            $table->foreign('posiciones_forzada_id')->references('id')->on('posiciones_forzadas')->onDelete('restrict');

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
        Schema::dropIfExists('tareas');
    }
}
