<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        //Create the token
        $token =  $user->createToken('movie.token')->plainTextToken;
        $response = [
            'message' => 'You have been registered and logged in successfully',
            'user' => $user,
            'token' => $token
        ];

        //Return the response
        return response($response , 201);
    }

    public function login(Request $request){
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
            
        if(Auth::attempt($data)){
            //Regenerate session
            // $request->session()->regenerate();

            $token = Auth::user()->createToken('movie.token')->plainTextToken;
            return response()->json([
                "message" => "You have been logged in successfully",
                "user" => Auth::user(),
                "token" => $token
            ], 201);
        } else{
            return response()->json("Credentials do not match." , 401);
        }

        
    }

    public function logout(Request $request){
        Auth::user()->tokens()->delete();

        return response()->json("You have been logged out successfully." , 205);
    }


}
