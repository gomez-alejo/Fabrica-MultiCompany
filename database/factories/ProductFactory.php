<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Company;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'barcode' => $this->faker->unique()->ean13(),
            'description' => $this->faker->paragraph(),
            'category' => $this->faker->randomElement(['Electrónica', 'Ropa', 'Alimentos', 'Hogar']),
            'unit_price' => $this->faker->randomFloat(2, 1000, 500000),
            'iva' => $this->faker->randomFloat(2, 0, 0.19),
            'min_stock' => $this->faker->numberBetween(5, 100),
            'company_id' => Company::factory(),
            'supplier_id' => Supplier::factory(),
        ];
    }
}
