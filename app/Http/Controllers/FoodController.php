<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       
            $food = Food::all();
            return $food;
        
        
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
        if ($request->hasFile('Image')) {
            try{
                $request -> validate([
                    'Name'=> 'required',
                    'Description'=>'required',
                    'Price'=>'required',
                    'idFoodGroupFK'=>'required',
                    'Image'=>'required'
        
                ]);
                
                     $customFileName = 'mi_archivo_personalizado.' . $request->file('Image')->getClientOriginalExtension();
                    $imagePath = $request->file('Image')->store('resources/Images', 'public');
                    $food = food::create([
                        'Name'=> $request->Name,
                        'Description'=> $request->Description,
                        'Price'=> $request->Price,
                        'idFoodGroupFK'=> $request->idFoodGroupFK,
                        'Image' => $imagePath
                    ]);
                
                return response()->json(["success" => 'Product stored: ' . $food], 200);
                
            }catch(Exception $e){
                return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);
            }
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
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
            $Food = Food::findOrFail($id);
            $request->validate([
                'Name'=> 'required',
                'Description'=>'required',
                'Price'=>'required',
                'idFoodGroupFK'=>'required'
            ]);
            if ($request->hasFile('Image')) {
                // $customFileName = 'mi_archivo_personalizado.' . $request->file('Image')->getClientOriginalExtension();
                $imagePath = $request->file('Image')->store('Images', 'public');
                $Food->Update([
                    'Name'=>$request->Name,
                    'Description'=> $request->Description,
                    'Price'=> $request->Price,
                    'idFoodGroupFK'=> $request->idFoodGroupFK,
                    'Image' => $imagePath
                ]);
            }
            return response()->json(["success" => 'Product stored: ' . $Food], 200);

            

        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food, String $id)
    {
        //
        try{
            Food::destroy($id);
            return response()->json(['the food was deleted']);
        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);

        }
    }
}
