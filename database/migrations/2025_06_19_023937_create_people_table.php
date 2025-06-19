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
        Schema::create('people', function (Blueprint $table) {
            $table->id(); // id INT(11) PRIMARY KEY
            $table->string('identification', 20);
            $table->string('first_name', 250);
            $table->string('last_name', 250);
            $table->string('phone', 50);
            $table->string('address', 250);
            $table->unsignedBigInteger('company_id'); // id_empresa
            // Foreign key constraint
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
