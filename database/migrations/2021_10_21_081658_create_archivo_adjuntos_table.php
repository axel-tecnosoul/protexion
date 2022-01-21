<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivoAdjuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivo_adjuntos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('anexo');
            $table->string('diagnostico')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('voucher_estudio_id');
            $table->foreign('voucher_estudio_id')->references('id')->on('vouchers_estudios')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivo_adjuntos');
    }
}
