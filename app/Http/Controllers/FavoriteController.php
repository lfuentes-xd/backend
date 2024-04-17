<?php

namespace App\Http\Controllers;

use App\Models\favorite;
use Illuminate\Http\Request;
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
        //
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{
            $request-> validate([
                'IdUserFK'=>'required',
                'IdFoodFK'=>'required'
            ]);
            $favorite = favorite::create([
                'IdUserFK'=>$request->IdUserFK,
                'IdFoodFK'=>$request->IdFoodFK
            ]);
            return response()->json(["success" => 'Product stored: ' . $favorite], 200);

        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(favorite $favorite)
    {
        //
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
        try{
            $favorite=favorite::findOrFail($id);
            $request-> validate([
                'IdUserFK'=>'required',
                'IdFoodFK'=>'required'
            ]);
            $favorite->update([
                'IdUserFK'=>$request->IdUserFK,
                'IdFoodFK'=>$request->IdFoodFK
            ]);
            return response()->json(["success" => 'Product favorite: ' . $favorite], 200);

        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);


        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(favorite $favorite, String $id)
    {
        //
        try{
            favorite::destroy($id);
            return response()->json(['the favorite was deleted']);
        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);

        }
    }
}
