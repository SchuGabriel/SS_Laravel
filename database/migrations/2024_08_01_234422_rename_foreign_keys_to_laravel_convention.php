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
            $table->renameColumn('id_montadora', 'montadora_id');
        });

        Schema::table('cod_similar', function (Blueprint $table) {
            $table->renameColumn('id_produto', 'produto_id');
        });

        Schema::table('aplicacao', function (Blueprint $table) {
            $table->renameColumn('id_posicao', 'posicao_id');
            $table->renameColumn('id_produto', 'produto_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modelo', function (Blueprint $table) {
            $table->renameColumn('montadora_id', 'id_montadora');
        });

        Schema::table('cod_similar', function (Blueprint $table) {
            $table->renameColumn('produto_id', 'id_produto');
        });

        Schema::table('aplicacao', function (Blueprint $table) {
            $table->renameColumn('posicao_id', 'id_posicao');
            $table->renameColumn('produto_id', 'id_produto');
        });
    }
};
