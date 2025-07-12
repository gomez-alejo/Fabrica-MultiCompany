<?php

namespace App\Services\Impl;

use App\Services\RequesttService;
use App\Models\Requestt;

class RequesttServiceImpl implements RequesttService
{

    public function all(array $params = [])
    {
        return Requestt::query()
        ->included($params['include'] ?? null)
        ->filter($params['filter'] ?? [])
        ->sort($params['sort'] ?? null)
        ->paginate($params['per_page'] ?? 15);
    }
    
    public function show(int $id): Requestt
    {
        return Requestt::findOrFail($id);
    }

    public function store(array $data): Requestt
    {
        return Requestt::create($data);
    }

    public function update(int $id, array $data): Requestt
    {
        $requestt = $this->show($id);
        $requestt->update($data);
        return $requestt;
    }

    public function delete(int $id): bool
    {
        $requestt = $this->show($id);
        return $requestt->delete();
    }
   
}
