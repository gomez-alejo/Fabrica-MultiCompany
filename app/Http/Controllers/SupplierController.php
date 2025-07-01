<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SupplierService;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        return response()->json($this->supplierService->getAll());
    }

    public function store(Request $request)
    {
        return response()->json($this->supplierService->create($request->all()), 201);
    }

    public function show($id)
    {
        return response()->json($this->supplierService->getById($id));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->supplierService->update($id, $request->all()));
    }

    public function destroy($id)
    {
        $this->supplierService->delete($id);
        return response()->json(['message' => 'Proveedor eliminado correctamente']);
    }
}
