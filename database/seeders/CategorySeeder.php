<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'programming' => [
                'slug' => Str::slug('programming')
            ],
            'technology' => [
                'slug' => Str::slug('technology')
            ],
            'science' => [
                'slug' => Str::slug('science')
            ],
            'review' => [
                'slug' => Str::slug('review')
            ]
        ];

        foreach ($categories as $key => $value) {
            Category::create([
                'name' => $key,
                'slug' => $value['slug']
            ]);
        }
    }
}
