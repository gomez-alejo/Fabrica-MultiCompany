<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        // Asegura que haya empresas antes de crear personas
        if (Company::count() === 0) {
            Company::factory()->count(3)->create();
        }

        // 🔹 Crear 20 personas aleatorias
        Person::factory()->count(20)->create();

        // 🔹 Personas realistas (comentadas)
        /*
        $exito = Company::where('name', 'Grupo Éxito S.A.')->first();

        if ($exito) {
            Person::create([
                'identification' => '1032456789',
                'first_name' => 'Carlos',
                'last_name' => 'Ramírez',
                'phone' => '3124567890',
                'address' => 'Cra 45 #12-34 Medellín',
                'company_id' => $exito->id,
            ]);

            Person::create([
                'identification' => '1098765432',
                'first_name' => 'Laura',
                'last_name' => 'Moreno',
                'phone' => '3009876543',
                'address' => 'Calle 90 #45-67 Bogotá',
                'company_id' => $exito->id,
            ]);
        }
        */
    }
}
