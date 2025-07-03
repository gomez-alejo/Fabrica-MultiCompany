<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;

class StockController extends Controller
{
    protected $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $stock = $this->stockService->getAll();
            return response()->json($stock);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el listado de stock',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'company_id' => 'required|integer|exists:companies,id',
                'warehouse_id' => 'required|integer|exists:warehouses,id',
                'product_id' => 'required|integer|exists:products,id',
                'quantity' => 'required|integer|min:0',
            ]);

            $stock = $this->stockService->create($request->all());

            return response()->json([
                'message' => 'Stock creado correctamente',
                'data' => $stock,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        try {
            // Cargar relaciones si es necesario
            $stock->load(['company', 'warehouse', 'product']);
            
            return response()->json([
                'message' => 'Stock obtenido correctamente',
                'data' => $stock,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Stock no encontrado',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        try {
            // En APIs REST, este método generalmente no se usa
            // pero puede devolver los datos para edición
            $stock->load(['company', 'warehouse', 'product']);
            
            return response()->json([
                'message' => 'Datos para editar stock',
                'data' => $stock,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Stock no encontrado',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        try {
            $request->validate([
                'company_id' => 'sometimes|required|integer|exists:companies,id',
                'warehouse_id' => 'sometimes|required|integer|exists:warehouses,id',
                'product_id' => 'sometimes|required|integer|exists:products,id',
                'quantity' => 'sometimes|required|integer|min:0',
            ]);

            $updatedStock = $this->stockService->update($stock, $request->all());

            return response()->json([
                'message' => 'Stock actualizado correctamente',
                'data' => $updatedStock,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        try {
            $this->stockService->delete($stock);

            return response()->json([
                'message' => 'Stock eliminado correctamente',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Stock no encontrado',
            ], 404);
        }
    }

    /**
     * Create a new stock entry (método adicional que ya tenías)
     */
    public function create(Request $request)
    {
        try {
            $request->validate([
                'company_id' => 'required|integer|exists:companies,id',
                'warehouse_id' => 'required|integer|exists:warehouses,id',
                'product_id' => 'required|integer|exists:products,id',
                'quantity' => 'required|integer|min:0',
            ]);

            $stock = $this->stockService->create($request->all());

            return response()->json([
                'message' => 'Stock creado correctamente',
                'data' => $stock,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);
        }
    }
}