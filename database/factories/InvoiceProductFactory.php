<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceProduct>
 */
class InvoiceProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::inRandomOrder()->first()?->id ?? Invoice::factory(),
            'product_id' => Product::inRandomOrder()->first()?->id ?? Product::factory(),
            'warehouse_id' => Warehouse::inRandomOrder()->first()?->id ?? Warehouse::factory(),

            'iva' => $this->faker->randomElement([0, 5, 19]), // IVA común en Colombia
            'quantity' => $this->faker->numberBetween(1, 100),
            'unit_cost' => $this->faker->randomFloat(2, 500, 200000), // $COP
        ];
    }
}
