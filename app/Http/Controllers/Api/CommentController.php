<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResourse;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/comments",
     *     tags={"Comments"},
     *     summary="Get comments list",
     *     @OA\Response(response="200", description="Success", @OA\JsonContent()),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return CommentResourse::collection(Comment::paginate(20));
    }

    /**
     * @OA\Post(
     *     path="/posts/{post}/comments/{comment?}",
     *     summary="Create new comment",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="text",
     *         in="query",
     *         description="Comment text",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(response=201, description="Successful created", @OA\JsonContent()),
     *     @OA\Response(response="400", description="You can`t comment unpublished posts", @OA\JsonContent()),
     * )
     */
    public function store(StoreCommentRequest $request, int $postId, ?int $parentId = null): JsonResponse
    {
        $post = Post::find($postId);
        if (!$post->is_published) {
            return response()->json(['message' => 'You can`t comment unpublished posts'], 400);
        }
        $validated = $request->validated();
        $validated['author_id'] = \Auth::user()->id;
        $validated['post_id'] = $postId;
        $validated['parent_id'] = $parentId;
        Comment::create($validated);

        return response()->json(['message' => 'Successful created']);
    }
}
