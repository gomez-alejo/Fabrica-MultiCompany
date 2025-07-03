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
    protected $allowFilter = ['id', 'quantity'];
    protected $allowSort = ['id', 'quantity'];

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
    public function scopeSort(Builder $query)
    {

     if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);

      foreach ($sortFields as $sortField) {

            $direction = 'asc';

            if(substr($sortField, 0,1)=='-'){ 
                $direction = 'desc';
                $sortField = substr($sortField,1);
            }
            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }
        }
        
    }

    public function scopeGetOrPaginate(Builder $query)
    {
      if (request('perPage')) {
            $perPage = intval(request('perPage'));

            if($perPage){
                return $query->paginate($perPage);
            }


         }
           return $query->get();
    }

    public function scopeIncluded($query)
    {
        // Ajusta las relaciones según tu modelo
        return $query->with(['company', 'warehouse', 'product']);
    }

}