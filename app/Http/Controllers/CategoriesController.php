<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

use Exception;

class CategoriesController extends Controller
{
    // 1. Lista categorías
    public function index()
    {
        try{

            $categories = Category::select('id', 'name', 'description')->get();

            if($categories){

                return response()->json(['categories' => $categories], 200);

            }
            else{

                return response()->json(['message' => 'No hay categorías registradas'], 404);

            }

        }
        catch(Exception $e){

            return response()->json([
                'error' => "Error al obtener categoría(s)"
            ], 500);

        }

    }

    // 2. Obtener una categoría en particular
    public function edit($id)
    {
        try{

            $category = Category::select('id', 'name', 'description')->findOrFail($id);

            if($category){

                return response()->json([
                    'category' => $category],
                200);

            }
            else{
                return response()->json(['message' => 'No se encuentra la categoría registrada'], 404);
            }

        }
        catch(Exception $e){

            return response()->json([
                'error' => "Error al obtener categoría"
            ], 500);

        }

    }

    // 3. Crear categoria
    public function store(CategoryRequest $request)
    {
        try{

            $category = new Category();
            $created = $category->create($request->validated());

            if($created){

                return response()->json([
                    'success' => "Categoría registrada exitosamente"],
                201);

            }

        }
        catch(Exception $e){

            return response()->json([
                'error' => "Error al registrar categoría"
            ], 500);

        }

    }

    // 4. Actuaizar una categoría
    public function update(CategoryRequest $request, $id)
    {
        try{

            $category = Category::findOrFail($id);
            $update = $category->update($request->validated());

            if($update){

                return response()->json([
                    'success' => "Categoría actualizada exitosamente"],
                201);

            }

        }
        catch(Exception $e){

            return response()->json([
                'error' => "Error al actualizar la categoría"
            ], 500);

        }

    }

    // 5. Eliminar una categoría en particular
    public function delete($id)
    {
        try{

            $category = Category::findOrFail($id);

            if($category){

                $category->delete($category);

                return response()->json([
                    'success' => "Categoría eliminada exitosamente"],
                201);

            }
            else {
                return response()->json(['error' => 'Categoría no encontrada'], 404);
            }

        }
        catch(Exception $e){

            return response()->json([
                'error' => "Error al eliminar la categoría"
            ], 500);

        }

    }

    // 6. Cantidad de productos de una categoría especifica
    public function quantity($category_id){

        try{
            // Obtenemos la categoría del producto
            $category = Category::findOrFail($category_id);

            // Verificar si la categoría tiene productos asociados
            if ($category->product()->exists()) {

                // Contar los productos en la categoría específica
                $quantity = $category->product()->count();
                $products = $category->product()->where('category_id', $category->id)->pluck('name')->toArray();

                $result = "Total de productos en la categoría " . Str::upper($category->name) . ": " . $quantity . " (" . implode(', ', $products) . ")";

                return response()->json([
                    'quantity' => $result
                ], 200);

            } else {
                return response()->json([
                    'message' => 'No hay productos registrados en la categoría '.$category->name
                ], 404);
            }

        }
        catch(Exception $e){

            return response()->json([
                'error' => "Error al obtener la categoría o no se encuentra registrada"
            ], 500);

        }

    }

}
