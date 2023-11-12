<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostVotes;
use App\Services\VoteService;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    private $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    public function vote(Request $request, Post $post)
    {
        $this->authorize('vote', [PostVotes::class, $post]);

        $this->voteService->castVote($post, $request->rating);

    }
}
