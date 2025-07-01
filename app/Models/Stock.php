<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'warehouse_id',
        'product_id',
        'quantity',
    ];

    protected $allowInclude = ['warehouse', 'company', 'product'];
    protected $allowFilter = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function scopeInclude(Builder $query)
    {
        if (empty($this->allowInclude) || empty(request('include'))) {
            return $query;
        }
        
        $relations = explode(',', request('include'));
        $allowedRelations = array_intersect($relations, $this->allowInclude);
        
        if (!empty($allowedRelations)) {
            $query->with($allowedRelations);
        }
        
        return $query;
    }

    public function scopeFilter(Builder $query)
    {
        // Validar que allowFilter está definido y es un array
        if (!is_array($this->allowFilter) || empty($this->allowFilter)) {
            return $query;
        }

        // Obtener filtros de la solicitud y asegurarse de que es un array
        $filters = request('filter');

        if (!is_array($filters) || empty($filters)) {
            return $query;
        }

        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter) && !empty($value)) {
                $query->where($filter, 'LIKE', '%'.$value.'%');
            }
        }

        return $query;
    }
}