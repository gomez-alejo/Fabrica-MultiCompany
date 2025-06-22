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
        Schema::create('product_request', function (Blueprint $table) {
            $table->id(); 

            $table->unsignedBigInteger('request_id');   // id_solicitud
            $table->unsignedBigInteger('product_id');   // id_producto
            $table->unsignedBigInteger('warehouse_id'); // id_bodega

            $table->float('iva');                       // iva
            $table->integer('quantity');                // cantidad
            $table->float('unit_cost');                 // costo_unitario

            $table->timestamps();

            // Foreign keys
            $table->foreign('request_id')->references('id')->on('requests')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_request');
    }
};
