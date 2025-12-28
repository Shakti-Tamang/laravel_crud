<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    //

    public function login(Request $request)
    {
        // 1. Validate
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

 
        $user = User::where('email', $validated['email'])->first();


        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return $this->errorResponse('Provided credentials are incorrect.', 401);
        }

        // 4. Create token (use a descriptive name, not user role)
        $token = $user->createToken('auth_token')->plainTextToken;

        // 5. Return success with token
        return $this->successResponse([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ],
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 'Login successful');
    }

public function getById(Request $request, $id)
{
    $currentUser = $request->user();
    
    if (!$currentUser) {
        return $this->errorResponse('User not authenticated', 401); // Changed to 401
    }

    $user = User::find($id);
    
    // Check if user exists
    if (!$user) {
        return $this->errorResponse('User not found', 404);
    }

    // Optional: Authorization check (user can only view own profile unless admin)
    if ($currentUser->id != $user->id && $currentUser->role !== 'admin') {
        return $this->errorResponse('Forbidden: You can only view your own profile', 403);
    }

    return $this->successResponse([
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role
        ],
    ], 'Successfully retrieved by id', 200);
}

}
