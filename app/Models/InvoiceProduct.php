<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceProductFactory> */
    use HasFactory;

    protected $table = 'invoice_product'; // Importatn: It's not in plural

    protected $fillable = [
        'invoice_id',
        'product_id',
        'warehouse_id',
        'iva',
        'quantity',
        'unit_cost',
    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }
}
