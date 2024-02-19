<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Post(
 *     path="/api/register",
 *     summary="Register a new user",
 *     tags={"Auth"},
 *     @OA\Parameter(
 *         name="login",
 *         in="query",
 *         description="User's login",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="email",
 *         in="query",
 *         description="User's email",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="password",
 *         in="query",
 *         description="User's password",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(response="201", description="User registered successfully"),
 *     @OA\Response(response="422", description="Validation errors")
 * )
 */
class RegisterController extends Controller
{
    public function save(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);
        if ($user) {
            Auth::loginUsingId($user->id);
            return response()->json(['message' => 'User registered successfully'], 201);
        }
        return response()->json(['message' => 'Error saving user'], 422);
    }
}
