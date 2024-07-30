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
        Schema::create('montadora', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });

        Schema::create('motor', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });

        Schema::create('posicao', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });

        Schema::create('grupo', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });

        Schema::create('modelo', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger('id_montadora');
            $table->foreign('id_montadora')->references('id')->on('montadora');
            $table->timestamps();
        });

        Schema::create('produto', function (Blueprint $table) {
            $table->id();
            $table->string('referencia', length: 50)->primary();
            $table->string('nome');
            $table->string('observacao')->nullable();
            $table->smallInteger('quant_carro')->nullable();
            $table->smallInteger('multiplo')->nullable();
            $table->timestamps();
        });

        Schema::create('cod_similar', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger('id_produto');
            $table->foreign('id_produto')->references('id')->on('produto');
            $table->timestamps();
        });

        Schema::create('aplicacao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_posicao')->nullable();
            $table->foreign('id_posicao')->references('id')->on('posicao');
            $table->unsignedBigInteger('id_produto');
            $table->foreign('id_produto')->references('id')->on('produto');
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
        Schema::dropIfExists('montadora');
        Schema::dropIfExists('motor');
        Schema::dropIfExists('posicao');
        Schema::dropIfExists('grupo');
        Schema::dropIfExists('modelo');
        Schema::dropIfExists('produto');
        Schema::dropIfExists('cod_similar');
        Schema::dropIfExists('aplicacao');
    }
};
