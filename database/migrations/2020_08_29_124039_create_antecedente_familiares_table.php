<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedenteFamiliaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedente_familiares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('su_padre_vive')->nullable(); //su padre vive
            $table->boolean('su_madre_vive')->nullable(); //su madre vive
            $table->boolean('cancer')->nullable(); //su madre o padre padece de las siguientes afecciones
            $table->boolean('diabetes')->nullable(); //su madre o padre padece de las siguientes afecciones
            $table->boolean('infarto')->nullable(); //su madre o padre padece de las siguientes afecciones
            $table->boolean('hipertension_Arterial')->nullable(); //su madre o padre padece de las siguientes afecciones
            $table->string('detalle')->nullable();
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
        Schema::dropIfExists('antecedente_familiares');
    }
}
