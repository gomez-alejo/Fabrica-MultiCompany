<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'person_id', 'business_name', 'nit'];

    public function products()
    {
        return $this->hasMany(Product::class); 
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class); // corregido "benlongsTo"
    }
}
