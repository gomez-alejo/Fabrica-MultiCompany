<?php

namespace App\Http\Controllers;

use App\Services\ProductRequestService;
use App\Http\Requests\StoreProductRequestRequest;
use App\Http\Requests\UpdateProductRequestRequest;

class ProductRequestController extends Controller
{
    protected $productRequestService;

    public function __construct(ProductRequestService $productRequestService)
    {
        $this->productRequestService = $productRequestService;
    }

    public function index()
    {
        $productRequests = $this->productRequestService->all();
        return response()->json($productRequests);
    }

    public function show($id)
    {
        $productRequest = $this->productRequestService->show($id);
        if (!$productRequest) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json($productRequest);
    }

    public function store(StoreProductRequestRequest $request)
    {
        $productRequest = $this->productRequestService->create($request->validated());
        return response()->json(['message' => 'Producto agregado a solicitud.', 'data' => $productRequest], 201);
    }

    public function update(UpdateProductRequestRequest $request, $id)
    {
        $productRequest = $this->productRequestService->update($id, $request->validated());
        if (!$productRequest) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json(['message' => 'Actualizado correctamente', 'data' => $productRequest]);
    }

    public function destroy($id)
    {
        $productRequest = $this->productRequestService->delete($id);
        if (!$productRequest) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json(['message' => 'Eliminado correctamente']);
    }
}
