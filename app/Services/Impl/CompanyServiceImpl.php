<?php

namespace App\Services\Impl;

use App\Services\CompanyService;
use App\Models\Company;

class CompanyServiceImpl implements CompanyService
{
    public function getAll()
    {
        return Company::all();
    }

    public function getById($id)
    {
        return Company::findOrFail($id);
    }

    public function create(array $data)
    {
        return Company::create($data);
    }

    public function update($id, array $data)
    {
        $company = Company::findOrFail($id);
        $company->update($data);
        return $company;
    }

    public function delete($id)
    {
        $company = Company::findOrFail($id);
        return $company->delete();
    }
}
