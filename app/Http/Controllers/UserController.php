<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        try{

            $users = User::select('name', 'email', 'phone')->get();

            if($users){

                return response()->json(['user'=> $users], 200);

            }
            else{

                return response()->json(['message' => 'No hay usuarios registrados'], 404);

            }

        }
        catch(Exception $e){

            return response()->json([
                'error' => "Error al obtener usuario(s)"
            ], 500);

        }

    }

    // 2. Obtener un usuario en particular
    public function edit($id)
    {
        try{

            $product = User::select('id', 'name', 'email', 'phone')->findOrFail($id);

            if($product){

                return response()->json([
                    'product' => $product],
                200);

            }
            else{
                return response()->json(['message' => 'No se encuentra el usuario registrado'], 404);
            }

        }
        catch(Exception $e){

            return response()->json([
                'error' => "Error al obtener usuario"
            ], 500);

        }

    }

    // 3. Crear categoria
    public function store(UserRequest $request)
    {
        try{

            $user = new User();
            $data = $request->validated();
            $created = $user->create($data);

            if($created){

                return response()->json([
                    'success' => "Tus datos han sido guardados"],
                201);

            }

        }
        catch(Exception $e){

            return response()->json([
                'error' => "Error al registrar usuario"
            ], 500);

        }

    }
}
