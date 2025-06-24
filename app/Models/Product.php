<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function stocks() {
        return $this->hasMany(Stock::class);
    }
    public function invoiceProducts()  {
        return $this->hasMany(InvoiceProduct::class);
    }
    public function supplier()  {
        return $this->belongsTo(Supplier::class);
    }
    public function productRequest(){
        return $this->hasMany(ProductRequest::class);
    }
    public function company() {
        return $this->belongsTo(Company::class);
    }
}
