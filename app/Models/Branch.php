<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';

    // Relación con empresa
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // Relación con requests (solicitudes)
    public function requests()
    {
        return $this->hasMany(Request::class, 'branch_id');
    }
}
