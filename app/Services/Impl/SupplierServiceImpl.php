<?php

namespace App\Services\Impl;

use App\Models\Supplier;
use App\Services\SupplierService;

class SupplierServiceImpl implements SupplierService
{
    public function getAll()
    {
        return Supplier::with(['company', 'person', 'products'])->get();
    }

    public function getById($id)
    {
        return Supplier::with(['company', 'person', 'products'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Supplier::create($data);
    }

    public function update($id, array $data)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($data);
        return $supplier;
    }

    public function delete($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
    }
}
