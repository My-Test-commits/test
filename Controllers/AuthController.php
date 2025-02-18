<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'patronymic' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:3',
            'birth_date' => 'required|date',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);
        return response()->json(['data' => [
            'user' => [
                'name' => "$user->last_name $user->first_name $user->patronymic",
                'email' => $user->email
            ],
            'code' => 201,
            'message' => 'Пользователь создан'
        ]], 201);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Login failed'], 403);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => "$user->last_name $user->first_name $user->patronymic",
                    'birth_date' => $user->birth_date,
                    'email' => $user->email
                ],
                'token' => $token
            ]
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([], 204);
    }
}
