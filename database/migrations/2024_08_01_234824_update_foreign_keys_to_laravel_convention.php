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
            $table->foreign('montadora_id')->references('id')->on('montadora');
        });

        Schema::table('cod_similar', function (Blueprint $table) {
            $table->foreign('produto_id')->references('id')->on('produto');
        });

        Schema::table('aplicacao', function (Blueprint $table) {
            $table->foreign('posicao_id')->references('id')->on('posicao');
            $table->foreign('produto_id')->references('id')->on('produto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modelo', function (Blueprint $table) {
            $table->dropForeign(['montadora_id']);
        });

        Schema::table('cod_similar', function (Blueprint $table) {
            $table->dropForeign(['produto_id']);
        });

        Schema::table('aplicacao', function (Blueprint $table) {
            $table->dropForeign(['posicao_id']);
            $table->dropForeign(['produto_id']);
        });
    }
};
