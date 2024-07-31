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
        Schema::table('modelo', function (Blueprint $table) {
            $table->foreign('id_montadora')->references('id')->on('montadora');
        });

        Schema::table('cod_similar', function (Blueprint $table) {
            $table->foreign('id_produto')->references('id')->on('produto');
        });

        Schema::table('aplicacao', function (Blueprint $table) {
            $table->foreign('id_posicao')->references('id')->on('posicao');
            $table->foreign('id_produto')->references('id')->on('produto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modelo', function (Blueprint $table) {
            $table->dropForeign(['id_montadora']);
        });

        Schema::table('cod_similar', function (Blueprint $table) {
            $table->dropForeign(['id_produto']);
        });

        Schema::table('aplicacao', function (Blueprint $table) {
            $table->dropForeign(['id_posicao']);
            $table->dropForeign(['id_produto']);
        });
    }
};
