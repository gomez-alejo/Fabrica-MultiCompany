<?php

namespace Database\Factories;

use App\Models\ProductRequest;
use App\Models\Requestt;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductRequestFactory extends Factory
{
    protected $model = ProductRequest::class;

    public function definition(): array
    {
        return [
            'request_id' => Requestt::factory(),
            'product_id' => Product::factory(),
            'warehouse_id' => Warehouse::factory(),
            'iva' => $this->faker->randomFloat(2, 0, 0.19),
            'quantity' => $this->faker->numberBetween(1, 50),
            'unit_cost' => $this->faker->randomFloat(2, 1000, 500000),
        ];
    }
}
