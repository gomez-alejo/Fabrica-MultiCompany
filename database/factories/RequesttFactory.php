<?php

namespace Database\Factories;

use App\Models\Requestt;
use App\Models\Company;
use App\Models\User;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequesttFactory extends Factory
{
    protected $model = Requestt::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'user_id' => User::factory(),
            'person_id' => Person::factory(),
            'status' => $this->faker->randomElement(['pendiente', 'aprobado', 'rechazado']),
            'products_json' => json_encode([
                [
                    'product_id' => $this->faker->numberBetween(1, 20),
                    'quantity' => $this->faker->numberBetween(1, 10)
                ],
                [
                    'product_id' => $this->faker->numberBetween(21, 40),
                    'quantity' => $this->faker->numberBetween(1, 5)
                ]
            ]),
        ];
    }
}
