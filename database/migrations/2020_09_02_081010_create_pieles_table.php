<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePielesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pieles', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->string('observacion1_piel')->nullable();
            $table->string('obs_vesicula')->nullable();
            $table->string('obs_ulceras')->nullable();
            $table->string('obs_fisuras')->nullable();
            $table->string('obs_prurito')->nullable();
            $table->string('obs_eczemas')->nullable();
            $table->string('obs_dertmatitis')->nullable();
            $table->string('obs_eritemas')->nullable();
            $table->string('obs_petequias')->nullable();
            $table->string('tejido')->nullable();

            $table->unsignedBigInteger('historia_clinica_id');
            $table->foreign('historia_clinica_id')->references('id')->on('historia_clinicas')->onDelete('restrict');
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
        Schema::dropIfExists('pieles');
    }
}
