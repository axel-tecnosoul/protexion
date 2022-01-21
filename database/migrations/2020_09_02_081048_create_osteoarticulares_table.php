<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOsteoarticularesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('osteoarticulares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('observacion1_os')->nullable();
            $table->string('observacion2_os')->nullable();
            $table->string('observacion3_os')->nullable();
            $table->string('observacion4_os')->nullable();
            $table->string('observacion_os')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('historia_clinica_id');
            $table->foreign('historia_clinica_id')->references('id')->on('historia_clinicas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('osteoarticulares');
    }
}
