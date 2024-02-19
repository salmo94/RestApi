<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/posts",
     *     tags={"Posts"},
     *     summary="Get posts list with pagination",
     *     @OA\Response(response="200", description="Success", @OA\JsonContent()),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::where('is_published', Post::STATUS_PUBLISHED)->paginate(10));
    }

    /**
     * @OA\Post(
     *     path="/api/posts",
     *     summary="Create new post",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Post's title",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="content",
     *         in="query",
     *         description="Post's content",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(response=201, description="Successful created", @OA\JsonContent()),
     *     @OA\Response(response="422", description="Unprocessable Content", @OA\JsonContent()),
     * )
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $validated['author_id'] = Auth::user()->id;
        Post::create($validated);

        return response()->json(['message' => 'Successful created']);
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{post}",
     *     tags={"Posts"},
     *     summary="Get post with comments",
     * @OA\Parameter(
     *         name="post",
     *         in="query",
     *         description="Post id",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Success", @OA\JsonContent()),
     *     @OA\Response(response="400", description="Such a post does not exist or it is unpublished", @OA\JsonContent()),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function show(string $id): PostResource
    {
        return new PostResource(Post::where('is_published', Post::STATUS_PUBLISHED)
            ->with('comments')
            ->findOrFail($id));
    }

    /**
     * @OA\Put(
     *     path="/api/posts/{post}",
     *     summary="Update post",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Post's title",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="content",
     *         in="query",
     *         description="Post's content",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(response=200, description="Updated", @OA\JsonContent()),
     *     @OA\Response(response="400", description="You can`t update published posts", @OA\JsonContent()),
     * )
     */
    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        $this->authorize('update', $post);
        if ($post->is_published) {
            return response()->json(['message' => 'You can`t update published posts'], 400);
        }
        $validated = $request->validated();
        $post->updateOrFail($validated);

        return response()->json(['message' => 'Updated']);
    }

    /**
     * @OA\Delete(
     *     path="/api/posts/{post}",
     *     tags={"Posts"},
     *     summary="Delete post",
     *     @OA\Response(response="200", description="Deleted", @OA\JsonContent()),
     *     @OA\Response(response="400", description="You can`t delete published posts", @OA\JsonContent()),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        $post = Post::findOrFail($id);
        $this->authorize('delete', [$post, auth()->user()]);
        if ($post->is_published) {
            return response()->json(['message' => 'You can`t delete published posts'], 400);
        }
        $post->delete();
        return response()->json(['message' => 'Deleted']);
    }

    /**
     * @OA\Put(
     *     path="api/posts/publish/{post}",
     *     summary="Change the post status",
     *     tags={"Posts"},
     *     @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     * )
     */
    public function publish(int $id): JsonResponse
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);
        $post->is_published = !$post->is_published;
        $post->save();

        return response()->json(['message' => 'Successful']);
    }
}
