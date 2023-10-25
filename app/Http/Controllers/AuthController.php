<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    
    // To register user
public function register(Request $request)
    { 
        
        // is to validate user
    $request->validate([
        'surname' => 'required|string',
        'otherNames' => 'required|string',
        'email'=>'required|string|unique:users',
        'password'=>'required|string',
        'phone' => 'required|string|unique:users'
    ]);
    // to create user


    $hashedPassword = Hash::make($request->input('password'));

    // Create a new user
    $user = User::create([
        'surname' => $request->input('surname'),
        'otherNames' => $request->input('otherNames'),
        'email' => $request->input('email'),
        'password' => $hashedPassword,
        'phone'=> $request->input('phone')
    ]);

    
    if($user){
        // to check if it is user
         $tokenResult = $user->createToken('Personal Access Token')->plainTextToken;
         
         return response()->json([
            'message' => 'Successfully created user!',
            'accessToken'=> $tokenResult,
            ],201);
        }
        else{
            return response()->json(['error'=>'Something went wrong!'],401);
        }
   }


public function login(Request $request) // to create a login for a user
{
    // to validate user login 
    $request->validate([
    'email' => 'required|string|email',
    'password' => 'required|string',
    
    ]);
    
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $expirationTime = 3600; // 1 hour 
        $token = $user->createToken('Personal Access Token')->plainTextToken;
        return response()->json(['token' => $token, "data" =>$user, 'token_type'=> 'Bearer', 'expires_in'=> $expirationTime], 200);
    } else {
       return response()->json(['error' => 'Unauthorized'], 401);
    }
 }

}  