<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Authenticate user and generate token",
     *     tags={"Auth"},
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
     *
     *     @OA\Response(response=201, description="Successful login", @OA\JsonContent()),
     *     @OA\Response(response=402, description="User is blocked", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Invalid credentials", @OA\JsonContent()),
     * )
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if (Auth::user()->status == User::STATUS_ACTIVE) {
                $token = $user->createToken('Token Name')->plainTextToken;
                return response()->json(['token' => $token]);
            }
            return response()->json(['message' => 'User is blocked'], 401);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Auth"},
     *     summary="Authenticate user and remove token",
     *     @OA\Response(response=201, description="Successful created", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Invalid credentials"),
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
