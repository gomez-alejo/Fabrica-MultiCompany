<?php

namespace App\Services;

interface WarehouseService
{
    public function all();
    public function show($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    
    /* public function getByCompanyId($companyId);
    public function getWithStocks();
    public function getWarehousesWithRequests(); */
}
