<?php

namespace App\Services\Impl;

use App\Services\RequesttService;
use App\Models\Requestt;

class RequesttServiceImpl implements RequesttService
{

    public function index()
    {
        return Requestt::all();
        //Posibles cambios en el MR 
   /*          ->included()
            ->filter()
            ->sort()
            ->paginate(); */
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
