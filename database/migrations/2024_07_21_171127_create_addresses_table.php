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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id') /* Establecemos la relacion con el campo user_id de la tabla users */
                  ->constrained()
                  ->onDelete('cascade');

            $table->integer('type'); /* Campo para identificar tipo de domicilio, oficina */

            $table->string('description'); /* Descriccion detallada de la direccion */

            $table->string('district');

            $table->string('reference'); 

            $table->integer('receiver'); /* Quien recibira el producto 1 = comprador, 2 = Otra persona */

            $table->json('receiver_info'); /* Informacion detallada de la persona que recibira la compra */

            $table->boolean('default')->default(false);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
