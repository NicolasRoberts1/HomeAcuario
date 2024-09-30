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
            $table->id('id_registro');
            $table->unsignedBigInteger('id_orden');
            $table->datetime('fecha');
            $table->string('cliente');
            $table->string('direccion');
            $table->float('total', 12, 2);
            $table->string('estado');
            $table->unsignedBigInteger('user_id');

            // Definir las claves foráneas
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
