<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostPublishionApiController extends Controller
{
    public function publish(Request $request)
    {
        $request->validate([
            'post_id' => 'required',
        ]);

        $post = Post::find($request->post_id);
        $post->is_published = true;
        $post->save();

        return response()->json(['message' => 'Post published successfully'], 201);
    }

    public function unpublish(Request $request)
    {
        $request->validate([
            'post_id' => 'required',
        ]);

        $post = Post::find($request->post_id);
        $post->is_published = false;
        $post->save();

        return response()->json(['message' => 'Post unpublished successfully'], 201);
    }
}
