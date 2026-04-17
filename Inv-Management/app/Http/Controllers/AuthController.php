<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register (Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);
    }

     public function login (Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = USer::where('email', $request->email)->first();

        if (! $user || ! Hash::check ($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['incorect'],

            ])
        }

    }


    
}
