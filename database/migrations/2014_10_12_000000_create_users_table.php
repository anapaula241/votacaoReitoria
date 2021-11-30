<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_eleitor', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome');
            $table->string('cpf', 14)->unique();
            $table->tinyInteger('tipo'); // 1=> aluno   2=> administrativo    3=>professor
            $table->string('password');
            $table->string('senha');
            $table->string('email')->unique();
            $table->dateTime('solicitasenha')->default(now());
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
        Schema::dropIfExists('tb_eleitor');
    }
}
