<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email', 
            'password' => 'required|string|max:50|confirmed',
            'company_id' => 'required|exists:companies,id',
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email, 
            'password' => bcrypt($request->password),
            'company_id' => $request->company_id,
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'username' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');// Asegúrate de que el campo email esté presente en la solicitud

        if (!$token = JWTAuth::attempt($credentials)) {// Verifica las credenciales
            // Si las credenciales son incorrectas, devuelve un error 401
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        return response()->json(['token' => $token]);// Devuelve el token JWT generado
    }

    public function me()// Obtiene los datos del usuario autenticado
    {  
        // Verifica si el token es válido y obtiene el usuario autenticado
        return response()->json(JWTAuth::parseToken()->authenticate());// Devuelve los datos del usuario autenticado
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Sesión cerrada']);
    }

    public function refresh()
    {
        $newToken = JWTAuth::refresh(JWTAuth::getToken());
        return response()->json(['token' => $newToken]);
    }
}
