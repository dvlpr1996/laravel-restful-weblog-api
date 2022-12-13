<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    public function definition()
    {
        $likeable = $this->likeable();
        return [
            'likeable_type' => $likeable,
            'likeable_id' => $likeable::factory(),
            'vote' => mt_rand(0, 10)

        ];
    }

    private function likeable()
    {
        return fake()->randomElement([
            Post::class,
            Comment::class
        ]);
    }
}
