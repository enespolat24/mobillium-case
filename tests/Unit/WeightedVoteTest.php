<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use App\Services\VoteService;
use Tests\TestCase;

use function Pest\Laravel\post;

class WeightedVoteTest extends TestCase
{
    public function testUpdatePostRating()
    {
        // Create a sample post
        $post = Post::factory()->create();
        //99 times rating of 1 and one 2
        for ($i = 0; $i < 100; $i++) {
            $post->votes()->create([
                'rating' => 1,
                'user_id' => User::factory()->create()->id,
                'post' => $post->id,
            ]);
        }

        $voteService = new VoteService();

        $serviceOutcome = $voteService->calculateWeightedScore($post);

        $this->assertEquals(1.3, $serviceOutcome);
    }
}
