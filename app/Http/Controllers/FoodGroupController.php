<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\FoodGroup;
use Illuminate\Http\Request;

class FoodGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $foodgroups = FoodGroup::all();
        return $foodgroups;
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
                'Name'=> 'required'
            ]);
            $food_groups=FoodGroup::create([
                'Name'=>$request->Name
            ]);
            return response()->json(["success" => 'Product stored: ' . $food_groups], 200);
        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodGroup $foodGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodGroup $foodGroup)
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
            $FoodGroup = FoodGroup::findOrFail($id);
            $request -> validate([
                'Name'=>'required'
            ]);
            $FoodGroup->update([
                'Name'=>$request->Name
            ]);
            return response()->json(["success" => 'Product stored: '. $FoodGroup], 200);


        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to Update: ' . $e->getMessage()], 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        //

        try{

            FoodGroup::destroy($id);
            return response()->json(["success" => 'Product deleted: ' ], 200);
        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);
        }
    }
}
