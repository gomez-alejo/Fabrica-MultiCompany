<?php

namespace App\Services\Impl;

use App\Services\WarehouseService;
use App\Models\Warehouse;

class WarehouseServiceImpl implements WarehouseService
{
    public function all()
    {
        return Warehouse::query()
            ->included()
            ->filter()
            ->sort()
            ->getOrPaginate();
    }

    public function show($id)
    {
        return Warehouse::findOrFail($id);
    }

    public function create(array $data)
    {
        return Warehouse::create($data);
    }

    public function update($id, array $data)
    {
         $warehouse = Warehouse::find($id);

        if (!$warehouse) {
            return null;
        }

        $warehouse->update($data);
        return $warehouse;

    }

    public function delete($id)
    {
        $warehouse = $this->show($id);
        if (!$warehouse) {
            return null;
        }
        return $warehouse->delete();
    }

}
