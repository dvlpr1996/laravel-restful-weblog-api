<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition()
    {
        return [
            'body' => fake()->sentences(2, true),
            'email' => fake()->email(),
            'author' => fake()->name(),
            'post_id' => Post::first(),
            'reply_of' => 0,
        ];
    }
}
