<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{


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

