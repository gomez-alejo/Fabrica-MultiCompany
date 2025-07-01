<?php

namespace App\Http\Controllers;

use App\Services\InvoiceProductService;
use App\Http\Requests\StoreInvoiceProductRequest;
use App\Http\Requests\UpdateInvoiceProductRequest;
use Illuminate\Http\Request;

class InvoiceProductController extends Controller
{
    protected $invoiceProductService;

    public function __construct(InvoiceProductService $invoiceProductService)
    {
        $this->invoiceProductService = $invoiceProductService;
    }

    public function index()
    {
        $invoiceProducts = $this->invoiceProductService->all();
        return response()->json($invoiceProducts);
    }

    public function show($id)
    {
        $invoiceProduct = $this->invoiceProductService->show($id);

        if (!$invoiceProduct) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json($invoiceProduct);
    }

    public function store(StoreInvoiceProductRequest $request)
    {
        $invoiceProduct = $this->invoiceProductService->create($request->validated());

        return response()->json([
            'message' => 'Producto agregado a la factura correctamente.',
            'data' => $invoiceProduct
        ], 201);
    }

    public function update(UpdateInvoiceProductRequest $request, $id)
    {
        $invoiceProduct = $this->invoiceProductService->update($id, $request->validated());

        if (!$invoiceProduct) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json(['message' => 'Actualizado correctamente', 'data' => $invoiceProduct]);
    }

    public function destroy($id)
    {
        $invoiceProduct = $this->invoiceProductService->delete($id);

        if (!$invoiceProduct) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json(['message' => 'Eliminado correctamente']);
    }
}
