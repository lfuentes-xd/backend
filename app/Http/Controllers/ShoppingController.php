<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Shopping = Shopping::all();
        return $Shopping;
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
            $request -> validate([
                
                'Quantity'=> 'required',
                'IdUserFK'=> 'required',
                'IdFoodFK'=> 'required'
            ]);
            $Shopping=Shopping::create([
                
                'Quantity'=> $request->Quantity,
                'IdUserFK'=> $request->IdUserFK,
                'IdFoodFK'=>  $request->IdFoodFK
            ]);
            return response()->json(["success" => 'Product stored: ' . $Shopping], 200);
        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Shopping $shopping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shopping $shopping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try{
            $Shopping=Shopping::findOrFail($id);
        $request->validate([
            'Quantity'=> 'required',
            'IdUserFK'=> 'required',
            'IdFoodFK'=> 'required'
        ]);
        $Shopping->update([
            'Quantity'=> $request->Quantity,
            'IdUserFK'=> $request->IdUserFK,
            'IdFoodFK'=>  $request->IdFoodFK
        ]);
        return response()->json(["success" => 'Product stored: ' . $Shopping], 200);
        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shopping $shopping)
    {
        //
        Shopping::destroy($id);
    }
}
