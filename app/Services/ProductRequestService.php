<?php

namespace App\Services;

interface ProductRequestService
{
    public function all();
    public function show($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
