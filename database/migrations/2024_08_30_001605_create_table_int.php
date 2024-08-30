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
        Schema::create('aplicacao_modelo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aplicacao_id');
            $table->unsignedBigInteger('modelo_id');
            $table->timestamps();

            $table->foreign('aplicacao_id')->references('id')->on('aplicacao');
            $table->foreign('modelo_id')->references('id')->on('modelo');
        });

        Schema::create('aplicacao_motor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aplicacao_id');
            $table->unsignedBigInteger('motor_id');
            $table->timestamps();

            $table->foreign('aplicacao_id')->references('id')->on('aplicacao');
            $table->foreign('motor_id')->references('id')->on('motor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplicacao_modelo');
        Schema::dropIfExists('aplicacao_motor');
    }
};
