<?php

use App\Models\Estoque;
use App\Models\Produto;
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
        Schema::create('produtos_em_estoques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produto');
            $table->unsignedBigInteger('id_estoque');
            $table->foreign('id_produto')->references('id')->on('produtos');
            $table->foreign('id_estoque')->references('id')->on('estoques');
            $table->integer('quantidade')->nullable(false);
            $table->decimal('valor_pago', 10, 2)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto_em_estoques');
    }
};
