<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    // Relación con empresa
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // Relación con requests (solicitudes)
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'branch_id');
    }
}
