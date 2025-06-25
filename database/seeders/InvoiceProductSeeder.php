<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        // Validamos que existan registros necesarios
        if (Invoice::count() === 0 || Product::count() === 0 || Warehouse::count() === 0) {
            $this->command->warn('Creando registros mínimos para facturas, productos y bodegas...');
            Invoice::factory()->count(5)->create();
            Product::factory()->count(10)->create();
            Warehouse::factory()->count(3)->create();
        }

        // 🔹 Crear 20 relaciones factura-producto-bodega
        InvoiceProduct::factory()->count(20)->create();

        // 🔹 Ejemplo realista (comentado)
        /*
        $invoice = Invoice::first();
        $product = Product::first();
        $warehouse = Warehouse::first();

        if ($invoice && $product && $warehouse) {
            InvoiceProduct::create([
                'invoice_id' => $invoice->id,
                'product_id' => $product->id,
                'warehouse_id' => $warehouse->id,
                'iva' => 19,
                'quantity' => 10,
                'unit_cost' => 89900,
            ]);
        }
        */
    }
}
