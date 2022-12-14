<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition()
    {
        return [
            'body' => fake()->sentences(10, true),
            'slug' => fake()->slug(2),
            'title' => fake()->sentence(10, true),
            'user_id' => User::first() ?? User::factory(),
            'summary' => fake()->sentence(5,true),
            'tags' => fake()->word(),
            'category_id' => Category::first() ?? Category::factory()
        ];
    }
}
