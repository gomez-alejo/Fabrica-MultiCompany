<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Services\UserService; // Asegúrate de que el servicio de usuario esté correctamente importado
use App\Models\User;
use App\Models\Company;
use App\Http\Requests\UpdateUserRequest; // Asegúrate de que la solicitud de actualización esté correctamente importada 
class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    { // Asegúrate de que UserService esté correctamente inyectado
        $this->userService = $userService; // Inyecta el servicio de usuario
    }

    public function index()
    {

        $user = $this->userService->all(); // Obtiene todos los usuarios usando el servicio
        $user = User::include()->filter()->get();
        return response()->json($user);
    }

    public function create()
    {
        $companies = Company::all();
        return view('dashboard.index', compact('companies'));
    }
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->create($request->validated());
        return response()->json([
            'message' => 'Usuario creado exitosamente',
            'user' => $user
        ], 201);
    }

    public function show($id)
    {
        $user = $this->userService->show($id);
        if (!$user) {
            return response()->json(['message' => 'no encontrado'], 404);
        }
        return response()->json($user);
    }
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userService->update($id, $request->validated());
        if (!$user) {
            return response()->json(['message' => 'no encontrado'], 404);
        }
        return response()->json(['message' => 'Usuario actualizado exitosamente', 'data' => $user]);
    }
    public function destroy($id)
    {
        $user = $this->userService->delete($id);
        if (!$user) {
            return response()->json(['message' => 'no encontrado'], 404);
        }

        return response()->json(['message' => 'Usuario eliminado exitosamente']);
    }
}