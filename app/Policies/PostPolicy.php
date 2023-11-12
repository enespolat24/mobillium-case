<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasRole('author');
    }

    /**
     * @return bool
     */
    public function update(User $user, Post $post)
    {
        return $user->hasRole('moderator') || ($user->hasRole('author') && $user->id === $post->user_id) || $user->hasRole('admin');
    }

    /**
     * @return bool
     */
    public function delete(User $user, Post $post)
    {
        return ($user->hasRole('author') && $user->id === $post->user_id) || $user->hasRole('admin');
    }

    /**
     * @return bool
     */
    public function publish(User $user)
    {
        return $user->hasRole('moderator') || $user->hasRole('admin');
    }
}
