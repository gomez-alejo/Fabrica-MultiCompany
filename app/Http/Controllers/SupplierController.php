<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        // Consulta con relaciones incluidas, filtrado, ordenamiento y paginación
        $suppliers = Supplier::included()->filter()->sort()->getOrPaginate();

        return response()->json($suppliers);
    }

    /**
     * Store a newly created supplier.
     */
    public function store(Request $request)
    {
        $request->validate([
            
            'company_id' => 'required|exists:companies,id',
            'person_id'  => 'required|exists:people,id',
            'business_name' => 'required|max:250',
            'nit' => 'required|max:30|unique:suppliers,nit',
        ]);

        $supplier = Supplier::create($request->all());

        return response()->json($supplier,201);
    }

    /**
     * Display the specified supplier.
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
    }

    /**
     * Update the specified supplier.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
     'company_id' => 'sometimes|exists:companies,id',
            'person_id'  => 'sometimes|exists:people,id',
            'business_name' => 'sometimes|max:250',
            'nit' => 'sometimes|max:30|unique:suppliers,nit,' . $supplier->id,
        ]);

        $supplier->update($request->all());

        return response()->json($supplier);
    }

    /**
     * Remove the specified supplier.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json(['message' => 'Supplier deleted successfully']);
    }
}