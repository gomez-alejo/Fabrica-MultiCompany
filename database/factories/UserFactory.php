<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->userName(),
            'name' => $this->faker->name(),
            'password' => Hash::make('password123'), // Default password
            'company_id' => Company::inRandomOrder()->first()?->id ?? Company::factory(),
        ];
    }
}
