<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalClinicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_clinicas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('documento')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->date('fecha_nacimiento');
            $table->string('nro_matricula')->nullable();
            $table->boolean('cuenta')->default(false);
            $table->string('foto')->nullable();

            $table->timestamps();

            $table->unsignedBigInteger('sexo_id')->default(1);
            $table->foreign('sexo_id')->references('id')->on('sexos')->onDelete('restrict');

            $table->unsignedBigInteger('puesto_id')->default(1);
            $table->foreign('puesto_id')->references('id')->on('puestos')->onDelete('restrict');

            $table->unsignedBigInteger('especialidad_id')->nullable();
            $table->foreign('especialidad_id')->references('id')->on('especialidades')->onDelete('restrict');

            $table->unsignedBigInteger('estado_id')->default(1);
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
        Schema::dropIfExists('personal_clinicas');
    }
}
