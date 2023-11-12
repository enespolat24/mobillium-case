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
        return $user->can('update_posts') || ($user->is($post->author));
    }

    /**
     * @return bool
     */
    public function delete(User $user, Post $post)
    {
        return $user->can('delete_posts') || ($user->is($post->author));
    }

    /**
     * @return bool
     */
    public function publish(User $user)
    {
        return $user->can('publish_posts');
    }

    /**
     * @return bool
     */
    public function unpublish(User $user)
    {
        return $user->can('unpublish_posts');
    }
}
