<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public function Products() {
        return $this->belongsToMany( Request_Product::class);
    }
    public function company()  {
        return $this->belongsTo(Company::class);
    }
    public function stocks()  {
        return $this->hasMany(Stock::class);
    }
    public function Invoices()  {
        return $this->belongsToMany(product_invoice::class);
    }
}
