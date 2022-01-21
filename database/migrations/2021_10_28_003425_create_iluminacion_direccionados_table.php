<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIluminacionDireccionadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iluminacion_direccionados', function (Blueprint $table) {
            //Atributos de formulario
                $table->bigIncrements('id');
                $table->binary('firma')                         ->nullable();
                $table->string('puesto')                        ->nullable();
                $table->string('antiguedad')                    ->nullable();
                $table->string('direccion_completa')            ->nullable();
                $table->string('observaciones')                 ->nullable();

                $table->unsignedBigInteger('voucher_id');
                $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('restrict');
                $table->timestamps();

            //Antecedentes
                $table->string('enfermedades')                  ->nullable();
                $table->string('transtornos_congenitos')        ->nullable();
                $table->string('enfermedades_profecionales')    ->nullable();
                $table->string('exposicion_anterior')           ->nullable();
                $table->string('exposicion_actual')             ->nullable();

            //Examen clínico
                $table->string('cefaleas')                      ->nullable();
                $table->string('vision_doble')                  ->nullable();
                $table->string('mareo_vertigo')                 ->nullable();
                $table->string('conjuntivitis')                 ->nullable();
                $table->string('vision_borrosa')                ->nullable();
                $table->string('inseguridad_de_pie')            ->nullable();

            //Examen ocular
                $table->boolean('no_centrados')                 ->nullable();
                $table->boolean('pupilas_anormales')            ->nullable();
                $table->boolean('conjuntivas_anormales')        ->nullable();
                $table->boolean('corneas_anormales')            ->nullable();
                $table->boolean('motilidad_anormal')            ->nullable();
                $table->boolean('nistagmus_ausente')            ->nullable();
                $table->string ('informe_ocular')               ->nullable();
                $table->string ('av_correccion')                ->nullable();
                $table->string ('av_sin_correccion')            ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iluminacion_direccionados');
    }
}
