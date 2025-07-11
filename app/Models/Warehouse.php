<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Laravel\Prompts\form;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'address',
        'company_id',
    ];


    //no sabia que datos poner exactamente a falta de una docuemntacion clara, sorry puse los que tenian sentido
    protected $allowedFilter = ['name', 'city', 'company_id'];
    protected $allowedIncluded = [
        'company',
        'stocks',
        'stocks.product',
        'invoiceProducts',
        'invoiceProducts.invoice',
        'productRequests',
        'productRequests.product'
    ];
    protected $allowedSort = ['name', 'city', 'id'];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function invoiceProducts()
    {
        return $this->hasMany(InvoiceProduct::class);
    }
    public function productRequests()
    {
        return $this->hasMany(ProductRequest::class);
    }

    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowedIncluded) || empty(request('included'))) {
            return $query;
        }

        $relations = explode(',', request('included'));

        $allowedIncluded = collect($this->allowedIncluded);

        foreach ($relations as $key => $relation) {
            if (!$allowedIncluded->contains($relation)) {
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }

    public function scopeFilter(Builder $query)
    {

        if (empty($this->allowedFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');

        $allowedFilter = collect($this->allowedFilter);

        foreach ($filters as $filter => $value) {

            if ($allowedFilter->contains($filter)) {

                $query->where($filter, 'LIKE', '%' . $value . '%');
            }
        }
    }

    public function scopeSort(Builder $query)
    {

        if (empty($this->allowedSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowedSort = collect($this->allowedSort);

        foreach ($sortFields as $sortField) {

            $direction = 'asc';

            if (substr($sortField, 0, 1) == '-') { //cambiamos la consulta a 'desc'si el usuario antecede el menos (-) en el valor de la variable sort
                $direction = 'desc';
                $sortField = substr($sortField, 1); //copiamos el valor de sort pero omitiendo, el primer caracter por eso inicia desde el indice 1
            }
            if ($allowedSort->contains($sortField)) {
                $query->orderBy($sortField, $direction); //ejecutamos la query con la direccion deseada sea 'asc' o 'desc'
            }
        }
    }

    public function scopeGetOrPaginate(Builder $query)
    {
        if (request('perPage')) {
            $perPage = intval(request('perPage')); //transformamos la cadena que llega en un numero.

            if ($perPage) { //como la funcion intval retorna 0 si no puede hacer la conversion 0  es = false
                return $query->paginate($perPage); //retornamos la cuonsulta de acuerdo a la ingresado en la vaiable $perPage
            }
        }
        return $query->get(); //sino se pasa el valor de $perPage en la URL se pasan todos los registros.

    }
}
