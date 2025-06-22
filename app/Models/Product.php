<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function stocks() {
        return $this->hasMany(Stock::class);
    }
    public function invoices()  {
        return $this->belongsToMany(Invoice::class);
    }
    public function supplier()  {
        return $this->belongsTo(Supplier::class);
    }
    public function request()  {
        return $this->belongsToMany(Requestt::class);
    }
    public function company() {
        return $this->belongsTo(Company::class);
    }
}
