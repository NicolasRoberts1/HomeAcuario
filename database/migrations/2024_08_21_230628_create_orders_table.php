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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha');
            $table->string('cliente', 75);
            $table->string('direccion');
            $table->string('pago', 15); //Estado Efectivo/transferencia
            $table->unsignedBigInteger('id_producto');
            $table->integer('cantidad');
            $table->float('total', 12, 2);
            $table->float('pre_entrega', 12, 2);
            $table->string('observacion', 200);
            $table->string('estado');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_producto')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
