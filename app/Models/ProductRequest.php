<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    /** @use HasFactory<\Database\Factories\ProductRequestFactory> */
    use HasFactory;

    protected $table = 'product_request'; // Tabla personalizada: no plural, por eso se declara manualmente

        protected $fillable = [
        'request_id',
        'product_id',
        'warehouse_id',
        'iva',
        'quantity',
        'unit_cost',
    ];

    public function requestt(){
        return $this->belongsTo(Requestt::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }
}
