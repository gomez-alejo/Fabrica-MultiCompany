<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'people';

    // Relación con la empresa
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // Relación con supplier (si esta persona es un proveedor)
    public function supplier()
    {
        return $this->hasMany(Supplier::class, 'person_id');
    }

    public function invioces()  {
        return $this->hasMany(Invoice::class);
    }

    public function request()  {
        return $this->hasMany(Request::class);
    }
}

