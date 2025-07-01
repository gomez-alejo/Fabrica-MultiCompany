<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }


    public function index(Request $request)
    {
        $query = Invoice::query();
        if ($request->has('with')) {
            $relations = explode(',', $request->with);
            $query->include($relations);
        }
        $filters = $request->all();
        $query->filterBy($filters);
        return $query->get();
    }

    
    public function store(Request $request)
    {   
        $validated = $request->validate([
        'person_id'       => 'required|exists:people,id',
        'company_id'      => 'required|exists:companies,id',
        'branch_id'       => 'required|exists:branches,id',
        'user_id'         => 'required|exists:users,id',
        'invoice_number'  => 'required|numeric|unique:invoices,invoice_number',
        'created_unix'    => 'required|integer',
        'payment_method'  => 'required|string|max:50',
        'total'           => 'required|numeric|min:0',
        'iva_total'       => 'required|numeric|min:0',
        ]);
        $invoice = $this->invoiceService->create($validated);
        return response()->json([
            'message' => 'Factura creada correctamente.',
            'data' => $invoice
        ], 201);
    }

    
    public function show($id)
    {
        $invoice = $this->invoiceService->show($id);
        if (!$invoice) {
            return response()->json(['message' => 'No encontrado'], 404);
        }
        return response()->json([
            'message' => 'Factura encontrada.',
            'data' => $invoice
            ]);
    }


    public function update(Request $request, int $id)
    {
    $validated = $request->validate([
        'person_id'       => 'sometimes|exists:people,id',
        'company_id'      => 'sometimes|exists:companies,id',
        'branch_id'       => 'sometimes|exists:branches,id',
        'user_id'         => 'sometimes|exists:users,id',
        'invoice_number'  => 'sometimes|numeric|unique:invoices,invoice_number,' . $id,
        'created_unix'    => 'sometimes|integer',
        'payment_method'  => 'sometimes|string|max:50',
        'total'           => 'sometimes|numeric|min:0',
        'iva_total'       => 'sometimes|numeric|min:0',
    ]);
        $invoice = $this->invoiceService->update($id, $validated);
        if (!$invoice) {
            return response()->json(['message' => 'Factura no encontrada.'], 404);
        }
        return response()->json([
            'message' => 'Factura actualizada correctamente.',
            'data'    => $invoice
        ]);
    }


    public function destroy($id)
    {
        $invoice = $this->invoiceService->delete($id);
        if (!$invoice) {
            return response()->json(['message' => 'No encontrado'], 404);
        }
        return response()->json(['message' => 'Eliminado correctamente']);
    }
}
