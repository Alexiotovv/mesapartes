<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

use Validator;
use App\Models\User;
use std\Class;
use Iluminate\Support\Facades\Hash;


class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        
        try {
            $credentials = $request->only('email', 'password');
            if ($token = JWTAuth::attempt($credentials)) {
                return response()->json(compact('token'));
            }
            return response()->json(['error' => 'Unauthorized'], 401);  

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error de ervidor'], 500);
        }

    }


    public function logout()
    {
        $token = JWTAuth::getToken(); // Obtener el token JWT de la solicitud
    
        Auth::logout(); // Cerrar sesión en la aplicación
        if ($token) {
            JWTAuth::invalidate($token); // Invalidar el token JWT
        }
    
        // return view('login');
        return response()->json(['message' => 'Successfully logged out']);
    }

  
}
