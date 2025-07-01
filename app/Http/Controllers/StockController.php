<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Services\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
    {
        $stock = Stock::include()->filter()->get();
        return response()->json($stock);
    }
protected $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function create(Request $request)
    {
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
