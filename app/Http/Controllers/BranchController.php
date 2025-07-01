<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Validator; 
use App\Services\BranchService; 

class BranchController extends Controller
{
    // Propiedad protegida para almacenar una instancia de BranchService
    protected $branchService;

    // Constructor que inyecta una instancia de BranchService
    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    // Método para listar todas las sucursales
    public function index(Request $request)
    {
        try {
            // Obtiene todas las sucursales utilizando el servicio
            $branches = $this->branchService->getAll($request);
            // Retorna una respuesta JSON con las sucursales y un código de estado 200 (OK)
            return response()->json([
                'branches' => $branches,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            // Manejo de excepciones: retorna un mensaje de error y el código de estado 500 (Internal Server Error)
            return response()->json([
                'error' => 'Error al obtener sucursales',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Método para mostrar una sucursal específica por ID
    public function show(Request $request, $id)
    {
        try {
            // Busca una sucursal por su ID utilizando el servicio
            $branch = $this->branchService->findById($id, $request);
            // Retorna una respuesta JSON con la sucursal y un código de estado 200 (OK)
            return response()->json([
                'branch' => $branch,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            // Manejo de excepciones: retorna un mensaje de error y el código de estado 404 (Not Found) o el código de la excepción
            return response()->json([
                'error' => 'Sucursal no encontrada',
                'message' => $e->getMessage()
            ], $e->getCode() ?: 404);
        }
    }

    // Método para crear una nueva sucursal
    public function store(Request $request)
    {
        // Valida los datos de entrada para crear una sucursal
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,id', // El company_id es obligatorio y debe existir en la tabla companies
            'name' => 'required|string|max:100', // El nombre es obligatorio, debe ser una cadena y tener un máximo de 100 caracteres
        ]);

        // Si la validación falla, retorna un mensaje de error y los mensajes de validación con código de estado 422 (Unprocessable Entity)
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validación fallida',
                'messages' => $validator->errors(),
                'status' => 422
            ], 422);
        }

        try {
            // Crea una nueva sucursal utilizando el servicio
            $branch = $this->branchService->create($request->all());
            // Retorna una respuesta JSON con un mensaje de éxito, la sucursal creada y un código de estado 201 (Created)
            return response()->json([
                'message' => 'Sucursal creada exitosamente',
                'branch' => $branch,
                'status' => 201
            ]);
        } catch (\Exception $e) {
            // Manejo de excepciones: retorna un mensaje de error y el código de estado 500 (Internal Server Error) o el código de la excepción
            return response()->json([
                'error' => 'Error al crear la sucursal',
                'message' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    // Método para actualizar una sucursal existente
    public function update(Request $request, $id)
    {
        // Valida los datos de entrada para actualizar una sucursal
        $validator = Validator::make($request->all(), [
            'company_id' => 'sometimes|required|exists:companies,id', // El company_id es opcional en la actualización, pero si se proporciona, debe existir en la tabla companies
            'name' => 'sometimes|required|string|max:100', // El nombre es opcional en la actualización, pero si se proporciona, debe ser una cadena y tener un máximo de 100 caracteres
        ]);

        // Si la validación falla, retorna un mensaje de error y los mensajes de validación con código de estado 422 (Unprocessable Entity)
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validación fallida',
                'messages' => $validator->errors(),
                'status' => 422
            ], 422);
        }

        try {
            // Actualiza una sucursal utilizando el servicio
            $branch = $this->branchService->update($id, $request->all());
            // Retorna una respuesta JSON con un mensaje de éxito, la sucursal actualizada y un código de estado 200 (OK)
            return response()->json([
                'message' => 'Sucursal actualizada exitosamente',
                'branch' => $branch,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            // Manejo de excepciones: retorna un mensaje de error y el código de estado 500 (Internal Server Error) o el código de la excepción
            return response()->json([
                'error' => 'Error al actualizar la sucursal',
                'message' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    // Método para eliminar una sucursal
    public function destroy($id)
    {
        try {
            // Elimina una sucursal utilizando el servicio
            $this->branchService->delete($id);
            // Retorna una respuesta JSON con un mensaje de éxito y un código de estado 204 (No Content)
            return response()->json([
                'message' => 'Sucursal eliminada exitosamente',
                'status' => 204
            ]);
        } catch (\Exception $e) {
            // Manejo de excepciones: retorna un mensaje de error y el código de estado 500 (Internal Server Error) o el código de la excepción
            return response()->json([
                'error' => 'Error al eliminar la sucursal',
                'message' => 'Error al encontrar sucursal: '.$e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }
}
