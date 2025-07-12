<?php

namespace App\Services;
use App\Models\Requestt;

interface RequesttService
{
    //
    public function all(array $params = []);

    public function show(int $id): Requestt;

    public function store(array $data): Requestt;

    public function update(int $id, array $data): Requestt;

    public function delete(int $id): bool;
}
