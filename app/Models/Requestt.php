<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Requestt extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'company_id',
        'user_id',
        'person_id',
        'status',
        'products_json',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function productRequest()
    {
        return $this->hasMany(ProductRequest::class);
    }
}
