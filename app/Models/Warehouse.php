<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public function requestProducts() {
        return $this->hasMany( Request_Product::class);
    }
    public function company()  {
        return $this->belongsTo(Company::class);
    }
    public function stocks()  {
        return $this->hasMany(Stock::class);
    }
    public function productInvoices()  {
        return $this->hasMany(product_invoice::class);
    }
}
