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

        //LISTAS BLANCAS
    protected $allowIncluded = [
        'user',
        'person',
        'company'
    ];

    //protected $allowFilter = ['id']; //Preguntar a dan
    //protected $allowSort = ['id', 'name', 'unit_price', 'min_stock'];

    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }
        
        $relations = explode(',', request('included'));
        $allowedIncluded = collect( $this->allowedIncluded);

        foreach ($relations as $key => $relation) {
            if (!$allowedIncluded->contains($relation)) {
                unset($relations[$key]);
            }
        }

        $query->with($relations);

    }

    protected $casts = [
        'products_json' => 'array',
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

    public function productRequests()
    {
        return $this->hasMany(ProductRequest::class);
    }
}
