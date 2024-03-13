<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;



class UserController extends Controller
{

    function create(Request $request){
        return view('usuarios.create');
    }
    function edit($id){
        $usuario=User::find($id);
        return view('usuarios.edit',['usuario'=>$usuario]);
    }
    function update(Request $request){
        try {
            $id=request('id');
            $usuario=User::findOrFail($id);
            $usuario->name=request('name');
            $usuario->email=request('email');
            $usuario->role=request('role');
            $usuario->status=request('status');
            if (request('contra')!='') {
                $usuario->password=request('contra');
            }
            $usuario->save();
            return redirect()->route('users')->with('mensaje','Registro Actualizado Correctamente!');
        } catch (\Throwable $th) {
            return redirect()->route('users')->with('error','Ocurrió un error durante el registro');
        }

    }

    public function register(Request $request){


        //Recepcionamos los datos para validar
        $validator=Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email'=> 'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:8'
        ]);

        //Preguntamos si hay errores en la validacion
        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        //Creamos el usuario
        $user = User::create([
            'name'=> $request->input('name'),
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
            'role'=>$request->input('role'),
        ]);

        return response()->json(['message'=>'Register Succesfully'], 201);

    }




    public function change_status(Request $request, $id_user)
    {

        try {
            $status_user=$request->input('status_user');
            $user = User::findOrFail($id_user);
            $user->status=$status_user;
            $user->save(); // Actualiza el estado del usuario
            return response()->json(['message' => 'Status cambiado correctamente'],200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th],500);
        }

    }

    public function users(Request $request){
        try {
            $users = User::all();
            return response()->json(['usuarios' => $users],200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'server error'],500);
        }
    }

}
