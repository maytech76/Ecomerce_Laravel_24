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
        Schema::create('option_product', function (Blueprint $table) {
            $table->id();

            /* Implementamos las dos migraciones que componen la tabla pivot option_producto */
            $table->foreignId('option_id')
                  ->constrained()
                  ->onDelete('cascade');
                  
            $table->foreignId('product_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->json('features');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_product');
    }
};
