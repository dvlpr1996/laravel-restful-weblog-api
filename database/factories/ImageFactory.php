<?php

namespace Database\Factories;

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
            'user_id' => User::first(),
        ];
    }
}
