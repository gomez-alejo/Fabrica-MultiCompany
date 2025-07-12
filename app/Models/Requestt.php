<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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
        //Sujetos a cambios
    protected $allowFilter = ['id', 'company', 'status']; 
    protected $allowSort = ['id', 'company', 'status'];

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

    public function scopeIncluded(Builder $query, $relations = null)
    {
    if (!$relations) return $query;

    $relationsArray = explode(',', $relations);

    $allowed = array_intersect($relationsArray, $this->allowIncluded);

    return $query->with($allowed);
    }

    public function scopeFilter(Builder $query, $filters = [])
    {
    if (!is_array($filters)) return $query;

    foreach ($filters as $field => $value) {
        if (in_array($field, $this->allowFilter) && $value !== null) {
            $query->where($field, $value);
        }
    }

    return $query;
    }

    public function scopeSort(Builder $query, $sort = null)
    {
    if (!$sort) return $query;

    foreach (explode(',', $sort) as $column) {
        $direction = 'asc';
        if (str_starts_with($column, '-')) {
            $direction = 'desc';
            $column = ltrim($column, '-');
        }

        if (in_array($column, $this->allowSort)) {
            $query->orderBy($column, $direction);
        }
    }

    return $query;
    }    
}
