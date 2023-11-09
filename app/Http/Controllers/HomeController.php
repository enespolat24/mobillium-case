<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'posts' => Post::with(['author', 'votes'])->paginate(6),
        ]);
    }
}
