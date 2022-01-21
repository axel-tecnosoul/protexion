<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedenteRecientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedente_recientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('detalle1_reciente')->nullable();; 
            $table->string('detalle2_reciente')->nullable();; 
            $table->string('detalle3_reciente')->nullable();; 
            $table->string('detalle4_reciente')->nullable();; 
            $table->string('detalle5_reciente')->nullable();; 
            $table->string('detalle6_reciente')->nullable();; 
            $table->string('detalle7_reciente')->nullable();; 
            $table->string('detalle8_reciente')->nullable();; 
            $table->string('detalle9_reciente')->nullable();; 
            $table->string('detalle10_reciente')->nullable();; 
            $table->string('detalle11_reciente')->nullable();; 
            $table->string('detalle12_reciente')->nullable();; 
            $table->string('detalle13_reciente')->nullable();; 
            $table->string('detalle14_reciente')->nullable();; 

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
        Schema::dropIfExists('antecedente_recientes');
    }
}
