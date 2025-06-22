<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public function products() {
        return $this->belongsToMany(Product::class);
    }
    public function company()  {
        return $this->belongsTo(Company::class);
    }
    public function stocks()  {
        return $this->hasMany(Stock::class);
    }
    public function invoices()  {
        return $this->belongsToMany(Invoice::class);
    }
    public function requests()  {
        return $this->belongsToMany(Requestt::class);
    }
}
