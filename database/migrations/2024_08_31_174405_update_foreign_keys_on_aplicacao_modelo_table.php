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
        Schema::table('aplicacao_modelo', function (Blueprint $table) {
            $table->dropForeign(['aplicacao_id']);
            $table->dropForeign(['modelo_id']);

            $table->foreign('aplicacao_id')
                  ->references('id')
                  ->on('aplicacao')
                  ->onDelete('cascade');

            $table->foreign('modelo_id')
                  ->references('id')
                  ->on('modelo')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aplicacao_modelo', function (Blueprint $table) {
            $table->dropForeign(['aplicacao_id']);
            $table->dropForeign(['modelo_id']);

            $table->foreign('aplicacao_id')
                  ->references('id')
                  ->on('aplicacao');

            $table->foreign('modelo_id')
                  ->references('id')
                  ->on('modelo');
        });
    }
};
