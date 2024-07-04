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
        Schema::create('covers', function (Blueprint $table) {
            
            $table->id();

            $table->string('image_path'); /* Nombre de la imagen */

            $table->string('title'); /* Titulo para identificar la imagen entre varias */

            $table->datetime('star_at'); /* Fecha inicio publicacion */
        
            $table->datetime('end_at')->nullable(); /* Fecha Final de la Publicacion */

            $table->boolean('is_active')->default(true);   /* Campo para determinar si esta activa o inactiva */

            $table->integer('order')->default(0);  /* campop para determinar el orden de las imagenes en las publicaciones */

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('covers');
    }
};
