<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }
    
    private function validationRules()
    {
        return [
            'name' => 'required|string|max:250',
            'nit' => 'required|string|max:30',
            'address' => 'required|string|max:250',
            'phones' => 'required|string|max:150',
            'website' => 'nullable|string|max:250',
            'email' => 'nullable|string|email|max:250',
        ];
    }

    public function index()
    {
        return response()->json($this->companyService->getAll());
        //$companies = Company::included()->filter()->sort()->getOrPaginate();
        //return response()->json($companies);

    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $company = $this->companyService->create($validated);

        return response()->json([
            'message' => 'Empresa creada correctamente',
            'data' => $company,
        ], 201);
    }

    public function show($id)
    {
        $company = Company::included()->findOrFail($id);

        return response()->json($company);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate($this->validationRules());

        $company = $this->companyService->update($id, $validated);

        if (!$company) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json([
            'message' => 'Empresa actualizada correctamente',
            'data' => $company,
        ]);
    }

    public function destroy($id)
    {
        $deleted = $this->companyService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json(['message' => 'Empresa eliminada correctamente']);
    }
}
