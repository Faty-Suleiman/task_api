<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    // To register user
public function register(Request $request)
    { 
        // is to validate user
    $request->validate([
        'name' => 'required|string',
        'email'=>'required|string|unique:users',
        'password'=>'required|string',
        
    ]);
    // to create user
    $user = User::create([
       'name' => $request->name,
       'email' => $request->email,
       'password' => $Hash::make($request->password),
    ]);
    if($user){
        // to check if it is user
         $tokenResult = $user->createToken('Personal Access Token');
         $token = $tokenResult;
         
         return response()->json([
            'message' => 'Successfully created user!',
            'accessToken'=> $token,
            ],201);
        }
        else{
            return response()->json(['error'=>'Provide proper details']);
        }
    }


public function login(Request $request)
{
    // to validate user login 
    $request->validate([
    'email' => 'required|string|email',
    'password' => 'required|string',
    
    ]);
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('personal access token')->accessToken;
        return response()->json(['token' => $token, 'token_type'=> 'Bearer'], 200);
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}

}
