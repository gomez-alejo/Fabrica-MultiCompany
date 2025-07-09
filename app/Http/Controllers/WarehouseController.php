<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Models\Warehouse;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $warehouseService;
    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }
    public function index()
    {
        $warehouses = $this->warehouseService->all();
        return response()->json($warehouses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarehouseRequest $request)
    {

        $warehouse = $this->warehouseService->create($request->validated());
        return response()->json([
            'message' => 'La bodega ha sido creada exitosamente.',
            'warehouse' => $warehouse
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        $warehouse = $this->warehouseService->show($warehouse->id);

        if (!$warehouse) {
            return response()->json(['message' => 'La bodega no fue encontrada'], 404);
        }
        return response()->json($warehouse);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {

        $updatedWarehouse = $this->warehouseService->update($warehouse->id, $request->validated());

        if (!$updatedWarehouse) {
            return response()->json(['message' => 'La bodega no fue encontrada'], 404);
        }

        return response()->json([
            'message' => 'La bodega ha sido actualizada exitosamente.',
            'warehouse' => $updatedWarehouse
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        $deleted = $this->warehouseService->delete($warehouse->id);

        if (!$deleted) {
            return response()->json(['message' => 'La bodega no fue encontrada'], 404);
        }

        return response()->json(['message' => 'La bodega ha sido eliminada.']);
    }
}
