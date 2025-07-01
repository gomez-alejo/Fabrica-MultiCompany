<?php

namespace App\Services\Impl;

// Importa las clases y facades necesarias
use App\Models\Branch;
use App\Services\BranchService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Exception;

class BranchServiceImpl implements BranchService
{
    // Método para obtener todas las sucursales con filtros y relaciones
    public function getAll(Request $request)
    {
        // Extrae los filtros de la solicitud
        $filters = $request->only(['name', 'company_id']);
        // Define las relaciones a incluir, por defecto incluye 'company'
        $includes = $request->input('include', ['company']);

        // Consulta las sucursales aplicando filtros e incluyendo relaciones, paginadas de 10 en 10
        return Branch::include($includes)
                    ->filter($filters)
                    ->paginate(10);
    }

    // Método para encontrar una sucursal por su ID
    public function findById($id, Request $request)
    {
        // Define las relaciones a incluir, por defecto incluye 'company'
        $includes = $request->input('include', ['company']);

        // Busca una sucursal por su ID, incluyendo las relaciones especificadas
        return Branch::query()
                    ->include($includes)
                    ->findOrFail($id);
    }

    // Método para crear una nueva sucursal
    public function create(array $data)
    {
        
            // Validación lógica: verifica que el nombre de la sucursal no esté vacío
            if (empty($data['name'])) {
                throw new \InvalidArgumentException("El nombre de la sucursal es obligatorio.");
            }

            // Crea una nueva sucursal con los datos proporcionados
            $branch = Branch::create($data);
            return $branch;
    }

    // Método para actualizar una sucursal existente
    public function update($id, array $data)
    {
    
            // Busca la sucursal por su ID o falla si no se encuentra
            $branch = Branch::findOrFail($id);

            // Validación lógica: verifica que el nombre de la sucursal no esté vacío
            if (empty($data['name'])) {
                throw new \InvalidArgumentException("El nombre no puede estar vacío.");
            }

            // Actualiza la sucursal con los nuevos datos
            $branch->update($data);
            return $branch;
    
    }

    // Método para eliminar una sucursal
    public function delete($id)
    {
            // Busca la sucursal por su ID o falla si no se encuentra
            $branch = Branch::findOrFail($id);
            // Elimina la sucursal
            $branch->delete();
            return true;
    }
}
