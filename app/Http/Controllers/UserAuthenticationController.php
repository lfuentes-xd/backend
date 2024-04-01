<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $User=User::all();
        return $User;
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
    public function login(Request $request){
        $request->validate([
            'Email'=>'required',
            'Password'=>'required'

        ]);
        $User=User::where('Email', $request->Email)->first();

        if(!$User|| !Hash::check($request->Password, $User->Password)){
            return response([
                'message'=>'The provided credential are incorrect'

            ], 401);
        }
        $token=$User->createToken('auth_token')->accessToken;
        
        return response([
            'token'=> $token
        ]);
    }
    public function store_register(Request $request)
    {
        //
        try{
            $request->validate([
                'Name'=>'required',
                'FirstSurname'=>'required',
                'SecondSurname'=>'required',
                'PhoneNumber'=>'required',
                'Email'=>'required',
                'Password'=>'required',
                'ControlNumber'=>'required',
                'Rol'=>'required'
            ]);
            $User=User::create([
                'Name'=>$request->Name,
                'FirstSurname'=>$request->FirstSurname,
                'SecondSurname'=>$request->SecondSurname,
                'PhoneNumber'=>$request->PhoneNumber,
                'Email'=>$request->Email,
                'Password'=> Hash::make($request->Password),
                'ControlNumber'=>$request->ControlNumber,
                'Rol'=>$request->Rol
            ]);
            return response()->json(["success" => 'Product stored: ' . $User], 200);
        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);

        }
    }
    public function userauth(){
        $User = auth()->User();

        if($User){
            return response()->json([
                'id'=> $User->id,
                'Name'=>$User->Name,
                'FirstSurname'=>$User->FirstSurname,
                'SecondSurname'=>$User->SecondSurname,
                'PhoneNumber'=>$User->PhoneNumber,
                'Email'=>$User->Email,
                'Password'=> Hash::make($User->Password),
                'ControlNumber'=>$User->ControlNumber,
                'Rol'=>$User->Rol

            ]);
        }
        return response()->json(['error' => 'Usuario no autenticado'], 401);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(UserAuthentication $userAuthentication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAuthentication $userAuthentication)
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
            $User=User::findOrFail($id);
            $request->validate([
                'Name'=>'required',
                'FirstSurname'=>'required',
                'SecondSurname'=>'required',
                'PhoneNumber'=>'required',
                'Email'=>'required',
                'Password'=>'required',
                'ControlNumber'=>'required',
                'Rol'=>'required'
            ]);
            $User->update([
                'Name'=>$request->Name,
                'FirstSurname'=>$request->FirstSurname,
                'SecondSurname'=>$request->SecondSurname,
                'PhoneNumber'=>$request->PhoneNumber,
                'Email'=>$request->Email,
                'Password'=>$request->Password,
                'ControlNumber'=>$request->ControlNumber,
                'Rol'=>$request->Rol
            ]);

            

            return response()->json(["success" => 'Product stored: ' . $User], 200);
 

        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAuthentication $userAuthentication, string $id)
    {
        //
        try{
            User::destroy($id);
            return response()->json(['the user was deleted']);
        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);

        }
    }
}
