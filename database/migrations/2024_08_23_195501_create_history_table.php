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
        Schema::create('history', function (Blueprint $table) {
            $table->unsignedBigInteger('id_orden');
            $table->unsignedBigInteger('id_producto');

            $table->unsignedBigInteger('user_id');
            $table->integer('cantidad');

            $table->timestamps();

            //claves primarias compuestas

            $table->primary(['id_orden', 'id_producto']);

            // Definir las claves foráneas
            $table->foreign('id_producto')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_orden')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
