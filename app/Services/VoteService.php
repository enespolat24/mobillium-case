<?php

namespace App\Services;

use App\Models\Post;

class VoteService
{
    public function vote($rating, $user, $postId)
    {
        $post = Post::findOrFail($postId);

        // Check if the user has already voted for this post
        if ($user->votes()->where('post_id', $postId)->count() === 0) {
            $post->votes()->create([
                'user_id' => $user->id,
                'rating' => $rating,
            ]);
        }

        // Calculate the weighted average
        $votes = $post->votes;
        $totalVotes = $votes->count();
        $last30PercentVotes = $votes->sortByDesc('created_at')->take(ceil(0.3 * $totalVotes));
        $remaining70PercentVotes = $votes->diff($last30PercentVotes);

        $weightedAverage = (
            ($last30PercentVotes->avg('rating') * 2 * $last30PercentVotes->count()) +
            ($remaining70PercentVotes->avg('rating') * $remaining70PercentVotes->count())
        ) / ($last30PercentVotes->count() * 2 + $remaining70PercentVotes->count());

        // Update the post's weighted average
        $post->weighted_average = $weightedAverage;
        $post->save();

        return redirect()->route('posts.show', $postId);
    }
}
