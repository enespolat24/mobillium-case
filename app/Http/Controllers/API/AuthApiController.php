<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['The provided credentials are incorrect.'],
            ], 500);
        }

        $userToken = $user->createToken('api-token')->plainTextToken;

        return response(['token' => $userToken], 200);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        $user->assignRole('reader');
        $token = $user->createToken('authToken')->plainTextToken;
        Cache::put('user_api_token_', $token, 60);

        return response()->json(['token' => $token, 'message' => 'User registered successfully'], 201);
    }

    public function getToken()
    {
        if (Cache::has('user_api_token_'.Auth::user()->id)) {
            return response()->json(['token' => Cache::get('user_api_token_'.Auth::user()->id), 'message' => 'this is your token'], 201);
        } else {
            $user = auth()->user();
            $token = $user->createToken('authToken')->plainTextToken;
            Cache::put('user_api_token_'.$user->id, $token, 60);

            return response()->json(['token' => $token, 'message' => 'Token generated successfully'], 201);
        }

    }
}
