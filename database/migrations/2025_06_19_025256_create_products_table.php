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
            $table->id(); // id INT(11)

            $table->string('name', 250);                // producto
            $table->string('barcode', 250);             // cod_barras
            $table->text('description');                // descripcion
            $table->string('category', 250);            // categoria
            $table->float('unit_price');                // precio_unidad
            $table->float('iva');                       // iva
            $table->integer('min_stock');               // stock_min

            $table->timestamps();
            
            $table->unsignedBigInteger('company_id');   // id_empresa
            $table->unsignedBigInteger('supplier_id');  // id_proveedor
            // Foreign key constraints
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
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
