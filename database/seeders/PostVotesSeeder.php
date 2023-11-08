<?php

namespace Database\Seeders;

use Database\Factories\PostVotesFactory;
use Illuminate\Database\Seeder;

class PostVotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostVotesFactory::new()->count(100)->create()->each(function ($postVote) {
            $postVote->user->assignRole('author');
        });
    }
}
