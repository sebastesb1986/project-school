<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    // 1. Lista productos
    public function index()
    {
        try{

            $products = Product::select('name', 'description', 'quantity', 'category_id')->get();

            if($products){

                return response()->json(['products'=> $products], 200);

            }
            else{

                return response()->json(['message' => 'No hay productos registrados'], 404);

            }

        }
        catch(Exception $e){

            return response()->json([
                'error' => "Error al obtener producto(s)"
            ], 500);

        }

    }

    // 2. Obtener un producto en particular
    public function edit($id)
    {
        try{

            $product = Product::select('id', 'name', 'description', 'quantity', 'category_id')->findOrFail($id);

            if($product){

                return response()->json([
                    'product' => $product],
                200);

            }
            else{
                return response()->json(['message' => 'No se encuentra el producto registrado'], 404);
            }

        }
        catch(Exception $e){

            return response()->json([
                'error' => "Error al obtener producto"
            ], 500);

        }

    }

    // 3. Crear categoria
    public function store(ProductRequest $request)
    {
        try{

            $product = new Product();
            $data = $request->validated();
            $created = $product->create($data);

            if($created){

                return response()->json([
                    'success' => "Producto registrado exitosamente"],
                201);

            }

        }
        catch(Exception $e){

            return response()->json([
                'error' => "Error al registrar producto"
            ], 500);

        }

    }

    // 4. Actuaizar un producto
    public function update(ProductRequest $request, $id)
    {
        try{

            $product = Product::findOrFail($id);
            $data = $request->validated();
            $update = $product->update($data);

            if($update){

                return response()->json([
                    'success' => "Producto actualizado exitosamente"],
                201);

            }

        }
        catch(Exception $e){

            return response()->json([
                'error' => "Error al actualizar producto"
            ], 500);

        }

    }

    // 5. Eliminar un producto en particular
    public function delete($id)
    {
        try{

        $product = Product::findOrFail($id);

        if($product){

            $product->delete($product);

            return response()->json([
                'success' => "Producto eliminado exitosamente"],
            201);

        }
        else {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        }
        catch(Exception $e){

            return response()->json([
                'error' => "Error al eliminar el producto"
            ], 500);

        }

    }
}
