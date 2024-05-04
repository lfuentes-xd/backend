<?php

namespace App\Http\Controllers;

use App\Models\favorite;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use App\Models\Food;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showfav($userId)
    {
        $favorite = favorite::where('IdUserFK', $userId)->with('food')->get();
        return $favorite;
    }

    public function index()
    {
        $favorite = favorite::all();
        return $favorite;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'IdUserFK' => 'required',
                'IdFoodFK' => 'required'
            ]);
            $favorite = favorite::create([
                'IdUserFK' => $request->IdUserFK,
                'IdFoodFK' => $request->IdFoodFK
            ]);
            return response()->json(["success" => 'Product stored: ' . $favorite], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);
        }
    }
    public function show(Request $request)
    {
        $request->validate([
            'IdUserFK' => 'required',
            'IdFoodFK' => 'required'
        ]);

        // Buscar los favoritos que coinciden con los IDs de usuario y comida
        $favorites = Favorite::where('IdUserFK', $request->IdUserFK)
            ->where('IdFoodFK', $request->IdFoodFK)
            ->pluck('id');

        return response()->json(["id"=>$favorites], 200);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        //
        try {
            $favorite = favorite::findOrFail($id);
            $request->validate([
                'IdUserFK' => 'required',
                'IdFoodFK' => 'required'
            ]);
            $favorite->update([
                'IdUserFK' => $request->IdUserFK,
                'IdFoodFK' => $request->IdFoodFK
            ]);
            return response()->json(["success" => 'Product favorite: ' . $favorite], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(String $id)
    // {
    //     try{
    //         favorite::destroy($id);
    //         return response()->json(['the favorite was deleted'], 200);
    //     }catch(Exception $e){
    //         return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);
    //     }
    // }

    public function destroy(String $id, Request $request)
    {
        try {
            // Buscar el favorito por su ID
            $favorite = Favorite::find($id);

            if (!$favorite) {
                return response()->json(['error' => 'El favorito no existe'], 404);
            }

            if ($favorite->IdUserFK != $request->IdUserFK) {
                return response()->json(['error' => 'No tienes permiso para eliminar este favorito' . $request->idUserFK], 403);
            }

            // Eliminar el favorito
            $favorite->delete();

            return response()->json(['message' => 'El favorito ha sido eliminado'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Ocurrió un error al intentar eliminar: ' . $e->getMessage()], 500);
        }
    }
}
