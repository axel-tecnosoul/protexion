<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedenteQuirurjicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedente_quirurjicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('detalle1_q')->nullable(); 
            $table->string('detalle2_q')->nullable(); 
            $table->string('detalle3_q')->nullable(); 

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
        Schema::dropIfExists('antecedente_quirurjicos');
    }
}
