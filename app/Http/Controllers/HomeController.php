<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        if (Cache::has('posts')) {
            $posts = Cache::get('posts');
        } else {
            $posts = Post::with(['author', 'votes'])->paginate(6);
            Cache::put('posts', $posts, 60);
        }

        return Inertia::render('Home', [
            'posts' => $posts,
        ]);
    }
}
