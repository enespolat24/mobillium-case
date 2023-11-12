<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class VotePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function vote(User $user, Post $post)
    {
        // Check if the user has already voted on this post
        return ! $user->votes()->where('post_id', $post->id)->exists();
    }
}
