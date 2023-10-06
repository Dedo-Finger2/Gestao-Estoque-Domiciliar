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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 70)->nullable(false);
            $table->string('imagem', 255)->nullable(true);
            $table->string('unidade_medida', 5)->nullable(true);
            $table->integer('quantidade_minima')->nullable(false);
            $table->double('preco_unitario', 10, 2)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
