<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function edit(Post $post)
    {
        $post->fill([
            'title' => request('title'),
            'content' => request('content'),
            'is_published' => request('is_published') ? true : false,
        ])->save();

        return redirect()->route('admin.posts.edit', $post->slug);
    }

    public function view(Post $post)
    {
        $post->view_count += 1;
        $post->save();

        return Inertia::render('Posts/show', [
            'post' => $post->load('author', 'votes'),
        ]);

    }

    public function destroy(Post $post)
    {
        $post->delete();
    }
}
