<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/index', [
            'posts' => Post::with('votes', 'author')->paginate(6),
        ]);
    }

    public function edit(Post $post)
    {
        $post->fill([
            'title' => request('title'),
            'content' => request('content'),
            'is_published' => request('is_published') ? true : false,
        ])->save();

        return Inertia::render('Admin/editPost', [
            'post' => $post,
        ]);
    }
}
