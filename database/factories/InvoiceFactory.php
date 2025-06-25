<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Company;
use App\Models\Branch;
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'branch_id' => Branch::factory(),
            'person_id' => Person::factory(),
            'user_id' => User::factory(),
            'invoice_number' => $this->faker->unique()->numberBetween(1000, 99999),
            'created_unix' => now()->timestamp,
            'payment_method' => $this->faker->randomElement(['Efectivo', 'Tarjeta', 'Transferencia']),
            'total' => $this->faker->randomFloat(2, 100, 10000),
            'iva_total' => function (array $attrs) {
                return round($attrs['total'] * 0.19, 2);
            },
        ];
    }
}
