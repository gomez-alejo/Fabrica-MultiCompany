<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branches';

    protected $fillable = [
        'company_id',
        'name',
    ];
    // Relación con empresa
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // Relación con facturas
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'branch_id');
    }

        // Lista blanca de filtros permitidos
    protected static $allowedFilters = ['name', 'company_id'];

    // Lista blanca de relaciones permitidas para include[]
    protected static $allowedIncludes = ['company', 'invoices'];

    // Scope: incluir relaciones validadas
    public function scopeInclude($query, array $relations = [])
    {
        $validRelations = array_intersect($relations, self::$allowedIncludes);
        return $query->with($validRelations);
    }

    // Scope: aplicar filtros validados
    public function scopeFilter($query, array $filters = [])
    {
        foreach ($filters as $key => $value) {
            if (!in_array($key, self::$allowedFilters)) {
                continue; // Ignora filtros no permitidos
            }

            if ($key === 'name') {
                $query->where('name', 'like', '%' . $value . '%');
            }

            if ($key === 'company_id') {
                $query->where('company_id', $value);
            }
        }

        return $query;
    }
}
