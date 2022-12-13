<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->word(),
            'slug' => fake()->slug(2, true)
        ];
    }
}
