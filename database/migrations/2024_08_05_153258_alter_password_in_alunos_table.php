<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPasswordInAlunosTable extends Migration
{
  public function up()
  {
    Schema::table('alunos', function (Blueprint $table) {
      $table
        ->string('password')
        ->nullable(false)
        ->change(); // Torna a coluna password not null
    });
  }

  public function down()
  {
    Schema::table('alunos', function (Blueprint $table) {
      $table
        ->string('password')
        ->nullable()
        ->change(); // Reverte a coluna password para nullable
    });
  }
}
