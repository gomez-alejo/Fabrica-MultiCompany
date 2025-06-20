<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    // Relación con empresa
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // Relación con proveedor
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    // Relación con producto
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_id');
    }

    // Usuario que creó la factura
    public function person()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

