<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductRequest;

class ProductRequestSeeder extends Seeder
{
    public function run(): void
    {
        ProductRequest::factory()->count(25)->create();
    }
}
