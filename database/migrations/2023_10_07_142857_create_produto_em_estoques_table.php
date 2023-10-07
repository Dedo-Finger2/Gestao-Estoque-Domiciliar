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
            $table->foreignIdFor(Produto::class, 'id_produto')->nullable(false);
            $table->foreignIdFor(Estoque::class, 'id_estoque')->nullable(false);
            $table->integer('quantidade')->nullable(false);
            $table->decimal('valor_pago', 10, 2)->nullable(false);
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
