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
        Schema::create('log_despesas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_despesa');
            $table->double('valor_pago', 10, 2)->nullable(false);
            $table->date('data_pagamento')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_despesas');
    }
};
