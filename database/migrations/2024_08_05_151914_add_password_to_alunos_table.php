<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasswordToAlunosTable extends Migration
{
  public function up()
  {
    Schema::table('alunos', function (Blueprint $table) {
      $table
        ->string('password')
        ->nullable()
        ->after('codigo_turma'); // Adiciona a coluna password como nullable
    });
  }

  public function down()
  {
    Schema::table('alunos', function (Blueprint $table) {
      $table->dropColumn('password');
    });
  }
}
