<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbVotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tb_voto', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->dateTime('data_hora');
            $table->string('voto');
            $table->string('chapa');
            $table->tinyInteger('tipo');
            $table->string('nome_unidade');
            $table->string('ip')->nullable();
            $table->uuid('eleitor_id')->index()->unique();
            $table->foreign('eleitor_id')->references('id')->on('tb_eleitor');

            $table->uuid('unidade_id')->index();
            $table->foreign('unidade_id')->references('id')->on('tb_unidade');

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
        Schema::dropIfExists('tb_voto');
    }
}
