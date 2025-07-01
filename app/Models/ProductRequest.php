<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProductRequest extends Model
{
    /** @use HasFactory<\Database\Factories\ProductRequestFactory> */
    use HasFactory;

    protected $table = 'product_request'; // Tabla personalizada: no plural, por eso se declara manualmente

    protected $fillable = [
        'request_id',
        'product_id',
        'warehouse_id',
        'iva',
        'quantity',
        'unit_cost',
    ];

    protected static $allowIncluded = [
        'requestt',
        'product',
        'warehouse',
    ];

    protected static $allowFilter = [
        'id',
        'request_id',
        'product_id',
        'warehouse_id',
        'iva',
        'quantity',
        'unit_cost',
    ];

    public function requestt()
    {
        return $this->belongsTo(Requestt::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function scopeIncluded(Builder $query)
    {
        if (empty(request('included'))) {
            return $query;
        }

        $relations = explode(',', request('included'));
        $allowed = collect(self::$allowIncluded);

        $validRelations = array_filter($relations, fn($rel) => $allowed->contains($rel));
        return $query->with($validRelations);
    }

    public function scopeFilter(Builder $query)
    {
        if (empty(request('filter'))) {
            return $query;
        }

        $filters = request('filter');
        $allowed = collect(self::$allowFilter);

        foreach ($filters as $field => $value) {
            if ($allowed->contains($field)) {
                $query->where($field, 'LIKE', "%$value%");
            }
        }

        return $query;
    }
}
