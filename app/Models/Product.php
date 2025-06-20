<?php

namespace App\Models;

use App\Http\Controllers\ProductInvoiceController;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function stocks() {
        return $this->hasMany(Stock::class);
    }
    public function Invoices()  {
        return $this->belongsToMany(ProductInvoiceController::class);
    }
    public function supplier()  {
        return $this->belongsTo(Supplier::class);
    }
    public function request()  {
        return $this->belongsToMany(Request_Product::class);
    }
    public function company() {
        return $this->belongsTo(Company::class);
    }
}
