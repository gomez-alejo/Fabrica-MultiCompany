<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\Company;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(), // crea una company relacionada
            'person_id' => Person::factory(),   // crea una person relacionada
            'business_name' => $this->faker->company(),
            'nit' => $this->faker->unique()->numerify('##########'),
        ];
    }
}
