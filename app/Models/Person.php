<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'identification',
        'first_name',
        'last_name',
        'phone',
        'address',
        'company_id',
    ];

    // Relación con la empresa
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Relación con supplier (si esta persona es un proveedor)
    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

    public function invoices()  {
        return $this->hasMany(Invoice::class);
    }

    public function requests()  {
        return $this->hasMany(Requestt::class);
    }
}

