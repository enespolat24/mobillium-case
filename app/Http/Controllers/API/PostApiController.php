<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Cache::has('posts')) {
            return Cache::get('posts');
        } else {
            $posts = Post::with('author')->get();
            Cache::put('posts', $posts, 60);

            return $posts;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validated();
            $post = Post::create($validatedData);
            Cache::put('posts_'.$post->id, $post, 60);

            return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Post creation failed', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Cache::has('posts_'.$id)) {
            return Cache::get('posts_'.$id);
        } else {
            $post = Post::with('author')->findOrFail($id);
            Cache::put('posts_'.$id, $post, 60);

            return $post;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validated();
            $post = Post::findOrFail($id);
            $post->update($validatedData);
            Cache::forget('posts_'.$post->id);
            Cache::put('posts_'.$post->id, $post, 60);

            return response()->json(['message' => 'Post updated successfully', 'post' => $post], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Post update failed', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            Cache::forget('posts_'.$post->id);

            return response()->json(['message' => 'Post deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Post deletion failed', 'error' => $e->getMessage()], 500);
        }
    }
}
