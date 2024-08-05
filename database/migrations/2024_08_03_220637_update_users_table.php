<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      // Se a coluna 'nome_completo' não existir, você pode adicioná-la com um valor padrão
      if (!Schema::hasColumn('users', 'nome_completo')) {
        $table->string('nome_completo')->nullable(false); // Adiciona a coluna como não nula
      } else {
        $table
          ->string('nome_completo')
          ->nullable(false)
          ->change(); // Atualiza a coluna para não nula
      }
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('users', function (Blueprint $table) {
      // Reverte a coluna para permitir nulos se necessário
      $table
        ->string('nome_completo')
        ->nullable()
        ->change();
    });
  }
}
