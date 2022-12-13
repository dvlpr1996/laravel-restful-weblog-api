<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    public function definition()
    {
        return [
            'path' => 'https://loremflickr.com/'
                . mt_rand(0, 500) . '/' . mt_rand(0, 500) .
                '/world?random=' . fake()->randomNumber(),
            'post_id' => Post::first(),
        ];
    }
}
