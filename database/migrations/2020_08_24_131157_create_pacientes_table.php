<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('documento')->unique()->nullable();
            $table->string('nombres');
            $table->string('apellidos');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('cuil')->nullable();
            $table->double('peso')->nullable();
            $table->double('estatura')->nullable();
            $table->string('telefono')->nullable();
            $table->boolean('historia_clinica')->default(false);
            $table->timestamps();
            $table->binary('imagen')->nullable();
            //$table->softDeletes();


            $table->unsignedBigInteger('origen_id')->nullable();
            $table->foreign('origen_id')->references('id')->on('origenes')->onDelete('restrict');

            $table->unsignedBigInteger('sexo_id')->nullable();
            $table->foreign('sexo_id')->references('id')->on('sexos')->onDelete('restrict')->nullable();

            $table->unsignedBigInteger('estado_civil_id')->nullable();
            $table->foreign('estado_civil_id')->references('id')->on('estado_civiles')->onDelete('restrict');

            $table->unsignedBigInteger('obra_social_id')->nullable();
            $table->foreign('obra_social_id')->references('id')->on('obra_sociales')->onDelete('restrict');

            $table->unsignedBigInteger('domicilio_id')->nullable();
            $table->foreign('domicilio_id')->references('id')->on('domicilios')->onDelete('restrict');

            $table->unsignedBigInteger('ciudad_id')->nullable();
            $table->foreign('ciudad_id')->references('id')->on('ciudades')->onDelete('restrict');

            $table->unsignedBigInteger('estado_id')->nullable();
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
