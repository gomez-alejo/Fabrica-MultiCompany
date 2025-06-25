<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'barcode',
        'description',
        'category',
        'unit_price',
        'iva',
        'min_stock',
        'company_id',
        'supplier_id',
    ];

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function invoiceProducts()
    {
        return $this->hasMany(InvoiceProduct::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function productRequest()
    {
        return $this->hasMany(ProductRequest::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
