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
        Schema::create('modelo', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger('id_montadora');
            $table->timestamps();
        });

        Schema::create('cod_similar', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger('id_produto');
            $table->timestamps();
        });

        Schema::create('aplicacao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_posicao')->nullable();
            $table->unsignedBigInteger('id_produto');
            $table->date('ano_inicial')->nullable();
            $table->date('ano_final')->nullable();
            $table->string('observacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplicacao');
        Schema::dropIfExists('cod_similar');
        Schema::dropIfExists('modelo');
    }
};
