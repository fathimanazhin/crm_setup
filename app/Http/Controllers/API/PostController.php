<?php

namespace App\Http\Controllers\API;

use OpenApi\Annotations as OA;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class PostController extends Controller
{
    protected function sendResponse($data, $message = "", $status = 200) {
    return response()->json([
        'success' => true,
        'message' => $message,
        'data' => $data,
        'status_code' => $status
    ], $status);
}

protected function sendError($message, $status = 400, $data = null) {
    return response()->json([
        'success' => false,
        'message' => $message,
        'data' => $data,
        'status_code' => $status
    ], $status);
}


/**
 * @OA\Get(
 *     path="/api/posts",
 *     tags={"Posts"},
 *     summary="Get all posts",
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Success"
 *     )
 * )
 */
    // List all posts with pagination
   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    $user = Auth::user();

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'token' => $token
    ]);
}

    // Store a new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return new PostResource($post);
    }

    // Show a single post
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return new PostResource($post);
    }

    // Update a post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $post->update($request->only(['title', 'content']));
        return new PostResource($post);
    }

    // Delete a post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}