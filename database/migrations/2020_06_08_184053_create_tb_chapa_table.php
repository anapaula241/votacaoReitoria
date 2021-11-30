<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbChapaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_chapa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome_chapa')->nullable();
            $table->string('diretor');
            $table->string('foto_diretor');
            $table->string('vicediretor');
            $table->string('foto_vicediretor');
            $table->timestamps();

            $table->uuid('unidade_id')->index();
            $table->foreign('unidade_id')->references('id')->on('tb_unidade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_chapa');
    }
}
