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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('sku');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('images_path');
            $table->float('price');
            $table->integer('stock')
                  ->unsigned()
                  ->default(0);

            /* Definimos sub_category con la relacion vinculada con la tabla sub_categoria */
            $table->foreignId('subcategory_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
