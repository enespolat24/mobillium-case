<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class AuthorController extends Controller
{
    public function index()
    {
        return Inertia::render('Author/index', [
            'posts' => Post::Where('author_id', auth()->user()->id)->with(['author'])->get(),
        ]);
    }

    public function show()
    {
        // return Inertia::render('Author/Show');
        return 'e';
    }
}
