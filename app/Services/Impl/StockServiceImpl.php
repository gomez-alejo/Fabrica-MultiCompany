<?php

namespace App\Services\impl;

use App\Models\Stock;
use App\Services\StockService;

class StockServiceImpl implements StockService
{
    public function create(array $data)
    {
        return Stock::create($data);
    }

    public function update(Stock $stock, array $data)
    {
        $stock->update($data);
        return $stock;
    }

    public function delete(Stock $stock)
    {
        $stock->delete();
    }

    public function getAll()
    {
        return Stock::included()->filter()->sort()->getOrPaginate();
    }
}