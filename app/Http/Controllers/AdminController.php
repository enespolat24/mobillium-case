<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/index', [
            'posts' => Post::with('votes', 'author')->paginate(6),
        ]);
    }

    public function editPosts(Post $post)
    {

        return Inertia::render('Admin/editPost', [
            'post' => $post,
        ]);
    }
}