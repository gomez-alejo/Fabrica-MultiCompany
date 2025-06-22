<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); // id (clave primaria)

            $table->unsignedBigInteger('company_id');     // id_empresa
            $table->unsignedBigInteger('branch_id');      // id_sucursal
            $table->unsignedBigInteger('person_id');      // id_persona
            $table->unsignedBigInteger('user_id');        // id_usuario

            $table->bigInteger('invoice_number');         // numero_factura 
            $table->integer('created_unix');              // creado (INT tipo timestamp UNIX)
            $table->string('payment_method', 50);         // medio_pago

            $table->float('total');                       // total
            $table->float('iva_total');                   // iva_total

            $table->timestamps();

            // Claves foráneas (donde aplica)
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
