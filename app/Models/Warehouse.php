<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'address',
        'company_id',
    ];


    public function company()  {
        return $this->belongsTo(Company::class);
    }
    public function stocks()  {
        return $this->hasMany(Stock::class);
    }
    public function invoiceProducts()  {
        return $this->hasMany(InvoiceProduct::class);
    }
    public function requests()  {
        return $this->belongsToMany(Requestt::class);
    }
}
