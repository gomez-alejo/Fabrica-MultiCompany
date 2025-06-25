<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        // Crear 10 empresas con datos aleatorios (factory)
        Company::factory()->count(10)->create();

        // Ejemplos comentados para empresas con datos más realistas
        /*
        Company::create([
            'name' => 'Grupo Éxito S.A.',
            'nit' => '890900451-2',
            'address' => 'Cra 48 #32B Sur - 139, Envigado, Antioquia',
            'phones' => '604 339 6060',
            'website' => 'https://www.grupoexito.com.co',
            'email' => 'contacto@grupoexito.com.co',
        ]);

        Company::create([
            'name' => 'Bavaria S.A.',
            'nit' => '860002802-9',
            'address' => 'Calle 50 #79-40, Bogotá, Cundinamarca',
            'phones' => '(1) 8000 512 526',
            'website' => 'https://www.bavaria.co',
            'email' => 'atencionalcliente@bavaria.co',
        ]);
        */
    }
}
