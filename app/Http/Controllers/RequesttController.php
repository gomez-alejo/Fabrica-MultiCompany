<?php

namespace App\Http\Controllers;

use App\Models\Requestt;
use Illuminate\Http\Request;

use App\Services\RequesttService;

class RequesttController extends Controller
{
    protected RequesttService $requesttService;

    public function __construct(RequesttService $requesttService)
    {
        $this->requesttService = $requesttService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $list = $this->requesttService->index($request->all());
        return response()->json([
            'data'    => $list,
            'message' => 'Listado de solicitudes obtenido correctamente.'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Se tiene a store
    }

    /**
     * Store a newly created resource in storage.
     */
    // El servicio de store ya llama a create en RequesttService
    public function store(Request $request)
    {
        $requestt = $this->requesttService->store($request->validate([
            // Todavía no sé qué reglas usaran xd
        ]));

        return response()->json([
            'data'    => $requestt,
            'message' => 'Solicitud creada correctamente.'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $requestt = $this->requesttService->show($id);

        return response()->json([
            'data'    => $requestt,
            'message' => "Solicitud {$id} obtenida correctamente."
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $requestt = $this->requesttService->update($id, $request->validate([
            // Todavía no sé qué reglas usaran xd
        ]));

        return response()->json([
            'data'    => $requestt,
            'message' => "Solicitud {$id} actualizada correctamente."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $deleted = $this->requesttService->delete($id);

        if ($deleted) {
            return response()->json([
                'message' => "Solicitud {$id} eliminada correctamente."
            ], 204);
        }

        return response()->json([
            'error' => "No se pudo eliminar la solicitud con ID {$id}."
        ], 400);
    }
}
