<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao', 30);
            $table->timestamps();
        });

        Schema::create('servidores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id') 
                ->references('id')
                ->on('users');
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')
                ->references('id')
                ->on('cargos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servidores');
        Schema::dropIfExists('cargos');
    }
};
