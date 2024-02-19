<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Get users list with pagination",
     *     @OA\Response(response=201, description="Successful", @OA\JsonContent()),
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::paginate(20));
    }

    /**
     * @OA\Get(
     *     path="/api/users/{user}",
     *     tags={"Users"},
     * @OA\Parameter(
     *         name="user",
     *         in="query",
     *         description="User id",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     summary="Get user info",
     *     @OA\Response(response="200", description="Success", @OA\JsonContent()),
     *     @OA\Response(response="404", description="User not found", @OA\JsonContent()),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function show(int $id): UserResource|JsonResponse
    {
        $user = User::find($id);
        if ($user === null) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return new UserResource($user);
    }

    /**
     * @OA\Put(
     *     path="/users/block/{user}",
     *     summary="Block user",
     *     tags={"Users"},
     *     @OA\Response(response=201, description="User is blocked", @OA\JsonContent()),
     *     @OA\Response(response="404", description="User not found", @OA\JsonContent()),
     *     @OA\Response(response="403", description="Unauthorized", @OA\JsonContent()),
     * )
     */
    public function block(int $id)
    {
        if (!\Auth::user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        /**
         * @var User $user
         */
        $user = User::find($id);
        if ($user === null) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->setAttribute('status', User::STATUS_BLOCKED);
        $user->save();

        return response()->json(['message' => "User $id is blocked"]);
    }
}
