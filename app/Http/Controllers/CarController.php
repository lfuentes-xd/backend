<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Food;



use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showCarr($userId)
    {
        $Car = Car::where('IdUserFK', $userId)->with('food')->get();
        return $Car;
    }
    public function index()
    {
        //
        $Car = Car::all();
        return $Car; 
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
            $Car = Car::create([
                'IdUserFK'=>$request->IdUserFK,
                'IdFoodFK'=>$request->IdFoodFK
            ]);
            return response()->json(["success" => 'Product stored: ' . $Car], 200);

        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car, String $id)
    {
        //
        try{
            $Car=Car::findOrFail($id);
            $request-> validate([
                'IdUserFK'=>'required',
                'IdFoodFK'=>'required'
            ]);
            $Car->update([
                'IdUserFK'=>$request->IdUserFK,
                'IdFoodFK'=>$request->IdFoodFK
            ]);
            return response()->json(["success" => 'Product favorite: ' . $Car], 200);

        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);


        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car, String $id)
    {
        //
        try{
            Car::destroy($id);
            return response()->json(['the Car was deleted']);
        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);

        }
    }
}
