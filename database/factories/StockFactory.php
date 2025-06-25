<?php

namespace Database\Factories;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Company;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    protected $model = Stock::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'warehouse_id' => Warehouse::factory(),
            'product_id' => Product::factory(),
            'quantity' => $this->faker->numberBetween(0, 500),
        ];
    }
}
