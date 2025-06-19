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
        Schema::create('companies', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name', 250);         // empresa
            $table->string('nit', 30);        // nit
            $table->string('address', 250);      // direccion
            $table->string('phones', 150);       // telefonos
            $table->string('website', 250)->nullable(); // web
            $table->string('email', 250)->nullable();   // correo
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
