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
        Schema::table('aplicacao_motor', function (Blueprint $table) {
            // Primeiro, removemos as chaves estrangeiras existentes
            $table->dropForeign(['aplicacao_id']);
            $table->dropForeign(['motor_id']);

            // Agora, adicionamos as chaves estrangeiras novamente com onDelete('cascade')
            $table->foreign('aplicacao_id')
                  ->references('id')
                  ->on('aplicacao')
                  ->onDelete('cascade');

            $table->foreign('motor_id')
                  ->references('id')
                  ->on('motor')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aplicacao_motor', function (Blueprint $table) {
            // Reverter as alterações caso seja necessário
            $table->dropForeign(['aplicacao_id']);
            $table->dropForeign(['motor_id']);

            // Adicionar as chaves estrangeiras sem onDelete('cascade')
            $table->foreign('aplicacao_id')
                  ->references('id')
                  ->on('aplicacao');

            $table->foreign('motor_id')
                  ->references('id')
                  ->on('motor');
        });
    }
};
