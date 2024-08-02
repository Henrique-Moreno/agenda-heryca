<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('agendas', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_servidor');
      $table->unsignedBigInteger('id_aluno');
      $table->date('data');
      $table->time('horario');
      $table->string('status');
      $table->timestamps();

      $table
        ->foreign('id_servidor')
        ->references('id')
        ->on('servidores')
        ->onDelete('cascade');
      $table
        ->foreign('id_aluno')
        ->references('id')
        ->on('alunos')
        ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('agendas');
  }
}
