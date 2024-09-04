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
        Schema::table('aplicacao', function (Blueprint $table) {
            $table->integer('ano_inicial')->nullable()->change();
            $table->integer('ano_final')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aplicacao', function (Blueprint $table) {
            $table->date('ano_inicial')->change(); // Reverte para o tipo de data
            $table->date('ano_final')->change(); // Reverte para o tipo de data
        });
    }
};
