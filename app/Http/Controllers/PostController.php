<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostController extends Controller
{
    public function createPage()
    {
        return Inertia::render('Post/create');
    }

    public function create()
    {
        $this->authorize('create', Post::class);

        Post::create(
            [
                'title' => request('title'),
                'content' => request('content'),
                'user_id' => Auth::user()->id,
            ]
        );
    }

    public function edit(Post $post)
    {
        $post->fill([
            'title' => request('title'),
            'content' => request('content'),
            'is_published' => request('is_published') ? true : false, //just in case
        ])->save();

        return redirect()->route('admin.posts.edit', $post->slug);
    }

    public function view(Post $post)
    {
        $post->view_count += 1;
        $post->save();

        $PrevPost = Post::where('id', '<', $post->id)->orderBy('id', 'desc')->first();
        $nextPost = Post::where('id', '>', $post->id)->orderBy('id')->first();

        return Inertia::render('Post/show', [
            'post' => $post->load('author', 'votes'),
            'prevPost' => $PrevPost,
            'nextPost' => $nextPost,
        ]);

    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
    }
}
