<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInvoicesTable extends Migration
{
    public function up(): void
    {
        Schema::create('product_invoices', function (Blueprint $table) {
            $table->id(); // id (clave primaria)

            $table->unsignedBigInteger('invoice_id');     // id_factura
            $table->unsignedBigInteger('product_id');     // id_producto
            $table->unsignedBigInteger('warehouse_id');   // id_bodega

            $table->float('iva');                         // iva
            $table->integer('quantity');                  // cantidad
            $table->float('unit_cost');                   // costo_unitario

            $table->timestamps();                         // created_at, updated_at

            // Claves foráneas
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_invoices');
    }
}
