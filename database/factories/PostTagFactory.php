<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostTagFactory extends Factory
{
    public function definition()
    {
        return [
            'post_id' => Post::first(),
            'tag_id' => Tag::first()
        ];
    }
}
