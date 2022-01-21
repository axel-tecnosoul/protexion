<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosicionesForzadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posiciones_forzadas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->binary('firma')->nullable();
            $table->char('codigo',10);
            $table->string('puesto')->nullable();
            $table->integer('antiguedad')->nullable();
            $table->string('nroTrabajo')->nullable();
            $table->char('dolor_articular',112);
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('restrict');

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
        Schema::dropIfExists('posiciones_forzadas');
    }
}
