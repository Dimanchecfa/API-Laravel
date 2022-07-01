<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //inscription
    public function register(Request $request) {
        $validateData= $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' =>  'required|string|email|max:255|unique:user',
            'password' =>  'required|string|min:8'
        ]);

            $user= User::create([
                'nom' =>$validateData['nom'],
                'prenom' =>$validateData['prenom'],
                'email' =>$validateData['email'],
                'password' =>Hash::make($validateData['password'])
            ]);
    $token = $user->createToken('auth_token')->PlainTextToken;

    return response()->json([
        'acces_token'=> $token ,
        'token_type' => 'Bearer',
    ]);
    

    }

//connexion
        
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Email ou mot de passe incorrect '
            ], 401);
        }

            $user = User::where('email', $request['email'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            ]);
    }

    //recuperation de l'utilisateur connecté en temps reel
    public function me(Request $request)
    {
        return $request->user();
    }


}
