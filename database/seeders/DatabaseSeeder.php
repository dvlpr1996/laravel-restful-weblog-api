<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\LikeSeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            ImageSeeder::class,
            LikeSeeder::class
        ]);
    }
}
