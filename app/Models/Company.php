<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Company extends Model
{
   use HasFactory;

   protected $table = 'companies';

   protected $fillable = [
      'name',
      'nit',
      'address',
      'phones',
      'website',
      'email',
   ];

   public function invoices() {
      return $this->hasMany(Invoice::class); 
   }

   public function branches() {
      return $this->hasMany(Branch::class); 
   }

   public function suppliers() {
      return $this->hasMany(Supplier::class); 
   }

   public function people() {
      return $this->hasMany(Person::class); 
   }

   public function requests() {
      return $this->hasMany(Requestt::class); 
   }

   public function warehouses() {
      return $this->hasMany(Warehouse::class); 
   }

   public function products() {
      return $this->hasMany(Product::class); 
   }

   public function stocks() {
      return $this->hasMany(Stock::class); 
   }

   public function users() {
      return $this->hasMany(User::class); 
   }

   protected $allowedIncludes = [
     'users',
     'branches',
     'suppliers',
     'people',
     'requests',
     'warehouses',
     'products',
     'invoices',
     'products.stocks',
     'warehouses.stocks',
   ];

   protected $allowedFilters = [
      'name',
      'nit',
      'address',
      'phones',
      'website',
      'email',
   ];

   protected $allowedSorts = [
      'name',
      'nit',
      'address',
      'phones',
      'website',
      'email',
   ];

   public function scopeIncluded(Builder $query)
   {
      if (empty($this->allowedIncludes) || empty(request('included'))) {
        return $query;
      }
       
      $relations = explode(',', request('included'));
      $allowed = collect($this->allowedIncludes);

      $validRelations = array_filter($relations, fn($rel) => $allowed->contains($rel));

      return $query->with($validRelations);
   }

   public function scopeFilter(Builder $query)
   {
      if (empty($this->allowedFilters) || empty(request('filter'))) {
        return $query;
      }

      $filters = request('filter');
      $allowed = collect($this->allowedFilters);

      foreach ($filters as $field => $value) {
         if ($allowed->contains($field)) {
            $query->where($field, 'LIKE', "%$value%");
         }
      }

      return $query;
   }

   public function scopeSort(Builder $query)
    {
      if (empty($this->allowedSorts) || empty(request('sort'))) {
         return $query;
      }

      $sortFields = explode(',', request('sort'));
      $allowedSorts = collect($this->allowedSorts);

      foreach ($sortFields as $sortField) {
         $direction = 'asc';

         if (substr($sortField, 0, 1) === '-') {
            $direction = 'desc';
            $sortField = substr($sortField, 1);
         }

         if ($allowedSorts->contains($sortField)) {
            $query->orderBy($sortField, $direction);
         }
      }

      return $query;
   }

    public function scopeGetOrPaginate(Builder $query)
    {
      if (request('perPage')) {
         $perPage = intval(request('perPage'));

         if ($perPage > 0) {
            return $query->paginate($perPage);
         }
      }

      return $query->get();
   }
}
