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

        Schema::create('produto', function (Blueprint $table) {
            $table->id();
            $table->string('referencia', length: 50)->unique();
            $table->string('nome');
            $table->string('observacao')->nullable();
            $table->smallInteger('quant_carro')->nullable();
            $table->smallInteger('multiplo')->nullable();
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
        Schema::dropIfExists('produto');
    }
};
