<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        // 🔹 Verifica que existan empresas antes de crear sucursales
        if (Company::count() === 0) {
            Company::factory()->count(5)->create(); // Backup por si acaso
        }

        // 🔹 Crear 20 sucursales aleatorias
        Branch::factory()->count(20)->create();

        // 🔹 Sucursales con datos más realistas (comentadas)
        /*
        $exito = Company::where('name', 'Grupo Éxito S.A.')->first();
        $bavaria = Company::where('name', 'Bavaria S.A.')->first();

        if ($exito) {
            Branch::create([
                'company_id' => $exito->id,
                'name' => 'Sucursal Medellín Sur',
            ]);

            Branch::create([
                'company_id' => $exito->id,
                'name' => 'Sucursal Bogotá Centro',
            ]);
        }

        if ($bavaria) {
            Branch::create([
                'company_id' => $bavaria->id,
                'name' => 'Sucursal Planta Tocancipá',
            ]);
        }
        */
    }
}
