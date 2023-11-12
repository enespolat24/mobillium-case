<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostVotes;

class VoteService
{
    /**
     * @return void
     */
    public function castVote(Post $post, $userVote)
    {
        PostVotes::create([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
            'rating' => $userVote,
        ]);

        $weightedScore = $this->calculateWeightedScore($post);

        $post->rating = $weightedScore;
        $post->save();
    }

    public function calculateWeightedScore($post)
    {
        $allVotes = $post->votes;
        $totalVotes = $allVotes->count();

        $effectivePercentage = 0.3;
        $weightOfLastVotes = 2;

        $lastVotesCount = (int) ($totalVotes * $effectivePercentage);

        $sortedVotes = $allVotes->sortBy('created_at');

        $lastVotes = $sortedVotes->slice(-$lastVotesCount);

        $firstVotes = $sortedVotes->slice(0, $totalVotes - $lastVotesCount);

        $weightedResult = ($firstVotes->count() + ($weightOfLastVotes * $lastVotes->count())) / $totalVotes;

        return $weightedResult;
    }
}
