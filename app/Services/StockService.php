<?php

namespace App\Services;

use App\Models\Stock;

interface StockService
{
    public function create(array $data);
    public function update(Stock $stock, array $data);
    public function delete(Stock $stock);
    public function getAll();
}