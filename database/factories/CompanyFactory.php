<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'nit' => $this->faker->unique()->numerify('########-#'), // Ej: 900123456-7
            'address' => $this->faker->address(),
            'phones' => $this->faker->phoneNumber(),
            'website' => $this->faker->optional()->url(),
            'email' => $this->faker->optional()->companyEmail(),
        ];
    }
}
