<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegura que haya al menos algunas compañías
        if (Company::count() === 0) {
            Company::factory()->count(5)->create();
        }

        // 🔹 Crear 15 bodegas aleatorias
        Warehouse::factory()->count(15)->create();

        // 🔹 Ejemplos de bodegas reales (comentados)
        /*
        $exito = Company::where('name', 'Grupo Éxito S.A.')->first();
        $bavaria = Company::where('name', 'Bavaria S.A.')->first();

        if ($exito) {
            Warehouse::create([
                'name' => 'Centro Logístico Itagüí',
                'city' => 'Itagüí',
                'address' => 'Cl. 85 #45-21',
                'company_id' => $exito->id,
            ]);
        }

        if ($bavaria) {
            Warehouse::create([
                'name' => 'Bodega Central Bogotá',
                'city' => 'Bogotá',
                'address' => 'Av. Boyacá #123-45',
                'company_id' => $bavaria->id,
            ]);
        }
        */
    }
}
