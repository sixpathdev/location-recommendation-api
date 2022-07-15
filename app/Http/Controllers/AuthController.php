<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use Exception;

class AuthController extends Controller
{
    public function registerUser(StoreUserRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['password']);
            $user = User::create($validated);

            return response()->json(['message' => 'Registration successful'], 201);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function login(LoginUserRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request['password'], $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $token = $user->createToken($request->email)->plainTextToken;
            return response()->json(['message' => 'Login successful', 'user' => $user, 'token' => $token], 200);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logout success', 'statusCode' => app('Illuminate\Http\Response')->status()], 200);
    }
}
