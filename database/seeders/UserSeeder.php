<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegurar que existan compañías
        if (Company::count() === 0) {
            Company::factory()->count(3)->create();
        }

        // 🔹 Crear 15 usuarios falsos
        User::factory()->count(15)->create();

        // 🔹 Usuarios realistas (comentados)
        /*
        $exito = Company::where('name', 'Grupo Éxito S.A.')->first();
        $bavaria = Company::where('name', 'Bavaria S.A.')->first();

        if ($exito) {
            User::create([
                'username' => 'admin_exito',
                'name' => 'Administrador Éxito',
                'password' => Hash::make('exito123'),
                'company_id' => $exito->id,
            ]);
        }

        if ($bavaria) {
            User::create([
                'username' => 'jefe_bavaria',
                'name' => 'Jefe de Planta',
                'password' => Hash::make('bavaria321'),
                'company_id' => $bavaria->id,
            ]);
        }
        */
    }
}
