<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $user=User::where('email', $request->email)->first();

        if(!$user|| !Hash::check($request->password, $user->password)){
            return response([
                'message'=>'The provided credential are incorrect'

            ], 401);
        }
        $token=$user->createToken('auth_token')->accessToken;
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
                'Rol'=>'required'
            ]);
            $User=User::create([
                'Name'=>$request->Name,
                'FirstSurname'=>$request->FirstSurname,
                'SecondSurname'=>$request->SecondSurname,
                'PhoneNumber'=>$request->PhoneNumber,
                'Email'=>$request->Email,
                'Password'=>$request->Password,
                'Rol'=>$request->Rol
            ]);
            return response()->json(["success" => 'Product stored: ' . $User], 200);
        }catch(Exception $e){
            return response()->json(['error' => 'An error occurred when trying to store: ' . $e->getMessage()], 500);

        }
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
                'Rol'=>'required'
            ]);
            $User->update([
                'Name'=>$request->Name,
                'FirstSurname'=>$request->FirstSurname,
                'SecondSurname'=>$request->SecondSurname,
                'PhoneNumber'=>$request->PhoneNumber,
                'Email'=>$request->Email,
                'Password'=>$request->Password,
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
