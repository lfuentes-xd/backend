<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{

    public function index()
    {
        $food = Food::all();
        return response()->json($food, 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
        try {
            $request->validate([
                'Name' => 'required',
                'Description' => 'required',
                'Price' => 'required',
                'idFoodGroupFK' => 'required',
                'Image' => 'required'
            ]);
            if ($request->hasFile('Image')) {
                $imagePath = $request->file('Image')->store('resources/Images', 'public');
                $food = food::create([
                    'Name' => $request->Name,
                    'Description' => $request->Description,
                    'Price' => $request->Price,
                    'idFoodGroupFK' => $request->idFoodGroupFK,
                    'Image' => $imagePath
                ]);

                return response()->json(["success" => 'Product stored: ' . $food], 200);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        $food = Food::findOrFail($id);
        return response()->json($food, 200);
    }

    public function edit(Food $food)
    {
        //
    }

    public function update(Request $request, String $id)
    {
        try {
            $Food = Food::findOrFail($id);
            $request->validate([
                'Name' => 'required',
                'Description' => 'required',
                'Price' => 'required',
                'idFoodGroupFK' => 'required'
            ]);
            if ($request->hasFile('Image')) {
                $imagePath = $request->file('Image')->store('public');
                $Food->update([
                    'Name' => $request->Name,
                    'Description' => $request->Description,
                    'Price' => $request->Price,
                    'idFoodGroupFK' => $request->idFoodGroupFK,
                    'Image' => $imagePath
                ]);
            } else {
                $Food->update([
                    'Name' => $request->Name,
                    'Description' => $request->Description,
                    'Price' => $request->Price,
                    'idFoodGroupFK' => $request->idFoodGroupFK,
                ]);
            }
            return response()->json(["success" => 'Product updated: ' . $Food], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(String $id)
    {
        //
        try {
            Food::destroy($id);
            return response()->json(['the food was deleted']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred when trying to delete: ' . $e->getMessage()], 500);
        }
    }
}
