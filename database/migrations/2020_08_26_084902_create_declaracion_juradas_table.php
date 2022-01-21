<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclaracionJuradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declaracion_juradas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->binary('firma')             ->nullable();
            $table->char('codigo',10);
            $table->date('fecha_realizacion')   ->nullable();
            
            $table->unsignedBigInteger('personal_clinica_id');
            $table->foreign('personal_clinica_id')->references('id')->on('personal_clinicas')->onDelete('restrict');
            $table->unsignedBigInteger('voucher_id');
            $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('restrict');
            $table->unsignedBigInteger('ciudad_id');
            $table->foreign('ciudad_id')->references('id')->on('ciudades')->onDelete('restrict');
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
        Schema::dropIfExists('declaracion_juradas');
    }
}
